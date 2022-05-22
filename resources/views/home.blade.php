@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        
        @if (auth()->user()->is_support)
		
        <div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Incidencias asignadas a mí</h3>
			</div>
			
			<div class="panel-body" style="overflow-x:auto;">
				<table class="table table-bordered" style="overflow-x:auto;">
					<thead>
						<tr>
							<th>Código</th>
							<th>Título</th>
							<th>Cliente</th>
							<th>Equipo tecnologico</th>
						</tr>
					</thead>
					<tbody id="dashboard_my_incidents">
						@foreach ($my_incidents as $incident)
							<tr>

								<td>
									<a href="/ver/{{ $incident->id }}">
										{{ $incident->id }}
									</a>
								</td>
								<td>{{ $incident->title_short }}</td>
								<td>{{ $incident->users->name }}</td>
								<td>{{ $incident->productos->descripcion ?? 'Ningun equipo utilizado'}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Incidencias sin asignar</h3>
			</div>
			<div class="panel-body" style="overflow-x:auto;">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Código</th>
							<th>Severidad</th>
							<th>Título</th>
							<th>Cliente</th>
							<th>Equipo tecnologico</th>
							<th>Estado</th>
							<th>Opción</th>
						</tr>
					</thead>
					<tbody id="dashboard_pending_incidents">
						@foreach ($pending_incidents as $incident)
							<tr>
								<td>
									<a href="/ver/{{ $incident->id }}">
										{{ $incident->id }}
									</a>
								</td>
								@if ( $incident->severity == "M")
								<strong><td bgcolor="#008000"><font color="#FFFFFF">{{$incident->severity_full }}</td></b>
								@endif
								@if ( $incident->severity == "N")
								<td bgcolor="#0000FF"><font color="#FFFFFF">{{$incident->severity_full }}</td>
								@endif
								@if ( $incident->severity == "A")
								<td bgcolor="#FF0000"><font color="#FFFFFF">{{$incident->severity_full }}</td>
								@endif
								<td>{{ $incident->title_short }}</td>
								<td>{{ $incident->users->name }}</td>
								<td>{{ $incident->productos->descripcion ?? 'Ningun equipo utilizado'}}</td>
								<td>{{ $incident->state }}</td>
								<td>
									<a href="/ver/{{ $incident->id }}" class="btn btn-primary btn-sm">
										Atender
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif

		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Incidencias reportadas por mí</h3>
			</div>
			<div class="panel-body" style="overflow-x:auto;">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Código</th>
							<th>Estado</th>
							<th>Título</th>
							<th>Responsable</th>
						</tr>
					</thead>
					<tbody id="dashboard_by_me">
						@foreach ($incidents_by_me as $incident)
							<tr>
								<td>
									<a href="/ver/{{ $incident->id }}">
										{{ $incident->id }}
									</a>
								</td>
								@if ($incident->state == "Resuelto")
                    			<td bgcolor="#5D7B9D"><font color="#fff">{{ $incident->state }}</td>
                    			@else
                    			<td>{{ $incident->state }}</td>
                   				@endif
								<td>{{ $incident->title_short }}</td>
								<td>
									{{ $incident->support_id ? $incident->support->name : 'Sin asignar' }}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

    </div>
</div>
@endsection
