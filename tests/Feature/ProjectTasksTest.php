<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_may_not_add_tasks()
    {
        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks', ['body' => 'test task'])
            ->assertRedirect('login');
    }

    public function test_only_the_owner_of_a_project_may_add_tasks()
    {
        $project = factory(Project::class)->create();
        
        $this->signIn();
        
        $this->post($project->path() . '/tasks', ['body' => 'test task'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'test task']);
    }

    public function test_a_project_can_have_tasks()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(factory(Project::class)->raw());

        $this->post($project->path() . '/tasks', ['body' => 'test task']);

        $this->get($project->path())
            ->assertSee('test task');
    }

    public function test_a_task_can_be_updated()
    {
        $this->signIn();

        $project = auth()->user()->projects()
            ->create(factory(Project::class)->raw());
        $task = $project->addTask('test');

        $attributes = [
            'body' => 'new test',
            'completed' => true,
        ];

        $this->patch($task->path(), $attributes);
        
        $this->assertDatabaseHas('tasks', $attributes);
    }

    public function test_only_the_owner_of_a_project_can_update_tasks()
    {
        $this->signIn();
        
        $project = factory(Project::class)->create();
        $task = $project->addTask('test task');

        $this->patch($task->path(), [
            'body' => 'new test',
            'completed' => true,
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'new test']);
    }

    public function test_task_body_is_required()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(factory(Project::class)->raw());

        $this->post($project->path() . '/tasks')
            ->assertSessionHasErrors('body');
    }
}
