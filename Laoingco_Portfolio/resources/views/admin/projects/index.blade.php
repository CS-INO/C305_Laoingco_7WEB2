<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin – Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen antialiased">

@include('components.header')

<main class="max-w-6xl mx-auto pt-24 pb-16 px-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold tracking-tight">Projects</h1>

        <a href="{{ route('admin.projects.create') }}"
           class="px-4 py-2 bg-blue-600 rounded-md text-sm font-semibold hover:bg-blue-700 shadow shadow-blue-600/30">
            + New Project
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-emerald-600/15 border border-emerald-500/70 text-sm text-emerald-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($projects->isEmpty())
        <p class="text-slate-400 text-sm">No projects yet. Click “New Project” to add one.</p>
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
                        <td class="px-4 py-3 align-middle">{{ $project->id }}</td>
                        <td class="px-4 py-3 align-middle">{{ $project->title }}</td>
                        <td class="px-4 py-3 align-middle">
                            @if($project->is_published)
                                <span class="inline-flex items-center px-2 py-1 text-xs rounded-full bg-emerald-500/15 text-emerald-300">
                                    ● Published
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs rounded-full bg-slate-500/15 text-slate-300">
                                    ● Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 align-middle">
                            {{ $project->created_at->format('Y-m-d') }}
                        </td>
                        <td class="px-4 py-3 align-middle text-right space-x-2">
                            <a href="{{ route('admin.projects.edit', $project) }}"
                               class="inline-flex px-3 py-1.5 rounded-md bg-amber-500/90 hover:bg-amber-500 text-xs font-medium">
                                Edit
                            </a>

                            <form action="{{ route('admin.projects.destroy', $project) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex px-3 py-1.5 rounded-md bg-rose-600/90 hover:bg-rose-700 text-xs font-medium">
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
