<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\TenantProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (! Gate::allows('manage-tenants')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = User::with(['tenantProfile', 'activeAssignment.room'])
            ->where('role', 'tenant');

        if ($search = $request->string('q')->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($room = $request->string('room')->toString()) {
            $query->whereHas('activeAssignment.room', function ($q) use ($room) {
                $q->where('number', 'like', "%{$room}%");
            });
        }

        $tenants = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('tenants.index', compact('tenants'));
    }

    public function edit(User $tenant)
    {
        if ($tenant->role !== 'tenant') abort(404);
        $tenant->load(['tenantProfile', 'activeAssignment.room']);
        $rooms = Room::orderBy('number')->get();
        return view('tenants.edit', compact('tenant', 'rooms'));
    }

    public function update(Request $request, User $tenant)
    {
        if ($tenant->role !== 'tenant') abort(404);
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email,' . $tenant->id],
            'phone' => ['nullable','string','max:50'],
            'address' => ['nullable','string','max:255'],
            'emergency_contact' => ['nullable','string','max:255'],
            'move_in_date' => ['nullable','date'],
        ]);

        $tenant->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        $profile = $tenant->tenantProfile ?: new TenantProfile(['user_id' => $tenant->id]);
        $profile->fill([
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'emergency_contact' => $data['emergency_contact'] ?? null,
            'move_in_date' => $data['move_in_date'] ?? null,
        ]);
        $tenant->tenantProfile()->save($profile);

        return redirect()->route('tenants.edit', $tenant)->with('status', 'Tenant profile updated.');
    }
}
