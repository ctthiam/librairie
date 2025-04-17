@extends('layouts.app')

@section('content')
    <h1>Modifier un Livre</h1>
    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block">Titre</label>
            <input type="text" name="title" id="title" value="{{ $book->title }}" required>
        </div>
        <div class="mb-4">
            <label for="author" class="block">Auteur</label>
            <input type="text" name="author" id="author" value="{{ $book->author }}" required>
        </div>
        <div class="mb-4">
            <label for="price" class="block">Prix (€)</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ $book->price }}" required>
        </div>
        <div class="mb-4">
            <label for="stock" class="block">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ $book->stock }}" required>
        </div>
        <div class="mb-4">
            <label for="category" class="block">Catégorie</label>
            <input type="text" name="category" id="category" value="{{ $book->category }}">
        </div>
        <div class="mb-4">
            <label for="image" class="block">Image</label>
            <input type="file" name="image" id="image">
            @if($book->image)
                <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="book-image-preview">
            @endif
        </div>
        <div class="mb-4">
            <label for="description" class="block">Description</label>
            <textarea name="description" id="description">{{ $book->description }}</textarea>
        </div>
        <button type="submit" class="button">Mettre à jour</button>
    </form>
@endsection