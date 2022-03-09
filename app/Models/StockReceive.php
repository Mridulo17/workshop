<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class StockReceive extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'stock_receive';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.stock_receive');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public static function types(){
        return [
            'product' => trans('product.product'),
            'product_part' => trans('stock_receive.product_part'),
        ];
    }

    public static function findType($type)
    {
        $types = self::types();
        foreach ($types as $key=>$value){
            if($key == $type){
                return $value;
                exit();
            }elseif(str_contains($value,$type)){
                return $key;
                exit();
            }
        }
    }

    public function workshop(){
        return $this->belongsTo(Workshop::class);
    }

    public function fire_station(){
        return $this->belongsTo(FireStation::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function stock_receive_items(){
        return $this->hasMany(StockReceiveItem::class);
    }

}
