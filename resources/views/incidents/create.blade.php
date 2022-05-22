@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Crear incidencia</div>
        <div class="panel-body">
        @if (session('notification'))
    <div class="alert alert-success">
        {{ session('notification')}}
    </div>
@endif
    <div class="panel-body">
        @if (count($errors) > 0)
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
            <div class="form-group">
                <label for="producto_id">Elegir serie del producto</label>
                <select name="producto_id" class="form-control">
                    <option value="">Serie</option>
                    @foreach ($productos as $producto)
                    @if ($producto->estados->nombre == "OPERATIVO")
                        <option value="{{ $producto->id }}">{{ $producto->serie }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Categoría</label>
                <select name="category_id" class="form-control">
                    <option value="">General</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="severity">Severidad</label>
                <select name="severity" class="form-control">
                    <option value="M">Menor</option>
                    <option value="N">Normal</option>
                    <option value="A">Alta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="archivo" class="col-md-4 col-form-label text-md-end">Elegir Archivo</label>
                <input type="file" class="form-control form-control-sm" id="archivo" class="form-control @error('archivo') is-invalid @enderror" name="archivo" value="{{ old('archivo') }}" >
                @error('archivo')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
                @enderror
            </div>
          </div>

            <div class="form-group">
                <button class="btn btn-success">Registrar incidencia</button>
            </div>
        </form>
    </div>
</div>
@endsection
