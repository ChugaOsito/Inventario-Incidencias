@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Mirar incidencias</div>
    <div class="panel-body">
        @if (session('notification'))
    <div class="alert alert-success">
        {{ session('notification')}}
    </div>
@endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Proyecto</th>
                    <th>Categoría</th>
                    <th>Fecha de envío</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="incident_key">{{ $incident->id }}</td>
                    <td id="incident_project">{{ $incident->project->name }}</td>
                    <td id="incident_category">{{ $incident->category_name }}</td>
                    <td id="incident_created_at">{{ $incident->created_at }}</td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th>Asignada a</th>
                    <th>Nivel</th>
                    <th>Estado</th>
                    <th>Severidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="incident_responsible">{{ $incident->support_name }}</td>
                    <td>{{ $incident->level->name }}</td>
                    <td id="incident_state">{{ $incident->state }}</td>
					@if ( $incident->severity == "M")
					<strong><td bgcolor="#008000"><font color="#FFFFFF">{{$incident->severity_full }}</td></b>
					@endif
					@if ( $incident->severity == "N")
					<td bgcolor="#0000FF"><font color="#FFFFFF">{{$incident->severity_full }}</td>
					@endif
					@if ( $incident->severity == "A")
					<td bgcolor="#FF0000"><font color="#FFFFFF">{{$incident->severity_full }}</td>
					@endif
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Título</th>
                    <td id="incident_summary">{{ $incident->title }}</td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td id="incident_description">{{ $incident->description }}</td>
                </tr>
                <tr>
                    <th>Cliente que genera la incidencia</th>
                    <td id="incident_description">{{ $incident->users->name }}</td>
                </tr>
                                <tr>
                <th>Equipo tecnologico de la incidencia</th>
                    <td id="incident_description">{{ $incident->productos->descripcion ?? 'Equipo dado de baja' }}</td>
                </tr>
                <th>Serie del equipo</th>
                    <td id="incident_description">{{ $incident->productos->serie ?? 'Equipo dado de baja' }}</td>
                </tr>
                                <tr>
                    <th>Archivo</th>
                    <td><a href="{{ asset('/storage/'.$incident->archivo) }}" class="btn btn-primary">Descargar Archivo</a></td>
                </tr>
            </tbody>
        </table>

        @if ($incident->support_id == null && $incident->active && auth()->user()->canTake($incident))
        <a href="/incidencia/{{ $incident->id }}/atender" class="btn btn-primary btn-sm" id="incident_btn_apply">
            Atender incidencia
        </a>
        <a href="/productos" class="btn btn-success btn-sm" id="incident_btn_edit">
        Utilizar equipo tecnologico
        </a>
        @endif

        @if (auth()->user()->id == $incident->client_id)
            @if ($incident->active)
                <a href="/incidencia/{{ $incident->id }}/resolver" class="btn btn-info btn-sm" id="incident_btn_solve">
                    Marcar como resuelto
                </a>
                <a href="/incidencia/{{ $incident->id }}/editar" class="btn btn-success btn-sm" id="incident_btn_edit">
                    Editar incidencia
                </a>
            @else
                <a href="/incidencia/{{ $incident->id }}/abrir" class="btn btn-info btn-sm" id="incident_btn_open">
                    Volver a abrir incidencia
                </a>
            @endif
        @endif

        @if (auth()->user()->id == $incident->support_id && $incident->active)
        <a href="/incidencia/{{ $incident->id }}/derivar" class="btn btn-danger btn-sm" id="incident_btn_derive">
            Derivar al siguiente nivel
        </a>
@endif  
@include('layouts.chat')
@endsection
