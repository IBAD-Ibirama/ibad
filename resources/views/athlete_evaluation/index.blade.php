<a href="{{ route('avaliacao_atleta.create') }}">Novo</a>
@foreach ($athleteEvaluations as $athleteEvaluation)
    <div>
        Atleta: {{ $athleteEvaluation->athlete->name }} <br/>
        Data: {{ $athleteEvaluation->realization_date }}
        <div>
            @foreach ($athleteEvaluation->physicalTests as $athleteEvaluationPhysicalTest)
                {{ $athleteEvaluationPhysicalTest->physicalTest->name }}: {{ $athleteEvaluationPhysicalTest->value }} <br/>
            @endforeach
        </div>
    </div>
    <hr>
@endforeach