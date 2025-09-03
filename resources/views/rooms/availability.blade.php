@extends('layouts.app')

@section('content')
<div class="agoda-hero mb-6">
    <h1 class="text-2xl font-semibold">Find your perfect room</h1>
    <p class="opacity-90">Explore currently available rooms at Areja Boarding House.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse ($rooms as $room)
        <div class="agoda-card overflow-hidden">
            <div class="agoda-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-lg font-semibold">Room {{ $room->number }}</div>
                    <span class="agoda-badge agoda-badge-success">Available</span>
                </div>
                @if($room->type)
                    <p class="text-gray-600 mb-2">Type: {{ $room->type }}</p>
                @endif
                <p class="text-gray-600">Capacity: {{ $room->capacity }}</p>
            </div>
        </div>
    @empty
        <div class="agoda-card p-6">No rooms currently available.</div>
    @endforelse
</div>
<div class="mt-4">{{ $rooms->links() }}</div>
@endsection
