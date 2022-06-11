@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Agregar nuevo equipo tecnologico</div>
        <div class="panel-body">
        @if (session('notification'))
            <div class="alert alert-success">
                {{ session('notification') }}
            </div>
        @endif

@if (count($errors) > 0 )
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
    <form action="" method="POST" enctype="multipart/form-data" novalidate>
        {{ csrf_field() }}
        <div class="row mb-3">
            <label for="codigos_id" class="col-md-4 col-form-label text-md-end" >Elegir equipo tecnológico</label>
            <div class="col-md-6">
            <select  name="codigos_id" class="form-control" id="exampleFormControlInput1" placeholder="Elegir codigo" value="{{ old('codigos_id') }}" >
                @foreach($codigos as $codigo)
                <option value="{{ $codigo->id }}">{{ $codigo->nombre }} {{$codigo->numero}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row mb-3">
        <label for="serie" class="col-md-4 col-form-label text-md-end">{{ __('Número de serie') }}</label>
        <div class="col-md-6">
        <input style="text-transform:uppercase;" type="text" class="form-control"  name="serie" maxlength="16" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="{{ old('serie') }}"><i>(Mínimo 8 - Máximo 16 caracteres)</i>
        </div>
        </div>

        <div class="row mb-3">
            <label for="descripción" class="col-md-4 col-form-label text-md-end">{{ __('Descripcion del equipo') }}</label>
        <div class="col-md-6">
        <input style="" type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
        </div>
        </div>

        <div class="row mb-3">
        <label for="fecha_compra" class="col-md-4 col-form-label text-md-end">{{ __('fecha de compra') }}</label>
        <div class="col-md-6">
        <input readonly id= "datepicker" style="text-transform:uppercase;" type="text" class="form-control"  name="fecha_compra"></i>
        </div>
        </div>
        <script>
                $('#datepicker').datepicker({
                    maxDate : new Date(),
                    uiLibrary: 'bootstrap',
                    format: 'yyyy-mm-dd hh:ii',
                });
        </script>

        <div class="row mb-3">
        <label for="precio" class="col-md-4 col-form-label text-md-end">{{ __('Precio') }}</label>
        <div class="col-md-2">
        <input style="text-transform:uppercase;" type="text" class="form-control"  name="precio"></i>
        </div>
        </div>

        <div class="row mb-3">
            <label for="user_id" class="col-md-4 col-form-label text-md-end" >Custodio</label>
            <div class="col-md-6">
            <select name="user_id" class="form-control" id="exampleFormControlInput1" placeholder="Elegir custodio del equipo tecnológico" value="{{ old('user_id') }}" >
                <option value="">Elegir Custodio</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        </div>

        <div class="row mb-3">
            <label for="estado" class="col-md-4 col-form-label text-md-end" >Estado</label>
            <div class="col-md-6">
            <select name="estado" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria" value="{{ old('estado') }}" >
                <option value="">Elegir Estado</option>
                @foreach($estados as $estado)
                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row mb-3">
            <label for="marca" class="col-md-4 col-form-label text-md-end">Marca</label>
            <div class="col-md-6">
            <select name="marca" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria" value="{{ old('marca') }}" >
                <option value="">Elegir Marca</option>
                @foreach($marcas as $marca)
                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row mb-3">
            <label for="modelo" class="col-md-4 col-form-label text-md-end">Modelo</label>
            <div class="col-md-6">
            <select name="modelo" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria" value="{{ old('modelo') }}" >
                <option value="">Elegir Modelo</option>
                @foreach($modelos as $modelo)
                <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row mb-3">
            <label for="departamento" class="col-md-4 col-form-label text-md-end" >Departamento</label>
            <div class="col-md-6">
            <select name="departamento" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria" value="{{ old('departamento') }}" >
                <option value="">Elegir Departamento</option>
                @foreach($departamentos as $departamento)
                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                @endforeach
            </select>
        </div>
        </div>

        <div class="row mb-3">
        <label for="caracteristicas" class="col-md-4 col-form-label text-md-end">{{ __('Características') }}</label>
        <div class="col-md-6">
        <textarea name="caracteristicas" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        </div>

        <div class="row mb-3">
                <label for="imagen" class="col-md-4 col-form-label text-md-end">Elegir Imagen</label>
                <div class="col-md-6">
                <input type="file" class="form-control form-control-sm" id="imagen" class="form-control @error('imagen') is-invalid @enderror" name="imagen" value="{{ old('imagen') }}" >
                @error('imagen')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
                @enderror
            </div>
          </div>
        <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
            <button  class="btn btn-success">Registrar equipo</button>
            </div>
        </div>
    </form>
@method('PUT')
@endsection

@section('scripts')
    <script src="/js/admin/users/edit.js"></script>
@endsection
