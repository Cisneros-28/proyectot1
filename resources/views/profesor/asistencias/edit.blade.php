@extends('adminlte::page')
@section('title', 'Lista de ASISTENCIA')
@section('content_header')
    <h1>Listar ASISTENCIA</h1>



@stop
@section('content')

    holi

    <div class="contenedor">
        <button id="btn-abrir-popup" class="btn-abrir-popup">Editar</button>
        <div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h3></h3>
                <h1>Editar Estado</h1>

				<form action="">
					<div class="contenedor-inputs">
						<input type="checkbox" placeholder="Nombre"> En aula
						<input type="email" placeholder="Correo">
					</div>
					<input type="submit" class="btn-submit" value="Suscribirse">
				</form>
			</div>
		</div>
    </div>
@endsection


@section('css')
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        /* body {
            background: #fff;
            font-family: 'Open Sans', sans-serif;
        } */

        .contenedor {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
        }

        /* .contenedor article {
            line-height: 28px;
        }

        .contenedor  h1 {
            font-size: 30px;
            text-align: left;
            padding: 50px 0;
        }

        .contenedor article p {
            margin-bottom: 20px;
        } */

        .contenedor .btn-abrir-popup {
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

        .contenedor .btn-abrir-popup:hover {
            background: rgba(94, 125, 227, .9);
        }

        /* ------------------------- */
        /* POPUP */
        /* ------------------------- */

        .overlay {
            background: rgba(0, 0, 0, .3);
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
            width: 10;
            margin-bottom: 10px;
            height: 52px;
            /* font-size: 18px;
            line-height: 52px;
            text-align: center; */
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
            background: rgba(94, 125, 227, .9);
        }

        /* ------------------------- */
        /* ANIMACIONES */
        /* ------------------------- */
        .popup.active {
            transform: scale(1);
            opacity: 1;
        }

        .popup.active h3 {
            animation: entradaTitulo .8s ease .5s forwards;
        }

       .popup.active h4 { animation: entradaSubtitulo .8s ease .5s forwards; }
        .popup.active .contenedor-inputs { animation: entradaInputs 1s linear 1s forwards; } */

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

<script>
    var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
	overlay = document.getElementById('overlay'),
	popup = document.getElementById('popup'),
	btnCerrarPopup = document.getElementById('btn-cerrar-popup');

btnAbrirPopup.addEventListener('click', function(){
	overlay.classList.add('active');
	popup.classList.add('active');
});

btnCerrarPopup.addEventListener('click', function(e){
	e.preventDefault();
	overlay.classList.remove('active');
	popup.classList.remove('active');
});
</script>
@endsection
