@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold agoda-text-primary">Rooms Needing Repairs</h1>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse ($rooms as $room)
        <div class="agoda-card p-4">
            <div class="text-lg font-semibold mb-1">Room {{ $room->number }}</div>
            @if($room->type)
                <p class="text-gray-600 mb-1">Type: {{ $room->type }}</p>
            @endif
            <p class="text-gray-600 mb-1">Status: {{ ucfirst($room->status) }}</p>
            <p class="text-red-600">Marked as needing repair</p>
        </div>
    @empty
        <div class="agoda-card p-6">No rooms are currently marked for repairs.</div>
    @endforelse
</div>
<div class="mt-4">{{ $rooms->links() }}</div>
@endsection
