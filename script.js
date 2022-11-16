window.onload = (function (){
    document.getElementById('pesquisa').addEventListener('submit', function(ev) {
        ev.preventDefault(); //Não envia o formulário
        carregaDados(document.getElementById('busca').value);
    })

});

function carregaDados(busca) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        dados = JSON.parse(this.responseText);
        montaTabela(dados);
    }
    xhttp.open("POST", "pesquisa.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("busca=" + busca)

}

function excluir(url){
    if (confirm('Confirma a Exclusão:')){
        
        window.location.href = url;
    }
}

function montaTabela(dados){
    el = document.getElementById("lista");
    el.remove(); // remove a tabela existente para recriá-la
    

    // aqui eu crio tudo como uma string, o ideal é criar cada elemento com a função Create e fazer o append desses ao documento
    let tabela = "<table class='table lista-contatos' id='lista'><thead><tr><th>Id</th><th>Nome</th><th>Sobrenome</th><th>Telefone</th><th>Alterar</th><th>Excluir</th></tr></thead>";
    for (let it in dados) {
        tabela += "<tr><td>" + dados[it].id + "</td>";
        tabela += "<td>" + dados[it].nome + "</td>";
        tabela += "<td>" + dados[it].sobrenome + "</td>";
        tabela += "<td>" + dados[it].telefone + "</td>";
        tabela += "<td><a href='novo/index.php?acao=editar&id="+dados[it].id+"'>Alt</a></td>";
        tabela += "<td><a href='#' onclick=excluir('index.php?acao=excluir&id="+dados[it].id+"','"+dados[it].nome+"')>Exc</a></td></tr>";
    }
    tabela += "</table>";
    document.getElementById('listagem').innerHTML = tabela;
}
