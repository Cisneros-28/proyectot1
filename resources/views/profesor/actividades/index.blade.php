@extends('adminlte::page')
@section('title', 'Lista de Actividades')
@section('content_header')
    <h1>Lista de Actividades</h1>

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
    <div class="card-header">
<a href="{{route('profesor.actividades.create')}}" class="btn btn-primary" >NUEVA ACTIVIDAD</a>
    </div>
    @endif
    <br>
    <div class="card">
        <div class="card body py-2 px-1">
            <table id="actividades" class="table table striped shadow-lg mt-4">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>TEMA</th>
                        <th>ENLACE</th>
                        <td>FECHA</td>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($actividades as $actividad)

                            <tr>

                                <td>{{ $actividad->id }}</td>
                                <td>{{ $actividad->nombre }}</a></td>
                                <td>{{ $actividad->tema->titulo }}</a></td>
                                <td><a target="_blank" href="{{ $actividad->enlace}}">{{ $actividad->enlace}}</a></td>

                                <td>{{ \Carbon\Carbon::parse($actividad->created_at)->formatLocalized('%d %B %G') }}</td>

                                <td style="text-align: center">
                                    @if ($actividad->estado_acti == 1)
                                        <span class="badge bg-success">DISPONIBLE</span>
                                    @elseif ($actividad['estado_acti'] == 0)
                                        <span class="badge bg-danger">NO DISPONIBLE</span>
                                    @else
                                        <span class="badge bg-warning">no permitido</span>
                                    @endif
                                </td>

                                <td width="200px" style="text-align: center">
                                    @if (Auth::user()->hasrole('PROFESOR'))
                                    <div class="brn-group">
                                        <a href="{{route('profesor.actividades.edit',$actividad->id)}}" class="btn btn-primary btn-sm">EDITAR</a>
                                        <a href="{{route('profesor.actividades.destroy',$actividad->id)}}" class="btn btn-danger btn-sm">ELIMINAR</a>
                                    </div>
                                    @endif
                                </td>
                                {{-- <td>{{\Carbon\Carbon::parse($producto->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                                {{--  <td>{{ \Carbon\Carbon::parse($estudiante->created_at)->formatLocalized('%d %B %G | %R %p') }}</td>
                            {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}

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
            $('#actividades').DataTable({
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

@endsection
