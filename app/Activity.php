<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'changes' => 'array',
    ];

    public function subject()
    {
        return $this->morphTo();
    }
}
