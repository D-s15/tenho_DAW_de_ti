<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da API</title>
</head>
<body>
    <h1>Dados da API</h1>
    <ul>
        @foreach ($api as $item)
            <li>{{ $item}}</li>
        @endforeach
    </ul>
</body>
</html>