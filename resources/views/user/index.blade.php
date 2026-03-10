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
        @foreach($user as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role ?? 'bewerber' }}</td>
                <td>{{ $user->company_id ?? '—' }}</td>
                <td>
                    <a href="{{ route('user.show', $user) }}">Ansehen</a>
                    <a href="{{ route('user.edit', $user) }}">Bearbeiten</a>
                    <form action="{{ route('user.destroy', $user) }}" method="POST" style="display:inline;">
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