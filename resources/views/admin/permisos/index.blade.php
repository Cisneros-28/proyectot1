
@extends('adminlte::page')
@section('title', 'Lista de Roles')
@section('content_header')
    <h1>Listar Roles</h1>
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
    <div class="card-header">
        <a href="{{ route('admin.permisos.create') }}" class="btn btn-primary">Nuevo Rol</a>
    </div>
    <br>



    <div class="card">
        <div class="card body py-2 px-1">
            <table id="productos" class="table table striped shadow-lg mt-4">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>ESTADO</th>
                        <th>FECHA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>

                            <td width="70px" style="text-align: right">
                                @if ($role->estado_rol == 1)
                                    <span class="badge bg-success">ACTIVO</span>
                                @elseif ($role->estado_rol == 0)
                                    <span class="badge bg-danger">NO ACTIVO</span>
                                @else
                                    <span class="badge bg-warning">No permitido</span>
                                @endif
                            </td>
                            {{-- <td>{{\Carbon\Carbon::parse($tema->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($role->created_at)->formatLocalized('%d %B %G | %R %p') }}</td>
                            {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}
                            <td >
                                <form action="{{ route('admin.permisos.destroy',$role->id) }}" method="POST">
                                    <a href="{{ route('admin.permisos.edit',$role->id) }}"
                                        class="btn btn-primary btn-sm">Editar</a>
                                    @method('delete')
                                    @csrf
                                    <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                                </form>
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
{{-- ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,, --}}
