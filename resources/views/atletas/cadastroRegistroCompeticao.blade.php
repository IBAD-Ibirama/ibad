@extends('layouts.app')

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

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @role('admin')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Registrar participação do atleta </span>
                    <a class="btn btn-warning btn-sm" href="/atleta/registroPraticipacaoAtleta"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{ URL::to('atleta/registroPraticipacaoAtleta/registrar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            
                            <div class="col">
                                <div class="form-group">
                                    <label for="competition">Competicao</label>
                                    <select class="form-control" id="competition" name="competition"></select>
                                </div>
                                <div class="form-group">
                                    <label for="modality">Atletas</label>
                                    <div class="form-group">
                                        <div id="list1" class="dropdown-check-list" tabindex="100">

                                            <span class="anchor">Selecione os atletas: </span>
                                            <ul id="athlete" class="items">

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="modality">Modalidade</label>
                                    <select class="form-control" id="modality" name="modality"></select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Categoria</label>
                                    <select class="form-control" id="category" name="category"></select>
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="Salvar participação">
                    </form>
                </div>
            </div>
            @else

            <p>Você não tem permissão para acessar essa funcionalidade.</p>

            @endrole
        </div>
    </div>
</div>


<style>
    .dropdown-check-list {
        display: inline-block;
    }

    .dropdown-check-list .anchor {
        position: relative;
        cursor: pointer;
        display: inline-block;
        padding: 5px 50px 5px 10px;
        border: 1px solid #ccc;
    }

    .dropdown-check-list .anchor:after {
        position: absolute;
        content: "";
        border-left: 2px solid black;
        border-top: 2px solid black;
        padding: 5px;
        right: 10px;
        top: 20%;
        -moz-transform: rotate(-135deg);
        -ms-transform: rotate(-135deg);
        -o-transform: rotate(-135deg);
        -webkit-transform: rotate(-135deg);
        transform: rotate(-135deg);
    }

    .dropdown-check-list .anchor:active:after {
        right: 8px;
        top: 21%;
    }

    .dropdown-check-list ul.items {
        padding: 2px;
        display: none;
        margin: 0;
        border: 1px solid #ccc;
        border-top: none;
    }

    .dropdown-check-list ul.items li {
        list-style: none;
    }

    .dropdown-check-list.visible .anchor {
        color: #0094ff;
    }

    .dropdown-check-list.visible .items {
        display: block;
    }
</style>

<script>
    controllerCompetition();
    controllerAthlete();
    controllerCategory();
    controllerModality();

    function controllerModality() {
        let modalities = <?= $modalities ?>; //pega todas as modalidades

        let select = document.querySelector('#modality'); //pega o select de modalidade

        //cria um option e anexa ele no append com as informações q queremos
        for (let i = 0; i < modalities.length; i++) {
            let obj = modalities[i];
            let option = document.createElement('option');

            option.value = obj.id;
            option.innerText = obj.player_number;
            select.append(option);
        }
    }

    function controllerCategory() {
        let categories = <?= $categories ?>; //pega todas as categorias

        let select = document.querySelector('#category'); //pega o select de categoria

        //cria um option e anexa ele no append com as informações q queremos
        for (let i = 0; i < categories.length; i++) {
            let obj = categories[i];
            let option = document.createElement('option');

            option.value = obj.id;
            option.innerText = obj.category;
            select.append(option);
        }
    }

    function controllerAthlete() {
        let athletes = <?= $athletes ?>; //pega todos os atletas

        let select = document.querySelector('#athlete'); //pega o select de atletas

        //cria um option e anexa ele no append com as informações q queremos
        for (let i = 0; i < athletes.length; i++) {
            let obj = athletes[i];
            let li = document.createElement('li');
            let input = document.createElement('input');
            input.type = 'checkbox';
            input.value = obj.id;
            console.log(obj);

            input.name = 'athletes[]';
            let textNode = document.createTextNode(" " + obj.name);
            li.append(input);
            li.append(textNode);
            select.append(li);

        }
    }

    function controllerCompetition() {
        let competitions = <?= $competitions ?>; //pega todas as competições

        let select = document.querySelector('#competition'); //pega o select de competicao

        //adiciona um evento quanto o elemento select for alterado
        select.addEventListener('change', function() {
            let optionSelected = this.options[this.selectedIndex]; //pega o option selecionado
            //pega a competição q foi seleciona no select
            debugger
            let obj = competitions.find(competition => competition.id == optionSelected.value);

            var data = new Date(obj.date);
            let dia = data.getDate().toString().padStart(2, '0');
            let mes = (data.getMonth() + 1).toString().padStart(2, '0');
            let ano = data.getFullYear();
            let min = (data.getMinutes() < 10) ? "0" + data.getMinutes() : data.getMinutes();
            let hora = ((data.getHours() < 10) ? "0" + data.getHours() : data.getHours()) + ':' + min;
            obj.date = dia + "/" + mes + "/" + ano + ' ' + hora;
            //pega o formulario
            const elements = document.querySelector('#formulario');
            /*
             preenche os campos do formulario q dize respeito as partes da competição
             */
            for (let i = 0; i < elements.length; i++) {
                const element = elements[i];
                if (obj[element.id]) {
                    element.value = obj[element.id];
                }
            }
        });

        //cria um option e anexa ele no append com as informações q queremos
        for (let i = 0; i < competitions.length; i++) {
            let obj = competitions[i];
            let option = document.createElement('option');

            option.value = obj.id;
            option.innerText = obj.place;
            select.append(option);
        }
    }

    var checkList = document.getElementById('list1');
    checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
        if (checkList.classList.contains('visible'))
            checkList.classList.remove('visible');
        else
            checkList.classList.add('visible');
    }
</script>

@endsection