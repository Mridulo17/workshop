<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionTestingDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function visitorEmployee(){

        return $this->belongsTo(Employee::class, 'visitor_employee_id');
    }

    public function visitorhelperEmployee(){
        return $this->belongsTo(Employee::class,'visitor_helper_employee_id');
    }

    public function inspectionTesting(){
        return $this->belongsTo(InspectionTesting::class);
    }

    public function visitorDesignation(){

        return $this->belongsTo(Designation::class, 'visitor_designation_id');
    }

    public function visitorhelperDesignation(){

        return $this->belongsTo(Designation::class, 'visitor_helper_designation_id');
    }
}
