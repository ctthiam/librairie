@extends('layouts.app')

@section('content')
    <h1>Commande #{{ $order->id }}</h1>
    <div class="card">
        <p><strong>Statut :</strong> {{ $order->status }}</p>
        <p><strong>Paiement :</strong> 
            @if ($order->isPaid())
                Payée ({{ $order->payment->amount }} € le {{ $order->payment->payment_date->format('d/m/Y') }})
            @else
                Non payée
                <form action="{{ route('orders.pay', $order) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-blue-600 hover:underline ml-2" onclick="console.log('Bouton Enregistrer le paiement cliqué')">Enregistrer un paiement</button>
                </form>
            @endif
        </p>
        <h2 class="text-xl font-semibold mt-4">Livres commandés</h2>
        <ul class="list-disc pl-5">
            @foreach ($order->books as $book)
                <li>{{ $book->title }} - {{ $book->pivot->quantity }} x {{ $book->price }} € = {{ $book->pivot->quantity * $book->price }} €</li>
            @endforeach
        </ul>
        <p class="mt-4"><strong>Total :</strong> {{ $order->books->sum(fn($book) => $book->pivot->quantity * $book->price) }} €</p>
    </div>
@endsection