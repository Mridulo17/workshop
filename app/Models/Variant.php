<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Variant extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    protected $guarded = ['id'];
    protected static $logName = 'variant';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.variant');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public function variant_type(){
        return $this->belongsTo(VariantType::class);
    }

    public function product_parts(){
        return $this->belongsToMany(ProductPart::class)->withTimestamps();
    }
}
