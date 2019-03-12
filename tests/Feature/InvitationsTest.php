<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_can_invite_users()
    {
        $project = ProjectFactory::create();

        $project->invite($member = factory(User::class)->create());

        $this->signIn($member)
            ->post(action('ProjectTaskController@store', $project), $task = ['body' => 'test']);

        $this->assertDatabaseHas('tasks', $task);
    }

    public function test_a_user_can_see_all_projects_they_have_invited_to_on_dashboard()
    {
        $user = factory(User::class)->create();

        $project = tap(ProjectFactory::create())->invite($user);

        $this->signIn($user)
            ->get('projects')
            ->assertSee($project->title);

    }
}
