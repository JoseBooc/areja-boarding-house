@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold agoda-text-primary">Tenants</h1>
    <div class="flex gap-2">
        <a href="{{ route('users.create') }}" class="agoda-btn-accent">New Tenant</a>
    </div>
</div>
<form method="GET" action="{{ route('tenants.index') }}" class="agoda-card p-4 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Search</label>
            <input type="text" name="q" value="{{ request('q') }}" class="agoda-input mt-1" placeholder="Name or email">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Room</label>
            <input type="text" name="room" value="{{ request('room') }}" class="agoda-input mt-1" placeholder="e.g., 101">
        </div>
        <div class="flex items-end">
            <button class="agoda-btn-primary">Filter</button>
        </div>
    </div>
</form>
<div class="agoda-card overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($tenants as $t)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $t->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $t->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ optional(optional($t->activeAssignment)->room)->number ?? '—' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('tenants.edit', $t) }}" class="agoda-link mr-3">Edit</a>
                        <a href="{{ route('tenants.assign.form', $t) }}" class="agoda-link">Assign/Change Room</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $tenants->links() }}</div>
@endsection
