@extends('layout.main')

@section('titulo')
    <title>Menu | Batalla Naval</title>
@endsection

@section('css')

@endsection

@section('titulo-pagina')
<div class="card-body text-center">
    <h1 class="h1 mb-4 text-gray-800">Partida Finalizada </h1>
    <h2> El ganador es:{{$ganador}} </h2>
    @for($i=0;$i<6;$i++)
    <br>
    @endfor
    <td><a href="{{route('usuario.menu')}}" class="btn-dark btn-sm" ><i class="fas fa-bars"></i>Volver al menu</a></td>
    
</div>
@endsection

@section('contenido')

@endsection

@section('js')

@endsection
