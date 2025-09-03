@extends('layouts.app')

@section('content')
<div class="agoda-hero mb-6">
    <h1 class="text-2xl font-semibold">Admin Dashboard</h1>
    <p class="opacity-90">Manage tenants, rooms, and system users.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <a href="{{ route('tenants.index') }}" class="agoda-card p-6 block hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold mb-2">Manage Tenants</h2>
        <p class="text-gray-600">Filter, edit, and manage tenant profiles.</p>
    </a>
    <a href="{{ route('rooms.availability') }}" class="agoda-card p-6 block hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold mb-2">Room Availability</h2>
        <p class="text-gray-600">View currently available rooms.</p>
    </a>
    <a href="{{ route('rooms.repairs') }}" class="agoda-card p-6 block hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold mb-2">Repairs</h2>
        <p class="text-gray-600">Rooms marked as needing maintenance.</p>
    </a>
    <a href="{{ route('users.index') }}" class="agoda-card p-6 block hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold mb-2">Users</h2>
        <p class="text-gray-600">Create and manage user accounts and roles.</p>
    </a>
</div>
@endsection
