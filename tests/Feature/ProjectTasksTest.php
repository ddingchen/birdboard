<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_guest_may_not_add_tasks()
    {
        $project = ProjectFactory::create();

        $this->post($project->path() . '/tasks')
            ->assertRedirect('login');
    }

    public function test_only_the_owner_of_a_project_may_add_tasks()
    {
        $project = ProjectFactory::create();

        $attributes = ['body' => $this->faker->sentence];

        $this->signIn()
            ->post($project->path() . '/tasks', $attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $attributes);
    }

    public function test_a_project_can_have_tasks()
    {
        $project = ProjectFactory::create();

        $attributes = ['body' => $this->faker->sentence];

        $this->signIn($project->owner)
            ->post($project->path() . '/tasks', $attributes);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    public function test_a_task_can_be_updated()
    {
        $project = ProjectFactory::withTask()->create();

        $attributes = [
            'body' => $this->faker->sentence,
        ];

        $this->signIn($project->owner)
            ->patch($project->tasks[0]->path(), $attributes);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    public function test_a_task_can_be_completed()
    {
        $project = ProjectFactory::withTask()->create();

        $attributes = [
            'body' => $this->faker->sentence,
            'completed' => true,
        ];

        $this->signIn($project->owner)
            ->patch($project->tasks[0]->path(), $attributes);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    public function test_a_task_can_be_marked_as_imcompleted()
    {
        $project = ProjectFactory::withTask()->create();

        $this->signIn($project->owner);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'test',
            'completed' => true,
        ]);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'test',
            'completed' => false,
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'test',
            'completed' => false,
        ]);
    }

    public function test_only_the_owner_of_a_project_can_update_tasks()
    {
        $project = ProjectFactory::withTask()->create();

        $attributes = [
            'body' => $this->faker->sentence,
            'completed' => true,
        ];

        $this->signIn()
            ->patch($project->tasks[0]->path(), $attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $attributes);
    }

    public function test_task_body_is_required()
    {
        $project = ProjectFactory::create();

        $this->signIn($project->owner)
            ->post($project->path() . '/tasks')
            ->assertSessionHasErrors('body');
    }
}
