<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Stats</title>
</head>
<body>
    <h1>Exercise Stats</h1>
{{-- Basicamente pega os dados passados do controller e exibe as atividades a quantidade de linhas e a médida de pulsações --}}
    @foreach ($stats as $type => $data)
        <h2>{{ ucfirst($type) }}</h2>
        <p>Quantidade de linhas: {{ $data['count'] }}</p>
        <p>Média das pulsações: {{ $data['average_pulse'] }}</p>
    @endforeach
</body>
</html>
