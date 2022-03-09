<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverRecordDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function driverRecord(){
        return $this->belongsTo(DriverRecord::class);
    }

    public function driverEmployee(){
        return $this->belongsTo(Employee::class,'driver_employee_id');
    }

    public function ssoSoEmployee(){
        return $this->belongsTo(Employee::class,'sso_so_employee_id');
    }


}
