@extends('adminlte::page')
@section('title', 'Editar Materia')
@section('content_header')
    <h1>Editar <a href="#">{{ $materia->descripcion }}</a></h1>
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
            {!! Form::model($materia, ['route' => ['admin.materias.update', $materia], 'method' => 'put', 'enctype'=>'multipart/form-data']) !!}
            @csrf

            <div class="form group">
                {!! Form::label('descripcion', 'Materia:') !!}
                {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Materia']) !!}
                @error('descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form group">
                {!! Form::label('estado_materia', 'Estado:') !!}
                {!! Form::select('estado_materia', [null => 'SELECCIONE ESTADO','0' => ' NO DISPONIBLE', '1' => 'DISPONIBLE'], null, [
                    'class' => 'form-control',
                ]) !!}
                @error('estado_materia')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <a class= 'btn btn-danger href' href="{{ URL::previous() }}">CANCELAR</a>
            {!! Form::submit('Actualizar Materia', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
