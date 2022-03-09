<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'product';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.product');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public static function fuels()
    {
        return [
            'octane' => 'অকটেন',
            'diesel' => 'ডিজেল',
            'petrol' => 'পেট্রোল',
            'gas' => 'গ্যাস',
        ];
    }

    public static function findFuels($fuel)
    {
        $fuels = self::fuels();
        foreach ($fuels as $key=>$value){
            if($key == $fuel){
                return $value;
                exit();
            }elseif(str_contains($value,$fuel)){
                return $key;
                exit();
            }
        }
    }

    public function product_parts(){
        return $this->belongsToMany(ProductPart::class)->withTimestamps();
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function model(){
        return $this->belongsTo(\App\Models\Model::class);
    }

    public function workshop(){
        return $this->belongsTo(Workshop::class);
    }

    public function fire_station(){
        return $this->belongsTo(FireStation::class);
    }

    public function drivers(){
        return $this->belongsToMany(Driver::class, 'driver_product')->withTimestamps();
    }

    public function type(){
        return $this->belongsTo(Type::class,'type_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function stock_receive_items()
    {
        return $this->morphMany(StockReceiveItem::class, 'itemable');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }


}
