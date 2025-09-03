<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = auth()->user()->role ?? null;
        if ($role === 'admin') return redirect()->route('dashboard.admin');
        if ($role === 'staff') return redirect()->route('dashboard.staff');
        if ($role === 'tenant') return redirect()->route('dashboard.tenant');
        abort(403);
    }

    public function admin()
    {
        abort_unless(Gate::allows('view-admin-dashboard'), 403);
        return view('dashboard.admin');
    }

    public function staff()
    {
        abort_unless(Gate::allows('view-staff-dashboard'), 403);
        return view('dashboard.staff');
    }

    public function tenant()
    {
        abort_unless(Gate::allows('view-tenant-dashboard'), 403);
        return view('dashboard.tenant');
    }
}
