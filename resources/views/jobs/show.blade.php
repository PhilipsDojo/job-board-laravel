<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>{{ $job->title }} – Details</title>
</head>
<body>
    <h1>{{ $job->title }}</h1>
    <a href="{{ route('jobs.index') }}">zurück</a>
    <a href="{{ route('jobs.edit', $job) }}">bearbeiten</a>

    <p><strong>Beschreibung:</strong> {{ $job->description }}</p>
    <p><strong>Ort:</strong> {{ $job->location }}</p>
    <p><strong>Firma:</strong> {{ $job->company->name ?? '—' }}</p>
    <p><strong>Kategorie:</strong> {{ $job->category->name ?? '—' }}</p>
    <p><strong>Ersteller:</strong> {{ $job->user->name ?? '—' }}</p>
    <p><strong>Status:</strong> {{ $job->is_active ? 'aktiv' : 'inaktiv' }}</p>
    <p><strong>Ablaufdatum:</strong> {{ $job->expires_at ? $job->expires_at->format('d.m.Y') : 'keins' }}</p>
    <p><strong>Erstellt am:</strong> {{ $job->created_at }}</p>
    <p><strong>Aktualisiert am:</strong> {{ $job->updated_at }}</p>
</body>
</html>