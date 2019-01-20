<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('projects', $attributes)->assertRedirect();

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();

        $this->get('projects/' . $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_a_project_requires_a_title()
    {
        $project = factory(Project::class)->raw(['title' => '']);

        $this->post('projects', $project)
            ->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $project = factory(Project::class)->raw(['description' => '']);

        $this->post('projects', $project)
            ->assertSessionHasErrors('description');
    }
}
