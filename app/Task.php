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

    public function imcomplete()
    {
        $this->completed = false;
        $this->save();

        $this->project->recordActivity('task_imcompleted');
    }
}
