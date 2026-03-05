<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorie bearbeiten</title>
</head>
<body>
    <h1>Kategorie bearbeiten</h1>

    <a href="{{ route('categories.index') }}">Zurück zur Übersicht</a>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Kategoriename:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Aktualisieren</button>
    </form>
</body>
</html>