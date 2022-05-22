@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Agregar modelo</div>
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
     <form action="" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="codigo">Editar código</label>
                <input type="text" name="codigo" class="form-control" value="{{ old('codigo', $codigo->codigo) }}">
            </div>
            <div class="form-group">
                <label for="nombre">Editar tipo de bien</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $codigo->nombre) }}">
            </div>
            <div class="form-group">
                <label for="numero">Editar número del bien</label>
                <input type="text" name="numero" class="form-control" value="{{ old('numero', $codigo->numero) }}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Editar modelo</button>
            </div>
        </form>
@method('PUT')
@endsection

@section('scripts')
    <script src="/js/admin/users/edit.js"></script>
@endsection