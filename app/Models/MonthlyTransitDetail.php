<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyTransitDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['month_name'];

    public function employee(){
        return $this->belongsTo(Employee::class,'sso_employee_id');
    }

    public function monthlyTransit(){
        return $this->belongsTo(MonthlyTransit::class);
    }

    public function getMonthNameAttribute(){
        return MonthlyTransit::findMonth($this->months);
    }
}
