@extends('adminlte::page')
@section('title', 'Lista de Estudiantes')
@section('content_header')
    <h1>Lista de Recursos seg el bloque</h1>

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

            <a href="{{ route('profesor.bloques.create') }}" class="btn btn-primary">NUEVO BLOQUE</a>

    </div>
    <br>
    <div class="card">
        <div class="card body py-2 px-1">
            <table id="productos" class="table table striped shadow-lg mt-4">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>TITULO</th>
                        <th>DESCRIPCION</th>
                        <th>TIPO</th>
                        <TH>TEMA</TH>
                        <TH>BLOQUE</TH>
                        <TH>ESTADO</TH>
                        <TH>ACCIONES</TH>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($bloques as $bloque)
@if ($bloque->id_curso == Auth::user()->curso->id )
                            <tr>

                                <td>{{ $bloque->id }}</td>
                                <td>{{ $bloque->titulo }}</td>
                                <td wire:model="path" wire:ignore id="ckcontent">{!! $bloque->descripcion !!}</td>
                                <td>{{$bloque->type->nombre}}</td>

                                @if ($bloque->id_tema !== null)
                                <td>{{$bloque->tema->titulo}}</td>
                                @else
                                <td> </td>
                                @endif

                                <td>{{ $bloque->bloque->nombre}}</td>

                                <td width="70px" style="text-align: right">
                                    @if ($bloque->estado == 1)
                                        <span class="badge bg-success">DISPONIBLE</span>
                                    @elseif ($bloque['estado'] == 0)
                                        <span class="badge bg-danger">NO DISPONIBLE</span>
                                    @else
                                        <span class="badge bg-warning">no permitido</span>
                                    @endif
                                </td>


                                <td>
                                    @if (Auth::user()->hasrole('PROFESOR'))
                                    <div class="brn-group">
                                        <a href="{{route('profesor.bloques.edit',$bloque->id)}}" class="btn btn-primary btn-sm">EDITAR</a>
                                        <a href="{{route('profesor.bloques.destroy',$bloque->id)}}" class="btn btn-danger btn-sm">ELIMINAR</a>
                                    </div>
                                    @endif
                                </td>
                                {{-- <td>{{\Carbon\Carbon::parse($producto->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                                {{--  <td>{{ \Carbon\Carbon::parse($estudiante->created_at)->formatLocalized('%d %B %G | %R %p') }}</td>
                            {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}

                            </tr>
@endif
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#descripcion' ),{
                simpleUpload:{
                    uploadUrl:"{route['profesor.bloques.index']}",
                }
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
<script>
   window.onload = function(){
    if(document.querySelector("#ckcontent")){
        ClassicEditor.create(document.querySelector("#ckcontent"),{
            extraPlugins:[MyCustomUploadAdapterPlugin]
        })
        .then(editor=>{
            editor.model.document.on('change:data',()=>{
                document.querySelector("#content").value=editor.getData()
            })
        })
.catch(error=>{
    console.error(error.stack);
});
    }
   }
</script>
<script>config.extraPlugins = 'html5video,widget,widgetselection,clipboard,lineutils';</script>
@endsection
