<?php

use Illuminate\Support\Facades\URL;
?>
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
    table, td, th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #root{
        height: 300px;
        overflow-y: auto;
    }

</style>
<h1>Consulta index competicao</h1>
<button id="btn-novo">Novo</button>
<div id="root"></div>
<script>
    let root  = document.querySelector('#root');
    let btnNovo = document.querySelector('#btn-novo');
    btnNovo.addEventListener('click', function() {
        redirecionaTelaCadastro();
    });

    criaTabela();

    function criaTabela() {
        let table = new Tabela();
        table.setColumns(['Data', 'Local', 'Coordenador', 'Nível competição', 'Opções']);
        table.createTable();
        root.append(table.getTable());

        let aRegistros = <?= $aRegistros ?>;

        let aIgnora = ['id', 'updated_at', 'created_at'];
        for(let i = 0; i < aRegistros.length; i++) {
            let data = aRegistros[i];
            let tr = document.createElement('tr');
            for(let [key, value] of Object.entries(data)) {
                if(aIgnora.includes(key)) {
                    continue;
                }
                let td = document.createElement('td');
                td.append(document.createTextNode(value))
                tr.append(td);
            }
            // let btnAltera = criaBtn('altera', function() {
                
            // });
            let btnExclui = criaBtn('exclui', function() {
                // alert(`${data.id}`);
                ajax('get', data.id, '<?= URL::to('competicao/remove') ?>', function(response) {
                    alert('oi');
                });
            });
            let td = document.createElement('td');
            td.append(btnExclui);
            tr.append(td)
            table.getTable().append(tr);
        }
    }

    function Tabela() {
        this.columns = null;
        this.table   = null; 

        this.setColumns = function(columns) {
            this.columns = columns;
        }

        this.createTable = function() {
            let table = this.getTable();
            let thead = document.createElement('thead');
            let tr    = document.createElement('tr');

            for(let i = 0; i < this.columns.length; i++) {
                let td = document.createElement('th');
                td.append(document.createTextNode(this.columns[i]));

                tr.append(td);
            }


            thead.append(tr);
            table.append(thead);
        }

        this.clear = function() {
            let table = this.getTable();
            while (table.firstChild) {
                table.removeChild(table.lastChild);
            }
        }

        this.getTable = function() {
            if(this.table == null) {
                this.table = document.createElement('table');
            }
            return this.table;
        }
    }

    function redirecionaTelaCadastro() {
        window.location.href = '<?= URL::to('competicao/form') ?>';
    }

    function criaBtn(titulo, func) {
        let btn = document.createElement('button');
        btn.append(document.createTextNode(titulo));
        btn.addEventListener('click', func);
        return btn;
    }

    function ajax(type="GET", data, url, func){
        fetch(`${url}/${data}`)
        .then(response => alert(response));
    }

</script>
@endsection