@extends('layouts.app')

@section('content')
    <h1>Détails du Livre</h1>
    <div class="card">
        @if($book->image)
            <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="book-image">
        @else
            <div class="book-image bg-gray-200 flex items-center justify-center text-gray-500">Pas d'image</div>
        @endif
        <h2 class="text-xl font-semibold mt-4">{{ $book->title }}</h2>
        <p><strong>Auteur :</strong> {{ $book->author }}</p>
        <p><strong>Prix :</strong> {{ $book->price }} €</p>
        <p><strong>Stock :</strong> {{ $book->stock }}</p>
        <p><strong>Description :</strong> {{ $book->description ?? 'Aucune description' }}</p>
        <p><strong>Statut :</strong> {{ $book->archived ? 'Archivé' : 'Actif' }}</p>
        <div class="mt-4">
            <a href="{{ route('books.edit', $book) }}" class="button">Modifier</a>
            @if(!$book->archived)
                <form action="{{ route('books.archive', $book) }}" method="POST" class="inline ml-2">
                    @csrf
                    <button type="submit" class="text-yellow-600 hover:underline" onclick="return confirm('Archiver ce livre ?')">Archiver</button>
                </form>
            @else
                <form action="{{ route('books.unarchive', $book) }}" method="POST" class="inline ml-2">
                    @csrf
                    <button type="submit" class="text-green-600 hover:underline" onclick="return confirm('Désarchiver ce livre ?')">Désarchiver</button>
                </form>
            @endif
            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline ml-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Supprimer définitivement ce livre ?')">Supprimer</button>
            </form>
        </div>
        <a href="{{ route('books.index') }}" class="button mt-4">Retour à la liste</a>
    </div>
@endsection