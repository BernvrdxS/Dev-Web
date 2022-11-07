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