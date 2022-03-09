<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class RepairJobCard extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'inspection_report';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.inspection_report');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public static function fuel_types(){
        return [
            'petrol' => 'পেট্রোল',
            'diesel' => 'ডিজেল',
            'octane' => 'অকটেন',
        ];
    }
    public function inspectionReport(){
        return $this->belongsTo(InspectionReport::class);
    }

    public function repairJobCardDetails(){
        return $this->hasMany(RepairJobCardDetail::class);
    }
}
