<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairJobCardDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function repairJobCard(){
        return $this->belongsTo(RepairJobCard::class);
    }

    public function allUnit(){

        return $this->belongsTo(Unit::class);
    }

}
