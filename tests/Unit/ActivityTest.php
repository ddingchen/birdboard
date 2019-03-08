<?php

namespace Tests\Unit;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_user()
    {
        $this->signIn();
        $project = ProjectFactory::ownedBy($user = auth()->user())->create();

        $this->assertEquals($user->id, $project->activities()->first()->user->id);
    }
}
