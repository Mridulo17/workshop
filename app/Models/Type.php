<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Type extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'type';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.type');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    public static function types(){
        return [
            'vehicle' => 'গাড়ি',
            'pump' => 'পাম্প',
            'equipment' => 'সরঞ্জাম',
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
}
