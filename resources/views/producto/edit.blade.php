@extends('layouts.app')
@section('content')
@if (auth()->user()->is_admin)
<div class="panel panel-primary">
    <div class="panel-heading">Editar Equipo tecnologico</div>
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
<form method="POST" action=" {{ route('producto.update', $producto->id) }} " enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}
        <img src="{{ asset('/storage/'.$producto->imagen) }}" class="img-thumbnail" width = "100" height = "100">&nbsp;

        <div class="row mb-3">
            <label for="codigos_id" class="col-md-4 col-form-label text-md-end">Elegir Codigo</label>
            <div class="col-md-6">
            <select name="codigos_id" class="form-control" id="exampleFormControlInput1" placeholder="Elegir codigos">
                <option value="">Elegir codigo</option>
                @foreach($codigos as $codigo)
                <option value="{{ $codigo->id }}" @if($producto->codigos_id == $codigo->id) selected @endif>{{ $codigo->nombre }}{{ $codigo->numero }}</option>
                @endforeach
            </select>
            @error('codigos_id')
                <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
        <label for="serie" class="col-md-4 col-form-label text-md-end">{{ __('Número de serie') }}</label>
        <div class="col-md-6">
        <input style="text-transform:uppercase;" type="text" class="form-control"  name="serie" maxlength="16" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="{{ old('serie', $producto->serie) }} "><i>(Mínimo 8 - Máximo 16 caracteres)</i>
        </div>
        </div>

        <div class="row mb-3">
        <label for="descripción" class="col-md-4 col-form-label text-md-end">{{ __('Descripcion del equipo') }}</label>
        <div class="col-md-6">
        <input style="" type="text" name="descripcion" class="form-control" value ="{{ old('description', $producto->descripcion) }}"> </input>
        </div>
        </div>

        <div class="row mb-3">
        <label for="fecha_compra" class="col-md-4 col-form-label text-md-end">{{ __('fecha de compra') }}</label>
        <div class="col-md-6">
        <input readonly id= "datepicker" style="text-transform:uppercase;" type="text" class="form-control"  value ="{{ old('description', $producto->fecha_compra) }}" name="fecha_compra"></i>
        </div>
        </div>
        <script>
                $('#datepicker').datepicker({
                    uiLibrary: 'bootstrap',
                    maxDate : new Date(),
                    format: 'yyyy-mm-dd hh:ii',
                });
        </script>

        <div class="row mb-3">
        <label for="precio" class="col-md-4 col-form-label text-md-end">{{ __('precio') }}</label>
        <div class="col-md-2">
        <input style="text-transform:uppercase;" type="text" class="form-control"  value ="{{ old('precio', $producto->precio) }}" name="precio"> </i>
        </div>
        </div>
         <div class="row mb-3">
            <label for="user_id" class="col-md-4 col-form-label text-md-end">Elegir custodio</label>
            <div class="col-md-6">
            <select name="user_id" class="form-control" id="exampleFormControlInput1" placeholder="Elegir custodio">
                <option value="">Elegir Custodio</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" @if($producto->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
            @enderror
          </div>
        </div>


        <div class="row mb-3">
            <label for="estado" class="col-md-4 col-form-label text-md-end">Elegir Estado</label>
            <div class="col-md-6">
            <select name="estado" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria">
                <option value="">Elegir estado</option>
                @foreach($estados as $estado)
                <option value="{{ $estado->id }}" @if($producto->estado_id == $estado->id) selected @endif>{{ $estado->nombre }}</option>
                @endforeach
            </select>
            @error('estado')
                <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
            <label for="marca" class="col-md-4 col-form-label text-md-end">Elegir Marca</label>
            <div class="col-md-6">
            <select name="marca" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria">
                <option value="">Elegir Marca</option>
                @foreach($marcas as $marca)
                <option value="{{ $marca->id }}" @if($producto->marca_id == $marca->id) selected @endif>{{ $marca->nombre }}</option>
                @endforeach
            </select>
            @error('marca')
                <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
            <label for="modelo" class="col-md-4 col-form-label text-md-end">Elegir Modelo</label>
            <div class="col-md-6">
            <select name="modelo" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria">
                <option value="">Elegir modelo</option>
                @foreach($modelos as $modelo)
                <option value="{{ $modelo->id }}" @if($producto->modelo_id == $modelo->id) selected @endif>{{ $modelo->nombre }}</option>
                @endforeach
            </select>
            @error('modelo')
                <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
            @enderror
          </div>
        </div>

         <div class="row mb-3">
            <label for="departamento" class="col-md-4 col-form-label text-md-end">Elegir Departamento</label>
            <div class="col-md-6">
            <select name="departamento" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria">
                <option value="">Elegir departamento</option>
                @foreach($departamentos as $departamento)
                <option value="{{ $departamento->id }}" @if($producto->departamento_id == $departamento->id) selected @endif>{{ $departamento->nombre }}</option>
                @endforeach
            </select>
            @error('departamento')
                <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
        <label for="caracteristicas" class="col-md-4 col-form-label text-md-end">{{ __('Características') }}</label>
        <div class="col-md-6">
        <input style="text-transform:uppercase;" type="text" class="form-control"  value ="{{ old('caracteristicas', $producto->caracteristicas) }}" name="caracteristicas"> </i>
        </div>
        </div>
        <div class="row mb-3">
                <label for="imagen" class="col-md-4 col-form-label text-md-end"></label>
                <div class="col-md-6">
                 <input readonly id= "datepicker" style="text-transform:uppercase;" type="file" class="form-control"  value ="{{ old('imagen', $producto->imagen) }}" name="imagen"></i>
                @error('imagen')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
                @enderror
            </div>
          </div>
        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button class="btn btn-success">Editar equipo tecnológico</button>
            </div>
        </div>
    </form>
    </div>
