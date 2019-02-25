<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_a_project_records_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activities);
    }

    public function test_updating_a_project_records_activity()
    {
        $project = ProjectFactory::create();

        $project->update(['description' => 'Changed']);

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated', $project->activities->last()->description);
    }

    public function test_creating_a_task_records_project_activity()
    {
        $project = ProjectFactory::create();

        $project->addTask('new task');

        $this->assertCount(2, $project->activities);
    }

    public function test_completing_a_task_records_project_activity()
    {
        $project = ProjectFactory::create();
        $task = $project->addTask('new task');

        $task->complete();

        $this->assertCount(3, $project->activities);
    }
}
