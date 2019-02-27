<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_a_project()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activities);
    }

    public function test_updating_a_project()
    {
        $project = ProjectFactory::create();

        $project->update(['description' => 'Changed']);

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated', $project->activities->last()->description);
    }

    public function test_creating_a_task()
    {
        $project = ProjectFactory::create();

        $project->addTask('new task');

        $this->assertCount(2, $project->activities);
    }

    public function test_completing_a_task()
    {
        $project = ProjectFactory::create();
        $task = $project->addTask('new task');

        $task->complete();

        $this->assertCount(3, $project->activities);
    }

    public function test_imcompleting_a_task()
    {
        $project = ProjectFactory::create();
        $task = $project->addTask('new task');

        $task->complete();
        $this->assertCount(3, $project->activities);

        $task->imcomplete();
        $this->assertCount(4, $project->fresh()->activities);
        $this->assertEquals('task_imcompleted', $project->fresh()->activities->last()->description);
    }

    public function test_deleting_a_task()
    {
        $project = ProjectFactory::create();
        $task = $project->addTask('new task');

        $task->delete();
        $this->assertCount(3, $project->fresh()->activities);
        $this->assertEquals('task_deleted', $project->fresh()->activities->last()->description);
    }
}
