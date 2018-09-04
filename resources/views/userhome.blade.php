
@extends('layouts.lol')

@section('content')

<div class="row" style="margin-top: -2%;">
		<div class="col-md-12" style=" text-align: center; padding: 10px 10px 10px 10px;>
			<img src="{{url('assets/img/company.png')}}" style="height: 45px" alt="Company Logo"> 

			<h3 style="margin-top:.5%;">Payroll System</h3>	
			
		</div>
	</div>
	<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(function() {
    $("#datepicker").datepicker();
  } );
</script>
{{-- <link href="assets/css/AddedDesign.css" rel="stylesheet"/> --}}
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" rel="stylesheet"/>
 --}}

</head>
<body>
 

<div class="row box-white padding-5" ">

	<table width="30%" border="0">

			<td>
				<h4 style="text-align: center;">Date:</h4>
			</td>
			<td>
				<div class="input-group date">
	  				<input type="text" class="form-control" id="datepicker"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
				</div>
			</td>

			<td>
				<input type="button" class="btn btn-primary" value="Search">
			</td>
	</table>

</div>
<div class="row box-white padding-20" style="margin-top: 1%;">

<div class="row " >
<div class="col-md-4" style="border-right: 1px rgba(150,150,150, .3) solid;">
<table>
	<h4><b> Profile </b></h4>
	<tr>

	<td>Name: 
	<td><b>{{ $user_employee->name }}</b></td>
	</tr>
	<tr>
	<td>Base Salary: </td>
	<td><b>{{ $user_employee->salary }}</b></td>
	</tr>
	<tr>
	<td>Allowance: </td>
	<td><b></b></td>
	</tr>
	<tr>

</table>
</div>
<div class="col-md-6">
<table>
<h4><b> Deductions(s) </b></h4>
	<tr>
	<td>Tax: </td>
	<td><b> </b></td>
	</tr>
	<tr>
	<td>Philhealth: </td>
	<td><b></b></td>
	</tr>
	<tr>
	<td>SSS: </td>
	<td><b></b></td>
	</tr>
	<tr>
	<td>PAG-IBIG:</td>
	<td></td>
	</tr>
	<tr>
	<td>Laptop Rent:</td>
	<td></td>
	</tr>
	<tr>
	<td>Others:</td>
	<td></td>
	</tr>
</table>
</div>
</div>
<hr id="divider">

<div class="row">

	<div class="col-md-6" style="border: 1px;">
		<table class="table table-condensed table-responsive">
		<thead>
			<tr>
				<th>Salary Received: </th>
				<th>From: </th>
				<th>Amount: </th>
				<th><b>Total:</b></th>
			</tr>
		</thead>
		<tbody id="payroll-tbody"></tbody>

		</table>
	</div>
</div>

</div>
</div>
</div>

</body>
</html>

<script type="text/javascript">
	$.ajax({
		url: "{{ url('/') }}/payroll/getPayroll/2/2018-09-04 11:09:09",
		method: "get",
		success: function(data){
			var table = $("#payroll-tbody");
			var row = "";
			$.each(data, function(key, value){
				row +=`<tr>
						<td>`+value["created_at"]+`</td>
						<td>N/A</td>
						<td>`+value["gross"]+`</td>
						<td>`+value["gross"]+`</td>
			   		</tr>`;	
			});
			table.empty();
			table.append(row);
			
			 
		}
	});

</script>

@endsection