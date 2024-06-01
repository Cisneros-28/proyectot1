@extends('adminlte::page')
@section('title', 'Editar Recurso Bloque')
@section('content_header')
    <h1>Editar Recurso Bloque</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($detalle, [
                'route' => ['profesor.bloques.update', $detalle->id],
                'method' => 'put',
                'enctype' => 'multipart/form-data',
            ]) !!}

            @csrf

            <div class="form-group">
                {!! Form::label('id_bloque', 'Bloque:') !!}
                {!! Form::select('id_bloque', $bloque, null, ['class' => 'form-control']) !!}
                @error('id_bloque')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('id_recurso', 'Tipo de Recurso:') !!}
                {!! Form::select('id_recurso', $type, null, ['class' => 'form-control']) !!}
                @error('id_recurso')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('id_tema', 'Tema:') !!}
                {!! Form::select('id_tema', $options, null, ['class' => 'form-control']) !!}
                @error('id_tema')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form group">
                {!! Form::label('titulo', 'Titulo:') !!}
                {!! Form::text('titulo', null, ['class' => 'form-control', 'placeholder' => 'Titulo Recurso']) !!}
                @error('titulo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="form group">
                {!! Form::label('descripcion', 'Descripcion:') !!}
                {!! Form::textarea('descripcion', null, [
                    'class' => 'form-control ckeditor',
                    'placeholder' => 'descripcion',
                    'id' => 'ckeditor',
                ]) !!}
                @error('descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form group">

                {!! Form::label('archivo', 'Archivo:') !!}
                <br>
                {!! Form::file('archivo', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                @error('archivo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <img id="imagenseleccionada" src="{{URL::asset(("imagen/{$detalle->imagen}"))}}" style="max-height: 300px">
            </div>

            <div class="form group">

                {!! Form::label('imagen', 'Imagen:') !!}
                <br>
                {!! Form::file('imagen', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                @error('imagen')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form group">

                {!! Form::label('video', 'Video:') !!}
                <br>
                {!! Form::url('video', null, ['class' => 'form-control', 'placeholder' => 'Introduzca Link del Video']) !!}
                @error('video')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form group">
                {!! Form::label('estado', 'Estado:') !!}
                {!! Form::select('estado', [null => 'SELECCIONE ESTADO','0' => 'NO ACTIVO', '1' => 'ACTIVO'], null, [
                    'class' => 'form-control',
                ]) !!}
                @error('estado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <a class='btn btn-danger href' href="{{ URL::previous() }}">Cancelar</a>
            {!! Form::submit('Actualizar Recurso', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('js')
<script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('.ckeditor').ckeditor();
        });
    </script>

    <script>
        $(document).ready(function(e) {
            $('#imagen').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenseleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);

            });
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descripcion'), {
                simpleUpload: {
                    uploadUrl: "{route['profesor.bloques.index']}",
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        window.onload = function() {
            if (document.querySelector("#ckcontent")) {
                ClassicEditor.create(document.querySelector("#ckcontent"), {
                        extraPlugins: [MyCustomUploadAdapterPlugin]
                    })
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            document.querySelector("#descripcion").value = editor.getData()
                        })
                    })
                    .catch(error => {
                        console.error(error.stack);
                    });
            }
        }
    </script>
@endsection
