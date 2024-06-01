@extends('adminlte::page')
@section('title', 'Editar preguntas')
@section('content_header')
    <h1>Editar Pregunta</h1>
@stop
@section('content')

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{ session('mensaje') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($pregunte, ['route' => ['profesor.preguntes.update', $pregunte->id], 'method' => 'put']) !!}

            <div class="form group">
                {!! Form::label('detalle_pre', 'Pregunta') !!}
                {!! Form::text('detalle_pre', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la Categoría']) !!}
                @error('detalle_pre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <br>
            <a class= 'btn btn-danger href' href="{{ URL::previous() }}">CANCELAR</a>
            {!! Form::submit('ACTUALIZAR PREGUNTA', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>

        @push('js')
            <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
            <script>
                ClassicEditor
                    .create(document.querySelector('#editor'))


                    .catch(error => {
                        console.error(error);
                    });
            </script>
        @endpush

    </div>
@stop
