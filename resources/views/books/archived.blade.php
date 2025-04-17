@extends('layouts.app')

@section('content')
    <h1>Livres Archivés</h1>
    <a href="{{ route('books.index') }}" class="button mb-4">Retour aux livres actifs</a>
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
                            <form action="{{ route('books.unarchive', $book) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:underline" onclick="return confirm('Désarchiver ce livre ?')">Désarchiver</button>
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