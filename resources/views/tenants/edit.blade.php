@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="agoda-card p-6">
        <h2 class="text-xl font-semibold agoda-text-primary mb-4">Edit Tenant Profile</h2>
        <form action="{{ route('tenants.update', $tenant) }}" method="POST" class="grid grid-cols-1 gap-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" class="agoda-input mt-1" required value="{{ old('name', $tenant->name) }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="agoda-input mt-1" required value="{{ old('email', $tenant->email) }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" class="agoda-input mt-1" value="{{ old('phone', optional($tenant->tenantProfile)->phone) }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" class="agoda-input mt-1" value="{{ old('address', optional($tenant->tenantProfile)->address) }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Emergency Contact</label>
                <input type="text" name="emergency_contact" class="agoda-input mt-1" value="{{ old('emergency_contact', optional($tenant->tenantProfile)->emergency_contact) }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Move-in Date</label>
                <input type="date" name="move_in_date" class="agoda-input mt-1" value="{{ old('move_in_date', optional(optional($tenant->tenantProfile)->move_in_date)->format('Y-m-d')) }}">
            </div>
            <div class="flex justify-end gap-3 mt-2">
                <a href="{{ route('tenants.index') }}" class="agoda-btn-accent">Back</a>
                <button class="agoda-btn-primary">Save</button>
            </div>
        </form>
    </div>
    <div class="agoda-card p-6">
        <h2 class="text-xl font-semibold agoda-text-primary mb-4">Room Assignment</h2>
        <div class="mb-4">
            <p class="text-gray-700">Current Room: <span class="font-medium">{{ optional(optional($tenant->activeAssignment)->room)->number ?? 'None' }}</span></p>
        </div>
        <a href="{{ route('tenants.assign.form', $tenant) }}" class="agoda-btn-accent">Assign or Change Room</a>
    </div>
</div>
@endsection
