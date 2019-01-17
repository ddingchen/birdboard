<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
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
