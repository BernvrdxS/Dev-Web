<?php

$acao = isset($_GET['acao'])?$_GET['acao']:"";
$id = isset($_GET['id'])?$_GET['id']:"";

if ($acao == 'editar') {
    //buscar dados do usuário que está sendo editado
    try{
        include_once "../config/conf.inc.php";   
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);

        $query = 'SELECT * FROM usuario WHERE id = :id';

        $stmt = $conexao->prepare($query);

        $stmt->bindValue(':id',$id); 
        
        $stmt->execute();
        $usuario = $stmt->fetch();
    }catch(PDOException $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
    print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
    die();
        } 
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
 
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h1>Cadastrar novo Usuário</h1>
    <form action="acaoUser.php" method="post">
        <input type="text" readonly name="id" id="id" value=<?php if(isset ($usuario)) echo $usuario['id']; else echo 0;?>>
        <label for="name">Nome:</label>
        <input type="text" name='nome' id='nome' placeholder="Informe seu nome completo..." value=<?php if(isset ($usuario)) echo $usuario['nome']?>>
        <label for="email">E-mail:</label>
        <input type="email" name='email' id='email' placeholder="usuario@mail.com..." value=<?php if(isset ($usuario)) echo $usuario['email']?>> 
        <label for="name">Senha:</label>
        <input type="password" name='senha' id='senha' placeholder="Informe uma senha ..." value=<?php if(isset ($usuario)) echo $usuario['senha']?>>
        <button type='submit' name='acao' value='salvar'>Enviar</button>
    </form>
    <hr>
    <section>
        <h2> Lista de Usuários cadastrados</h2>
        <form action="" method="get" id='pesquisa'>
            <input type="search" name='busca' id='busca'>
            <button type="submit" name='pesquisa'>Buscar</button>
        </form>
        <table class='table'>
            <?php             
                try{
                    include_once "../config/conf.inc.php";   
                    // cria a conexão com o banco de dados 
                    $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
                    // montar consulta
                    $busca = isset($_GET['busca'])?$_GET['busca']:"";
                    $query = 'SELECT * FROM usuario';
                    if ($busca != ""){
                        $busca = '%'.$busca.'%';
                        $query .= ' WHERE nome like :busca' ;
                    }
                    // preparar consulta
                    $stmt = $conexao->prepare($query);
                    // vincular variaveis com a consulta
                    if ($busca != ""){
                    $stmt->bindValue(':busca',$busca); 
                    }
                    $stmt->execute();
                    $usuarios = $stmt->fetchAll();
                    echo '<tr><th>ID</td><th>Nome</th><th>E-mail</th><th>Senha</th><th>Editar</th></tr>';
                    foreach($usuarios as $usuario){
                        $editar = "<a href= 'cadUser.php?acao=editar&id=" .$usuario['id']. "'>Alterar</a>";
                        echo '<tr><td>'.$usuario['id'].'</td><td>'.$usuario['nome'].'</td><td>'.$usuario['email'].'</td><td>'.$usuario['senha']."</td><td>{$editar}</td></tr>";
                    }
                }catch(PDOException $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
                    print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
                    die();
                }           
            ?>        
        </table>
    </section>
</body>
</html>