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
    <div class="card-body">
    </div>
</div>
@endsection

@section('contenido')

@endsection

@section('js')

@endsection

