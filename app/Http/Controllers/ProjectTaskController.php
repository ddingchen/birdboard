<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate([
            'body' => 'required',
        ]);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $this->authorize('update', $project);

        $task->update($request->validate(['body' => 'required']));

        $request->completed ? $task->complete() : $task->imcomplete();

        return redirect()->back();
    }
}
