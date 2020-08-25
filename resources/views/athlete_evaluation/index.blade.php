<a href="{{ route('avaliacao_atleta.create') }}">Novo</a>
@foreach ($athleteEvaluations as $athleteEvaluation)
    <div>
        Atleta: {{ $athleteEvaluation->athlete->name }} <br/>
        Data: {{ $athleteEvaluation->realization_date }}
        <div>
            Testes Físicos:
            @foreach ($athleteEvaluation->physicalTests as $athleteEvaluationPhysicalTest)
                {{ $athleteEvaluationPhysicalTest->physicalTest->name }}: {{ $athleteEvaluationPhysicalTest->value }} <br/>
            @endforeach
        </div>
        <div>
            Índices Corporais:
            @foreach ($athleteEvaluation->bodyIndexes as $athleteEvaluationBodyIndex)
                {{ $athleteEvaluationBodyIndex->bodyIndex->name }}: {{ $athleteEvaluationBodyIndex->value }} <br/>
            @endforeach
        </div>
    </div>
    <hr>
@endforeach