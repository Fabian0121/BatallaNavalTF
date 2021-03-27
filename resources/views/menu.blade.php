@extends('layout.main')

@section('titulo')
    <title>Menu | Batalla Naval</title>
@endsection

@section('css')

@endsection

@section('titulo-pagina')
<div class="card-body text-center">
    <h1 class="h1 mb-4 text-gray-800">Bienvenido {{session('usuario')->correo}}</h1>
    <h1 class="display-3 text-muted">Bienvenido a Batalla Naval</h1>
    @for($i=0;$i<3;$i++)
    <br>
    @endfor
    <h2 class="m-0 font-weight-bold text-info"> Total de partidas jugadas</h2>
    <h2> Jugadas: {{ $mensaje }}</h2>
    @for($i=0;$i<2;$i++)
    <br>
    @endfor
    <h3 class="m-0 font-weight-bold text-info"> Partidas Gandadas </h3>
    <h2> Ganadas: {{ $mensaje2 }}</h2>
    @for($i=0;$i<2;$i++)
    <br>
    @endfor
    <h3 class="m-0 font-weight-bold text-info"> Detalles ultima partida </h3>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Estatus</th>
                    <th>Jugador 1</th>
                    <th>Jugador 2</th>
                    <th>Ganador</th>
                    <th>Creado</th>
                    <th>Detalles</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
@endsection

@section('contenido')

@endsection

@section('js')

@endsection

