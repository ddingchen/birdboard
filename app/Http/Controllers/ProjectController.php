<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::all(),
        ]);
    }

    public function show(Project $project)
    {
        if (!auth()->user()->is($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $project = auth()->user()->projects()->create($request->validate([
            'title' => 'required',
            'description' => 'required',
        ]));

        return redirect($project->path());
    }
}
