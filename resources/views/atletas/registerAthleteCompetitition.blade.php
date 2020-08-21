@extends('base')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Ooops!</strong> Houve um problema com sua requisição...<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<style>
    .div-information {
        padding-top: 50px;
        display: flex;
        flex-direction: column;
    }

    .body-grid {
        overflow-y: auto;
        height: 40%;
    }

    .div-filters {
        margin-top: 35px;
    }

    .custom-table {
        height: 200px;
    }

    .button-submit {
        margin-bottom: 25px;
    }
</style>
<div>

    <h4>Registrar participação do atleta em uma competição</h4>

    <div class="div-information">
        <h6>Atletas</h6>
        <div class="row div-filters">
            <div class="col-6">
                <form method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="AthleteName">Busca pelo nome do atleta</label>
                        <input type="text" class="form-control" id="AthleteName" name="name" placeholder="Nome do atleta">
                        <small class="form-text text-muted">Informe o nome do atleta para filtrar</small>
                    </div>
                    <button type="submit" class="btn btn-primary button-submit">Buscar</button>
                </form>
            </div>
            <div class="col-6">
                <div class="body-grid">
                    <table class="table table-striped custom-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($athletes as $athlete)
                            <tr>
                                <td>{{$athlete->id}}</td>
                                <td>{{$athlete->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="div-information">
        <h6>Competições</h6>
        <div class="row div-filters">
            <div class="col-4">
                <form method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="competitionDate">Busca pela data da competição</label>
                        <input type="date" class="form-control" id="competitionDate" name="date" placeholder="Data da competição">
                        <small class="form-text text-muted">Informe a data que ocorreu a competição para filtrar</small>
                    </div>
                    <button type="submit" class="btn btn-primary button-submit">Buscar</button>
                </form>
                <form method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="competitionPlace">Busca pelo local da competição</label>
                        <input type="text" class="form-control" id="competitionPlace" name="date" placeholder="cep, logradouro - estado">
                        <small class="form-text text-muted">Informe o local que ocorreu a competição para filtrar</small>
                    </div>
                    <button type="submit" class="btn btn-primary button-submit">Buscar</button>
                </form>
            </div>
            <div class="col-8">
                <div class="body-grid">
                    <table class="table table-striped custom-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Local</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($competitions as $competition)
                            <tr>
                                <td>{{$competition->id}}</td>
                                <td>{{$competition->date}}</td>
                                <td>{{$competition->place}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="div-information">
        <h6>Registrar atleta na competição</h6>
        <div class="div-filters">
            <form method="POST" action="{{ URL::to('atletas/registerAthleteCompetition/register') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="athleteId">ID do atleta</label>
                            <input type="number" class="form-control" id="athleteId" name="athleteId" placeholder="ID do atleta">
                            <small class="form-text text-muted">Informe o ID do atleta para registrar na competição</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="competitionId">ID da competição</label>
                            <input type="number" class="form-control" id="competitionId" name="competitionId" placeholder="ID da competição">
                            <small class="form-text text-muted">Informe o ID da competição para registrar um atleta</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="modalitiesSelect">Modalidade</label>
                            <select class="form-control" id="modalitiesSelect" name="modalitiesSelect">
                                @foreach($modalities as $modality)
                                <option value='$modality->id'>{{ $modality->player_number }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Selecione a modalidiade do atleta na competição</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="CategorySelect">Categoria</label>
                            <select class="form-control" id="CategorySelect" name="CategorySelect">
                                @foreach($categories as $category)
                                <option value='1'>{{ $category->category }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Selecione a categoria do atleta na competição</small>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary button-submit">Registrar</button>
                </div>

            </form>
        </div>
        <div class="body-grid" style="height: 400px; margin-bottom: 50px;">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Atleta</th>
                        <th scope="col">Data</th>
                        <th scope="col">Local</th>
                        <th scope="col">Modalidade</th>
                        <th scope="col">Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($athletesCompetitions as $participation)
                    <tr>
                        <td>{{$participation->name}}</td>
                        <td>{{$participation->date}}</td>
                        <td>{{$participation->place}}</td>
                        <td>{{$participation->player_number}}</td>
                        <td>{{$participation->category}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection