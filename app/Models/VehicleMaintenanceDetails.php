<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMaintenanceDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehicleMaintenanceOrder(){

        return $this->belongsTo(VehicleMaintenanceOrder::class);
    }

    public function employee(){

        return $this->belongsTo(Employee::class, 'order_giving_employee_id');
    }
}
