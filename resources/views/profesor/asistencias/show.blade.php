@extends('adminlte::page')
@section('title', 'Lista de Evaluaciones')
@section('content_header')

<H1>Lista de Asistencia fecha {{$asistencia->fecha}}</H1>



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

    <br>
    <div class="card">
        <div class="card body py-2 px-1">
            <table id="productos" class="table table striped shadow-lg mt-4">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>ASISTENCIA</th>
                        <th>ESTUDIANTE</th>
                        <th>CURSO</th>
                        <th>ESTADO</th>
                        <th>CAMBIAR</th>
                    </tr>
                </thead>
                <tbody>
                    <div>
                        <form action="{{route('profesor.asistencias.update')}}" method="post">
                            @csrf
                            @csrf
                            <button type="submit" class="btn btn-primary" id="btn" > Actualizar</button>



                    @foreach($detalle as $data)


                    <tr>
                        <td>{{$data->id}}</td>

                        <td>@if ($data->estado == 'presente')
                        <span class="badge bg-success">PRESENTE</span>
                    @elseif ($data['estado'] == 'ausente')
                        <span class="badge bg-danger">AUSENTE</span>
                    @else
                        <span class="badge bg-warning">no permitido</span>
                    @endif
                       </td>


                        <td>{{$data->user->nombre_user}} {{$data->user->apellido_user}}</td>

                        <td>{{$data->user->curso->nombre_curso}}</td>
                        {{-- <td>
                            <input type="checkbox" name="verificar" id="verificar">  En aula
                            <input type="checkbox" name="ksdf" id=""> Ausente
                        </td> --}}

                        <td>@if ($data->verificar == '1')
                            <span class="badge bg-success">EN AULA</span>
                        @elseif ($data['verificar'] == '0')
                            <span class="badge bg-danger">FALTA</span>
                        @else
                            <span class="badge bg-warning">FALTA</span>
                        @endif
                           </td>




                        <td>
                            {!! Form::hidden('estado[]', $data->estado, ['class' => 'form-control',]) !!}
                            {!! Form::hidden('fecha[]', $data->fecha, ['class' => 'form-control', ]) !!}
                            {!! Form::hidden('user_id[]', $data->user_id, ['class' => 'form-control',]) !!}
                            {!! Form::hidden('asistencia_id[]', $data->asistencia_id, ['class' => 'form-control',]) !!}

                            @if ($data->verificar == '0')
                            {!! Form::hidden('id[]', $data->id, ['class' => 'form-control',]) !!}
                            {!! Form::label('verificar', 'EN AULA:') !!}
@else
{!! Form::hidden('id[]', $data->id, ['class' => 'form-control',]) !!}
                            {!! Form::label('verificar', 'FALTA:') !!}
@endif

                           {!! Form::checkbox('verificar[]', $data->id,null) !!}
                            {{-- <input type="checkbox" name="verificar[]" value="<?php echo $data->id ?>" class="form-check-input settings" id="checkAsistencia"> EN CLASE --}}

<?php //echo $data->id ?>
<?php //echo ($data->verificar == '1' ? ' checked' : '')?>


                    </td>


{{-- <td>
    <div>
        <div class="actions">
            <form action="" method="POST" class="togglecompletion">
            <div>
                <input type="hidden" name="id" value="4444">
                <input type="hidden" name="sesskey000" value="dslkjñskd">
                <input type="hidden" name="modulename" value="recursosevaluacion temas dns+dhcp">
                <input type="hidden" name="completionstate" value="0">
                <button class="btn btn-link" aria-live="assertive">
                    <img class="icon"
                     src="https://aula.uajms.edu.bo/theme/image.php/moove/core/1645549591/i/completion-manual-y" alt="">
                </button>

            </div>

            </form>
        </div>
    </div>
</td> --}}







                        <td>
                            {{-- <form action="{{route('profesor.asistencias.update',$data->id)}}" method="post">
                                @csrf
                                <ul class="list-group no-b ">


                                               <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                                   <div>
                                                       <i class="icon icon-wifi purple-text"></i> En aula

                                                   </div>
                                                   <div class="material-switch">
                                                       <input id="verificar" name="verificar" value="en_aula" type="checkbox">
                                                       <label for="verificar" class="bg-primary"></label>
                                                   </div>
                                               </li>



                                               <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                                <div>
                                                    <i class="icon icon-wifi purple-text"></i> Ausente
                                                </div>
                                                <div class="material-switch">
                                                    <input id="verificar" name="verificar" value="ausente" type="checkbox">
                                                    <label for="verificar" class="bg-primary"></label>
                                                </div>
                                            </li>


                                           </ul>
                                        </form> --}}
                        </td>
                    </tr>
                    @endforeach

                </form>
                <?php
