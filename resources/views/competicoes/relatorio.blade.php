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
<form action="{{ URL::to('competicoes/relatorio') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="idCampeonato">Id do campeonato para o Relatório*</label>
        <input type="text" class="form-control" id="idCampeonato" name="id" placeholder="Id do Campeonato">
        <small class="form-text text-muted">Informe o id do campeonato para emissão.</small>
    </div>
    <div class="form-group">
        <label for="tituloCampeonato">Título da competição*</label>
        <textarea class="form-control" id="tituloCampeonato" name="titulo" placeholder="Título do Relatório"></textarea>
        <small class="form-text text-muted">Informe o título para ser inserido no relatório.</small>
    </div>
    <div class="form-group">
        <label for="descricaoCampeonato">Descrição do Campeonato*</label>
        <textarea class="form-control" id="descricaoCampeonato" name="descricao" placeholder="Texto do Relatório">Representando a cidade de (cidade), a equipe de (equipe) competiu com (atletas) atletas, nas categorias (categorias).</textarea>
        <small class="form-text text-muted">Atualize o texto com as informações de descrição da participação da equipe.</small>
    </div>
    <div class="form-group">
        <label for="informacoesEquipe">Informações da Equipe</label>
        <textarea class="form-control" id="informacoesEquipe" name="informacoes" placeholder="Informações da equipe no Relatório">A etapa foi promovida por (promovedor), e a equipe de (cidade) retornou da competição com (medalhas) medalhas conquistadas.</textarea>
        <small class="form-text text-muted">Atualize o texto de com informações de resultados da equipe.</small>
    </div>
    <div class="form-group">
        <label for="observacoesCampeonato">Observações de Desempenho</label>
        <textarea class="form-control" id="observacoesCampeonato" name="observacoes" placeholder="Observações extras do campeonato"></textarea>
        <small class="form-text text-muted">Informe aqui observações para serem inseridas após os resultados.</small>
    </div>
    <div class="form-group">
        <label for="apoiadores">Apoiadores</label>
        <textarea class="form-control" id="apoiadores" name="apoiadores" placeholder="Nome de apoiadores"></textarea>
        <small class="form-text text-muted">Informe aqui o nome dos apoiadores.</small>
    </div>
    <div class="form-group">
        <label for="obsFinais">Observações Finais</label>
        <textarea class="form-control" id="obsFinais" name="obsfinais" placeholder="Observações finais do campeonato">As atividades que envolvem o badminton ocorrem as (data), no (local), e são abertas à comunidade gratuitamente. Os professores (professores) convidam a comunidade interessada a conhecer a modalidade e participar dos projetos.</textarea>
        <small class="form-text text-muted">Informe aqui observações para serem inseridas no final do relatório.</small>
    </div>
    <button type="submit" class="btn btn-primary">Emitir</button>
</form>
@endsection