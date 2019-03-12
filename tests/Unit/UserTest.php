<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_project()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    public function test_a_user_has_accessable_projects()
    {
        $john = factory(User::class)->create();
        $sally = factory(User::class)->create();
        $nick = factory(User::class)->create();

        // owned john
        ProjectFactory::ownedBy($john)->create();
        // john is invited
        ProjectFactory::ownedBy($sally)->create()->invite($john);
        // invited others
        ProjectFactory::ownedBy($sally)->create()->invite($nick);

        $this->assertCount(2, $john->accessableProjects());

    }
}
