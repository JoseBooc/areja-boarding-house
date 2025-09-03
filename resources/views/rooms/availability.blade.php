@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold agoda-text-primary">Available Rooms</h1>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse ($rooms as $room)
        <div class="agoda-card p-4">
            <div class="flex items-center justify-between mb-2">
                <div class="text-lg font-semibold">Room {{ $room->number }}</div>
                <span class="px-2 py-0.5 rounded text-xs bg-green-100 text-green-800">Available</span>
            </div>
            @if($room->type)
                <p class="text-gray-600 mb-2">Type: {{ $room->type }}</p>
            @endif
            <p class="text-gray-600">Capacity: {{ $room->capacity }}</p>
        </div>
    @empty
        <div class="agoda-card p-6">No rooms currently available.</div>
    @endforelse
</div>
<div class="mt-4">{{ $rooms->links() }}</div>
@endsection
