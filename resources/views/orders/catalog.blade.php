@extends('layouts.app')

@section('content')
    <h1>Catalogue des Livres</h1>

    <!-- Formulaire de filtres -->
<div class="filter-card mb-6">
    <h2>Filtres</h2>
    <form method="GET" action="{{ route('orders.catalog') }}" class="filter-form">
        <div class="filter-group">
            <label for="price_min" class="text-sm">Prix min (€)</label>
            <input type="number" step="0.01" min="0" name="price_min" id="price_min" value="{{ request('price_min') }}">
        </div>
        <div class="filter-group">
            <label for="price_max" class="text-sm">Prix max (€)</label>
            <input type="number" step="0.01" min="0" name="price_max" id="price_max" value="{{ request('price_max') }}">
        </div>
        <div class="filter-group">
            <label for="author" class="text-sm">Auteur</label>
            <input type="text" name="author" id="author" value="{{ request('author') }}">
        </div>
        <div class="filter-group">
            <label for="category" class="text-sm">Catégorie</label>
            <input type="text" name="category" id="category" value="{{ request('category') }}">
        </div>
        <div class="filter-buttons">
            <button type="submit" class="button">Appliquer</button>
            <a href="{{ route('orders.catalog') }}" class="button">Réinitialiser</a>
        </div>
    </form>
</div>

    <!-- Liste des livres -->
    <div class="grid">
    @forelse ($books as $book)
        <div class="card book-card">
            @if($book->image)
                <a href="{{ route('orders.book', $book) }}">
                    <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="book-image">
                </a>
            @else
                <a href="{{ route('orders.book', $book) }}">
                    <div class="book-image bg-gray-200 flex items-center justify-center text-gray-500">Pas d'image</div>
                </a>
            @endif
            <div class="book-details">
                <h2><a href="{{ route('orders.book', $book) }}" class="text-white hover:underline">{{ $book->title }}</a></h2>
                <p>{{ $book->author }}</p>
                <p class="font-bold">{{ $book->price }} €</p>
                <p class="text-sm">Stock : {{ $book->stock }}</p>
                <form action="{{ route('orders.addToCart') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <label for="quantity_{{ $book->id }}" class="block text-sm">Quantité :</label>
                    <input type="number" name="quantity" id="quantity_{{ $book->id }}" min="1" max="{{ $book->stock }}" value="1" class="quantity-input">
                    <button type="submit" class="button">Ajouter au panier</button>
                </form>
            </div>
        </div>
    @empty
        <p>Aucun livre disponible avec ces filtres.</p>
    @endforelse
</div>

    @if (!empty($cart))
        <div class="card mt-6">
            <h2 class="text-xl font-semibold mb-4">Votre Panier</h2>
            <ul class="list-disc pl-5">
                @foreach ($cart as $item)
                    <li>{{ $item['title'] }} - {{ $item['quantity'] }} x {{ $item['price'] }} € = {{ $item['quantity'] * $item['price'] }} €</li>
                @endforeach
            </ul>
            <p class="mt-4"><strong>Total :</strong> {{ array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)) }} €</p>
            <form action="{{ route('orders.store') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="button">Passer la commande</button>
            </form>
        </div>
    @endif

    @if ($errors->any())
        <div class="error-message">{{ $errors->first() }}</div>
    @endif
@endsection