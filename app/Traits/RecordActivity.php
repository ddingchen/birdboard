<?php

namespace App\Traits;

trait RecordActivity
{
    public $oldAttributes = [];

    protected static function bootRecordActivity()
    {
        foreach (static::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->recordDescription($event));
            });
        }

        static::updating(function ($model) {
            $model->oldAttributes = $model->getOriginal();
        });
    }

    protected function recordDescription($event)
    {
        return strtolower(class_basename($this)) . '_' . $event;
    }

    protected static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }

        return ['created', 'updated'];
    }

    public function recordActivity($description)
    {
        $this->activities()->create([
            'description' => $description,
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id,
            'changes' => $this->wasChanged() ? [
                'before' => array_diff($this->oldAttributes, $this->getAttributes()),
                'after' => $this->getChanges(),
            ] : null,
        ]);
    }
}
