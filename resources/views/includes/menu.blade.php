	@if (auth()->check())
		<div class="panel-footer" align="center">
				<div class="user-box">
					<form action="{{ url('/profile/image') }}" id="avatarForm">
						{{ csrf_field() }}
						<input type="file" style="display: none" id="avatarInput">
					</form>
					<div class="wrap">
						<div class="user-img">
							@if(auth()->user()->image)
								<img src="{{ asset('images/users/'.auth()->id().'.'.auth()->user()->image ) }}" alt="user-img" id="avatarImage" title="{{ auth()->user()->name }}" class="img-circle  img-responsive">
							@else
								<img src="{{ asset('images/users/GAD.jpg') }}" width="150" height="150" id="avatarImage" title="{{ auth()->user()->name }}" class="img-circle img-responsive">
							@endif
						</div>
						<div class="text_over_image" id="textToEdit">Editar</div>
					</div>
					<h5>{{ auth()->user()->name }}</h5>
				</div>
		</div>
	@endif
	<div class="panel panel-primary">
	<div class="panel-heading">Menú</div>
	<div class="panel-body">
		<ul class="nav nav-pills nav-stacked">
			@if (auth()->check())
				<li @if(request()->is('home')) class="active" @endif>
					<a href="/home">Panel principal</a>
				</li>
				<li @if(request()->is('reportar')) class="active" @endif>
					<a href="/reportar">Reportar incidencia</a>
				</li>
				@if (auth()->user()->is_admin)
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						Inventario <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="/productos">Equipos tecnologicos</a></li>
						<li><a href="/productos/create">Agregar equipo</a></li>
						<li><a href="/codigos/create">Agregar Tipo de Bien</a></li>
					</ul>
				</li>
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						Administración <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="/usuarios">Usuarios</a></li>
						<li><a href="/proyectos">Agregar proyectos</a></li>
						<li><a href="{{route('activity/log')}}">Activity Logs</a></li>
					</ul>
				</li>
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						Logs <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{route('activity/log')}}">Usuarios</a></li>
						<li><a href="{{route('activity/log/producto')}}">Productos</a></li>
						<li><a href="{{route('activity/log/incidencia')}}">Incidencias</a></li>
					</ul>
				</li>
				@endif
			@else
				<li @if(request()->is('/')) class="active" @endif><a href="/">Bienvenido</a></li>
			@endif
		</ul>
	</div>
</div>
