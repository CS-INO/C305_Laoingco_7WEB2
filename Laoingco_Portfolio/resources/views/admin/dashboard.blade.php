<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen antialiased">

@include('components.header')

<main class="max-w-6xl mx-auto px-6 pt-24 pb-16">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Dashboard</h1>
            <p class="text-sm text-slate-400 mt-1">Manage the projects displayed on your portfolio.</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('admin.settings.edit') }}"
               class="inline-flex items-center px-4 py-2 rounded-md text-sm border border-slate-700 hover:bg-slate-800">
                ⚙️ Settings
            </a>
            <a href="{{ route('admin.projects.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md text-sm font-semibold hover:bg-blue-700 shadow shadow-blue-600/30">
                + New Project
            </a>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-emerald-600/15 border border-emerald-500/70 text-sm text-emerald-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        {{-- Profile --}}
        @php
            $profile = $settings['profile_image'] ?? null;
            $name = $settings['name'] ?? 'Your Name';
            $headline = $settings['headline'] ?? 'Add your headline in Settings';
        @endphp

        <div class="md:col-span-1 rounded-xl bg-slate-900/60 border border-slate-800 p-4">
            <div class="flex items-center gap-3">
                <img
                    src="{{ $profile ? asset('storage/'.$profile) : 'https://via.placeholder.com/96?text=Photo' }}"
                    class="h-16 w-16 rounded-full object-cover border border-slate-700"
                    alt="Profile"
                >
                <div>
                    <div class="font-semibold text-lg">{{ $name }}</div>
                    <div class="text-xs text-slate-400">{{ $headline }}</div>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.settings.edit') }}"
                   class="inline-flex items-center px-3 py-1.5 rounded-md text-xs border border-slate-700 hover:bg-slate-800">
                    Edit Settings
                </a>
            </div>
        </div>

        {{-- Stats boxes --}}
        <div class="rounded-xl bg-slate-900/60 border border-slate-800 p-4">
            <p class="text-xs text-slate-400 mb-1">Total Projects</p>
            <p class="text-2xl font-semibold">{{ $total }}</p>
        </div>

        <div class="rounded-xl bg-slate-900/60 border border-slate-800 p-4">
            <p class="text-xs text-slate-400 mb-1">Published</p>
            <p class="text-2xl font-semibold">{{ $published }}</p>
        </div>

        <div class="rounded-xl bg-slate-900/60 border border-slate-800 p-4">
            <p class="text-xs text-slate-400 mb-1">Drafts</p>
            <p class="text-2xl font-semibold">{{ $drafts }}</p>
        </div>
    </div>

    {{-- Projects Table --}}
    @if($projects->isEmpty())
        <p class="text-slate-400 text-sm">
            No projects yet. Click → <span class="font-semibold">“New Project”</span>
        </p>
    @else
        <div class="rounded-xl border border-slate-800 bg-slate-900/60 overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-900/80 text-slate-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium">ID</th>
                        <th class="px-4 py-3 text-left font-medium">Title</th>
                        <th class="px-4 py-3 text-left font-medium">Status</th>
                        <th class="px-4 py-3 text-left font-medium">Created</th>
                        <th class="px-4 py-3 text-right font-medium">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($projects as $project)
                    <tr class="border-t border-slate-800/60 hover:bg-slate-900/80">
                        <td class="px-4 py-3">{{ $project->id }}</td>

                        <td class="px-4 py-3">
                            <div class="font-medium">{{ $project->title }}</div>
                        </td>

                        <td class="px-4 py-3">
                            @if($project->is_published)
                                <span class="inline-flex items-center px-2 py-1 text-xs rounded-full bg-emerald-500/15 text-emerald-300">● Published</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs rounded-full bg-slate-500/15 text-slate-300">● Draft</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">{{ $project->created_at->format('Y-m-d') }}</td>

                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.projects.edit', $project) }}"
                               class="px-3 py-1.5 rounded-md bg-amber-500/90 hover:bg-amber-500 text-xs font-medium">Edit</a>

                            <form method="POST"
                                  action="{{ route('admin.projects.destroy', $project) }}"
                                  class="inline"
                                  onsubmit="return confirm('Delete this project?');">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1.5 rounded-md bg-rose-600/90 hover:bg-rose-700 text-xs font-medium">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    @endif

</main>

@include('components.footer')

</body>
</html>
