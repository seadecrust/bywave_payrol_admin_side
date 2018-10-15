<html>
<head>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
	<div class="container">
		<div class="box">
			<h1 class="page-header">Payroll</h1>
			
			<address id="address-header">
				<p>{{ $payroll->employee->name }}</p>
				<p>{{ $payroll->employee->email }}</p>
				<p>{{ $payroll->employee->address }}</p>
			</address>		
			
			<hr>
			<p><b>Department: </b> {{ $payroll->employee->role->department->name }}</p>
			<p><b>Role: </b> {{ $payroll->employee->role->name }}</p>
				
			@if($payroll->employee->full_time)
				<p><b>Full-Time</b> :  Yes</p>

				<p><b>Base Salary</b>: {{ $payroll->employee->salary }}</p>

			@else
				<p><b>Part-Time</b> : Yes</p>
				<p><b>Base Salary</b>: 0</p>
			@endif				
			<hr>
			<table style= "width:100%">
				<thead>
					<tr>	
						<th>Date-issued</td>
						<th>Over-Time</th>
						<th>Hours</th>
						<th>Rate</th>
						<th>Laptop Rent</th>
						<th style="color:#FF6666;">Tax</th>
						<th style="color:#FF6666;">Philhealth</th>
						<th style="color:#FF6666;">SSS</th>
						<th style="color:#FF6666;">Pag-ibig</th>
						<th style="color:#FF6666;">Others</th>
						<th>Salary Given</th>
					</tr>
				</thead>									
				<tbody>			
					<tr>		
						<td>{{ $payroll->created_at->toDateString() }}
						<td>
							@if($payroll->over_time)
								<b>Yes</b>				
							@else
								<b>No</b>							
							@endif				
						</td>
								<td>{{ $payroll->hours }}</td>
								<td>{{ $payroll->rate }}</td>
								<td>{{ $payroll->laptoprent }}</td> 
								<td>{{ $payroll->tax }}</td>
								<td>{{ $payroll->philhealth }}</td>
								<td>{{ $payroll->sss }}</td>
								<td>{{ $payroll->pagibig }}</td>
								<td>{{ $payroll->others }}</td>
								<td>{{ $payroll->gross }}</td>								
					</tr>					
				</tbody>																			
			</table>					
		</div>
	</div>
	
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
