@extends('layouts.app')


@section('content')



	<div class="col-lg-12">
		<h1 class="page-header">Update Employee: {{$employee->name }}</h1>
	</div>
		
	<form action="{{ route('employees.update', ['id'=>$employee->id]) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			
		<div class="form-group col-md-6">
			<label for="name">Name: </label>

			<input type="text" name="name" value="{{ $employee->name}}" class="form-control">		

		</div>
		
		<div class="form-group col-md-2">
			<label for="email">Email: </label>
			<input type="email" name="email" value="{{ $employee->email}}" class="form-control">		
		</div>
		<div class="form-group col-md-2">
			<label for="phone">Contact: </label>
			<input type="text" name="phone" value="{{ $employee->phone}}" class="form-control">		

		</div>
		
		<div class="form-group col-md-2">
			<label for="idnum">ID Number: </label>
			<input type="text" name="idnum" value="{{ $employee->idnum}}" class="form-control"  class="form-control" 
			 	{{ Auth::user()->role == "admin" ? '' : 'readonly' }}>
			 			
		</div>

		<div class="form-group col-md-2" >
			<label for="password">Password: @if(Auth::user()->role == 'admin') <a id="reset_password">Reset Password</a>@endif </label>
			<input type="password" name="password" value="{{ $employee->password}}" id="password-holder" class="form-control" readonly>	
		</div>
		
		<div class="form-group col-md-10">
			<label for="address">Address: </label>
			<input type="text" name="address" value="{{ $employee->address }}" class="form-control">		
		</div>
		
		<div class="form-group col-lg-3">
			<label for="salary">Salary: </label>
			<input type="text" name="salary" value="{{ $employee->salary}}" class="form-control" 
			 	{{ Auth::user()->role == "admin" ? '' : 'readonly' }}>	
			 	@if( $employee->role != "admin" )
			 		<input type="hidden" name="salary" value="{{ $employee->salary}}" class="form-control">	
			 	@endif
		</div>
		
		<div class="form-group col-lg-3">
			<label for="role">Select a Role</label>
			<select name="role_id"  cols="5" rows="5" class="form-control" {{ Auth::user()->role == "admin" ? '' : 'readonly' }}> 		
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

			<select name="full_time" id="full_time" class="form-control" {{ Auth::user()->role == "admin" ? '' : 'readonly' }}>
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
				<label for="datestarted">Date Started: (YYYY-MM-DD)</label>
  				<input type="text" name="datestarted"  id="date" value="{{ $employee->datestarted}}" class="form-control" {{ Auth::user()->role == "admin" ? '' : 'readonly' }}><span class="input-group-addon" ></i></span>
  				@if( $employee->role != "admin" )
			 		<input type="hidden" name="datestarted" value="{{ $employee->datestarted }}" class="form-control">	
			 	@endif
			</div>
		</td>
		</div>

		
		<div class="text-center">
			<button class="btn btn-success" type="submit" >Update Changes</button>
		</div>
	</form>



	<div id="update-password" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Update Password</h4>
	      </div>
	      <div class="modal-body">
	    
	        	<div class="form-group">
	        		<label>Old Password</label>
	        		<input type="password" name="old-password" class="form-control" id="old-password" placeholder="Current Password">
	        	</div>
	        	<div class="form-group">
	        		<label>New Password</label>
	        		<input type="password" name="new-password" class="form-control" id="new-password" placeholder="New Password" readonly>
	        	</div>
	        	<div class="form-group">
	        		<label>Verify Password</label>
	        		<input type="password" name="verify-password" class="form-control" id="verify-password" placeholder="Confirm New Password" readonly>
	        	</div>
	        	<div class="form-group text-center">
	        		<button class="btn btn-info" id="btn-update-password" data-dismiss="modal" disabled>Save</button>
	        	</div>
	        
	      </div>
	    </div>

	  </div>
	</div>

	<div id="modal-save" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-body text-center">
	    	Password saved!
	    	<br>
	       <aclass="btn btn-info" id="btn-update-password" data-dismiss="modal">OK</a>
	      </div>
	    </div>

	  </div>
	</div>


	<script type="text/javascript">
		$(function(){

		 @if(Auth::user()->role != 'admin')
			$("#password-holder").click(function(){
				$("#update-password").modal();
			});
		@endif

			$("#old-password").keyup(function(){
				var input = $(this).val(); 
				if(input.length > 5 ){
					$("#new-password").prop("readonly", false);
				}else{
					$("#new-password").prop("readonly", true);
				}
			});

			$("#new-password").keyup(function(){
				var input = $(this).val(); 
				if(input.length > 5 ){
					if(input != $("#old-password").val())
						$("#verify-password").prop("readonly", false);
					else
						$("#verify-password").prop("readonly", true);
				}else{
					$("#verify-password").prop("readonly", true);
				}
			});

			$("#verify-password").keyup(function(){
				var input = $(this).val(); 
			
					if(input != $("#new-password").val()){
						$("#btn-update-password").prop("disabled", true);
					}else{
						$("#btn-update-password").prop("disabled", false);
					}
			});

			$("#btn-update-password").click(function(){
			
				var objectData = {
					id: {{ $employee->id }},
					old: $("#old-password").val(),
					new: $("#new-password").val(),
				};

				$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});

				$.ajax({
					url: "{{ url('/') }}/employee/changePass",
					method: 'post',
					data: {data : objectData},
					success: function(data){
						$("#modal-save").modal();
					}
				});

			});

			$("#reset_password").click(function(){
				$.ajax({
					url:"{{ url('/') }}/admin/reset/{{ $employee->id }}",
					method: "get",
					success: function(data){
						console.log(data);
						$("#password-holder").val(data);	
					}
				});
			});


		});
	</script>
@endsection
