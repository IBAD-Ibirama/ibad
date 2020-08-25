<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
    }
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
                <th width="20%">
                    Atleta
                </th>
                <th width="10%">
                    Data
                </th>
                <th width="35%">
                    Testes Físicos
                </th>
                <th width="35%">
                    Índices Corporais
                </th>
            </tr>
        </theader>
        <tbody>
            @foreach ($athleteEvaluations as $athleteEvaluation)
                <tr>
                    <td>
                        {{ $athleteEvaluation->athlete->name }}
                    </td>
                    <td>
                        {{ $athleteEvaluation->realization_date }}
                    </td>
                    <td>
                        @if ($athleteEvaluation->physicalTests()->count() > 0)
                            @foreach ($athleteEvaluation->physicalTests as $athleteEvaluationPhysicalTest)
                                <div>
                                    {{ $athleteEvaluationPhysicalTest->physicalTest->name }}: {{ $athleteEvaluationPhysicalTest->value }}
                                </div>
                            @endforeach
                        @else
                            Não informado
                        @endif
                    </td>
                    <td>
                        @if ($athleteEvaluation->bodyIndexes()->count() > 0) 
                            @foreach ($athleteEvaluation->bodyIndexes as $athleteEvaluationBodyIndex)
                                <div>
                                    {{ $athleteEvaluationBodyIndex->bodyIndex->name }}: {{ $athleteEvaluationBodyIndex->value }} <br/>
                                </div>
                            @endforeach
                        @else
                            Não informado                            
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>