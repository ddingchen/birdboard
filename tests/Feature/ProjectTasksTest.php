<?php

namespace Tests\Feature;

use App\Project;
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
        $this->withoutExceptionHandling();
        $this->signIn();

        $project = auth()->user()->projects()->create(factory(Project::class)->raw());

        $this->post($project->path() . '/tasks', ['body' => 'test task']);

        $this->get($project->path())
            ->assertSee('test task');
    }

    public function test_task_body_is_required()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(factory(Project::class)->raw());

        $this->post($project->path() . '/tasks')
            ->assertSessionHasErrors('body');
    }
}
