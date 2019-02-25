<?php

namespace App;

use App\Project;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            Activity::create([
                'project_id' => $task->project->id,
                'description' => 'task_created',
            ]);
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return $this->project->path() . '/tasks/' . $this->id;
    }

    public function complete()
    {
        $this->completed = true;
        $this->save();

        $this->project->recordActivity('task_completed');
    }
}
