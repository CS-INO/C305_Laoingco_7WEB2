@extends('layout.app')

@section('content')
<div class="max-w-md mx-auto px-6 pt-6">
    <div class="bg-slate-900/60 border border-slate-800 rounded-xl p-6">
        <h1 class="text-2xl font-semibold text-white mb-2">Sign In</h1>
        <p class="text-sm text-slate-400 mb-4">
            Welcome back! Log in to continue.
        </p>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-rose-900/30 border border-rose-800 text-sm text-rose-200">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

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

            <button type="submit"
                    class="w-full py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-semibold">
                Login
            </button>
        </form>

        <p class="text-sm text-slate-400 mt-4">
            Don't have an account?
            <a href="{{ route('register.form') }}" class="text-blue-400 hover:underline">Register</a>
        </p>
    </div>
</div>
@endsection
