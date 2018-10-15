@extends('layouts.app')

@section('content')

	<div class="col-lg-12">
		<h1 class="page-header">Edit Payroll : {{ $payroll->employee->name }}</h1>
	</div>
		@if($payroll->employee->full_time)
			<p><b>Full-Time</b> :  Yes</p>
			<p><b>Base Salary</b>: {{ $payroll->employee->salary }}</p>
		@else
			<p><b>Part-Time<b> : Yes</p>
			<br>
			<p><b>Base Salary<b>: 0</p>
		@endif
		
		<form action="{{ route('payrolls.update',['id'=>$payroll->id])}}" method="POST"
			class="form-horizontal">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
			
			@if($payroll->over_time == "1")
			<div class="form-group">
				<label class="control-label col-md-1" for="over_time">Overtime:</label>
				<div class="col-md-4">
			    <select name="over_time" id="over_time" class="form-control" readonly>
						<option value="1">Yes</option>					
					</select>
				</div>
			</div>
			@endif

			@if($payroll->over_time == "0")
			<div class="form-group">
				<label class="control-label col-md-1" for="over_time">Overtime:</label>
				<div class="col-md-4">
			    <select name="over_time" id="over_time" class="form-control" readonly>
						<option value="0">No</option>					
					</select>
				</div>
			</div>
			@endif
			
			<div class="form-group">
				<label class="control-label col-md-1" for="input_salary">Salary: </label>
				<div class="col-md-4">					
					<input type="number" name="input_salary" value="{{ $payroll->input_salary}}" class="form-control">		
				</div>
			</div>
		@if($payroll->over_time == "1")
			<div class="form-group">
				<label class="control-label col-md-1" for="hours">Hours: </label>
				<div class="col-md-4">					
					<input type="number" name="hours"value="{{ $payroll->hours}}" class="form-control">		
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-1" for="rate">Rate: </label>
				<div class="col-md-4">
					<input type="number" name="rate" value="{{ $payroll->rate}}"class="form-control">	
				</div>
			</div>			
			@endif

			<div class="form-group">
				<label class="control-label col-md-1" for="laptoprent">Laptop rent: </label>
				<div class="col-md-4">					
					<input type="number" name="laptoprent"value="{{ $payroll->laptoprent}}" class="form-control">		
				</div>
			</div>

			<div class="col-lg-12">
				<h3 style="color:red;" class="page-header"><b>DEDUCTIONS</b></h3>
			</div>

			<div class="form-group">
				<label class="control-label col-md-1" for="tax">Tax: </label>
				<div class="col-md-4">					
					<input type="number" name="tax"value="{{$payroll->tax}}" class="form-control">		
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-1" for="philhealth">Philhealth: </label>
				<div class="col-md-4">					
					<input type="number" name="philhealth" value="{{ $payroll->philhealth}}" class="form-control">		
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-1" for="sss">SSS: </label>
				<div class="col-md-4">					
					<input type="number" name="sss" value="{{$payroll->sss}}"class="form-control">		
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-1" for="pagibig">Pag-ibig: </label>
				<div class="col-md-4">					
					<input type="number" name="pagibig" value="{{ $payroll->pagibig}}" class="form-control">		
				</div>
			</div>	

			<div class="form-group">
				<label class="control-label col-md-1" for="others">Others: </label>
				<div class="col-md-4">					
					<input type="number" name="others" value="{{ $payroll->others}}" class="form-control">		
				</div>
			</div>	
			
			<div class="col-lg-4 text-center">
				<button class="btn btn-success" type="submit" >Update</button>
			</div>
		</form> 

@endsection
