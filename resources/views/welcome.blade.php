<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobbörse Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; }
        .card { border: 1px solid #ccc; padding: 20px; text-align: center; }
        .count { font-size: 2em; margin: 10px 0; }
        a { display: inline-block; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Jobbörse Dashboard</h1>

        <div class="grid">
            <!-- Kategorien -->
            <div class="card">
                <h2>Kategorien</h2>
                <div class="count">{{ $categories->count() }}</div>
                <a href="{{ route('categories.index') }}">Ansehen</a>
            </div>

        </div>
    </div>
</body>
</html>