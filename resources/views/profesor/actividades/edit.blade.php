@extends('adminlte::page')
@section('title', 'Editar Actividad')
@section('content_header')
    <h1>Editar Actividad</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($actividad, ['route' => ['profesor.actividades.update', $actividad->id], 'method' => 'put'])!!}

        @csrf


        <div class="form-group">
            {!! Form::label('id_tema', 'Tema:') !!}
            {!! Form::select('id_tema', $temas, null, ['class' => 'form-control']) !!}
            @error('id_tema')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

            <div class="form group">
                {!! Form::label('nombre', 'Nombre:') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre Actividad']) !!}
                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form group">
                {!! Form::label('enlace', 'Enlace:') !!}
                {!! Form::URL('enlace', null, ['class' => 'form-control', 'placeholder' => 'Link de la actividad']) !!}
                @error('enlace')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            {!! Form::hidden('id_user',Auth::user()->id, null,[ 'class' => 'form-control']) !!}

            <div class="form group">
                {!! Form::label('estado_acti', 'Estado:') !!}
                {!! Form::select('estado_acti', [null => 'SELECCIONE ESTADO','0' => ' NO DISPONIBLE', '1' => 'DISPONIBLE'], null, [
                    'class' => 'form-control',
                ]) !!}
                @error('estado_acti')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {!! Form::hidden('id_curso',Auth::user()->curso->id,null, ['class' => 'form-control']) !!}

            <br>
            <a class= 'btn btn-danger href' href="{{ URL::previous() }}">CANCELAR</a>
            {!! Form::submit('ACTUALIZAR ACTIVIDAD', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <center> <iframe width="795" height="690" frameborder="0" src="https://es.educaplay.com/"></iframe>
        </center>
    </div>
@stop
