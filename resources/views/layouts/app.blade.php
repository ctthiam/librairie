<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Librairie en Ligne</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="min-h-screen">
        <nav>
            <div class="container">
                <a href="{{ route('books.index') }}">Gestion Livres</a>
                <a href="{{ route('books.archived') }}">Livres Archivés</a>
                <a href="{{ route('orders.catalog') }}">Catalogue</a>
                <a href="{{ route('orders.index') }}">Commandes</a>
            </div>
        </nav>
        <main>
            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>