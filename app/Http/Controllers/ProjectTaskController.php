<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    public function store(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        request()->validate([
            'body' => 'required',
        ]);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Request $request, Project $project, Task $task)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        $task->update(['body' => $request->body]);

        if ($request->has('completed')) {
            $task->complete();

            $task->project->recordActivity('task_completed');
        }

        return redirect()->back();
    }
}
