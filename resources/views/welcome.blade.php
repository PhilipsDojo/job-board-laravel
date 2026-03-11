<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobbörse Dashboard</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Header mit Login-Infos */
        .user-header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 5px;
        }

        .user-info {
            font-weight: bold;
        }

        .role-badge {
            background: #007bff;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.9em;
        }

        .nav-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 20px 0;
            padding: 10px;
            background: #e9ecef;
            border-radius: 5px;
        }

        .nav-links a {
            margin: 0;
            padding: 5px 10px;
            background: white;
            border-radius: 3px;
            text-decoration: none;
            color: #333;
        }

        .nav-links a:hover {
            background: #007bff;
            color: white;
        }

        .logout-form {
            display: inline;
        }

        .logout-form button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
            background: white;
        }

        .count {
            font-size: 2em;
            margin: 10px 0;
            color: #007bff;
        }

        a {
            display: inline-block;            
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- LOGIN / USER STATUS -->
        @auth
            <div class="user-header">
                <span class="user-info">
                    Herzlich willkommen!                 
                    <span class="role-badge">{{ auth()->user()->role }}</span>
                </span>
                <a href="{{ route('profile.edit') }}">Profil</a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        @else
            <div class="user-header">
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Registrieren</a>
            </div>
        @endauth

        <!-- ROLLEN-BASIERTE NAVIGATION -->
        @auth
            <div class="nav-links">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('categories.index') }}">Kategorien verwalten</a>
                    <a href="{{ route('user.index') }}">Benutzer verwalten</a>
                @endif

                @if(auth()->user()->role === 'arbeitgeber')
                    <a href="{{ route('companies.index') }}">Meine Firmen</a>
                    <a href="{{ route('jobs.create') }}">Job erstellen</a>
                @endif

                @if(auth()->user()->role === 'bewerber')
                    <a href="{{ route('jobs.index') }}">Jobs durchsuchen</a>
                    <a href="{{ route('profile.edit') }}">Mein Profil</a>
                @endif

                <!-- Für alle eingeloggten User -->
                <a href="{{ route('jobs.index') }}">Alle Jobs</a>
                <a href="{{ route('companies.index') }}">Alle Firmen</a>
            </div>
        @endauth
        <h1>Jobbörse Dashboard</h1>

        <div class="grid"> <!-- new grid Start --> 
            <!-- Kategorien -->
            <div class="card">
                <h2>Kategorien</h2>
                <div class="count">{{ $categories->count() }}</div>
                <a href="{{ route('categories.index') }}">Ansehen</a>
            </div>
       
            <!-- Jobs -->           
            <div class="card">
                <h2>Jobs</h2>
                <div class="count">{{ $jobs->count() }}</div>
                <a href="{{ route('jobs.index') }}">Ansehen</a>
            </div>
        
            <!-- Firmen -->       
            <div class="card">
                <h2>Firmen</h2>
                <div class="count">{{ $companies->count() }}</div>
                <a href="{{ route('companies.index') }}">Ansehen</a>
            </div>

            <!-- User --> 
            <div class="card">
                <h2>User</h2>
                <div class="count">{{ $user->count() }}</div>
                <a href="{{ route('user.index') }}">Ansehen</a>
            </div>
        </div>
    </div> <!-- new grid End --> 
</body>

</html>