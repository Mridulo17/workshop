<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Google\Service\CivicInfo\Office;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MailResetPasswordNotification;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'user';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans(self::$logName.'.user');
        return self::$logName .' '.ActivityLogHelper::eventName($eventName);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function division(){
        return $this->belongsTo(Division::class,'division_id');
    }

    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }

    public function fireStation(){
        return $this->belongsTo(FireStation::class,'fire_station_id');
    }

    public function office(){
        return $this->belongsTo(Office::class,'office_id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class,'designation_id');
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new MailResetPasswordNotification($token));
    }

}
