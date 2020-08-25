<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
    }
    label, input:not([hidden]) {
        display: block;
    }
    #formContainer {
        padding: 30px;
        border: 1px solid #cccc;
        width: fit-content;
        border-radius: 10px;
    }
    #container{
        margin-top: 20px;
        display: flex;
        justify-content:center;
    }
    input, select{
        margin-bottom: 10px;
        height: 30px;
        font-size: 15px;
        width: 100%;
        border-radius: 10px;
        border: 1px solid #cccc;
        padding-left: 5px;
    }
    input, select:focus{
        outline: none;
    }
    label{
        margin-bottom: 2px;
    }
    .button{
        margin-top: 20px;
        padding: 5px;
        height: 30px;
        width: 100%;
    }
    input[type="submit"] {
        cursor: pointer;
    }
    input[type="submit"]:hover {
        opacity: 0.9;
    }
</style>

<div id="container">
    <div id="formContainer">
        <form action="{{ route('avaliacao_atleta.store') }}" method="POST">
            @csrf
            <div>
                <h4>Avaliação:</h4>
                <label>Atleta</label>
                <select name="athlete_id" required>
                    <option value="">Selecione um atleta</option>
                    @foreach ($athletes as $athlete)
                        <option value="{{ $athlete->id }}">
                            {{ $athlete->name }}
                        </option>
                    @endforeach
                </select>
                <label>Data da Avaliação</label>
                <input type="date" name="realization_date" required/>
            </div>
            <div>
                <h4>Testes Físicos:</h4>
                @foreach ($physicalTests as $physicalTest)
                    <label>{{ $physicalTest->name }}</label>
                    <input type="number" name="physical_tests[]" value="{{ $physicalTest->id }}" hidden/>
                    <input type="number" name="physical_tests_values[]"/>
                @endforeach
            </div>
            <div>
                <h4>Índices Corporais:</h4>
                @foreach ($bodyIndexes as $bodyIndex)
                    <label>{{ $bodyIndex->name }}</label>
                    <input type="number" name="body_indexes[]" value="{{ $bodyIndex->id }}" hidden/>
                    <input type="number" name="body_indexes_values[]"/>
                @endforeach
            </div>
            <input type="submit" name="Salvar" class="button"/>
        </form>
    </div>
</div>