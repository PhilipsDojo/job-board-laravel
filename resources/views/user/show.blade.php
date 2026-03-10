<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} – Details</title>
</head>
<body>
    <h1>{{ $user->name }}</h1>

    <a href="{{ route('user.index') }}">Zurück zur Übersicht</a>
    <a href="{{ route('user.edit', $user) }}">Bearbeiten</a>

    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>E-Mail:</strong> {{ $user->email }}</p>
    <p><strong>Rolle:</strong> {{ $user->role ?? 'bewerber' }}</p>
    <p><strong>Firma-ID:</strong> {{ $user->company_id ?? '—' }}</p>
    <p><strong>Erstellt am:</strong> {{ $user->created_at }}</p>
    <p><strong>Aktualisiert am:</strong> {{ $user->updated_at }}</p>
</body>
</html>