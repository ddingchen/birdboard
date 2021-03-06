<?php

namespace Tests\Unit;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $task = factory(Task::class)->create();

        $this->assertEquals("/projects/{$task->project_id}/tasks/{$task->id}", $task->path());
    }

    public function test_it_belongs_to_a_project()
    {
        $task = factory(Task::class)->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }

    public function test_it_can_be_completed()
    {
        $task = factory(Task::class)->create();

        $task->complete();

        $this->assertTrue($task->fresh()->completed);
    }

    public function test_it_can_be_imcompleted()
    {
        $task = factory(Task::class)->create(['completed' => true]);

        $task->imcomplete();

        $this->assertFalse($task->fresh()->completed);
    }
}
