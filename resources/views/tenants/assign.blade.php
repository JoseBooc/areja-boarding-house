@extends('layouts.app')

@section('content')
<div class="max-w-2xl agoda-card p-6">
    <h2 class="text-xl font-semibold agoda-text-primary mb-4">Assign/Change Room for {{ $tenant->name }}</h2>
    <form action="{{ route('tenants.assign', $tenant) }}" method="POST" class="grid grid-cols-1 gap-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Available Rooms</label>
            <select name="room_id" class="agoda-input mt-1" required>
                <option value="" disabled selected>Select a room</option>
                @foreach ($availableRooms as $room)
                    <option value="{{ $room->id }}">#{{ $room->number }} @if($room->type) ({{ $room->type }}) @endif</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" name="start_date" class="agoda-input mt-1" value="{{ now()->toDateString() }}">
        </div>
        <div class="flex justify-end gap-3 mt-2">
            <a href="{{ route('tenants.edit', $tenant) }}" class="agoda-btn-accent">Cancel</a>
            <button class="agoda-btn-primary">Save Assignment</button>
        </div>
    </form>
</div>
@endsection
