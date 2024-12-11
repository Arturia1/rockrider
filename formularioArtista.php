<?php

    if(isset($_POST['submit']))
    {
        include_once('config.php');

        $nome_fantasia = $_POST['$nome_fantasia'];
        $cnpj = $_POST['cnpj'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $genero_music = $_POST['genero_music'];
        $data_formacao = $_POST['data_formacao'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $endereco = $_POST['endereco'];
        $tipo_usuario = $_POST['tipo_usuario'];

        $result = mysqli_query($conexao, "INSERT INTO artista(nome_fantasia,cnpj,senha,email,telefone,genero_music,data_formacao,cidade,estado,endereco,tipo_usuario) 
        VALUES ('$nome_fantasia', '$cnpj','$senha','$email','$telefone','$genero_music','$data_formacao','$cidade','$estado','$endereco', '$tipo_usuario')");

        header('Location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(0, 0, 0), rgb(110, 0, 0));
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: white;
        }
        .box {
            color: white;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 15px;
            width: 100%;
            max-width: 500px;
        }
        fieldset {
            border: 3px solid darkred;
            padding: 20px;
            border-radius: 10px;
        }
        legend {
            border: 1px solid darkred;
            padding: 10px;
            text-align: center;
            background-color: darkred;
            border-radius: 8px;
        }
        .inputBox {
            position: relative;
            margin-bottom: 20px;
        }
        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            padding: 5px 0;
        }
        .labelInput {
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: 0.5s;
            color: white;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput {
            top: -20px;
            font-size: 12px;
            color: darkred;
        }
        #data_formacao {
            border: none;
            padding: 8px;
            margin-bottom: 20px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
            width: 100%;
            color: white;
            background-color: rgba(255,255,255,0.1);
        }
        #submit {
            background-color: darkred;
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            margin-top: 20px;
        }
        #submit:hover {
            background-color: red;
        }
        .radio-group {
            margin-bottom: 20px;
        }
        .radio-options {
            display: flex;
            gap: 15px;
        }
        #sexo_outros_container {
            display: none;
            margin-top: 15px;
        }
        .link-voltar {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: lightcoral;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            transition: background-color 0.3s ease;
        }
        .link-voltar:hover {
            background-color: crimson;
            cursor: pointer;
        }
        @media screen and (max-width: 600px) {
            .box {
                width: 90%;
                padding: 15px;
            }
            .radio-options {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <a href="home.php" class="link-voltar">Voltar</a>
    <div class="box">
        <form action="formularioArtista.php" method="POST">
            <fieldset>
                <legend><b>Formulário Artista</b></legend>
                <br>
                <input type="hidden" name="tipo_usuario" value="artista">
                <div class="inputBox">
                    <input type="text" name="nome_fantasia" id="nome_fantasia" class="inputUser" required>
                    <label for="nome_fantasia" class="labelInput">Nome fantasia</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="cnpj" id="cnpj" class="inputUser" required>
                    <label for="cnpj" class="labelInput">CNPJ</label>
                </div>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="genero_music" id="genero_music" class="inputUser" required>
                    <label for="genero_music" class="labelInput">Gênero musical</label>
                </div>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <label for="data_formacao"><b>Data de Nascimento</b></label>
                <input type="date" name="data_formacao" id="data_formacao" required>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label for="cidade" class="labelInput">Cidade</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required>
                    <label for="estado" class="labelInput">Estado</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required>
                    <label for="endereco" class="labelInput">Endereço</label>
                </div>
                <input type="submit" name="submit" id="submit" value="Enviar">
            </fieldset>
        </form>
    </div>
</body>
</html>
