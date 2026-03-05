<!DOCTYPE html>
<html>
<head>
    <title>Datenbank-Test</title>
</head>
<body>
    <h1>Datenbank-Test & Model</h1>

        <h2>Kategorien ({{ $categories->count() }})</h2>
        @foreach($categories as $category)
            <p>{{ $category->name }}</p>
        @endforeach

    <h2>User ({{ $users->count() }})</h2>
    @foreach($users as $user)
        <p>
            ID: {{ $user->id }} | 
            Name: {{ $user->name }} | 
            Email: {{ $user->email }} | 
            Rolle: {{ $user->role }}
        </p>
    @endforeach

    <h2>Firmen ({{ $companies->count() }})</h2>
    @foreach($companies as $company)
        <p>
            ID: {{ $company->id }} | 
            Name: {{ $company->name }} | 
            Besitzer: {{ $company->user_id }}
        </p>
    @endforeach

    <h2>Jobs ({{ $jobs->count() }})</h2>
    @foreach($jobs as $job)
        <p>
            ID: {{ $job->id }} | 
            Titel: {{ $job->title }} | 
            Ort: {{ $job->location }} | 
            Firma: {{ $job->company_id }} | 
            Kategorie: {{ $job->category_id }}
            Status: {{$job->is_active ?'aktiv':'inaktiv'}}
        </p>
    @endforeach

</body>
</html>