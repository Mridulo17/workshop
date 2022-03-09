<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function locationable()
    {
        return $this->morphTo();
    }
}
