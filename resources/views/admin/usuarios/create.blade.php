@extends('adminlte::page')
@section('title', 'Nuevo Usuario')
@section('content_header')
    <h1>Nuevo Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.usuarios.store']) !!}

            @include('admin.usuarios.partials.form')

                <br>
                {!! Form::submit('Guardar Usuario',['class' => 'btn btn-primary']) !!}
              {!! Form::close() !!}

        </div>
    </div>
@stop
