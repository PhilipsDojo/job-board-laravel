<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzer bearbeiten</title>
</head>
<body>
    <h1>Benutzer bearbeiten: {{ $user->name }}</h1>

    <a href="{{ route('user.index') }}">Zurück zur Übersicht</a>

    <form action="{{ route('user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="password">Neues Passwort (leer lassen, wenn nicht ändern):</label>
            <input type="password" name="password" id="password">
            @error('password') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="role">Rolle:</label>
            <select name="role" id="role">
                <option value="bewerber" {{ old('role', $user->role) == 'bewerber' ? 'selected' : '' }}>Bewerber</option>
                <option value="arbeitgeber" {{ old('role', $user->role) == 'arbeitgeber' ? 'selected' : '' }}>Arbeitgeber</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="company_id">Firma-ID (nur für Arbeitgeber):</label>
            <input type="number" name="company_id" id="company_id" value="{{ old('company_id', $user->company_id) }}">
            @error('company_id') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Aktualisieren</button>
    </form>
</body>
</html>