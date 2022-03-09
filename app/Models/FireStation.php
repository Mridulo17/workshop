<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class FireStation extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'fire_station';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.fire_station');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public static function getCategories()
    {
        return [
            'সিটি কর্পোরেশন' => 'সিটি কর্পোরেশন',
            'জেলা' => 'জেলা',
            'উপজেলা' => 'উপজেলা'
        ];
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }

    public function greater_district(){
        return $this->belongsTo(GreaterDistrict::class);
    }

    public function city_corporation(){
        return $this->belongsTo(CityCorporation::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function thana(){
        return $this->belongsTo(Thana::class);
    }

    public function workshop(){
        return $this->belongsTo(Workshop::class);
    }

    public function fire_station_type(){
        return $this->belongsTo(FireStationType::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function locations()
    {
        return $this->morphMany(Location::class, 'locationable');
    }

}
