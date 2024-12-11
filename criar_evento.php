<?php
session_start();
include_once('config.php'); // Certifique-se de incluir a configuração do banco de dados

// Verificar se o usuário é um artista
if (isset($_SESSION['id']) && $_SESSION['tipo_usuario'] == 'artista') {
    $artista_id = $_SESSION['id']; // ID do artista logado

    // Recuperar os dados do formulário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome_evento = mysqli_real_escape_string($conexao, $_POST['nome_evento']);
        $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
        $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
        $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
        $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
        $local = mysqli_real_escape_string($conexao, $_POST['local']);
        
        // Verificar se a imagem foi enviada
        if (isset($_FILES['foto_evento']) && $_FILES['foto_evento']['error'] === UPLOAD_ERR_OK) {
            // Processar o upload da foto
            $foto_evento = 'uploads/' . basename($_FILES['foto_evento']['name']);
            move_uploaded_file($_FILES['foto_evento']['tmp_name'], $foto_evento);
        } else {
            $foto_evento = NULL; // Caso não haja foto
        }

        // Inserir o evento no banco de dados
        $sql = "INSERT INTO eventos (artista_id, nome, descricao, cidade, estado, endereco, local, foto, data_criacao) 
                VALUES ('$artista_id', '$nome_evento', '$descricao', '$cidade', '$estado', '$endereco', '$local', '$foto_evento', NOW())";

        if ($conexao->query($sql) === TRUE) {
            echo "Evento criado com sucesso!";
            // Redirecionar para a página de eventos ou outra página desejada
            header("Location: menu.php");
        } else {
            echo "Erro ao criar evento: " . $conexao->error;
        }
    }
} else {
    // Se o artista não estiver logado ou o tipo não for 'artista'
    echo "Você precisa estar logado como artista para criar um evento.";
}
?>

<!-- Formulário HTML -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Evento</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(0, 0, 0), rgb(110, 0, 0));
            color: white;
            text-align: center;
        }
        .form-container {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 15px;
            width: 400px;
            margin: 50px auto;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .inputSubmit {
            background-color: darkred;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }
        .inputSubmit:hover {
            background-color: red;
        }
        .btnVoltar {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: darkred;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            transition: background-color 0.3s ease;
        }
        .btnVoltar:hover {
            background-color: crimson;
        }
    </style>
</head>
<body>

    <a href="menu.php" class="btnVoltar">Voltar</a>

    <div class="form-container">
        <h1>Criar Evento</h1>
        <form action="criar_evento.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nome_evento" placeholder="Nome do Evento" required>
            <textarea name="descricao" placeholder="Descrição (máximo 300 caracteres)" maxlength="300" required></textarea>
            <input type="text" name="cidade" placeholder="Cidade" required>
            <input type="text" name="estado" placeholder="Estado" required>
            <input type="text" name="endereco" placeholder="Endereço" required>
            <input type="text" name="local" placeholder="Local" required>
            <input type="file" name="foto_evento" accept="image/*">
            <input class="inputSubmit" type="submit" value="Criar Evento">
        </form>
    </div>

</body>
</html>
