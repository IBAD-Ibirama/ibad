<?php

use Illuminate\Support\Facades\URL;
?>
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
@endif<style>
    table, td, th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #root{
        overflow-x: auto;
    }

</style>
<div class="container">
    <h1>Consulta Participação</h1>
    <button id="btn-registra">Registra Participação</button>
    <div id="root"></div>
    <script>
        let root = document.querySelector('#root');
        document.querySelector('#btn-registra').addEventListener('click', function () {
            window.location.href = '<?= URL::to('atleta/registroPraticipacaoAtleta/registra') ?>';
        });

        criaTabela();

        function criaTabela() {
            let table = new Tabela();
            table.setColumns(['Atleta', 'Data', 'Local', 'Descrição', 'Categoria', 'Modalidade']);
            table.createTable();
            root.append(table.getTable());

            let aRegistros = <?= $athletesCompetitions ?>;
            
            let campos = [
                 'name'
                ,'date'
                ,'place'
                ,'descricao'
                ,'category'
                ,'player_number'
            ];

            for (let i = 0; i < aRegistros.length; i++) {
                let data = aRegistros[i];
                let tr = document.createElement('tr');
                for (let [key, value] of Object.entries(data)) {
                    if (campos.includes(key)) {
                        let td = document.createElement('td');
                        td.append(document.createTextNode(value))
                        tr.append(td);
                    }
                }
                let td = document.createElement('td');
                table.getTable().append(tr);
            }
        }

        function Tabela() {
            this.columns = null;
            this.table = null;

            this.setColumns = function (columns) {
                this.columns = columns;
            }

            this.createTable = function () {
                let table = this.getTable();
                let thead = document.createElement('thead');
                let tr = document.createElement('tr');

                for (let i = 0; i < this.columns.length; i++) {
                    let td = document.createElement('th');
                    td.append(document.createTextNode(this.columns[i]));

                    tr.append(td);
                }
                thead.append(tr);
                table.append(thead);
            }

            this.clear = function () {
                let table = this.getTable();
                while (table.firstChild) {
                    table.removeChild(table.lastChild);
                }
            }

            this.getTable = function () {
                if (this.table == null) {
                    this.table = document.createElement('table');
                }
                return this.table;
            }
        }

    </script>
</div>
@endsection