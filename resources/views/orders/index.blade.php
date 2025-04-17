@extends('layouts.app')

@section('content')
    <h1>Liste des Commandes</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Statut</th>
                    <th>Livres</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @foreach ($order->books as $book)
                                {{ $book->title }} ({{ $book->pivot->quantity }})
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:underline">Détails</a>
                            <form action="{{ route('orders.update', $order) }}" method="POST" class="inline ml-2">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="en attente" {{ $order->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en préparation" {{ $order->status == 'en préparation' ? 'selected' : '' }}>En préparation</option>
                                    <option value="expédiée" {{ $order->status == 'expédiée' ? 'selected' : '' }}>Expédiée</option>
                                    <option value="payée" {{ $order->status == 'payée' ? 'selected' : '' }}>Payée</option>
                                </select>
                            </form>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Annuler cette commande ?')">Annuler</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection