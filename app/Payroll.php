<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	protected $fillable=['employee_id','over_time','hours','rate','input_salary','tax','philhealth','sss','pagibig','laptoprent','others'];
	
	
	public function employee(){
		return $this->belongsTo('App\Employee');
	}
	
	public function grossPay(){
		$calc = 0;
		$deduction = $this->tax + $this->philhealth + $this->sss +$this->pagibig  + $this->others;
		if($this->employee->full_time && !$this->over_time){
			$calc = $this->input_salary + $this->laptoprent;
			return $this->gross = $calc - $deduction;
		}
		if($this->employee->full_time && $this->over_time){
			$calc = $this->hours * $this->rate + $this->input_salary;
			return $this->gross + $this->laptoprent = $calc - $deduction;
		}
		if($this->over_time || !$this->full_time){
			$calc = $this->hours * $this->rate + $this->input_salary;
			return $this->gross = $calc - $deduction;
		}
		return $this->gross = 0;
	}
	
	
}
