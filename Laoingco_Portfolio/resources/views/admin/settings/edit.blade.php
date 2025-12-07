@extends('layout.app')

@section('content')
<main class="max-w-3xl mx-auto pt-24 pb-16 px-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">Site Settings</h1>
            <p class="text-sm text-slate-400">Manage your landing hero details and profile image.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-sm px-3 py-2 border rounded border-slate-700 hover:bg-slate-800">← Back</a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
      <div class="mb-4 px-4 py-2 bg-emerald-600/15 border border-emerald-500/70 text-sm text-emerald-200 rounded">
        {{ session('success') }}
      </div>
    @endif

    {{-- Errors --}}
    @if($errors->any())
      <div class="mb-4 px-4 py-2 bg-rose-900/40 border border-rose-500 text-sm text-rose-100 rounded">
        <ul class="list-disc list-inside space-y-1">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1 font-medium">Display Name</label>
                <input type="text" name="name" value="{{ old('name', $settings['name'] ?? '') }}"
                       class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1 font-medium">Contact Email</label>
                <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}"
                       class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm mb-1 font-medium">Headline (under your name)</label>
            <input type="text" name="headline" value="{{ old('headline', $settings['headline'] ?? '') }}"
                   class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm"
                   placeholder="CS student & aspiring full-stack developer">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1 font-medium">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $settings['github_url'] ?? '') }}"
                       class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm"
                       placeholder="https://github.com/username">
            </div>
            <div>
                <label class="block text-sm mb-1 font-medium">LinkedIn URL</label>
                <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}"
                       class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm"
                       placeholder="https://www.linkedin.com/in/username/">
            </div>
        </div>

        <div>
            <label class="block text-sm mb-1 font-medium">Profile Image</label>

            @php $profile = $settings['profile_image'] ?? null; @endphp
            @if($profile)
              <img src="{{ asset('storage/'.$profile) }}" alt="Profile" class="h-24 w-24 rounded-full object-cover mb-2 border border-slate-700">
            @endif

            <input type="file" name="profile_image" class="w-full text-sm text-slate-300">
            <p class="text-xs text-slate-400 mt-1">JPG, PNG, WEBP up to 4 MB.</p>
        </div>

        <div class="pt-2">
            <button class="px-4 py-2 bg-blue-600 rounded-md text-sm font-semibold hover:bg-blue-700 shadow shadow-blue-600/30">
                Save Settings
            </button>
        </div>
    </form>
</main>
@endsection
