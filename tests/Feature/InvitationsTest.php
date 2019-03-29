<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_owner_may_invite_a_user()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $invitedUser = factory(User::class)->create();

        $this->signIn($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => $invitedUser->email,
            ])
            ->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($invitedUser));
    }

    public function test_the_invited_email_must_be_associated_with_a_valid_birdboard_account()
    {
        $project = ProjectFactory::create();

        $this->signIn($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => 'dc@dc.com',
            ])
            ->assertSessionHasErrors(['email' => 'The user you are inviting must have a Birdboard account.']);
    }

    public function test_non_owners_may_not_invite_users()
    {
        $this->signIn()
            ->post(ProjectFactory::create()->path() . '/invitations')
            ->assertStatus(403);
    }

    public function test_invited_user_may_update_project_detail()
    {
        $project = ProjectFactory::create();

        $project->invite($member = factory(User::class)->create());

        $this->signIn($member)
            ->post(action('ProjectTaskController@store', $project), $task = ['body' => 'test']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
