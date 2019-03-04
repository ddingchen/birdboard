<?php

namespace App;

use App\Activity;
use App\Project;
use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordActivity;

    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean',
    ];

    protected static $recordableEvents = ['created', 'deleted'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    public function path()
    {
        return $this->project->path() . '/tasks/' . $this->id;
    }

    public function complete()
    {
        $this->completed = true;
        $this->save();

        $this->recordActivity('task_completed');
    }

    public function imcomplete()
    {
        $this->completed = false;
        $this->save();

        $this->recordActivity('task_imcompleted');
    }
}
