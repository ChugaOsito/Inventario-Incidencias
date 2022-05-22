@extends('layouts.app')
@section('content')
  <div class="panel panel-primary">
    <div class="panel-heading">Detalle del equipo tecnólogico</div>
    <div class="panel-body">
<div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="/storage/{{$producto->imagen}}"   width="150" height="150" >
        &nbsp;
        <center>
              @if ($contador == "CADUCADO")
              <div wire:poll.1000ms class="alert alert-dismissible alert-warning">
              {{$contador}}
              </div>
              @else
              <div wire:poll.1000ms class="alert alert-dismissible alert-success">
              {{$contador}} Años
              @endif
              </div>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <p class="card-text">
        <small>
                   
                    <li><strong>Serie: </strong>{{$producto->serie}}</li>
                    <li><strong>Nombre del equipo tecnológico: </strong>{{$producto->descripcion}}</li>
                    <li><strong>Fecha de ingreso: </strong>{{$producto->fecha_ingreso}}</li>
                    <li><strong>Fecha de compra: </strong>{{$producto->fecha_compra}}</li>
                    <li><strong>Marca: </strong>{{$producto->marcas->nombre}}</li>
                    <li><strong>Modelo: </strong>{{$producto->modelos->nombre}}</li>
                    <li><strong>Características: </strong>{{$producto->caracteristicas}}</li>
        </small>
    </div>
                  <div class="alert alert-dismissible alert-success">
                  <li><strong>Estado: </strong>{{$producto->estados->nombre}}</li>
                  <li><strong>Departamento: </strong>{{$producto->departamentos->nombre}}</li>
    </div>

    <div class="alert alert-dismissible alert-info">
                  <li><strong>Custodio: </strong>{{$producto->users->name}}</li>
                  <li><strong>Precio: </strong>{{$producto->precio}}</li>
                  
  </div>
@endsection