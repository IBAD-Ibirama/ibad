@extends('base')
@section('content')
<style>   
    .relatorio_competicao > * {
        text-align: center;
    }
    
    @media(print){
        * {
            display: none
        }
        
        .area_impressao, .area_impressao * {
            display: initial;
        }
    }
</style>
<div class="area_impressao relatorio_competicao">
    <h2>Relatório da Competição</h2>
    <h3>
        {{ $descricao         }}
    </h3>
    <p>
        Data: {{ $competicao->data  }}
    </p>
    <p>
        Local: {{ $competicao->local }}
    </p>
    <p>
        Coordenador: {{ $competicao->coordenador }}
    </p>
    <p>
        Nivel da Competição: {{ $competicao->nivel_competicao }}
    </p>
</div>
<script>print();</script>
@endsection