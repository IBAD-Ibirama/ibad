<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border-bottom: 1px solid #eceff1;
            padding: 8px;
            text-align: left;
        }

        .saida {
            background-color: #ffcdd2;
        }

        .entrada {
            background-color: #c8e6c9;
        }

        th {
            text-align: left;
        }
    </style>
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
            <th>Especificação</th>
        </tr>
        @foreach ( $moves as $move )
        <tr class='{{ $move->type }}'>
            <td>{{ $move->description }}</td>
            <td>{{ $move->date }}</td>
            <td>R${{ $move->value }}</td>
            <td>{{ $move->type }}</td>
            <td>{{ $move->specification }}</td>
        </tr>
        @endforeach
    </table>
    <footer>
        <div>
            <span>Total de entradas: </span>
            <span>R${{ $totalDeposit }},00</span>
        </div>

        <div>
            <span>Total de saídas: </span>
            <span>R${{ $totalOutflows }},00</span>
        </div>
    </footer>

</body>

</html>