<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KmplLphDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kmplLphRecord(){
        return $this->belongsTo(KmplLphRecord::class);
    }

    public function examiner_employee(){
        return $this->belongsTo(Employee::class,'examiner_employee_id');
    }

    public function examiner_designation(){
        return $this->belongsTo(Designation::class,'examiner_designation_id');
    }

}
