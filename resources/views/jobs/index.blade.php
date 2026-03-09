<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Jobs</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Stellenanzeigen</h1>
    <a href="{{ route('jobs.create') }}">Neuen Job erstellen</a>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Ort</th>
                <th>Firma</th>
                <th>Kategorie</th>
                <th>Status</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
        @foreach($jobs as $job)
            <tr>
                <td>{{ $job->title }}</td>
                <td>{{ $job->location }}</td>
                <td>{{ $job->company->name ?? '—' }}</td>
                <td>{{ $job->category->name ?? '—' }}</td>
                <td>{{ $job->is_active ? 'aktiv' : 'inaktiv' }}</td>
                <td>
                    <a href="{{ route('jobs.show', $job) }}">Ansehen</a>
                    <a href="{{ route('jobs.edit', $job) }}">Bearbeiten</a>
                    <form action="{{ route('jobs.destroy', $job) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Wirklich löschen?')">Löschen</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>