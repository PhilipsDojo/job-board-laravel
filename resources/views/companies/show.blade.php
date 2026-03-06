<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $company->name }} Details</title>
</head>
<body>
    <h1>{{ $company->name }}</h1>

    <a href="{{ route('companies.index') }}">Zurück zur Übersicht</a>
    <a href="{{ route('companies.edit', $company) }}"> Bearbeiten</a>

    <p><strong>ID:</strong> {{ $company->id }}</p>
    <p><strong>Beschreibung:</strong> {{ $company->description ?? '—' }}</p>
    <p><strong>Website:</strong> 
        @if($company->website)
            <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
        @else
            —
        @endif
    </p>
    <p><strong>Besitzer (User-ID):</strong> {{ $company->user_id }}</p>

    @if($company->logo)
        <p><strong>Logo:</strong></p>
        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo von {{ $company->name }}" width="150">
    @endif

    <p><strong>Erstellt am:</strong> {{ $company->created_at }}</p>
    <p><strong>Aktualisiert am:</strong> {{ $company->updated_at }}</p>
</body>
</html>