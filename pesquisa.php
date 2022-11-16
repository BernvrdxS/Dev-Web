<?php

    include_once('acao.php');

    $busca = isset($_POST['busca'])?$_POST['busca']:'';

    if ($busca != '') {
        $contatos = carregaDoArquivoParaVetor();
        $cont = [];
        foreach($contatos as $contato) {
            if ($contato['nome'] == $busca) {
                $cont[] = $contato;
            }
        }

        echo json_encode($cont);
    }

?>