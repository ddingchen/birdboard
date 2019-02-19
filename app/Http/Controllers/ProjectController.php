<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'notes' => 'nullable',
    ];

    public function index()
    {
        return view('projects.index', [
            'projects' => auth()->user()->projects,
        ]);
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $project = auth()->user()->projects()->create($request->validate($this->rules));

        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($request->validate($this->rules));

        return redirect($project->path());
    }
}
