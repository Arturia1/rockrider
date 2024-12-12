<?php
session_start();
include_once('config.php');

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: home.php'); // Redireciona para a página inicial após logout
    exit();
}

// Verificar se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['tipo_usuario'])) {
    header('Location: login.php');
    exit();
}

// Recuperar dados do usuário da sessão
$email = $_SESSION['email'];
$tipo_usuario = $_SESSION['tipo_usuario']; // 'usuario' ou 'artista'

// Verificar tipo de usuário e buscar dados do banco de dados
if ($tipo_usuario == 'usuario') {
    $sql = "SELECT nome, foto_perfil FROM usuarios WHERE email = '$email'";
} else if ($tipo_usuario == 'artista') {
    $sql = "SELECT nome_fantasia AS nome, foto_perfil FROM artista WHERE email = '$email'";
} else {
    die('Tipo de usuário desconhecido.');
}

$result = $conexao->query($sql);

// Verificar se a consulta retornou resultados
if ($result && $result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    $nome = $usuario['nome'];
    $foto_perfil = $usuario['foto_perfil'] ?? 'assets/placeholder-profile.jpg';  // Foto padrão se não encontrar foto
} else {
    $nome = 'Usuário Desconhecido';
    $foto_perfil = 'assets/placeholder-profile.jpg'; // Foto padrão se não encontrar usuário
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu do Usuário</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(0, 0, 0), rgb(110, 0, 0));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            color: white;
        }
        .menu-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 20px;
            padding: 30px;
            width: 300px;
            text-align: center;
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid white;
        }
        .welcome-message {
            font-size: 20px;
            margin-bottom: 30px;
        }
        .menu-icons {
            display: flex;
            justify-content: space-between;
            width: 100%;
            gap: 10px;
        }
        .menu-icon {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            padding: 15px;
            width: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .menu-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }
        .menu-icon i {
            font-size: 30px;
            margin-bottom: 10px;
            color: white;
        }
        .menu-icon-label {
            font-size: 12px;
            color: white;
        }

        /* Estilo do botão "Sair" */
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
    <!-- Botão de logout -->
    <a href="?logout=true" class="btnVoltar">Sair</a>

    <div class="menu-container">
        <!-- Exibir a foto de perfil do usuário -->
        <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil" class="profile-photo">
        
        <div class="welcome-message">
            Bem-vindo(a), <?php echo htmlspecialchars($nome); ?>
        </div>
        
        <div class="menu-icons">
            <div class="menu-icon" onclick="window.location.href='perfil.php'">
                <i class="fas fa-user"></i>
                <div class="menu-icon-label">Perfil</div>
            </div>
            
            <div class="menu-icon" onclick="window.location.href='feed.php'">
                <i class="fas fa-home"></i>
                <div class="menu-icon-label">Feed</div>
            </div>

            <?php if ($tipo_usuario == 'usuario') { ?>
                <div class="menu-icon" onclick="window.location.href='eventos_usuario.php'">
                    <i class="fas fa-calendar"></i>
                    <div class="menu-icon-label">Eventos</div>
                </div>
            <?php } else if ($tipo_usuario == 'artista') { ?>
                <div class="menu-icon" onclick="window.location.href='criar_evento.php'">
                    <i class="fas fa-ticket-alt"></i>
                    <div class="menu-icon-label">Criar Evento</div>
                </div>
            <?php } ?>
            
            <div class="menu-icon" onclick="window.location.href='eventos.php'">
                <i class="fas fa-compass"></i>
                <div class="menu-icon-label">Descubra</div>
            </div>
        </div>
    </div>
</body>
</html>
