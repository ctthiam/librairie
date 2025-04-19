<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de Commande</title>
</head>
<body>
    <h1>Merci pour votre commande !</h1>
    <p>Votre commande #{{ $order->id }} a été reçue et est en attente de traitement.</p>
    <h2>Livres commandés :</h2>
    <ul>
        @foreach ($order->books as $book)
            <li>{{ $book->title }} - {{ $book->pivot->quantity }} x {{ $book->price }} €</li>
        @endforeach
    </ul>
    <p><strong>Total :</strong> {{ $order->books->sum(fn($book) => $book->pivot->quantity * $book->price) }} €</p>
    <p>Vous recevrez une facture par e-mail une fois la commande expédiée.</p>
</body>
</html>