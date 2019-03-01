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
        $this->assertNull($project->activities->last()->changes);
    }

    public function test_updating_a_project()
    {
        $project = ProjectFactory::create();
        $originalDescription = $project->description;

        $project->update(['description' => 'Changed']);

        $this->assertCount(2, $project->activities);
        tap($project->activities->last(), function ($activity) use ($originalDescription) {
            $this->assertEquals('updated', $activity->description);
            $expected = [
                'before' => ['description' => $originalDescription],
                'after' => ['description' => 'Changed'],
            ];
            $this->assertEquals($expected, $activity->changes);
        });
    }

    public function test_creating_a_task()
    {
        $project = ProjectFactory::create();

        $task = $project->addTask('new task');

        tap($project->activities->last(), function ($activity) use ($task) {
            $this->assertEquals('task_created', $activity->description);
            $this->assertEquals($task->body, $activity->subject->body);
        });
    }

    public function test_completing_a_task()
    {
        $project = ProjectFactory::create();
        $task = $project->addTask('new task');

        $task->complete();

        tap($project->activities->last(), function ($activity) use ($task) {
            $this->assertEquals('task_completed', $activity->description);
            $this->assertEquals($task->body, $activity->subject->body);
        });
    }

    public function test_imcompleting_a_task()
    {
        $project = ProjectFactory::create();
        $task = $project->addTask('new task');

        $task->complete();
        $this->assertCount(3, $project->activities);

        $task->imcomplete();
        $this->assertCount(4, $project->fresh()->activities);

        tap($project->fresh()->activities->last(), function ($activity) use ($task) {
            $this->assertEquals('task_imcompleted', $activity->description);
            $this->assertEquals($task->body, $activity->subject->body);
        });
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
