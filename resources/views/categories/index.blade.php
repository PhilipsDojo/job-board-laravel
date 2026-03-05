<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorien</title>
</head>
<body>
    <h1>Kategorien Übersicht</h1>

    <a href="{{ route('categories.create') }}">Neue Kategorie</a>
 @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.show', $category) }}">Ansehen</a>
                    <a href="{{ route('categories.edit', $category) }}">Bearbeiten</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
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