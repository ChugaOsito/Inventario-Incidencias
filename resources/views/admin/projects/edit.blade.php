@extends('layouts.app')

@section('content')
@if (auth()->user()->is_admin)
<div class="panel panel-primary">
    <div class="panel-heading">Editar proyectos</div>
    <div class="panel-body">
        @if (session('notification'))
    <div class="alert alert-success">
        {{ session('notification')}}
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
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $project->name) }}">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" name="description" class="form-control" value="{{ old('description', $project->description) }}">
            </div>
            <div class="form-group">
                <label for="start">Fecha de inicio</label>
                <input type="date" name="start" class="form-control" value="{{ old('start', $project->start) }}">
            </div>
               &nbsp;
            <div class="form-group">
                <button class="btn btn-success">Guardar proyecto</button>
            </div>
        </form>
   &nbsp;
       <div class="row">
            <div class="col-md-6">
                <p>Categorías</p>
                <form action="/categorias" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Ingrese nombre" class="form-control">
                    </div>
                    <button class="btn btn-primary">Añadir</button>                    
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" title="Editar" data-category="{{ $category->id }}">Editar
                                </button>
                                <a href="/categoria/{{ $category->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">Eliminar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <p>Niveles</p>
                <form action="/niveles" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Ingrese nombre" class="form-control">
                    </div>
                    <button class="btn btn-primary">Añadir</button>                    
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nivel</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($levels as $key => $level)
                        <tr>
                            <td>N{{ $key+1 }}</td>
                            <td>{{ $level->name }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" title="Editar" data-level="{{ $level->id }}">Editar
                                </button>
                                <a href="/nivel/{{ $level->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">Eliminar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>        

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalEditCategory">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">Editar categoria</h5>
      </div>
      <form action="/categoria/editar" method="POST">
          {{ csrf_field() }}
          <div class="modal-body">        
            <input type="hidden" name="category_id" id="category_id" value="">
            <div class="form-group">
                <label for="name">Nombre de la categoría</label>
                <input type="text" class="form-control" name="name" id="category_name" value="">
            </div>        
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalEditLevel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Nivel</h5>
      </div>
      <form action="/nivel/editar" method="POST">
          {{ csrf_field() }}
          <div class="modal-body">        
            <input type="hidden" name="level_id" id="level_id" value="">
            <div class="form-group">
                <label for="name">Nombre del nivel</label>
                <input type="text" class="form-control" name="name" id="level_name" value="">
            </div>        
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Button trigger modal -->
@endif
@endsection

@section('scripts')
    <script src="/js/admin/projects/edit.js"></script>
@endsection