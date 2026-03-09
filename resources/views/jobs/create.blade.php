<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Job erstellen</title>
</head>

<!-- Kurze Definition zu "old"
wird verwendet, wenn das Formular neu geladen wird
Beispiel:
User gibt Daten ein
Bsp Titel ist falsch oder fehlt
Laravel zeigt Formular erneut mit Fehlermeldung an.
old() füllt die bereits eingegeben validierten Werte automatisch wieder ein.

-->
<body>
    <h1>Neuen Job erstellen</h1>
    <a href="{{ route('jobs.index') }}">Zurück</a>

    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf

        <div><label>Titel:</label><input type="text" name="title" value="{{ old('title') }}" required></div>
        <div><label>Beschreibung:</label><textarea name="description" required>{{ old('description') }}</textarea></div>
        <div><label>Ort:</label><input type="text" name="location" value="{{ old('location') }}" required></div>
        <div>
<!-- add hidden field eine Checkbox wird nur im request mitgesendet, wenn es ein eigenes Feld hat. -->
            <label>Aktiv?</label>
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
        </div>
        <div><label>Ablaufdatum:</label><input type="date" name="expires_at" value="{{ old('expires_at') }}"></div>
        <div><label>Firma (ID):</label><input type="number" name="company_id" value="{{ old('company_id') }}" required></div>
        <div><label>Kategorie (ID):</label><input type="number" name="category_id" value="{{ old('category_id') }}" required></div>
        <div><label>Benutzer (ID):</label><input type="number" name="user_id" value="{{ old('user_id') }}" required></div>

        <button type="submit">Speichern</button>
    </form>
</body>
</html>