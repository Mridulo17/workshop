<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class MonthlyTransit extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'monthly_transit';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.monthly_transit');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public static function entry_types()
    {
        return [
            'manual' => 'ম্যানুয়াল',
            'automatic' => 'সয়ংক্রিয়',
        ];
    }

    public static function months()
    {
        return [
            'january' => trans('monthly_transit.january'),
            'february' => trans('monthly_transit.february'),
            'march' => trans('monthly_transit.march'),
            'april' => trans('monthly_transit.april'),
            'may' => trans('monthly_transit.may'),
            'june' => trans('monthly_transit.june'),
            'july' => trans('monthly_transit.july'),
            'august' => trans('monthly_transit.august'),
            'september' => trans('monthly_transit.september'),
            'october' => trans('monthly_transit.october'),
            'november' => trans('monthly_transit.november'),
            'december' => trans('monthly_transit.december'),
        ];
    }

    public static function findMonth($month)
    {
        $months = self::months();
        foreach ($months as $key=>$value){
            if($key == $month){
                return $value;
                exit();
            }
        }
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function monthlyTransitDetails(){
        return $this->hasMany(MonthlyTransitDetail::class);
    }
}
