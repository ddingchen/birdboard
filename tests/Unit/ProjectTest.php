<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->project = ProjectFactory::create();
    }

    public function test_it_has_a_path()
    {
        $this->assertEquals('/projects/' . $this->project->id, $this->project->path());
    }

    public function test_it_belongs_to_an_owner()
    {
        $this->assertInstanceOf(User::class, $this->project->owner);
    }

    public function test_it_can_add_a_task()
    {
        $task = $this->project->addTask('test task');

        $this->assertCount(1, $this->project->tasks);
        $this->assertTrue($this->project->tasks->contains($task));
    }

    public function test_a_project_can_invite_users()
    {
        $project = ProjectFactory::create();

        $project->invite(factory(User::class)->create());

        $this->assertCount(1, $project->members);
    }
}
