@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tableau de bord</h1>
    <p>Bienvenue, {{ auth()->user()->name }} !</p>
    @if(auth()->user()->role === 'gestionnaire')
        <p>Vous êtes un gestionnaire. <a href="{{ route('books.index') }}" class="text-blue-600 hover:underline">Gérer les livres</a></p>
    @else
        <p>Vous êtes un utilisateur. <a href="{{ route('orders.catalog') }}" class="text-blue-600 hover:underline">Voir le catalogue</a></p>
    @endif
@endsection