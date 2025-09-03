@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center">
<div class="max-w-md mx-auto agoda-card p-6">
    <h1 class="text-2xl font-semibold agoda-text-primary mb-4">Sign in</h1>
    <p class="text-gray-600 mb-6">Admin access required to manage users.</p>
    <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" class="agoda-input mt-1" required autocomplete="email" value="{{ old('email') }}" />
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" name="password" type="password" class="agoda-input mt-1" required autocomplete="current-password" />
        </div>
        <div class="flex items-center justify-between">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="mr-2">
                <span class="text-sm text-gray-700">Remember me</span>
            </label>
            <button class="agoda-btn-primary">Sign in</button>
        </div>
    </form>
</div>
</div>
@endsection
