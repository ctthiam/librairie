@extends('layouts.app')

@section('content')
    <h1>Gestion des Livres</h1>
    <a href="{{ route('books.create') }}" class="button mb-4">Ajouter un livre</a>
    <a href="{{ route('books.archived') }}" class="button mb-4 ml-4">Voir les livres archivés</a>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td><a href="{{ route('books.show', $book) }}" class="text-blue-600 hover:underline">{{ $book->title }}</a></td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->price }} €</td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:underline">Modifier</a>
                            <form action="{{ route('books.archive', $book) }}" method="POST" class="inline ml-2">
                                @csrf
                                <button type="submit" class="text-yellow-600 hover:underline" onclick="return confirm('Archiver ce livre ?')">Archiver</button>
                            </form>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Supprimer définitivement ce livre ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection