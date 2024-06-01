@extends('adminlte::page')
@section('title', 'Nuevo Curso')
@section('content_header')
    <h1>Nuevo Curso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.cursos.store']) !!}


            <div class="form group">
                {!! Form::label('nombre_curso', 'Nombre:') !!}
                {!! Form::text('nombre_curso', null, ['class' => 'form-control', 'placeholder' => 'Nombre Curso']) !!}
                @error('nombre_curso')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form group">
                {!! Form::label('estado_curso', 'Estado:') !!}
                {!! Form::select('estado_curso',[null => 'SELECCIONE ESTADO','0' => 'NO ACTIVO', '1' => 'ACTIVO'], null, [
                    'class' => 'form-control',
                ]) !!}

                @error('estado_curso')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <br>
            {!! Form::submit('Guardar Curso', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
