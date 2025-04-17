@extends('layouts.app')

@section('content')
    <h1>Détails du Livre</h1>
    <div class="card book-card">
        @if($book->image)
            <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="book-image">
        @else
            <div class="book-image bg-gray-200 flex items-center justify-center text-gray-500">Pas d'image</div>
        @endif
        <h2>{{ $book->title }}</h2>
        <p>{{ $book->author }}</p>
        <p class="font-bold">{{ $book->price }} €</p>
        <p class="text-sm">Stock : {{ $book->stock }}</p>
        @if($book->category)
            <p><strong>Catégorie :</strong> {{ $book->category }}</p>
        @endif
        <p><strong>Description :</strong> {{ $book->description ?? 'Aucune description' }}</p>
        <form action="{{ route('orders.addToCart') }}" method="POST" class="mt-2">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <label for="quantity_{{ $book->id }}" class="block text-sm">Quantité :</label>
            <input type="number" name="quantity" id="quantity_{{ $book->id }}" min="1" max="{{ $book->stock }}" value="1" class="quantity-input">
            <button type="submit" class="button">Ajouter au panier</button>
        </form>
        <a href="{{ route('orders.catalog') }}" class="button mt-4">Retour au catalogue</a>
    </div>
@endsection