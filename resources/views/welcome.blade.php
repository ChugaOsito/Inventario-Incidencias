@extends('layouts.app')
@section('content')
<div class="card mb-3">
		<ul class="nav nav-pills">
  <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Inicio</a></li>
  <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Perfil del usuario</a></li>
  
    <ul class="dropdown-menu">
      <li><a href="#dropdown1" data-toggle="tab">Action</a></li>
      <li class="divider"></li>
      <li><a href="#dropdown2" data-toggle="tab">Another action</a></li>
    </ul>
  </li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
  &nbsp;
  <div class="panel-body">
    <div class="jumbotron">
  <h1>Gestión de incidencias</h1>
  <p>Un sistema de control de inventarios te permite controlar los bienes y registrar los movimientos.</p>
  <p><a href="/home" class="btn btn-success btn-lg">Conocer más</a></p>

  </div>
</div>
  </div>
  &nbsp;
  <div class="tab-pane fade" id="profile">
  <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Panel primary</h3>
  </div>
  <div class="panel-body">
<h5>NOMBRE: {{ auth()->user()->name }}</h5>
<h5>EMAIL:  {{ auth()->user()->email }}</h5>
  </div>
</div>
@endsection
