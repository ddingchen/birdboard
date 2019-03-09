<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
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
        $othersProject = ProjectFactory::create();
        $ownedProject = ProjectFactory::create();

        $this->signIn($ownedProject->owner)
            ->get('projects')
            ->assertSee($ownedProject->title)
            ->assertDontSee($othersProject->title);
    }

    public function test_a_user_can_view_a_project()
    {
        $project = ProjectFactory::create();

        $this->signIn($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_authenticated_user_canoot_view_projects_of_others()
    {
        $project = ProjectFactory::create();

        $this->signIn()
            ->get($project->path())
            ->assertStatus(403);
    }

    public function test_a_user_can_update_a_project()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => $notes = $this->faker->sentence,
        ];

        $this->signIn($project->owner)
            ->patch($project->path(), $attributes);

        $this->get($project->path() . '/edit')->assertStatus(200);

        $this->assertDatabaseHas('projects', $attributes);
    }

    public function test_an_authenticated_user_canoot_update_projects_of_others()
    {
        $project = ProjectFactory::create();

        $this->signIn()
            ->patch($project->path())
            ->assertStatus(403);
    }

    public function test_a_user_can_delete_a_project()
    {
        $project = ProjectFactory::create();

        $this->signIn($project->owner)
            ->delete($project->path())
            ->assertRedirect('projects')
            ->assertDontSee($project->title);
    }

    public function test_unauthenticate_users_cannot_delete_projects()
    {
        $project = ProjectFactory::create();

        $this->delete($project->path())
            ->assertRedirect('login');

        $this->signIn()
            ->delete($project->path())
            ->assertStatus(403);
    }

    public function test_guests_may_not_manage_projects()
    {
        $this->get('projects')->assertRedirect('login');

        $this->post('projects')->assertRedirect('login');

        $this->get(ProjectFactory::create()->path())->assertRedirect('login');
    }
}
