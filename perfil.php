<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

include_once('config.php');

// Buscar dados do usuário atual
$email = $_SESSION['email'];
$tipo_usuario = $_SESSION['tipo_usuario']; // Tipo de usuário (usuario ou artista)

if ($tipo_usuario == 'usuario') {
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
} elseif ($tipo_usuario == 'artista') {
    $sql = "SELECT * FROM artista WHERE email = '$email'";
} else {
    // Tipo de usuário não reconhecido
    header('Location: login.php');
    exit();
}

$result = $conexao->query($sql);
$usuario = $result->fetch_assoc();

// Processar upload de foto
if (isset($_POST['upload_foto'])) {
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
        $diretorio_upload = 'uploads/perfil/';
        
        // Criar diretório se não existir
        if (!is_dir($diretorio_upload)) {
            mkdir($diretorio_upload, 0777, true);
        }

        // Nome único para o arquivo
        $nome_arquivo = $diretorio_upload . uniqid() . '_' . basename($_FILES['foto_perfil']['name']);
        
        // Verificar tipo de arquivo
        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
        $tipo_arquivo = $_FILES['foto_perfil']['type'];
        
        if (in_array($tipo_arquivo, $tipos_permitidos)) {
            // Tentar fazer upload
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $nome_arquivo)) {
                // Atualizar caminho da foto no banco
                if ($tipo_usuario == 'usuario') {
                    $sql_foto = "UPDATE usuarios SET foto_perfil = '$nome_arquivo' WHERE email = '$email'";
                } else {
                    $sql_foto = "UPDATE artista SET foto_perfil = '$nome_arquivo' WHERE email = '$email'";
                }
                $conexao->query($sql_foto);
                $mensagem_sucesso = "Foto de perfil atualizada com sucesso!";
            } else {
                $mensagem_erro = "Erro ao fazer upload da imagem.";
            }
        } else {
            $mensagem_erro = "Tipo de arquivo não permitido. Use JPEG, PNG ou GIF.";
        }
    }
}

// Processar atualização de perfil
if (isset($_POST['atualizar_perfil'])) {
    $nome = $conexao->real_escape_string($_POST['nome']);
    $telefone = $conexao->real_escape_string($_POST['telefone']);
    $cidade = $conexao->real_escape_string($_POST['cidade']);
    $estado = $conexao->real_escape_string($_POST['estado']);

    if ($tipo_usuario == 'usuario') {
        $sql_update = "UPDATE usuarios SET 
                        nome = '$nome', 
                        telefone = '$telefone', 
                        cidade = '$cidade', 
                        estado = '$estado' 
                        WHERE email = '$email'";
    } elseif ($tipo_usuario == 'artista') {
        $sql_update = "UPDATE artista SET 
                        nome_fantasia = '$nome', 
                        telefone = '$telefone', 
                        cidade = '$cidade', 
                        estado = '$estado' 
                        WHERE email = '$email'";
    }

    if ($conexao->query($sql_update)) {
        $mensagem_sucesso = "Perfil atualizado com sucesso!";
        // Recarregar dados do usuário
        $result = $conexao->query($sql);
        $usuario = $result->fetch_assoc();
    } else {
        $mensagem_erro = "Erro ao atualizar perfil: " . $conexao->error;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalizar Perfil</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(0, 0, 0), rgb(110, 0, 0));
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
        }
        .foto-perfil {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .foto-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        .btn {
            background-color: darkred;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: red;
        }
        .mensagem-sucesso {
            background-color: green;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
        .mensagem-erro {
            background-color: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
        .link-voltar {
            display: block;
            text-align: center;
            color: white;
            text-decoration: none;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Personalizar Perfil</h1>
        
        <?php
        if (isset($mensagem_sucesso)) {
            echo "<div class='mensagem-sucesso'>$mensagem_sucesso</div>";
        }
        if (isset($mensagem_erro)) {
            echo "<div class='mensagem-erro'>$mensagem_erro</div>";
        }
        ?>

        <div class="foto-upload">
            <img src="<?php echo !empty($usuario['foto_perfil']) ? $usuario['foto_perfil'] : 'assets/default-profile.png'; ?>" 
                 alt="Foto de Perfil" class="foto-perfil">
            
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="foto_perfil" accept="image/jpeg,image/png,image/gif" required>
                <button type="submit" name="upload_foto" class="btn">Atualizar Foto</button>
            </form>
        </div>

        <form method="POST">
            <div class="input-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" 
                       value="<?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>" required>
            </div>

            <div class="input-group">
                <label for="email">Email (não editável)</label>
                <input type="email" id="email" name="email" 
                       value="<?php echo htmlspecialchars($email); ?>" disabled>
            </div>

            <div class="input-group">
                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" 
                       value="<?php echo htmlspecialchars($usuario['telefone'] ?? ''); ?>" required>
            </div>

            <div class="input-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" 
                       value="<?php echo htmlspecialchars($usuario['cidade'] ?? ''); ?>" required>
            </div>

            <div class="input-group">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" 
                       value="<?php echo htmlspecialchars($usuario['estado'] ?? ''); ?>" required>
            </div>

            <button type="submit" name="atualizar_perfil" class="btn" style="width: 100%;">Salvar Alterações</button>
        </form>

        <a href="menu.php" class="link-voltar">Voltar ao Sistema</a>
    </div>
</body>
</html>
