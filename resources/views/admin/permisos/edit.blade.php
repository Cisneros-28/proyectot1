@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>editar rol</h1>
@stop
@section('content')

    @if (session('mensaje'))
        <div class="alert alert-success">
            <strong>{{session('mensaje')}}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($role, ['route'=>['admin.permisos.update',$role->id], 'method'=>'put']) !!}

            @include('admin.permisos.partials.form')

                <a class= 'btn btn-danger href' href="{{ URL::previous() }}">CANCELAR</a>
                {!! Form::submit('Actualizar Rol', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    <script> console.log('Hi!'); </script>
@stop
