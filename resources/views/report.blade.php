@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Iniciar sesión</div>
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
        <div class="row mb-3">
            <label for="category_id" class="col-md-4 col-form-label text-md-end">Categoria</label>
            <div class="col-md-6">
            <select name="category_id" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria">
                <option value="">General</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="row mb-3">
            <label name="severity" class="col-md-4 col-form-label text-md-end" for="exampleFormControlSelect1">Severidad</label>
            <div class="col-md-6">
            <select name="severity" class="form-control" id="exampleFormControlSelect1">
                <option value="M">Menor</option>
                <option value="N">Normal</option>
                <option value="A">Alto</option>
            </select>
        </div>
        </div>
        <div class="row mb-3">
            <label for="title" class="col-md-4 col-form-label text-md-end">Título</label>
            <div class="col-md-6">
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-md-4 col-form-label text-md-end">Descripción</label>
            <div class="col-md-6">
            <textarea name="description" class="form-control">{{ old('decription') }}</textarea>
            </div>
        </div>
        <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
            <button class="btn btn-primary">Registrar incidencia</button>
        </div>
    </form>
        </div>
</div>
@endsection