<?php

    if(isset($_POST['submit']))
    {
        include_once('config.php');

        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $sexo = $_POST['genero'];
        $sexo_outros = isset($_POST['sexo_outros']) ? $_POST['sexo_outros'] : '';
        $data_nasc = $_POST['data_nascimento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $endereco = $_POST['endereco'];
        $tipo_usuario = $_POST['tipo_usuario'];

        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,cpf,senha,email,telefone,sexo,sexo_outros,data_nasc,cidade,estado,endereco,tipo_usuario) 
        VALUES ('$nome', '$cpf','$senha','$email','$telefone','$sexo','$sexo_outros','$data_nasc','$cidade','$estado','$endereco','$tipo_usuario')");

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
        #data_nascimento {
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
        <form action="formularioUsuario.php" method="POST">
            <fieldset>
                <legend><b>Formulário de Clientes</b></legend>
                <br>
                <input type="hidden" name="tipo_usuario" value="usuario">
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
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
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <div class="radio-group">
                    <p>Sexo:</p>
                    <div class="radio-options">
                        <div>
                            <input type="radio" id="feminino" name="genero" value="feminino" required>
                            <label for="feminino">Feminino</label>
                        </div>
                        <div>
                            <input type="radio" id="masculino" name="genero" value="masculino" required>
                            <label for="masculino">Masculino</label>
                        </div>
                        <div>
                            <input type="radio" id="outro" name="genero" value="outro" required>
                            <label for="outro">Outro</label>
                        </div>
                    </div>
                    <div id="sexo_outros_container">
                        <div class="inputBox">
                            <input type="text" name="sexo_outros" id="sexo_outros" class="inputUser">
                            <label for="sexo_outros" class="labelInput">Especifique seu sexo/gênero</label>
                        </div>
                    </div>
                </div>
                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const outroRadio = document.getElementById('outro');
            const sexoOutrosContainer = document.getElementById('sexo_outros_container');
            const sexoOutrosInput = document.getElementById('sexo_outros');
            outroRadio.addEventListener('change', function() {
                sexoOutrosContainer.style.display = this.checked ? 'block' : 'none';
                sexoOutrosInput.required = this.checked;
            });
        });
    </script>
</body>
</html>
