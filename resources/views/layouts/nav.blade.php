<script type="text/javascript" src="{{asset('js/date_time.js')}}"></script>

<nav class="navbar navbar-default navbar-static-top" style="background-color:#ffddc1;">
	<div class="container">
		<div class="navbar-header">

			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" >
				<img src="/assets/img/company.png" style="height: 25px"> 
			<a class="navbar-brand" href="{{ url('/') }}">
			</a>
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">
				@if(Auth::user()->role !="employee")
				<li><a href="{{ route('departments.index') }}">Departments</a></li>
				<li><a href="{{ route('roles.index') }}">Roles</a></li>
				<li><a href="{{ route('employees.index') }}">Employees</a></li>
				@endif	
				<li> <a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span id="date_time"></span>
                 <script type="text/javascript">window.onload = date_time('date_time');</script></a>
                </li>
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@guest
					<li><a href="{{ route('login') }}">Login</a></li>
					<li><a href="{{ route('register') }}">Register</a></li>
					
				@else
					<li><a href="{{ route('home') }}">Dashboard</a></li>
					<li class="dropdown">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown" >
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" id="test">
							<li>
								<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
					
				@endguest
			</ul>
		</div>
	</div>
</nav>