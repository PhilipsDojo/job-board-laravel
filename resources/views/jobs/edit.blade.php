<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Job bearbeiten</title>
</head>
<body>
    <h1>Job bearbeiten: {{ $job->title }}</h1>
    <a href="{{ route('jobs.index') }}">Zurück</a>

    <form action="{{ route('jobs.update', $job) }}" method="POST">
        @csrf
        @method('PUT')

        <div><label>Titel:</label><input type="text" name="title" value="{{ old('title', $job->title) }}" required></div>
        <div><label>Beschreibung:</label><textarea name="description" required>{{ old('description', $job->description) }}</textarea></div>
        <div><label>Ort:</label><input type="text" name="location" value="{{ old('location', $job->location) }}" required></div>
        <div>
<!-- add hidden field eine Checkbox wird nur im request mitgesendet, wenn es ein eigenes Feld hat. -->
            <label>Aktiv?</label>
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $job->is_active ? 'checked' : '' }}>
        </div>
        <div><label>Ablaufdatum:</label><input type="date" name="expires_at" value="{{ old('expires_at', $job->expires_at ? $job->expires_at->format('Y-m-d') : '') }}"></div>
        <div><label>Firma (ID):</label><input type="number" name="company_id" value="{{ old('company_id', $job->company_id) }}" required></div>
        <div><label>Kategorie (ID):</label><input type="number" name="category_id" value="{{ old('category_id', $job->category_id) }}" required></div>
        <div><label>Benutzer (ID):</label><input type="number" name="user_id" value="{{ old('user_id', $job->user_id) }}" required></div>

        <button type="submit">Aktualisieren</button>
    </form>
</body>
</html>