@extends('layouts.app')

@section('content')
	
	<div class="col-lg-12">
		<h2 class="page-header">Payroll : {{ $employee->name }}</h2>
	</div>
		@if($employee->full_time)
			<p><b>Full-Time</b> :  Yes</p>
			<p><b>Base Salary</b>: {{ $employee->salary }}</p>
		@else
			<p><b>Part-Time<b> : Yes</p>
			<br>
			<p><b>Base Salary<b>: 0</p>
		@endif
		
		<form action="{{ route('payrolls.store',['id'=>$employee->id])}}" method="POST"
			class="form-horizontal">
				{{ csrf_field() }}
			
			<div class="form-group">
				<label class="control-label col-md-1" for="over_time">Overtime:</label>
				<div class="col-md-4">
					<select name="over_time" id="over_time" class="form-control">
						<option value="1">Yes</option>
						<option value="0">No</option>					
					</select>
				</div>
			</div>
			<script> 
		$('[name="over_time"]').on('change',function( event ) {  	
 if ($(over_time).val() == "1") {
    $('[name="hours"]').show(); 
    $('[name="rate"]').show();
    $('label[for="hours"]').show();
 	$('label[for="rate"]').show(); 
  }
 else {
 	$('[name="hours"]').hide();
  	$('[name="rate"]').hide();
 	$('label[for="hours"]').hide();
 	$('label[for="rate"]').hide();
  }
 });
			</script>
	
			<div class="form-group">
				<label class="control-label col-md-1" for="input_salary">Salary: </label>
				<div class="col-md-4">					
					<input type="number" name="input_salary" class="form-control">		
				</div>
			</div>

			
			<div class="form-group">
				<label class="control-label col-md-1" for="hours">Hours: </label>
				<div class="col-md-4">					
					<input type="number" name="hours" class="form-control">		
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-1" for="rate">Rate: </label>
				<div class="col-md-4">
					<input type="number" name="rate" class="form-control">	
				</div>
			</div>	

			<div class="form-group">
				<label class="control-label col-md-1" for="laptoprent">Laptop rent: </label>
				<div class="col-md-4">					
					<input type="number" name="laptoprent" class="form-control">		
				</div>
			</div>

			<div class="col-lg-12">
				<h3 style="color:red;" class="page-header"><b>DEDUCTIONS</b></h3>
			</div>

			<div class="form-group">
				<label class="control-label col-md-1" for="tax">Tax: </label>
				<div class="col-md-4">					
					<input type="number" name="tax" class="form-control">		
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-1" for="philhealth">Philhealth: </label>
				<div class="col-md-4">					
					<input type="number" name="philhealth" class="form-control">		
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-1" for="sss">SSS: </label>
				<div class="col-md-4">					
					<input type="number" name="sss" class="form-control">		
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-1" for="pagibig">Pag-ibig: </label>
				<div class="col-md-4">					
					<input type="number" name="pagibig" class="form-control">		
				</div>
			</div>	


			<div class="form-group">
				<label class="control-label col-md-1" for="others">Others: </label>
				<div class="col-md-4">					
					<input type="number" name="others" class="form-control">		
				</div>
			</div>	

			<div class="col-lg-4 text-center">
				<button class="btn btn-success" type="submit" >Submit</button>
			</div>
		</form> 

@endsection
