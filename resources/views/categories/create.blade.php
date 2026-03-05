<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorie erstellen</title>
</head>
<body>
    <h1>Neue Kategorie erstellen</h1>

    <a href="{{ route('categories.index') }}">Zurück zur Übersicht</a>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Kategoriename:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Speichern</button>
    </form>
</body>
</html>