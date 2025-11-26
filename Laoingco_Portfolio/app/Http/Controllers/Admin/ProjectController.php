<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'short_description' => 'nullable',
            'body' => 'nullable',
            'thumbnail' => 'nullable|image|max:2048',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_published' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['title']).'-'.Str::random(6);
        $data['is_published'] = $request->has('is_published');

        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required',
            'short_description' => 'nullable',
            'body' => 'nullable',
            'thumbnail' => 'nullable|image|max:2048',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_published' => 'nullable',
        ]);

        if ($project->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']).'-'.Str::random(6);
        }

        $data['is_published'] = $request->has('is_published');

        if ($data['is_published'] && !$project->published_at) {
            $data['published_at'] = now();
        } elseif (!$data['is_published']) {
            $data['published_at'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted!');
    }
}
