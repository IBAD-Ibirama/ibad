<style>
    label, input:not([hidden]) {
        display: block;
    }
</style>
<form action="{{ route('avaliacao_atleta.store') }}" method="POST">
    @csrf
    <label>Atleta</label>
    <select name="athlete_id" required>
        @foreach ($athletes as $athlete)
            <option value="{{ $athlete->id }}">
                {{ $athlete->name }}
            </option>
        @endforeach
    </select>
    <label>Data da Avaliação</label>
    <input type="date" name="realization_date" required/>
    Testes Físicos:
    @foreach ($physicalTests as $physicalTest)
        <label>{{ $physicalTest->name }}</label>
        <input type="number" name="physical_tests[]" value="{{ $physicalTest->id }}" hidden/>
        <input type="number" name="physical_tests_values[]"/>
    @endforeach
    Índices Corporais:
    @foreach ($bodyIndexes as $bodyIndex)
        <label>{{ $bodyIndex->name }}</label>
        <input type="number" name="body_indexes[]" value="{{ $bodyIndex->id }}" hidden/>
        <input type="number" name="body_indexes_values[]"/>
    @endforeach
    <input type="submit" name="Salvar"/>
</form>