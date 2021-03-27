@extends('layout.main')

@section('titulo')
    <title>Menu | Batalla Naval</title>
@endsection

@section('css')

@endsection

@section('titulo-pagina')
<div class="card-body text-center">
    <h1 class="h1 mb-4 text-gray-800">Partida Finalizada {{session('usuario')->correo}}</h1>
    <td><a href="{{route('usuario.menu')}}" class="btn-dark">Volver al menu</a></td>
    <td><a href="{{route('usuario.menu')}}" class="btn-dark">Detallles</a></td>
</div>
@endsection

@section('contenido')

@endsection

@section('js')

@endsection
