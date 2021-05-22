@extends('extenciones.adminGral')
@section('content')
<br>
        <div class="container w-50" style = "font-family:Brush Script MT,arial,helvética;"><h1>Lista De Publicaciones</h1></div>
        <div id="main-container" class="w-50 container-md">
            <table class="table border-dark">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        
                    </tr>
                </thead>
                @foreach($recetas as $receta)
                <tr>
                    <td>{{$receta->nombre}}</td>
                    <td><a href="/Recetas/{{$receta->id}}/editar" type="submit" class="btn btn-dark">Editar Receta</a></td>
                </tr>
                @endforeach
            </table>
        </div>
        </div> <br>         
        </div><br>
@endsection