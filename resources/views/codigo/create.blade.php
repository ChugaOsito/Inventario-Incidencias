@extends('layouts.app')

@section('content')
@if (auth()->user()->is_admin)
<div class="panel panel-primary">
    <div class="panel-heading">Agregar codigo</div>

    <div class="panel-body">
        @if (session('notification'))
            <div class="alert alert-success">
                {{ session('notification') }}
            </div>
        @endif
                @if (count($errors) > 0)
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
                <label for="codigo">Código</label>
                <input type="text" name="codigo" class="form-control" placeholder="Ingrese código">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre del tipo de bien</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre del equipo tecnologico">
            </div>
            <div class="form-group">
                <label for="numero">Número del bien</label>
                <input type="text" name="numero" class="form-control" placeholder="Ingrese número del equipo tecnologico">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Registrar codigo</button>
            </div>
        </form>
        
        <form method="GET" action="{{ route('codigos') }}">
            {{ csrf_field() }}
            <div style="overflow-x:auto;">
                <table id="productos" class="table table-striped dt-responsive nowrap" style="width:100%">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Tipo de bien</th>
                            <th scope="col">Número</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($codigos as $codigo)
                        <td>{{ $codigo->id }}</td>
                        <td>{{ $codigo->codigo }}</td>
                        <td>{{ $codigo->nombre }}</td>
                        <td>{{ $codigo->numero }}</td>
                        <td>
                            <a href="/codigos/{{ $codigo->id }}/editar" class="btn btn-sm btn-success"
                                title="Editar">Editar
                            </a>
                            <a href="/codigos/{{ $codigo->id }}/eliminar" class="btn btn-sm btn-danger"
                                title="Dar de baja">Eliminar
                            </a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</div>
       @section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

    @endsection
    @section('scripts')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
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
    @endif
    @method('PUT')
    @endsection