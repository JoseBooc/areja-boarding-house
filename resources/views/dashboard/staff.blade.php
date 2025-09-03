@extends('layouts.app')

@section('content')
<div class="agoda-hero mb-6">
    <h1 class="text-2xl font-semibold">Staff Dashboard</h1>
    <p class="opacity-90">Maintenance and room tasks.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <a href="{{ route('rooms.repairs') }}" class="agoda-card p-6 block hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold mb-2">Rooms Needing Repairs</h2>
        <p class="text-gray-600">View rooms flagged for maintenance.</p>
    </a>
</div>
@endsection
