<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firmen</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        a { margin-right: 10px; }
        img { border-radius: 4px; object-fit: cover; }
    </style>
</head>
<body>
    <h1>Firmen Übersicht</h1>

    <a href="{{ route('companies.create') }}">Neue Firma</a>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Logo</th>
                <th>ID</th>
                <th>Name</th>
                <th>Website</th>
                <th>Besitzer-ID</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td>
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="50" height="50">
                    @else
                        —
                    @endif
                </td>
                <td>{{ $company->id }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->website ?? '—' }}</td>
                <td>{{ $company->user_id }}</td>
                <td>
                    <a href="{{ route('companies.show', $company) }}">Ansehen</a>
                    <a href="{{ route('companies.edit', $company) }}">Bearbeiten</a>
                    <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
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