<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TyreRecordDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tyreRecord(){
        return $this->belongsTo(TyreRecord::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'manufacturer_brand_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'manufacturer_country_id');
    }

    public function employeeDriver()
    {
        return $this->belongsTo(Employee::class, 'driver_employee_id');
    }

    public function employeeSsoSo()
    {
        return $this->belongsTo(Employee::class, 'sso_so_employee_id');
    }
}
