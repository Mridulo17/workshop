<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function driverEmployee(){

        return $this->belongsTo(Employee::class, 'duty_driver_employee_id');
    }

    public function ssoEmployee(){
        return $this->belongsTo(Employee::class,'sso_employee_id');
    }

    public function batteryRecord(){
        return $this->belongsTo(BatteryRecord::class);
    }

}
