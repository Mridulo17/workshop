<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairSummaryDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function repairSummary(){
        return $this->belongsTo(RepairSummary::class);
    }

}
