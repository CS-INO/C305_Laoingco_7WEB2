<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen antialiased">

@include('components.header')

<main class="max-w-4xl mx-auto pt-24 pb-16 px-6">
    <h1 class="text-2xl font-bold mb-4">Edit Project</h1>

    @if($errors->any())
        <div class="mb-4 px-4 py-2 bg-rose-900/40 border border-rose-500 text-sm text-rose-100 rounded">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4">
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
                      class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('short_description', $project->short_description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm mb-1 font-medium">Body</label>
            <textarea name="body" rows="5"
                      class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body', $project->body) }}</textarea>
        </div>

        <div>
            <label class="block text-sm mb-1 font-medium">Thumbnail (image)</label>

            @if($project->thumbnail)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$project->thumbnail) }}"
                         alt="{{ $project->title }}"
                         class="h-24 w-24 object-cover rounded-lg border border-slate-700">
                </div>
            @endif

            <input type="file" name="thumbnail"
                   class="w-full text-sm text-slate-300">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1 font-medium">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}"
                       class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-sm mb-1 font-medium">Live URL</label>
                <input type="url" name="live_url" value="{{ old('live_url', $project->live_url) }}"
                       class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm">
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
                    class="px-4 py-2 bg-blue-600 rounded-md text-sm font-semibold hover:bg-blue-700 shadow shadow-blue-600/30">
                Update
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
