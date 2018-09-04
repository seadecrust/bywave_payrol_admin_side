<script type="text/javascript" src="{{asset('js/date_time.js')}}"></script>

<nav class="navbar navbar-default navbar-static-top" style="background-color:#ffddc1;">
	<div class="container">
		<div class="navbar-header">

			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}">
				{{ config('app.name', 'Payroll') }}
			</a>
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">
				
				<li><a href="{{ route('employees.edit',['id'=>Auth::user()->id]) }}"><b>Profile</b></a></li>	
				<li> <a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span id="date_time"></span>
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
						<a href="#" class="dropdown-toggle" data-target="#test" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" >
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

