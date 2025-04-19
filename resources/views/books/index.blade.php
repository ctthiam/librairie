@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Gestion des Livres</h1>
    <div class="mb-4">
        <a href="{{ route('books.create') }}" class="button bg-orange-500 hover:bg-orange-600 text-white">Ajouter un livre</a>
        <a href="{{ route('books.archived') }}" class="button bg-orange-500 hover:bg-orange-600 text-white ml-2">Voir les livres archivés</a>
    </div>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-blue-800 text-white">
                <th class="p-2">Titre</th>
                <th class="p-2">Auteur</th>
                <th class="p-2">Prix</th>
                <th class="p-2">Stock</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr class="{{ $book->stock <= 0 ? 'bg-red-100' : '' }}">
                    <td class="border p-2">{{ $book->title }}</td>
                    <td class="border p-2">{{ $book->author }}</td>
                    <td class="border p-2">{{ number_format($book->price, 2) }} €</td>
                    <td class="border p-2">{{ $book->stock }}</td>
                    <td class="border p-2 space-x-2">
                        <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:underline">Modifier</a>
                        @if ($book->archived)
                            <form action="{{ route('books.unarchive', $book) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:underline">Désarchiver</button>
                            </form>
                        @else
                            <form action="{{ route('books.archive', $book) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-orange-600 hover:underline">Archiver</button>
                            </form>
                        @endif
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection