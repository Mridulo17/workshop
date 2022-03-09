<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductPartVariant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product_part(){
        return $this->belongsTo(ProductPart::class);
    }

    public function variants(){
        return $this->hasMany(Variant::class,'variant_type_id','variant_type_id');
    }

    public function variant(){
        return $this->belongsTo(Variant::class);
    }

    public function variant_type(){
        return $this->belongsTo(VariantType::class);
    }

}
