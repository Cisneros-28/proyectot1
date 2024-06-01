@extends('adminlte::page')
@section('title', 'Lista de Asistencia')
@section('content_header')
    <h1>LISTAR ASISTENCIA</h1>



@stop
@section('content')
    @if (session('mensaje'))
        <div class="alert alert-success">
            <strong>{{ session('mensaje') }}</strong>
        </div>
    @endif
    @if (session('deleted'))
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>{{ session('deleted') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if (Auth::user()->hasrole('PROFESOR'))
            <form action="{{route('profesor.asistencias.store')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary" id="btn" >NUEVA ASISTENCIA</button>
            </form>
            @endif


    <br>
    <div class="card">
        <div class="card body py-2 px-1">

            <table id="productos" class="table table striped shadow-lg mt-4">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>FECHA</th>
                        <th>ACCIONES</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($asistencias as $asistencia)
                    <tr>
                        <td>{{$asistencia->id}}</td>


                            <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->formatLocalized('%d %B %G') }}</td>


                        <td>
                            @if (Auth::user()->hasrole('ESTUDIANTE'))
                            <a href="{{route('profesor.asistencias.show', $asistencia->id)}}" class="btn btn-secondary btn-sm">VER</a>
                                @endif
                                @if (Auth::user()->hasrole('PROFESOR'))
                            <form action="{{ route('profesor.asistencias.destroy', $asistencia->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('profesor.asistencias.show', $asistencia->id)}}" class="btn btn-secondary btn-sm">VER</a>
                                <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                            </form>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#productos').DataTable({
                "language": {
                    "search": "Buscar",
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "first": "primero",
                        "last": "Ultimo"
                    }
                }
            });
        });
    </script>
    <script>
        function deshabilitar(btn) {

             document.getElementById(btn).style.visibility = 'hidden';

     }
     </script>

@endsection
