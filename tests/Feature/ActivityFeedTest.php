<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_project_generates_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activities);
    }

    public function test_update_project_generates_activity()
    {
        $project = ProjectFactory::create();

        $project->update(['description' => 'Changed']);

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated', $project->activities->last()->description);
    }
}
