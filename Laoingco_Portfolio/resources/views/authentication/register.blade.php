@extends('layout.app')

@section('content')
<div class="max-w-md mx-auto px-6 pt-6">
    <div class="bg-slate-900/60 border border-slate-800 rounded-xl p-6">
        <h1 class="text-2xl font-semibold text-white mb-2">Create Account</h1>
        <p class="text-sm text-slate-400 mb-4">
            Join to manage your portfolio projects.
        </p>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-rose-900/30 border border-rose-800 text-sm text-rose-200">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm text-slate-300 mb-1">Name</label>
                <input type="text" name="name" required
                       class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white focus:ring-2 focus:ring-blue-600">
            </div>

            <div>
                <label class="block text-sm text-slate-300 mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white focus:ring-2 focus:ring-blue-600">
            </div>

            <div>
                <label class="block text-sm text-slate-300 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white focus:ring-2 focus:ring-blue-600">
            </div>

            <div>
                <label class="block text-sm text-slate-300 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white focus:ring-2 focus:ring-blue-600">
            </div>

            <button type="submit"
                    class="w-full py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-semibold">
                Create Account
            </button>
        </form>

        <p class="text-sm text-slate-400 mt-4">
            Already have an account?
            <a href="{{ route('login.form') }}" class="text-blue-400 hover:underline">Sign in</a>
        </p>
    </div>
</div>
@endsection
