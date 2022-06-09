@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Equipos Anexos de {{$product->codigos->nombre}}     @if ($product->codigos->numero == null)
        <td>{{$product->codigos->codigo}}.{{$product->name_codigo}}</td>
        @else
        <td>{{$producto->codigos->codigo}}.{{$producto->codigos->numero}}.{{$producto->name_codigo}}</td>
        @endif</div>
        <div class="panel-body">




<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus fa-1x "> Nuevo Equipo Anexo</i></button>
<br>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-dark">Crear Equipo Anexo</h4>
            </div>
            <div class="modal-body">

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
            <input style="text-transform:uppercase;" type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
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

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
</div>

</div>
</div>
</div>
<br>

<div style="overflow-x:auto;">
    <table id="productos" class="table table-striped dt-responsive nowrap" style="width:100%">
        <thead class="bg-primary text-light">
            <tr>
                <th scope="col">Tipo de Bien</th>
                <th scope="col">Detalle</th>
                <th scope="col">Custodio</th>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th class="bg-success" scope="col">Estado</th>
                <th scope="col">Depreciación</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col">Precio devaluado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <td>{{ $producto->codigos->nombre}}</td>
            <td><a href="/productos/{{ $producto->id }}/show" class="btn btn-sm btn-warning"
                    title="Editar">Detalle</a></td>
            <td>{{$producto->users->name}}</td>
            <td>{{ $producto->codigo}}</td>
            <td>{{ $producto->descripcion}}</td>
            @if ($producto->estados->nombre == "OPERATIVO")
            <td bgcolor="#5D7B9D">
                <font color="#fff">{{ $producto->estados->nombre }}
            </td>
            @else
            <td>{{ $producto->estados->nombre }}</td>
            @endif
            @if ($producto->vencimiento == "3")
            <td bgcolor="#008000">
                <font color="#fff">{{ $producto->vencimiento}} Años
            </td>
            @elseif ($producto->vencimiento == "2")
            <td bgcolor="#0000FF">
                <font color="#fff">{{ $producto->vencimiento}} Años
            </td>
            @elseif ($producto->vencimiento == "1")
            <td bgcolor="#f39c12">
                <font color="#fff">{{ $producto->vencimiento}} Año
            </td>
            @elseif ($producto->vencimiento == "CADUCADO")
            <td bgcolor="#FF0000">
                <font color="#fff">{{ $producto->vencimiento}}
            </td>
            @else
            <td>{{ $producto->vencimiento }}</td>
            @endif
            <td>{{ $producto->fecha_ingreso}}</td>
            <td>{{ $producto->precio_devaluado }}$</td>
            <td>
                @if ($producto->trashed())
                <a href="/productos/{{ $producto->id }}/restaurar" class="btn btn-sm btn-success"
                    title="Restaurar">Restaurar
                </a>
                @else

                <a href="/productos/{{ $producto->id }}/editar" class="btn btn-sm btn-primary"
                    title="Editar">Editar
                </a>
                <a href="/productos/{{ $producto->id }}/eliminar" class="btn btn-sm btn-danger"
                    title="Dar de baja">Dar de baja
                </a>
                @endif
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection

@section('scripts')
    <script src="/js/admin/users/edit.js"></script>
    <script type="text/javascript">
        @if (count($errors) > 0)
            $('#myModal').modal('show');
        @endif
        </script>

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js">
</script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function() {
    $('#productos').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "Nada encontrado",
            "infoFiltered": "(filtrando de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "next": "siguiente",
                "previous": "Anterior"
            }
        }
    });
});
</script>
@endsection
@section('styles')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

        @endsection
