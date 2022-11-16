<?php
// verificar dados enviados
// echo 'Dados enviados:<br>';
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
define('JSON','https://63591f81ff3d7bddb9998ad6.mockapi.io/contato');

function carregaDadosFormParaVetor(){
    $destino = '';
    if (isset($_FILES['foto'])){
        // define a pasta destino do arquivo feito upload
        $destino = 'imagens/'.$_FILES['foto']['name'];
        // move o arquivo para a pasta destino
        move_uploaded_file($_FILES['foto']['tmp_name'],$destino);
    }

    // pega informação enviada via post e guarda no vetor dados   
    $dados = array( 'id' => isset($_POST['id'])?$_POST['id']:'',  // teste ISSET é para verificar se os dados foram enviados
                    'nomeCompleto' => isset($_POST['nomeCompleto'])?$_POST['nomeCompleto']:'',
                    'dataNascimento' => isset($_POST['dataNascimento'])?$_POST['dataNascimento']:'',
                    'email' => isset($_POST['email'])?$_POST['email']:'',
                    'telefone' => isset($_POST['telefone'])?$_POST['telefone']:'',
                    'sexo' => isset($_POST['sexo'])?$_POST['sexo']:'',
                    'parente' => isset($_POST['parente'])?$_POST['parente']:'',
                    'origem' => isset($_POST['origem'])?$_POST['origem']:''
                ); 
    return $dados; 

}


function inserir($novocontato){ // atualiza arquivo com todos os dados
    $dados = carregaDoArquivoParaVetor();
    // $novocontato = carregaDadosFormParaVetor();
    $novocontato['id'] = nextID($dados);
    if (validaDados($novocontato)){
        if ($dados){ 
            array_push($dados,$novocontato);
        }else{
            $dados[] = $novocontato;
        }
        salvaDadosNoArquivo($dados);
        return true;
    }
    return false;
}

function salvaDadosNoArquivo($dados){
    file_put_contents(JSON,json_encode($dados));    
}

function nextID($dados){
    $id = 0;
    if ($dados)
        $id = intval($dados[count($dados)-1]['id']);
    return ++$id;
}

function carregaDoArquivoParaVetor(){
 //   if (file_exists(JSON)){
        $conteudo = file_get_contents(JSON);
        $contatos = json_decode($conteudo,true);
        return $contatos;
 //   }
    return null;

}

function validaDados($dados){

    foreach($dados as $campo){  // apenas verifica se tem algum campo em branco
        if ($campo == '')
            return false;
    }
    return true;
}

function excluir($id){
    $dados = carregaDoArquivoParaVetor();
    $i = 0;
    foreach($dados as $contato){
        if ($contato['id'] == $id)
            break;
        else
        $i++;
    }
    array_splice($dados,$i,1);
    salvaDadosNoArquivo($dados);
}

function buscaContato($id){
    $dados = carregaDoArquivoParaVetor();
    foreach($dados as $contato){
        if ($contato['id'] == $id)
            return $contato;
    }
}

function alterar($alterado){
    $dados = carregaDoArquivoParaVetor();
    $i = 0;
    foreach($dados as $contato){
        if ($contato['id'] == $alterado['id'])
            break;
        else
        $i++;
    }
    array_splice($dados,$i,1,array($alterado));
    salvaDadosNoArquivo($dados);  
}


$acao = isset($_POST['acao'])?$_POST['acao']:'';

if ($acao =='salvar'){

    $contato = carregaDadosFormParaVetor();
    if ($contato['id'] == ''){
        if (inserir($contato))
            header('location: index.php');
    }else{    
        alterar($contato);
        header('location: index.php');

    }
}
else{

    $acao = isset($_GET['acao'])?$_GET['acao']:'';
    $id = isset($_GET['id'])?$_GET['id']:'';
    
    if ($acao == 'excluir'){
        excluir($id);
    }else if($acao == 'editar'){
        $contato = buscaContato($id);
        
        
    }
}
?> 