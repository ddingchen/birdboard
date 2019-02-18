<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;

/**
 * ProjectFactory
 */
class ProjectFactory
{
    protected $owner;

    protected $tasksCount;

    public function create()
    {
        $project = factory(Project::class)->create([
            'owner_id' => $this->owner->id ?? factory(User::class),
        ]);

        if ($this->tasksCount) {
            $project->tasks()->createMany(factory(Task::class, $this->tasksCount)->raw());
        }

        return $project;
    }

    public function withTask()
    {
        $this->tasksCount = 1;

        return $this;
    }
}