</div>
@endif

@if (auth()->user()->is_support)
<div class="panel panel-primary">
    <div class="panel-heading">3.- Ubicación y responsable</div>
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
<form method="POST" action=" {{ route('producto.update', $producto->id) }} " enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}
    <img src="{{ asset('/storage/'.$producto->imagen) }}" class="img-thumbnail" width = "100" height = "100">


        <div hidden class="row mb-3">
        <label for="user_id" class="col-md-4 col-form-label text-md-end">{{ __('Representante') }}</label>
        <div class="col-md-6">
        <input readonly type="text" name="user_id" class="form-control" value="{{ auth()->user()->id }}"> </input>
        </div>
        </div>

        <div hidden class="row mb-3">
        <label for="descripción" class="col-md-4 col-form-label text-md-end">{{ __('Nombre del equipo') }}</label>
        <div class="col-md-6">
        <input type="text" name="descripcion" class="form-control" value ="{{ old('description', $producto->descripcion) }}"> </input>
        </div>
        </div>

        <div hidden class="row mb-3">
        <label for="serie" class="col-md-4 col-form-label text-md-end">{{ __('Número de serie') }}</label>
        <div class="col-md-6">
        <input type="text" name="serie" class="form-control" value="{{ old('serie', $producto->serie) }} "></input>
        </div>
        </div>

        <div hidden class="row mb-3">
        <label for="estado" class="col-md-4 col-form-label text-md-end">{{ __('Número de serie') }}</label>
        <div class="col-md-6">
        <input value="1" type="text" name="estado" class="form-control" value="{{ old('serie', $producto->estado) }} "></input>
        </div>
        </div>

        <div hidden class="row mb-3">
            <label for="marca" class="col-md-4 col-form-label text-md-end">Elegir Marca</label>
            <div class="col-md-6">
            <select name="marca" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria">
                <option value="">Elegir Marca</option>
                @foreach($marcas as $marca)
                <option value="{{ $marca->id }}" @if($producto->marca_id == $marca->id) selected @endif>{{ $marca->nombre }}</option>
                @endforeach
            </select>
            @error('marca')
                <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
            @enderror
          </div>
        </div>

        <div hidden class="row mb-3">
            <label for="modelo" class="col-md-4 col-form-label text-md-end">Elegir Modelo</label>
            <div class="col-md-6">
            <select name="modelo" class="form-control" id="exampleFormControlInput1" placeholder="Elegir categoria">
                <option value="">Elegir modelo</option>
                @foreach($modelos as $modelo)
                <option value="{{ $modelo->id }}" @if($producto->modelo_id == $modelo->id) selected @endif>{{ $modelo->nombre }}</option>
                @endforeach
            </select>
            @error('modelo')
                <span class="invalid-feedback d-block" role="alert"><strong>{{$message}}</strong></span>
            @enderror
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
        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button class="btn btn-sm btn-info">Utilizar equipo tecnológico</button>
            </div>
        </div>
    </form>
    </div>
</div>
@endif
@endsection

@section('scripts')
    <script src="/js/admin/users/edit.js"></script>
@endsection
