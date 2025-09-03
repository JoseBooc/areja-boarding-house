@extends('layouts.app')

@section('content')
<div class="agoda-hero mb-6">
    <h1 class="text-2xl font-semibold">Tenant Dashboard</h1>
    <p class="opacity-90">Quick access to your payments and dues.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <a href="{{ route('tenant.utilities') }}" class="agoda-card p-6 block hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold mb-2">Utility Payments</h2>
        <p class="text-gray-600">View and manage your utility payments.</p>
    </a>
    <a href="{{ route('tenant.rent') }}" class="agoda-card p-6 block hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold mb-2">Rent Due</h2>
        <p class="text-gray-600">See current rent and due dates.</p>
    </a>
</div>
@endsection
