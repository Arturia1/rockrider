<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['email']) || $_SESSION['tipo_usuario'] !== 'usuario') {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];
$mensagem = ''; // Para armazenar a mensagem de sucesso ou erro

// Verificar se o filtro de inscritos foi solicitado
$mostrarInscritos = isset($_GET['inscritos']) && $_GET['inscritos'] == '1';

if ($mostrarInscritos) {
    $sql = "SELECT eventos.id, eventos.nome, eventos.descricao, eventos.data_criacao
            FROM eventos
            INNER JOIN inscricoes ON eventos.id = inscricoes.id_evento
            INNER JOIN usuarios ON usuarios.id = inscricoes.id_usuario
            WHERE usuarios.email = '$email'";  // Usando email da tabela usuarios
} else {
    $sql = "SELECT id, nome, descricao, data_criacao FROM eventos";
}

$result = $conexao->query($sql);
$eventos = $result->fetch_all(MYSQLI_ASSOC);

// Processar inscrições
if (isset($_POST['inscrever']) && isset($_POST['id_evento'])) {
    $idEvento = (int)$_POST['id_evento'];
    
    // Verificar se o usuário já está inscrito
    $checkInscricao = "SELECT * FROM inscricoes WHERE id_evento = $idEvento AND id_usuario = (SELECT id FROM usuarios WHERE email = '$email')";
    $resultCheck = $conexao->query($checkInscricao);

    if ($resultCheck->num_rows === 0) {
        // Inserir a inscrição
        $inscreverSql = "INSERT INTO inscricoes (id_evento, id_usuario) 
                         SELECT $idEvento, id FROM usuarios WHERE email = '$email'";
        if ($conexao->query($inscreverSql)) {
            $mensagem = '<div class="mensagem-sucesso">Inscrição realizada com sucesso!</div>';
        } else {
            $mensagem = '<div class="mensagem-erro">Erro ao realizar a inscrição. Tente novamente.</div>';
        }
    } else {
        $mensagem = '<div class="mensagem-erro">Você já está inscrito neste evento.</div>';
    }
}

// Processar cancelamento de inscrição
if (isset($_POST['cancelar']) && isset($_POST['id_evento'])) {
    $idEvento = (int)$_POST['id_evento'];

    // Remover a inscrição
    $cancelarSql = "DELETE FROM inscricoes WHERE id_evento = $idEvento AND id_usuario = (SELECT id FROM usuarios WHERE email = '$email')";
    if ($conexao->query($cancelarSql)) {
        $mensagem = '<div class="mensagem-sucesso">Inscrição cancelada com sucesso!</div>';
    } else {
        $mensagem = '<div class="mensagem-erro">Erro ao cancelar a inscrição. Tente novamente.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(0, 0, 0), rgb(110, 0, 0));
            color: white;
            padding: 20px;
        }
        .event-container {
            margin-bottom: 20px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
        }
        .event-title {
            font-size: 20px;
            font-weight: bold;
        }
        .event-description {
            margin: 10px 0;
        }
        .event-date {
            font-size: 14px;
            color: gray;
        }
        .button {
            background-color: crimson;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: darkred;
        }
        .filter-button {
            margin-bottom: 20px;
            background-color: darkblue;
        }
        .no-events-message {
            text-align: center;
            font-size: 18px;
            color: white;
            margin-top: 50px;
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
    </style>
</head>
<body>
    <h1>Eventos Disponíveis</h1>
    <a href="eventos_usuario.php?inscritos=1" class="button filter-button">Mostrar apenas eventos inscritos</a>
    <a href="eventos_usuario.php" class="button filter-button">Mostrar todos os eventos</a>

    <?php echo $mensagem; ?> <!-- Exibe a mensagem de sucesso ou erro -->

    <?php if (empty($eventos)): ?>
        <div class="no-events-message">
            <?php if ($mostrarInscritos): ?>
                Você não possui nenhuma inscrição em evento.
            <?php else: ?>
                Não há eventos disponíveis no momento.
            <?php endif; ?>
        </div>
    <?php else: ?>
        <?php foreach ($eventos as $evento): ?>
            <div class="event-container">
                <div class="event-title"><?php echo htmlspecialchars($evento['nome']); ?></div>
                <div class="event-description"><?php echo htmlspecialchars($evento['descricao']); ?></div>
                <div class="event-date">Data de Criação: <?php echo htmlspecialchars($evento['data_criacao']); ?></div>

                <?php if (!$mostrarInscritos): ?>
                    <form method="POST" style="margin-top: 10px;">
                        <input type="hidden" name="id_evento" value="<?php echo $evento['id']; ?>">
                        <button type="submit" name="inscrever" class="button">Inscrever-se</button>
                    </form>
                <?php else: ?>
                    <form method="POST" style="margin-top: 10px;">
                        <input type="hidden" name="id_evento" value="<?php echo $evento['id']; ?>">
                        <button type="submit" name="cancelar" class="button">Cancelar Inscrição</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
