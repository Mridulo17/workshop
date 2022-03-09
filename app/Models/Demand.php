<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Demand extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function inspectionReport(){
        return $this->belongsTo(InspectionReport::class);
    }
    public function productPart(){
        return $this->belongsTo(ProductPart::class);
    }

}
