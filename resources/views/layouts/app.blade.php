<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Librairie en Ligne') }}</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-sky-500 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('orders.catalog') }}" class="text-2xl font-bold">Librairie en Ligne</a>
            <div class="flex items-center">
                <div class="space-x-4">
                    <a href="{{ url('/') }}" class="hover:underline">Accueil</a>
                    <a href="{{ route('orders.catalog') }}" class="hover:underline">Catalogue</a>
                    @auth
                        <a href="{{ route('orders.index') }}" class="hover:underline">Mes Commandes</a>
                        @if(auth()->user()->role === 'gestionnaire')
                            <a href="{{ route('books.index') }}" class="hover:underline">Gérer les livres</a>
                        @endif
                    @endauth
                </div>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="ml-8">
                        @csrf
                        <button type="submit" class="hover:underline">Déconnexion</button>
                    </form>
                @else
                    <div class="ml-8 space-x-4">
                        <a href="{{ route('login') }}" class="hover:underline">Connexion</a>
                        <a href="{{ route('register') }}" class="hover:underline">Inscription</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
    <main class="container mx-auto mt-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
    <footer class="bg-red-500 text-white p-4 mt-6">
        <div class="container mx-auto text-center">
            © {{ date('Y') }} Librairie en Ligne. Tous droits réservés.
        </div>
    </footer>
</body>
</html>