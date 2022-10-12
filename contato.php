<?php
include "acao.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-contato.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="validate.js" type="text/javascript"></script>
    <title>Contato</title>
</head>

<body>
    <div class="container-fluid">
        <form action="acao.php" id="formulario" method="post" name="formulario">
            <p>Dados do contato</p>
            <div class="form-row">
                <div class="col-md-6">
                    <input readonly class="form-control-plaintext" type="text" id="id" name="id" value=<?= isset($contato) ? $contato['id'] : '' ?>>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Nome Completo" name="nomeCompleto" required value=<?= isset($contato) ? $contato['nomeCompleto'] : '' ?>>
                    <span class="error"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <input type="number" class="form-control" placeholder="Telefone" name="telefone" required value=<?= isset($contato) ? $contato['telefone'] : '' ?>>
                    <span class="error"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" value=<?= isset($contato) ? $contato['email'] : '' ?>>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="date" class="form-control" name="dataNascimento" id="dataNascimento" value="" required onchange="validate()" value=<?= isset($contato) ? $contato['dataNascimento'] : '' ?>>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="idade" id="idade" placeholder="Idade" readonly>
                </div>
            </div>
            <p>Informações adicionais sobre o contato</p>
            <div>
                <label for="parente"></label>
                <input type="checkbox" id="parente" name="parente" <?php if (isset($contato) and $contato['parente']) echo 'checked' ?>> <label for="parente">Esse contato é um parente?</label>
            </div>
            <div class="form-group col-sm-6">
                <label for="origem">De onde você conhece esse contato?</label>
                <select class="form-control form-control-sm-6" name="origem" id="origem">
                    <option value="0">Selecione</option>
                    <option value="1" <?php if (isset($contato) and $contato['origem'] == 1) echo 'selected'; ?>>Trabalho</option>
                    <option value="2" <?php if (isset($contato) and $contato['origem'] == 2) echo 'selected'; ?>>Escola</option>
                    <option value="3" <?php if (isset($contato) and $contato['origem'] == 3) echo 'selected'; ?>>Internet</option>
                    <option value="4" <?php if (isset($contato) and $contato['origem'] == 4) echo 'selected'; ?>>Festas</option>
                </select>
            </div>

            <p>Sexo</p>
            <div>
                <input type="radio" class="form-check-input" id="sexofeminino" name="sexo" value="1" <?php if (isset($contato) and $contato['sexo'] == '1') echo 'checked'; ?>>
                <label class="form-check-label" for="sexofeminino">Feminino:</label>
                <input type="radio" class="form-check-input" id="sexomasculino" name="sexo" value="2" <?php if (isset($contato) and $contato['sexo'] == '2') echo 'checked'; ?>>
                <label class="form-check-label" for="sexomasculino">Masculino:</label>
            </div>
            <div>
                <button class="btn btn-primary" type="submit" name="acao" value="salvar">Salvar</button>
                <input class="btn btn-cancel" type="reset" name="cancelar" value="Cancelar" onclick='window.location.href="index.php"'>
            </div>
        </form>
    </div>
</body>