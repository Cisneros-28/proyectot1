@extends('adminlte::page')
@section('title', 'Lista de Evaluaciones')
@section('content_header')
    <h1>Listar Evaluaciones</h1>



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
        <a href="{{ route('profesor.evaluaciones.create') }}" class="btn btn-primary">NUEVA EVALUACION</a>

    </div>
    @endif
    <br>
    <div class="card">
        <div class="card body py-2 px-1">
            <table id="productos" class="table table striped shadow-lg mt-4">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>

                        <th>TEMA</th>
                        <th>TRIMESTRE</th>
                        <th>ESTADO</th>
                        <th>FECHA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluaciones as $evaluacion)
                        <tr>
                            <td>{{ $evaluacion->id }}</td>
                            <td> <a href="{{ route('profesor.evaluaciones.show', $evaluacion->id) }}">{{ $evaluacion->nombre }}</a> </td>

                            <td>{{ $evaluacion->tema->titulo }}</td>
                            <td>{{ $evaluacion->trimestre->descripcion }}</td>

                            <td width="70px" style="text-align: right">
                                @if ($evaluacion->estado_eval == 1)
                                    <span class="badge bg-success">DISPONIBLE</span>
                                @elseif ($evaluacion['estado_eval'] == 0)
                                    <span class="badge bg-danger">NO DISPONIBLE</span>
                                @else
                                    <span class="badge bg-warning">no permitido</span>
                                @endif
                            </td>




                            {{-- <td>{{\Carbon\Carbon::parse($evaluacion->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($evaluacion->created_at)->formatLocalized('%d %B %G') }}
                            </td>
                            {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}
                            <td>
                                @if (Auth::user()->hasrole('PROFESOR'))
                                <form action="{{ route('profesor.evaluaciones.destroy', $evaluacion->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('profesor.evaluaciones.edit', $evaluacion->id) }}"
                                        class="btn btn-primary btn-sm">EDITAR</a>

                                    @method('delete')
                                    @csrf


                                    <input type="submit" value="ELIMINAR" class="btn btn-danger btn-sm">
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

@endsection
