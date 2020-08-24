@extends('base')

@section('content')
<div class="container">
    <h1>Financeiro</h1>
    <table id="tabela" class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Ano</th>
                <th scope="col">Janeiro</th>
                <th scope="col">Fevereiro</th>
                <th scope="col">Março</th>
                <th scope="col">Abril</th>
                <th scope="col">Maio</th>
                <th scope="col">Junho</th>
                <th scope="col">Julho</th>
                <th scope="col">Agosto</th>
                <th scope="col">Setembro</th>
                <th scope="col">Outubro</th>
                <th scope="col">Novembro</th>
                <th scope="col">Dezembro</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script>
    let tabela    = document.querySelector('#tabela');
    let pagamento = <?= $pagamento ?>;

    let ignora    = ['id', 'athletes_id', 'created_at', 'updated_at'];
    debugger
    for(let i = 0; i < pagamento.length; i++) {
        let tr = document.createElement('tr');
        for (var [key, value] of Object.entries(pagamento[i])) {
            if(ignora.includes(key)) {
                continue;
            }
            let td = document.createElement('td');
            if (value == true) {
                td.append('Pago');
            } else if (value == false) {
                td.append('Aberto');
            } else {
                td.append(value);
            }
            tr.append(td);
        }
        tabela.append(tr);
    }
</script>
@endsection