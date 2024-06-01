@extends('adminlte::page')
@section('title', 'Nuevo Pregunta ')
@section('content_header')
    <h1>Nueva Pregunta </h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'profesor.evaluaciones.stpre']) !!}
            @csrf

            @foreach (range(0, 6) as $x)
                <?php $e = 1; ?>

                <div class="card">
                    <div class="card-header">
                        {!! Form::label('pregunta', 'Pregunta : ') !!} {{ $c = $e + $x }}
                    </div>
                    <div class="card-body">

                        <table>

                            <tbody>

                                <tr>

                                    <td>
                                        <div class="form group">
                                            @foreach ($evaluaciones as $eva)
                                            {!! Form::hidden('id_examen[]', $eva, null, ['class' => 'form-control']) !!}
                                            @endforeach

                                        </div>
                                    </td>

                                    <td>
                                        <!--
                                        {!! Form::hidden('nota_pre[]', '5', [
                                                'class' => 'form-control',
                                                'placeholder' => 'Nota',
                                                'min' => '0',
                                                'max' => '5',
                                                '',
                                            ]) !!}
                                        <div class="form group{{ $errors->has('nota_pre.' . $x) ? 'has-error' : '' }}">
                                            {!! Form::label('nota_pre', 'nota') !!}
                                            {!! Form::number('nota_pre[]', '5', [
                                                'class' => 'form-control',
                                                'placeholder' => 'Nota',
                                                'min' => '0',
                                                'max' => '5',
                                                '',
                                            ]) !!}
                                            @if ($errors->has('nota_pre.' . $x))
                                                <span class="text-danger">
                                                    {{ $errors->first('nota_pre.' . $x) }}
                                                </span>
                                            @endif
                                        </div>
                                    -->
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                        <div class="form group{{ $errors->has('pregunta.' . $x) ? 'has-error' : '' }}">
                            {!! Form::label('pregunta', 'Detalle Pregunta : ') !!}
                            {!! Form::text('pregunta[]', null, ['class' => 'form-control', 'placeholder' => 'Pregunta']) !!}
                            @if ($errors->has('pregunta.' . $x))
                                <span class="text-danger">
                                    {{ $errors->first('pregunta.' . $x) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <br>
            {!! Form::submit('GUARDAR PREGUNTAS ', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
