@extends('adminlte::page')
@section('title', 'Lista de Evaluaciones')
@section('content_header')

<H1>Lista de Asistencias</H1>



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

    <br>
    <div class="card">
        <div class="card body py-2 px-1">
            <table id="productos" class="table table striped shadow-lg mt-4">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>FECHA</th>
                        <th>ESTADO</th>
                        <th>VERIFICADO</th>
                        <th>CURSO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalleasistencia as $data)
                    <tr>
                        <td>{{$data->fecha}} </td>

                        <td>@if ($data->estado == 'presente')
                        <span class="badge bg-success">PRESENTE</span>
                    @elseif ($data['estado'] == 'ausente')
                        <span class="badge bg-danger">AUSENTE</span>
                    @else
                        <span class="badge bg-warning">no permitido</span>
                    @endif
                       </td>
                       <td>@if ($data->verificar == 1)
                        <span class="badge bg-success">EN AULA</span>
                    @elseif ($data['verificar'] == 0)
                        <span class="badge bg-danger">FALTA</span>
                    @else
                        <span class="badge bg-warning">no permitido</span>
                    @endif
                       </td>



                        <td>{{$data->user->curso->nombre_curso}}</td>
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

