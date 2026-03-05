<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorie Details</title>
</head>
<body>
    <h1>Kategorie Details</h1>

    <a href="{{ route('categories.index') }}">Zurück zur Übersicht</a>
    <a href="{{ route('categories.edit', $category) }}">Bearbeiten</a>

    <p><strong>ID:</strong> {{ $category->id }}</p>
    <p><strong>Name:</strong> {{ $category->name }}</p>
    <p><strong>Erstellt am:</strong> {{ $category->created_at }}</p>
    <p><strong>Aktualisiert am:</strong> {{ $category->updated_at }}</p>
</body>
</html>