<!DOCTYPE html>
<html>
<head>
    <title>Livres Archivés</title>
</head>
<body>
    <h1>Livres Archivés</h1>
    <ul>
        @foreach ($books as $book)
            <li>{{ $book->title }}</li>
        @endforeach
    </ul>
</body>
</html>