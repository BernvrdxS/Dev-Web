<?php

$nome = isset($_POST ['nome'])?$_POST['nome']:"";
$email = isset($_POST ['email'])?$_POST['email']:"";
$senha = isset($_POST ['senha'])?$_POST['senha']:"";
$id = isset($_POST ['id'])?$_POST['id']:"";

if ($nome != "" && $senha != "" && $email != "") {
    include_once "../config/conf.inc.php";
        try {
            //cria a conexão com o banco de dados
            $conexao = new PDO(MYSQL_DSN, DB_USER, DB_PASSWORD);
            
            // montar query
            if($id > 0) {
                $query ='UPDATE usuario SET nome = :nome, email = :email, senha = :senha
                        WHERE id = :id';
            } else {
                $query = 'INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)';
            }
            
            //prepara consulta
            $stmt = $conexao->prepare($query);

            //vincular variaveis com a consulta
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $senha);
            if ($id > 0) {
                $stmt->bindValue(':id', $id);
            }
            //executa a consulta
            if ($stmt->execute())
                header("location: cadUser.php");
            else
            echo 'Erro ao inserir dados';
    }catch(PDOException $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
        print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
        die();
    }

}
?>