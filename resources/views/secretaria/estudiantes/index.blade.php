@extends('adminlte::page')
@section('title', 'Lista de Estudiantes')
@section('content_header')
    <h1>Listar Estudiantes</h1>


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
    @if (Auth::user()->hasRole('ADMIN'))
    <div class="card-header">
        <a href="{{ route('secretaria.estudiantes.create') }}" class="btn btn-primary">Nuevo Estudiante</a>
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
                        <th>APELLIDO</th>
                        <th>GENERO</th>
                        <th>ROL</th>
                        <th>CURSO</th>
                        <th>DIRECCION</th>
                        <th>ESTADO</th>
                        <th>REGISTRADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($estudiantes as $estudiante)

                            <tr>

                                <td>{{ $estudiante->id }}</td>
                                <td><a href="#">{{ $estudiante->nombre_user }}</a></td>
                                <td>{{ $estudiante->apellido_user }}</td>

                                <td width="70px" style="text-align: right">
                                    @if ($estudiante->genero == 'F')
                                        <span class="badge bg-secondary">FEMENINO</span>
                                    @elseif ($estudiante->genero == 'M')
                                        <span class="badge bg-secondary">MASCULINO</span>
                                    @else
                                        <span class="badge bg-warning">No permitido</span>
                                    @endif
                                </td>
                                <td> @if (!empty($estudiante->getRoleNames()))
                                    @foreach($estudiante->getRoleNames() as $rolName)
                                        {{$rolName}}
                                    @endforeach
                                    @endif
                                </td>
                                <TD>{{$estudiante->curso->nombre_curso }}</TD>
                                <td>{{ $estudiante->direccion}}</td>


                                <td width="70px" style="text-align: right">
                                    @if ($estudiante->estado_user == 1)
                                        <span class="badge bg-success">ACTIVO</span>
                                    @elseif ($estudiante->estado_user == 0)
                                        <span class="badge bg-danger">NO ACTIVO</span>
                                    @else
                                        <span class="badge bg-warning">No permitido</span>
                                    @endif
                                </td>
                                {{-- <td>{{\Carbon\Carbon::parse($producto->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                                {{--  <td>{{ \Carbon\Carbon::parse($estudiante->created_at)->formatLocalized('%d %B %G | %R %p') }}</td>
                            {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}
                            <td>{{ \Carbon\Carbon::parse($estudiante->created_at)->formatLocalized('%d %B %G | %R %p') }}
                            </td>
                            {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}
                            <td>
                                @if (Auth::user()->hasrole('ADMIN'))
                                <form action="{{ route('secretaria.estudiantes.destroy', $estudiante->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('secretaria.estudiantes.edit', $estudiante->id) }}"
                                        class="btn btn-primary btn-sm">Editar</a>

                                    @method('delete')
                                    @csrf
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

@endsection
