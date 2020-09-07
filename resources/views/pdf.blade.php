<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <head>
        <h1>Ibirama/IBAD</h1>
        <p>Relatório de prestação de contas</p>
    </head>
    <table style="width:100%">
    <tr>
        <th>Descricao</th>
        <th>Data</th>
        <th>Valor</th>
        <th>Tipo</th>
        <th>Especificacao</th>
    </tr>
    @foreach($moves as $move)
    <tr>
        <td>{{$move->descricao}}</td>
        <td>{{$move->data}}</td>
        <td>{{$move->valor}}</td>
        <td>{{$move->tipo}}</td>
        <td>{{$move->especificacao}}</td>
    </tr>
    @endforeach
    </table>
    <footer>
    <span>Total</span>
    <span>30</span>
    </footer>

</body>
</html>
