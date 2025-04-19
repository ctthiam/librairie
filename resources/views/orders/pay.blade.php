@extends('layouts.app')

@section('content')
    <h1>Enregistrer un paiement pour la commande #{{ $order->id }}</h1>
    <div class="card">
        @if ($order->isPaid())
            <p class="text-red-600">Cette commande est déjà payée.</p>
        @else
            <form action="{{ route('orders.pay', $order) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="amount" class="block text-sm">Montant (€)</label>
                    <input type="number" step="0.01" name="amount" id="amount" required class="quantity-input">
                </div>
                @error('amount')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
                <button type="submit" class="button" onclick="console.log('Bouton Soumettre le paiement cliqué')">Enregistrer le paiement</button>
            </form>
        @endif
        <a href="{{ route('orders.show', $order) }}" class="button mt-4">Retour aux détails</a>
    </div>
@endsection