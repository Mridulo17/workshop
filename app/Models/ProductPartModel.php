<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductPartModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product_part(){
        return $this->belongsTo(ProductPart::class);
    }

    public function model(){
        return $this->belongsTo(Model::class);
    }

}
