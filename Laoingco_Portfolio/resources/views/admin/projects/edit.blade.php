<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine for tiny interactivity (image preview, disable submit) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen antialiased">

@include('components.header')

<main class="max-w-4xl mx-auto pt-24 pb-16 px-6" x-data="{ submitting:false, previewSrc:null }">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Edit Project</h1>
        <a href="{{ route('admin.projects.index') }}"
           class="px-3 py-1.5 rounded-md text-sm border border-slate-700 hover:bg-slate-800">
            ← Back
        </a>
    </div>

    {{-- Flash (success) --}}
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

    {{-- Status hint --}}
    <div class="mb-4 text-xs text-slate-400">
        Status:
        @if($project->is_published)
            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-300">Published</span>
            @if($project->published_at)
                • since {{ $project->published_at->format('Y-m-d H:i') }}
            @endif
        @else
            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-slate-500/15 text-slate-300">Draft</span>
        @endif
    </div>

    <form action="{{ route('admin.projects.update', $project) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4"
          x-on:submit="submitting=true">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm mb-1 font-medium">Title</label>
            <input type="text" name="title" value="{{ old('title', $project->title) }}"
                   class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <div>
            <label class="block text-sm mb-1 font-medium">Short Description</label>
            <textarea name="short_description" rows="3"
                      class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="One-liner or elevator pitch for the project">{{ old('short_description', $project->short_description) }}</textarea>
            <p class="mt-1 text-xs text-slate-400">Tip: keep under ~140–160 characters.</p>
        </div>

        <div>
            <label class="block text-sm mb-1 font-medium">Body</label>
            <textarea name="body" rows="5"
                      class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Longer notes, tech used, challenges, etc.">{{ old('body', $project->body) }}</textarea>
        </div>

        <div>
            <label class="block text-sm mb-1 font-medium">Thumbnail (image)</label>

            {{-- Current thumbnail --}}
            @if($project->thumbnail)
                <div class="mb-2 flex items-center gap-3">
                    <img src="{{ asset('storage/'.$project->thumbnail) }}"
                         alt="{{ $project->title }}"
                         class="h-20 w-20 object-cover rounded-lg border border-slate-700">
                    <span class="text-xs text-slate-400">Current</span>
                </div>
            @endif

            {{-- Preview of new file (client-side) --}}
            <template x-if="previewSrc">
                <div class="mb-2">
                    <img :src="previewSrc" alt="Preview" class="h-20 w-20 object-cover rounded-lg border border-blue-700/50 shadow shadow-blue-700/20">
                    <div class="text-xs text-slate-400 mt-1">New preview</div>
                </div>
            </template>

            <input type="file" name="thumbnail" accept="image/*"
                   class="w-full text-sm text-slate-300 file:mr-3 file:px-3 file:py-1.5 file:rounded-md file:border-0 file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700"
                   x-on:change="if($event.target.files[0]) previewSrc = URL.createObjectURL($event.target.files[0])">
            <p class="mt-1 text-xs text-slate-400">JPG, PNG, WEBP up to 4 MB.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1 font-medium">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}"
                       class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm"
                       placeholder="https://github.com/username/repo">
            </div>

            <div>
                <label class="block text-sm mb-1 font-medium">Live URL</label>
                <input type="url" name="live_url" value="{{ old('live_url', $project->live_url) }}"
                       class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm"
                       placeholder="https://example.com">
            </div>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" id="is_published" name="is_published"
                   class="rounded border-slate-700 bg-slate-900"
                   {{ old('is_published', $project->is_published) ? 'checked' : '' }}>
            <label for="is_published" class="text-sm text-slate-200">
                Published
            </label>
        </div>

        <div class="flex gap-3 pt-3">
            <button type="submit"
                    :disabled="submitting"
                    :class="submitting ? 'opacity-60 cursor-not-allowed' : ''"
                    class="px-4 py-2 bg-blue-600 rounded-md text-sm font-semibold hover:bg-blue-700 shadow shadow-blue-600/30">
                <span x-show="!submitting">Update</span>
                <span x-show="submitting">Updating…</span>
            </button>
            <a href="{{ route('admin.projects.index') }}"
               class="px-4 py-2 rounded-md text-sm border border-slate-600 hover:bg-slate-800">
                Cancel
            </a>
        </div>
    </form>
</main>

@include('components.footer')

</body>
</html>
