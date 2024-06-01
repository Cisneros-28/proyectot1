@extends('adminlte::page')
@section('title', 'Lista de Estudiantes')
@section('content_header')
    <h1>Estudiantes que Respondieron la Evaluacion</h1>
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
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <TH>NOTA</TH>
                        <th>ESTADO</th>

                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($count >0)
                    @foreach ($estudiantes as $estudiante)

                        <tr>

                            <td>{{ $estudiante->id_user }}</td>
                            <td>{{ $estudiante->nombre_user }}</td>
                            <td>{{ $estudiante->apellido_user }}</td>
                            <td>{{$estudiante->nota_res}}</td>
                            <!--llamar al atributo notas y sumar el array-->
                            <!-- /*   $suma=0;  ?>
@//foreach ($notas as $nnn)


                            @//if (//$estudiante->id_user == $nnn->estado_res)

                          /<?php
                            //$nose= array('notas' => $nnn['nota_res']);
                            //$suma= array_sum($nose)+$suma;
                            ?>

                       //endif


@//endforeach
<td>//$suma}}</td>*/-->
                            <?php //echo "".array_sum($notas);?>

                            <!--llamar al atributo estado_res para saber si ha sido calificado o no-->

                            <TD>

                                <span class="badge bg-success">CALIFICADO</span></TD>


                             <!--llamar atributo ESTADO_res para bloquear boton-->
                            {{-- <td>
                                <div class="brn-group">
                                   <a type="submit"  href="{{ route('profesor.dash.edit',['estudiante' => $estudiante->id_user, 'evaluacion' => $estudiante->id])}}" class="btn btn-secondary btn-sm">Ver</a>
                                   <!--<a type="submit"  href="" class="btn btn-danger btn-sm">Editar</a>
                                   -->
                                </div>
                            </td> --}}


                            {{-- <td>{{\Carbon\Carbon::parse($producto->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                            {{--  <td>{{ \Carbon\Carbon::parse($estudiante->created_at)->formatLocalized('%d %B %G | %R %p') }}</td>
                        {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}

                        </tr>
                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>





                                 @endforeach
                                 <!--aqio ba eñ textp-->





                                 @foreach ($nocalificado as $estudiante)

                                 <tr>

                                     <td>{{ $estudiante->id_user }}</td>
                                     <td>{{ $estudiante->nombre_user }}</td>
                                     <td>{{ $estudiante->apellido_user }}</td>
                                     <!--llamar al atributo notas y sumar el array-->
                                     <td>0</td>

                                     <!--llamar al atributo estado_res para saber si ha sido calificado o no-->
                                     <TD><span class="badge bg-danger">NO CALIFICADO</span></TD>


                                      <!--llamar atributo ESTADO_res para bloquear boton-->
                                     <td>
                                         <div class="brn-group">
                                            <a type="submit"  href="{{ route('profesor.dash.edit',['estudiante' => $estudiante->id_user, 'evaluacion' => $estudiante->id])}}" class="btn btn-primary btn-sm">Calificar</a>


                                         </div>
                                     </td>


                                     {{-- <td>{{\Carbon\Carbon::parse($producto->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                                     {{--  <td>{{ \Carbon\Carbon::parse($estudiante->created_at)->formatLocalized('%d %B %G | %R %p') }}</td>
                                 {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}

                                 </tr>
                                 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                                 <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>





                                          @endforeach




                                 @else
                                 @foreach ($estudiantes as $estudiante)

                                 <tr>

                                     <td>{{ $estudiante->id_user }}</td>
                                     <td>{{ $estudiante->nombre_user }}</td>
                                     <td>{{ $estudiante->apellido_user }}</td>
                                     <!--llamar al atributo notas y sumar el array-->
                                     <td>0</td>

                                     <!--llamar al atributo estado_res para saber si ha sido calificado o no-->
                                     <TD><span class="badge bg-danger">NO CALIFICADO</span></TD>


                                      <!--llamar atributo ESTADO_res para bloquear boton-->
                                     <td>
                                         <div class="brn-group">
                                            <a type="submit"  href="{{ route('profesor.dash.edit',['estudiante' => $estudiante->id_user, 'evaluacion' => $estudiante->id])}}" class="btn btn-secondary btn-sm">Calificar</a>


                                         </div>
                                     </td>


                                     {{-- <td>{{\Carbon\Carbon::parse($producto->created_at)->format('d-m-Y | H:i:s')}}</td> --}}
                                     {{--  <td>{{ \Carbon\Carbon::parse($estudiante->created_at)->formatLocalized('%d %B %G | %R %p') }}</td>
                                 {{-- {{ \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y %I:%M %p') }} --}}

                                 </tr>
                                 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                                 <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>





                                          @endforeach

                                 @endif

                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
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

