<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class VehicleMaintenanceOrder extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'vehicle_maintenance_order';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.vehicle_maintenance_order');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public static function entry_types()
    {
        return [
            'manual' => 'ম্যানুয়াল',
            'automatic' => 'সয়ংক্রিয়',
        ];
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function vehicleMaintenanceDetails(){

        return $this->hasMany(VehicleMaintenanceDetails::class);
    }
}
