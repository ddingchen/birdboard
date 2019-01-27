<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('projects', $attributes)->assertRedirect();

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_a_project_requires_a_title()
    {
        $project = factory(Project::class)->raw(['title' => '']);

        $this->actingAs(factory(User::class)->create());

        $this->post('projects', $project)
            ->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $project = factory(Project::class)->raw(['description' => '']);

        $this->actingAs(factory(User::class)->create());

        $this->post('projects', $project)
            ->assertSessionHasErrors('description');
    }

    public function test_a_user_can_view_a_project()
    {
        $project = factory(Project::class)->create();

        $this->actingAs($project->owner);

        $this->get('projects/' . $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_authenticated_user_canoot_view_projects_of_others()
    {
        $this->be(factory(User::class)->create());

        $project = factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_guests_may_not_create_projects()
    {
        $this->post('projects', factory(Project::class)->raw())
            ->assertRedirect('login');
    }

    public function test_guests_may_not_view_projects()
    {
        $this->get('projects')->assertRedirect('login');
    }

    public function test_guests_may_not_view_a_single_project()
    {
        $project = factory(Project::class)->create();

        $this->get('projects/' . $project->id)->assertRedirect('login');
    }
}
