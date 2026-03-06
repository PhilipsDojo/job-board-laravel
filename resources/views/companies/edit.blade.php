<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma bearbeiten</title>
</head>
<body>
    <h1>Firma bearbeiten: {{ $company->name }}</h1>

    <a href="{{ route('companies.index') }}">Zurück zur Übersicht</a>

    <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Firmenname:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}" required>
            @error('name') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="description">Beschreibung:</label>
            <textarea name="description" id="description" rows="4">{{ old('description', $company->description) }}</textarea>
            @error('description') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="website">Website:</label>
            <input type="url" name="website" id="website" value="{{ old('website', $company->website) }}">
            @error('website') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="logo">Logo (neues Bild):</label>
            <input type="file" name="logo" id="logo" accept="image/*">
            @error('logo') <div style="color:red;">{{ $message }}</div> @enderror

            @if($company->logo)
                <div style="margin-top:10px;">
                    <p>Aktuelles Logo:</p>
                    <img src="{{ asset('storage/' . $company->logo) }}" width="100">
                </div>
            @endif
        </div>

        <div>
            <label for="user_id">Besitzer (User-ID):</label>
            <input type="number" name="user_id" id="user_id" value="{{ old('user_id', $company->user_id) }}" required>
            @error('user_id') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Aktualisieren</button>
    </form>
</body>
</html>