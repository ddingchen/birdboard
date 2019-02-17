<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => $this->faker->sentence,
        ];

        $this->post('projects', $attributes)->assertRedirect();

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_a_project_requires_a_title()
    {
        $project = factory(Project::class)->raw(['title' => '']);

        $this->signIn();

        $this->post('projects', $project)
            ->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $project = factory(Project::class)->raw(['description' => '']);

        $this->signIn();

        $this->post('projects', $project)
            ->assertSessionHasErrors('description');
    }

    public function test_a_user_can_only_view_owned_projects_in_list()
    {
        $this->signIn();

        $othersProject = factory(Project::class)->create();
        $ownedProject = auth()->user()->projects()->create(factory(Project::class)->raw());

        $this->get('projects')
            ->assertSee($ownedProject->title)
            ->assertDontSee($othersProject->title);
    }

    public function test_a_user_can_view_a_project()
    {
        $project = factory(Project::class)->create();

        $this->signIn($project->owner);

        $this->get('projects/' . $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_authenticated_user_canoot_view_projects_of_others()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_a_user_can_update_a_project()
    {
        $this->withoutExceptionHandling();
        $project = factory(Project::class)->create();
        
        $this->signIn($project->owner);

        $this->patch($project->path(), ['notes' => $notes = $this->faker->sentence]);
        
        $this->get($project->path())
            ->assertSee($notes);
    }

    public function test_an_authenticated_user_canoot_update_projects_of_others()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->patch($project->path())->assertStatus(403);
    }

    public function test_guests_may_not_manage_projects()
    {
        $this->get('projects')->assertRedirect('login');
        $this->post('projects')->assertRedirect('login');
        $this->get(factory(Project::class)->create()->path())->assertRedirect('login');
    }
}
