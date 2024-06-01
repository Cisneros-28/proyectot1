@extends('adminlte::page')
@section('title', 'Editar usuario')
@section('content_header')
    <h1>Editar usuarios </h1>
@stop

@section('content')

    @if (session('mensaje'))
        <div class="alert alert-success">
            <strong>{{session('mensaje')}}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            {!! Form::model($users,['route' => ['admin.usuarios.update',$users->id],'method'=>'put']) !!}

            @include('admin.usuarios.partials.form')

            <br>
            <a class= 'btn btn-danger href' href="{{ URL::previous() }}">CANCELAR</a>
                {!! Form::submit('Actualizar Usuario',['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
