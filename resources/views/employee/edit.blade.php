@extends('layouts.app')


@section('content')


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

	<div class="col-lg-12">
		<h1 class="page-header">Update Employee: {{$employee->name }}</h1>
	</div>
		
	<form action="{{ route('employees.update', ['id'=>$employee->id]) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			
		<div class="form-group col-md-6">
			<label for="name">Name: </label>
<<<<<<< HEAD
			<input type="text" name="name" value="{{ $employee->name}}" class="form-control" >		
=======

			<input type="text" name="name" value="{{ $employee->name}}" class="form-control">		

>>>>>>> 283e69186d3c00e1780fa1e701090c503f6e4dd7
		</div>
		
		<div class="form-group col-md-2">
			<label for="email">Email: </label>
<<<<<<< HEAD
			<input type="email" name="email" value="{{ $employee->email}}" class="form-control" >		
		</div>
		<div class="form-group col-md-2">
			<label for="phone">Contact: </label>
			<input type="text" name="phone" value="{{ $employee->phone}}" class="form-control" >		
=======
			<input type="email" name="email" value="{{ $employee->email}}" class="form-control">		
		</div>
		<div class="form-group col-md-2">
			<label for="phone">Contact: </label>
			<input type="text" name="phone" value="{{ $employee->phone}}" class="form-control">		

>>>>>>> 283e69186d3c00e1780fa1e701090c503f6e4dd7
		</div>
		
		<div class="form-group col-md-2">
			<label for="idnum">ID Number: </label>
<<<<<<< HEAD
			<input type="text" name="idnum" value="{{ $employee->idnum}}" class="form-control" >		
=======
			<input type="text" name="idnum" value="{{ $employee->idnum}}" class="form-control">		

>>>>>>> 283e69186d3c00e1780fa1e701090c503f6e4dd7
		</div>

		<div class="form-group col-md-2" hidden="">
			<label for="password">Password: </label>
<<<<<<< HEAD
			<input type="password" name="password" value="{{ $employee->password}}" class="form-control" >		
=======
			<input type="password" name="password" value="{{ $employee->password}}" class="form-control">		
>>>>>>> 283e69186d3c00e1780fa1e701090c503f6e4dd7
		</div>
		
		<div class="form-group col-md-12">
			<label for="address">Address: </label>
<<<<<<< HEAD
			<input type="text" name="address" value="{{ $employee->address }}" class="form-control" >		
=======
			<input type="text" name="address" value="{{ $employee->address }}" class="form-control">		
>>>>>>> 283e69186d3c00e1780fa1e701090c503f6e4dd7
		</div>
		
		<div class="form-group col-lg-3">
			<label for="salary">Salary: </label>
			<input type="text" name="salary" value="{{ $employee->salary}}" class="form-control" 
			 	{{ Auth::user()->role == "admin" ? '' : 'disabled' }}>	
			 	@if( $employee->role != "admin" )
			 		<input type="hidden" name="salary" value="{{ $employee->salary}}" class="form-control">	
			 	@endif
		</div>
		
		<div class="form-group col-lg-3">
			<label for="role">Select a Role</label>
			<select name="role_id"  cols="5" rows="5" class="form-control" {{ Auth::user()->role == "admin" ? '' : 'disabled' }}> 		
				@foreach($roles as $role)
					<option value="{{ $role->id}}"
						@if($employee->role->id == $role->id)
							selected							
						@endif						
					>{{ $role->name }}</option>
				@endforeach
			</select>

			@if( $employee->role != "admin" )
			 		<input type="hidden" name="role_id" value="{{ $role->id }}" class="form-control">	
			 @endif
		</div>
					
		<div class="form-group col-lg-3">
			<label for="full_time">Position:</label>

			<select name="full_time" id="full_time" class="form-control" {{ Auth::user()->role == "admin" ? '' : 'disabled' }}>
				<option value="1">Full-Time</option>
				<option value="0">Part-Time</option>					
			</select>
		@if( $employee->role != "admin" )
			 		<input type="hidden" name="full_time" value="{{ $role->id }}" class="form-control">	
			 @endif
		</div>

	<div class="form-group col-lg-3">
		
		<td>
			<div class="input-group date">
<<<<<<< HEAD
				<label for="datestarted">Date Started: (YYYY-MM-DD) </label>
  				<input type="text" name="datestarted"  id="date" value="{{ $employee->datestarted}}" class="form-control" readonly="readonly"><span class="input-group-addon" ></i></span>
=======
				<label for="datestarted">Date Started: (YYYY-MM-DD)</label>
  				<input type="text" name="datestarted"  id="date" value="{{ $employee->datestarted}}" class="form-control" {{ Auth::user()->role == "admin" ? '' : 'disabled' }}><span class="input-group-addon" ></i></span>
  				@if( $employee->role != "admin" )
			 		<input type="hidden" name="datestarted" value="{{ $employee->datestarted }}" class="form-control">	
			 	@endif
>>>>>>> 283e69186d3c00e1780fa1e701090c503f6e4dd7
			</div>
		</td>
		</div>

		
		<div class="text-center">
			<button class="btn btn-success" type="submit" >Update Changes</button>
		</div>
	</form>

@endsection