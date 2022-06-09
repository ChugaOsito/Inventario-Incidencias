@extends('layouts.app')

@section('content')
@if (auth()->user()->is_admin)
<div class="panel panel-success">
    <div class="panel-heading">Equipos tecnológicos</div>
    <div class="panel-body">
        @if (session('notification'))
        <div class="alert alert-success">
            {{ session('notification')}}
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
        <form action="{{route('productos')}}" method="GET" class="navbar-form navbar-righ" role="search">
            <blockquote class="blockquote-reverse">
                <small>GII <cite title="Source Title">Obtener un reporte general de todos los equipos
                        tecnologicos</cite></small>
                <a align="right" href="{{route('imprimir')}}" class="btn btn-sm btn-info">PDF</a>
                <a href="/export" class="btn btn-sm btn-warning">EXCEL</a>
                <a align="right" href="/productos" class="btn btn-sm btn-success">ACTUALIZAR</a>
            </blockquote>
        </form>
        <form method="GET" action="{{ route('productos') }}">
            {{ csrf_field() }}
            <div style="overflow-x:auto;">
                <table id="productos" class="table table-striped dt-responsive nowrap" style="width:100%">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th scope="col">Tipo de Bien</th>
                            <th scope="col">Detalle</th>
                            <th scope="col">Custodio</th>
                            <th scope="col">Código</th>
                            <th scope="col">Descripcion</th>
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
                        <td>{{$producto->codigo}}</td>
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
                            <a href="/productos/{{ $producto->id }}/anexos" class="btn btn-sm btn-primary"
                                title="Registrar Equipo Anexo">Equipos Anexos
                            </a>
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
    </div>

    @endif

    @if (auth()->user()->is_support)
    <div class="panel panel-primary">
        <div class="panel-heading">Equipos tecnológicos que no están operando</div>
        <div class="panel-body">
            <div style="overflow-x:auto;">
                <table id="productos" class="table table-bordered">
                    <thead class="bg-success text-light">
                        <tr>
                            <th scope="col">Imagen</th>
                            <th scope="col">Serie</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        @if ($producto->estados->nombre == "NO OPERATIVO")
                        <td><img src="{{ asset('/storage/'.$producto->imagen) }}" width="40" height="40"></td>
                        <td>{{ $producto->serie}}</td>
                        <td>{{ $producto->descripcion}}</td>
                        <td>{{ $producto->users->name }}</td>
                        <td>{{ $producto->departamentos->nombre}}</td>
                        <td>{{ $producto->estados->nombre }}</td>
                        <td><a href="/productos/{{ $producto->id }}/editar" class="btn btn-sm btn-primary"
                                title="Editar">Usar</a></td>
                        @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        @section('styles')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

        @endsection
        @section('scripts')
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
        @method('PUT')
        @endsection
