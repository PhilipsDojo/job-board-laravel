<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzer</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        a { margin-right: 10px; }
    </style>
</head>
<body>
    <h1>Benutzer Übersicht</h1>

    <a href="{{ route('user.create') }}">Neuen Benutzer anlegen</a>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Rolle</th>
                <th>Firma-ID</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
        @foreach($user as $singleUser)   <!-- Naming geändert für sicherere Iteration -->
            <tr>
                <td>{{ $singleUser->id }}</td>
                <td>{{ $singleUser->name }}</td>
                <td>{{ $singleUser->email }}</td>
                <td>{{ $singleUser->role ?? 'bewerber' }}</td>
                <td>{{ $singleUser->company_id ?? '—' }}</td>
                <td>
                    <a href="{{ route('user.show', $singleUser) }}">Ansehen</a>
                    <a href="{{ route('user.edit', $singleUser) }}">Bearbeiten</a>
                    <form action="{{ route('user.destroy', $singleUser) }}" method="POST" style="display:inline;">
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