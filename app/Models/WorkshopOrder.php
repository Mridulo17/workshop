<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class WorkshopOrder extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'workshop_order';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.workshop_order');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public static function fuel_types(){
        return [
            'petrol' => 'পেট্রোল',
            'diesel' => 'ডিজেল',
            'octane' => 'অকটেন',
        ];
    }

    public static function findFuelType($type)
    {
        $types = self::fuel_types();
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

    public function faults(){
        return $this->hasMany(Fault::class);
    }

    public function inspectionReport(){
        return $this->hasOne(InspectionReport::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }

}
