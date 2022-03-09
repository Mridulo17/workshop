<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductPart extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'product_part';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.product_part');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public function product_part_variants(){
        return $this->hasMany(ProductPartVariant::class);
    }

    public function type(){
        return $this->belongsTo(Type::class,'type_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function model(){
        return $this->belongsTo(\App\Models\Model::class);
    }

    public function fireStation(){
        return $this->belongsTo(\App\Models\FireStation::class);
    }

    /*public function products(){
        return $this->hasMany(ProductPartProduct::class);
    }*/

    public function product_part_products(){
        return $this->hasMany(ProductPartProduct::class);
    }

    public function product_part_models(){
        return $this->hasMany(ProductPartModel::class);
    }

    public function stock_receive_items()
    {
        return $this->morphMany(StockReceiveItem::class, 'stockable');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function workshop(){
        return $this->belongsTo(Workshop::class);
    }

}
