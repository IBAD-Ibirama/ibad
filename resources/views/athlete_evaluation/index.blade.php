<style>
    a{
        border: 1px solid #cccc;
        padding: 10px;
        border-radius: 5px;
        color: #000;
        text-decoration: none;
    }

    a:hover {
        background: #cccc;
    }

    tr:nth-child(even) {
        background-color: #f0f0f0;
    }

    #container{
        margin-top: 50px;
    }

    #tabela{
        border-collapse: collapse;
        text-align: center;
    }

    th{
        background: #cccc;
    }

    td, th{
        border: 1px solid #cccc;
        padding: 5px;
        min-width: 100px;
    }

    #tabelaContainer{
        margin-top: 30px;
    }

</style>

<div id="container">
    <a href="{{ route('avaliacao_atleta.create') }}">Novo</a>
</div>

<div id="tabelaContainer">
    <table id="tabela">
        <theader>
            <tr>
            <th>Atleta</th>
            <th>Data</th>
            <th>Arremesso medicineball 2kg (cm)	</th>
            <th>Salto horizontal (cm)</th>
            <th>Teste do quadrado 4m (s)</th>
            <th>Corrida de 20m (s)	</th>
            <th>Teste do bipe</th>
            <th>Teste de sentar e alcançar (cm)	</th>
            <th>Nº de abdominais em 1 min</th>
            </tr>
        </theader>
        <tbody>
            @foreach ($athleteEvaluations as $athleteEvaluation)
                <tr>
                <td>{{ $athleteEvaluation->athlete->name }}</td>
                <td>{{ $athleteEvaluation->realization_date }}</td>
                @foreach ($athleteEvaluation->physicalTests as $athleteEvaluationPhysicalTest)
                    <td>
                    {{ $athleteEvaluationPhysicalTest->value }}
                    </td>
                @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
