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
            'user_id' => ($this->project ?? $this)->owner_id,
            'description' => $description,
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id,
            'changes' => $this->wasChanged() ? [
                'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after' => array_except($this->getChanges(), 'updated_at'),
            ] : null,
        ]);
    }
}
