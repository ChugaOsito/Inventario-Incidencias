 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border-collapse: collapse;
            border-spacing: 0;
        }
        th{
            padding: 10px 20px;
            border: 1px solid #000;
        }
        h1{
        text-align: center;
        text-transform: uppercase;
        }
        .contenido{
        font-size: 20px;
        }
        #primero{
        background-color: #ccc;
        }
        #segundo{
        color:#44a359;
        }
        #tercero{
        text-decoration:line-through;
        }
    </style>

</head>
<body id="body">
<h1>Reporte General de los equipos tecnologicos</h1>
         @foreach($productos as $producto)
        <div class="contenido">
            <p id="primero">Consulta de incidencias e inventario:</p>{{ $producto->users->name }} 
        </div>
    
       <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Serie</th>
                    <th>Nombre</th>
                    <th>Responsable</th>
                    <th>Estado</th>
                    <th>Departamento</th>
                </tr>
            </thead>
            <tbody>
             </tr>  
                    <td>{{ $producto->serie}}</td>
                    <td>{{ $producto->descripcion}}</td>
                    <td>{{ $producto->users->name }}</td> 
                    <td>{{ $producto->estados->nombre }}</td>
                    <td>{{ $producto->departamentos->nombre }}</td>
                </tr>   
            </tbody>
        </table></center>
        @endforeach
         <script src="script.js"></script>  
    </body>
</html>