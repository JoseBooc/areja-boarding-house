<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomAssignment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (! Gate::allows('assign-rooms')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function assignForm(User $tenant)
    {
        if ($tenant->role !== 'tenant') abort(404);
        $tenant->load('activeAssignment.room');
        $availableRooms = Room::available()->orderBy('number')->get();
        return view('tenants.assign', compact('tenant', 'availableRooms'));
    }

    public function assign(Request $request, User $tenant)
    {
        if ($tenant->role !== 'tenant') abort(404);

        $data = $request->validate([
            'room_id' => ['required','exists:rooms,id'],
            'start_date' => ['nullable','date']
        ]);
        $startDate = $data['start_date'] ?? Carbon::today()->toDateString();

        $room = Room::findOrFail($data['room_id']);
        if ($room->needs_repair || $room->status !== 'available' || $room->activeAssignment) {
            return back()->withErrors('Selected room is not available.');
        }

        $current = $tenant->activeAssignment;
        if ($current) {
            $current->end_date = Carbon::today()->toDateString();
            $current->save();
            $current->room->update(['status' => 'available']);
        }

        RoomAssignment::create([
            'user_id' => $tenant->id,
            'room_id' => $room->id,
            'start_date' => $startDate,
        ]);

        $room->update(['status' => 'occupied']);

        return redirect()->route('tenants.edit', $tenant)->with('status', 'Room assignment saved.');
    }
}
