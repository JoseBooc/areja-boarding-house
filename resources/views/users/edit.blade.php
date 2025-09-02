@extends('layouts.app')

@section('content')
<div class="max-w-2xl agoda-card p-6">
    <h2 class="text-xl font-semibold agoda-text-primary mb-4">Edit User</h2>
    <form action="{{ route('users.update', $user) }}" method="POST" class="grid grid-cols-1 gap-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" class="agoda-input mt-1" required value="{{ old('name', $user->name) }}">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="agoda-input mt-1" required value="{{ old('email', $user->email) }}">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" class="agoda-input mt-1" required>
                @foreach ($roles as $role)
                    <option value="{{ $role }}" @selected(old('role', $user->role)===$role)>{{ ucfirst($role) }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="password" class="agoda-input mt-1">
                <p class="text-xs text-gray-500 mt-1">Leave blank to keep current password</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" class="agoda-input mt-1">
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-2">
            <a href="{{ route('users.index') }}" class="agoda-btn-accent">Cancel</a>
            <button class="agoda-btn-primary">Save Changes</button>
        </div>
    </form>
</div>
@endsection
