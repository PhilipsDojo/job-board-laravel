<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma erstellen</title>
</head>
<body>
    <h1>Neue Firma erstellen</h1>

    <a href="{{ route('companies.index') }}">Zurück zur Übersicht</a>

    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data"> <!-- ändert die Art wie der Browser Daten sendet ohne "enctype nur Text"-->
        @csrf

        <div>
            <label for="name">Firmenname:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="description">Beschreibung:</label>
            <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
            @error('description') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="website">Website:</label>
            <input type="url" name="website" id="website" value="{{ old('website') }}">
            @error('website') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="logo">Logo (Bild):</label>
            <input type="file" name="logo" id="logo" accept="image/*">
            @error('logo') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="user_id">Besitzer (User-ID):</label>
            <input type="number" name="user_id" id="user_id" value="{{ old('user_id') }}" required>
            @error('user_id') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Speichern</button>
    </form>
</body>
</html>