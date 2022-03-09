<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LubricantDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lubricantRecord(){
        return $this->belongsTo(LubricantRecord::class);
    }

    public function substitutorEmployee(){
        return $this->belongsTo(Employee::class,'substitutor_employee_id');
    }

    public function ssoEmployee(){
        return $this->belongsTo(Employee::class,'sso_employee_id');
    }

}
