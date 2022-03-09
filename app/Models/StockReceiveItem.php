<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockReceiveItem extends Model
{
    protected $guarded = ['id'];

    public function itemable()
    {
        return $this->morphTo();
    }

    public function stock_receive()
    {
        return $this->belongsTo(StockReceive::class);
    }

    public function model(){
        return $this->belongsTo(\App\Models\Model::class);
    }
}
