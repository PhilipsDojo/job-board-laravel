<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzer erstellen</title>
</head>
<body>
    <h1>Neuen Benutzer anlegen</h1>

    <a href="{{ route('user.index') }}">Zurück zur Übersicht</a>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="password">Passwort:</label>
            <input type="password" name="password" id="password" required>
            @error('password') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="role">Rolle:</label>
            <select name="role" id="role">
                <option value="bewerber" {{ old('role') == 'bewerber' ? 'selected' : '' }}>Bewerber</option>
                <option value="arbeitgeber" {{ old('role') == 'arbeitgeber' ? 'selected' : '' }}>Arbeitgeber</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="company_id">Firma-ID (nur für Arbeitgeber):</label>
            <input type="number" name="company_id" id="company_id" value="{{ old('company_id') }}">
            @error('company_id') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Speichern</button>
    </form>
</body>
</html>