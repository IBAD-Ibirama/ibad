@extends('base')
@section('content')
<style>   
    .relatorio_competicao {
        font-size: 14pt;
        text-align: justify;
    }
    
    .relatorio_competicao > h4 {
        text-align: center;
    }
    
    .relatorio_competicao > p {
        text-indent: 30pt;
    }
    
    .relatorio_competicao_resultados {
        display: flex;
        flex-direction: column;
        border: 1px solid black;
    }
    
    .relatorio_competicao_resultados > .relatorio_competicao_colocacao {
        font-weight: bold;
        border-bottom: 1px solid black;
    }
    
    .relatorio_competicao_colocacao:not(:first-child) {
        border-top: 1px solid black;
    }
    
    .relatorio_competicao_colocacao, .relatorio_atleta_colocacao {
        margin: 0;
    }
    
    .relatorio_atleta_colocacao {
        display: flex;
        justify-content: space-between;
    }
    
    .relatorio_competicao_ouro, .relatorio_atleta_colocacao_1 {
        order: 1;
    }
    
    .relatorio_competicao_prata, .relatorio_atleta_colocacao_2 {
        order: 2;
    }
    
    .relatorio_competicao_bronze, .relatorio_atleta_colocacao_3 {
        order: 3;
    }
    
    .relatorio_competicao_modalidade {
        font-weight: bold;
    }
    
    @media only screen{
        .area_impressao, .area_impressao * {
            display: none;
        }
    }
    
    @media print{
        body > *:not(.base_sistema), .base_sistema > * {
            display: none !important;
        }
        
        .area_impressao {
            display: initial !important;
        }
    }
</style>
<p>
    O seu relatório deve estar sendo impresso.
</p>
<button class="btn btn-primary" onclick="print()">Imprimir novamente</button>
<div class="area_impressao relatorio_competicao">
    <h4>
        Relatório da competição: {{ $titulo }}
    </h4>
    <p>
        Na data {{ $competicao->date }} ocorreu em {{ $competicao->place }} a competição {{ $titulo }}. Esta foi
        coordenada por {{ $competicao->coordinator }} e envolveu um total de {{ count($atletas) }} participantes. {{ $descricao }}
    </p>
    <p>
        {{ $informacoes }}
    </p>
    <p>
        Resultados finais da competição:
    </p>
    <div class="relatorio_competicao_resultados">
        <p class="relatorio_competicao_colocacao relatorio_competicao_ouro">Ouro (1º Lugar)</p>
        <p class="relatorio_competicao_colocacao relatorio_competicao_prata">Prata (2º Lugar)</p>
        <p class="relatorio_competicao_colocacao relatorio_competicao_bronze">Bronze (3º Lugar)</p>
        @foreach($atletas as $atleta)
        @if($atleta->results <= 3)
        <p class="relatorio_atleta_colocacao relatorio_atleta_colocacao_{{$atleta->results}}">
            <span>{{$atleta->name}}</span>
            <span class="relatorio_competicao_modalidade">{{$atleta->player_number}} - {{$atleta->category}}     </span>
        </p>
        @endif
        @endforeach
    </div>
    <p>
        {{ $observacoes }}
    </p>
    @if($apoiadores)
    <p>
        O Ibirama Badminton agradece a todos os apoiadores: {{ $apoiadores }}
    </p>
    @endif
    <p>
        {{ $obsfinais }}
    </p>
</div>
<script>print();</script>
@endsection