if (isset($_POST['verificar']))
{
    print_r($_POST['verificar']);
}
?>
            </div>
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
 <style>   * {
        padding: 0;
        margin: 0;
        box-sizing:border-box;
    }

    body {
        background: #fff;
        font-family: 'Open Sans', sans-serif;
    }

    .contenedor {
        width: 90%;
        max-width: 1000px;
        margin: 20px auto;
    }

    .contenedor article {
        line-height: 28px;
    }

    .contenedor article h1 {
        font-size: 30px;
        text-align: left;
        padding: 50px 0;
    }

    .contenedor article p {
        margin-bottom: 20px;
    }

    .contenedor article .btn-abrir-popup {
        padding: 0 20px;
        margin-bottom: 20px;
        height: 40px;
        line-height: 40px;
        border: none;
        color: #fff;
        background: #5E7DE3;
        border-radius: 3px;
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
        cursor: pointer;
        transition: .3s ease all;
        cursor: pointer;
    }

    .contenedor article .btn-abrir-popup:hover {
        background: rgba(94,125,227, .9);
    }

    /* ------------------------- */
    /* POPUP */
    /* ------------------------- */

    .overlay {
        background: rgba(0,0,0,.3);
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        align-items: center;
        justify-content: center;
        display: flex;
        visibility: hidden;
    }

    .overlay.active {
        visibility: visible;
    }

    .popup {
        background: #F8F8F8;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.3);
        border-radius: 3px;
        font-family: 'Montserrat', sans-serif;
        padding: 20px;
        text-align: center;
        width: 600px;

        transition: .3s ease all;
        transform: scale(0.7);
        opacity: 0;
    }

    .popup .btn-cerrar-popup {
        font-size: 16px;
        line-height: 16px;
        display: block;
        text-align: right;
        transition: .3s ease all;
        color: #BBBBBB;
    }

    .popup .btn-cerrar-popup:hover {
        color: #000;
    }

    .popup h3 {
        font-size: 36px;
        font-weight: 600;
        margin-bottom: 10px;
        opacity: 0;
    }

    .popup h4 {
        font-size: 26px;
        font-weight: 300;
        margin-bottom: 40px;
        opacity: 0;
    }

    .popup form .contenedor-inputs {
        opacity: 0;
    }

    .popup form .contenedor-inputs input {
        width: 100%;
        margin-bottom: 20px;
        height: 52px;
        font-size: 18px;
        line-height: 52px;
        text-align: center;
        border: 1px solid #BBBBBB;
    }

    .popup form .btn-submit {
        padding: 0 20px;
        height: 40px;
        line-height: 40px;
        border: none;
        color: #fff;
        background: #5E7DE3;
        border-radius: 3px;
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
        cursor: pointer;
        transition: .3s ease all;
    }

    .popup form .btn-submit:hover {
        background: rgba(94,125,227, .9);
    }

    /* ------------------------- */
    /* ANIMACIONES */
    /* ------------------------- */
    .popup.active {	transform: scale(1); opacity: 1; }
    .popup.active h3 { animation: entradaTitulo .8s ease .5s forwards; }
    .popup.active h4 { animation: entradaSubtitulo .8s ease .5s forwards; }
    .popup.active .contenedor-inputs { animation: entradaInputs 1s linear 1s forwards; }

    @keyframes entradaTitulo {
        from {
            opacity: 0;
            transform: translateY(-25px);
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes entradaSubtitulo {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes entradaInputs {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
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

@endsection
