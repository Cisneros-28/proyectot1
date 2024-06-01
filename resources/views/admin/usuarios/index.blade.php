
@extends('adminlte::page')
@section('title', 'Lista de Usuarios')
@section('content_header')
    <h1>Listar Usuarios</h1>


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
        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">Nuevo Usuario</a>
    </div>
    <br>
    <div class="card">
        <div class="card body py-2 px-1">
            <table id="productos" class="table table striped shadow-lg mt-4">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <TH>GENERO</TH>
                        <th>ROL</th>
                        {{-- <th>ROL PERMISOS</th> --}}
                        <th>DIRECCION</th>
                        <th>ESTADO</th>
                        <th>REGISTRADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($usuarios as $usuario)

                            <tr>

                                <td>{{ $usuario->id }}</td>
                                <td><a href="#">{{ $usuario->nombre_user }}</a></td>
                                <td>{{ $usuario->apellido_user }}</td>
                                <td width="70px" style="text-align: right">
                                    @if ($usuario->genero == 'F')
                                        <span class="badge bg-secondary">FEMENINO</span>
                                    @elseif ($usuario->genero == 'M')
                                        <span class="badge bg-secondary">MASCULINO</span>
                                    @else
                                        <span class="badge bg-warning">No permitido</span>
                                    @endif
                                </td>


                                 <td> @if (!empty($usuario->getRoleNames()))
                                    @foreach($usuario->getRoleNames() as $rolName)
                                        {{$rolName}}
                                    @endforeach
                                    @endif
                                </td>

                                <td>{{ $usuario->direccion}}</td>

                                <td width="70px" style="text-align: right">
                                    @if ($usuario->estado_user == 1)
                                        <span class="badge bg-success">ACTIVO</span>
                                    @elseif ($usuario->estado_user == 0)
                                        <span class="badge bg-danger">NO ACTIVO</span>
                                    @else
                                        <span class="badge bg-warning">No permitido</span>
                                    @endif
                                </td>
                                {{-- <td>{{\Carbon\Carbon::parse($producto->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                                {{--  <td>{{ \Carbon\Carbon::parse($estudiante->created_at)->formatLocalized('%d %B %G | %R %p') }}</td>
                            {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}
                            <td>{{ \Carbon\Carbon::parse($usuario->created_at)->formatLocalized('%d %B %G | %R %p') }}
                            </td>
                            {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}
                            <td >

                                <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('admin.usuarios.edit', $usuario->id) }}"
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
{{-- ------------------------- --}}
{{-- @extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>user VISTA</h1>
@stop

@section('content')

@if (session('mensaje'))
    <div class="alert alert-success">
        <strong>{{session('mensaje')}}</strong>
    </div>
@endif

<div class="card-header">

        <a href="{{route('admin.usuarios.create')}}" class="btn btn-primary">Nuevo Usuario</a>

</div>
<div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>cursos</th>
                        <th>rol</th>

                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->nombre_user}}</td>
                        <td>{{$user->id_curso}}</td>




                        <td>{{$user->email}}</td>
                        <td widrh='10px'>
                            <a class="btn btn-primary" href="{{route('admin.usuarios.edit',$user)}}">Editar</a>
                        </td>

                        <td width="10px">

                                <form action="{{route('admin.usuarios.destroy',$user->id)}}" method="POST">
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
</div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    <script> console.log('Hi!'); </script>
@stop --}}
