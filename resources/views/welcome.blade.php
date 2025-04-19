@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Bienvenue sur Librairie en Ligne</h1>
    <p>Explorez notre catalogue de livres et passez vos commandes dès maintenant !</p>
    <a href="{{ route('orders.catalog') }}" class="button mt-4 inline-block">Voir le Catalogue</a>
@endsection