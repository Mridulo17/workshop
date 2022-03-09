<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleTransferDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehicleTransfer(){
        return $this->belongsTo(VehicleTransfer::class);
    }

    public function orderDesignation(){
        return $this->belongsTo(Designation::class,'order_designation_id');
    }

    public function fromEmployeeDesignation(){
        return $this->belongsTo(Designation::class,'from_employee_designation_id');
    }

    public function toEmployeeDesignation(){
        return $this->belongsTo(Designation::class,'to_employee_designation_id');
    }

    public function toEmployee(){
        return $this->belongsTo(Employee::class,'to_employee_id');
    }

    public function fromEmployee(){
        return $this->belongsTo(Employee::class,'from_employee_id');
    }

    public function fromFireStation(){
        return $this->belongsTo(FireStation::class,'from_fire_station_id');
    }

    public function toFireStation(){
        return $this->belongsTo(FireStation::class,'to_fire_station_id');
    }

}
