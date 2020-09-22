$(document).ready(function () {
    $('#phone').mask('(00)00000-0000');
    $('#cpf').mask('000.000.000-00');
});

document.getElementById('athlete').addEventListener('change', function (e) {
    var selectedAthlete = e.target.value;
    var option = document.getElementById("athlete-" + selectedAthlete);

    var name = option.dataset.name;
    adicionarNovoAtleta(selectedAthlete, name);
});

document.getElementById('user_id').addEventListener('change', function (e) {
    var selectedUser = e.target.value;
    atualizarUsuario(selectedUser);
});

function adicionarNovoAtleta(id, nome) {
    var atletas = document.getElementById("listaDeAtletas");
    atletas.innerHTML += "<li class='mb-3' id='item" + id + "'><div class='input-group'><form style='display: inline' method='post'><input class='form-control' type='text' value='" + nome + "' readonly><div class='input-group-prepend'><button class='btn btn-outline-danger' onclick='removerAtleta(" + id + ")'>Remover</button></div></form></div><input type='hidden' name='" + id + "' id='atleta' value='" + id + "'></li>";
}

function atualizarUsuario(idUsuario) {
    document.getElementById('usuario').value = idUsuario
}

function removerAtleta(id) {
    var listaAtletas = document.getElementById("listaDeAtletas");
    var atleta = document.getElementById("item" + id);
    listaAtletas.removeChild(atleta);
}
