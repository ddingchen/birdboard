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
        return view('projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        Project::create($request->validate([
            'title' => 'required',
            'description' => 'required',
        ]));

        return redirect('projects');
    }
}
