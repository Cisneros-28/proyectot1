@extends('adminlte::page')
@section('title', 'Lista de Temas')
@section('content_header')
    <h1>Listar Temas</h1>
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
        <a href="{{ route('profesor.temas.create') }}" class="btn btn-primary">NUEVO TEMA</a>
    </div>
    @endif
    <br>
    <div class="card">
        <div class="card body py-2 px-1">
            <table id="productos" class="table table striped shadow-lg mt-4">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>N° TEMA</th>
                        <th>TITULO</th>
                        <th>RECURSO</th>
                        <th>BLOQUE</th>
                        <th>FECHA</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($temas as $tema)
                        <tr>
                            <td>{{ $tema->id }}</td>

                            <td>{{ $tema->titulo }}</td>
                            <td>{{ $tema->detalle_tema }}</td>

                            <td><a href="" ><img width="25px" src="{{URL::asset('imagen/archivo.png')}}" >  {{ $tema->recurso }}</a></td>
<td>{{$tema->bloque->nombre}}</td>
                            {{-- <td>{{\Carbon\Carbon::parse($tema->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($tema->created_at)->formatLocalized('%d %B %G') }}</td>
                            {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}
{{-- parse($tema->created_at)-> --}}
                            <td width="70px" style="text-align: right">
                                @if ($tema->estado_tema == 1)
                                    <span class="badge bg-success">DISPONIBLE</span>
                                @elseif ($tema['estado_tema'] == 0)
                                    <span class="badge bg-danger">NO DISPONIBLE</span>
                                @else
                                    <span class="badge bg-warning">no permitido</span>
                                @endif
                            </td>

                            <td>
                                @if (Auth::user()->hasrole('PROFESOR'))
                                <form action="{{ route('profesor.temas.destroy', $tema) }}" method="POST">
                                    <a href="{{asset('documets/'.$tema->recurso)}}" target="_blank" class="btn btn-secondary btn-sm">VER</a>
                                    <a href="{{ route('profesor.temas.edit', $tema) }}" class="btn btn-primary btn-sm">EDITAR</a>
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

  <script>//window.open('pagpdf.php', '_blank');</script>

@endsection
