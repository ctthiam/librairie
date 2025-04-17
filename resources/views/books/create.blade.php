@extends('layouts.app')

@section('content')
    <h1>Ajouter un Livre</h1>
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf
        <div class="mb-4">
            <label for="title" class="block">Titre</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="mb-4">
            <label for="author" class="block">Auteur</label>
            <input type="text" name="author" id="author" required>
        </div>
        <div class="mb-4">
            <label for="price" class="block">Prix (€)</label>
            <input type="number" step="0.01" name="price" id="price" required>
        </div>
        <div class="mb-4">
            <label for="stock" class="block">Stock</label>
            <input type="number" name="stock" id="stock" required>
        </div>
        <div class="mb-4">
            <label for="category" class="block">Catégorie</label>
            <input type="text" name="category" id="category">
        </div>
        <div class="mb-4">
            <label for="image" class="block">Image</label>
            <input type="file" name="image" id="image">
        </div>
        <div class="mb-4">
            <label for="description" class="block">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <button type="submit" class="button">Ajouter</button>
    </form>
@endsection