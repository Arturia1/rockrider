<?php
session_start();
include_once('config.php');

// Verificar se o usuário está logado como artista
if (!isset($_SESSION['email']) || $_SESSION['tipo_usuario'] != 'artista') {
    header('Location: login.php');
    exit();
}

$artista_id = $_SESSION['id']; // ID do artista logado

// Buscar eventos do artista com filtros (nome do evento ou estado)
$nome_evento = isset($_POST['nome_evento']) ? mysqli_real_escape_string($conexao, $_POST['nome_evento']) : '';
$estado_evento = isset($_POST['estado']) ? mysqli_real_escape_string($conexao, $_POST['estado']) : '';

// Condição de filtro por nome ou estado
$sql = "SELECT * FROM eventos WHERE artista_id = '$artista_id'";

if ($nome_evento) {
    $sql .= " AND nome LIKE '%$nome_evento%'";
}
if ($estado_evento) {
    $sql .= " AND estado LIKE '%$estado_evento%'";
}

$sql .= " ORDER BY data_criacao DESC";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Eventos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(0, 0, 0), rgb(110, 0, 0));
            color: white;
            padding: 20px;
        }
        .search-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
            width: 200px;
        }
        .search-container button {
            background-color: darkred;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .search-container button:hover {
            background-color: crimson;
        }
        .search-container i {
            font-size: 18px;
            color: white;
        }
        .event-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
        }
        .event-container img {
            width: 50%;
            max-width: 300px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .event-container h3 {
            margin: 10px 0;
            font-size: 18px;
            font-weight: bold;
        }
        .event-container p {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .events-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            overflow-y: auto;
            max-height: 500px;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .events-list {
                grid-template-columns: 1fr;
            }
        }
        .back-button {
            background-color: darkred;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }
        .back-button:hover {
            background-color: crimson;
        }
        .details-button {
            background-color: darkred;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        .details-button:hover {
            background-color: crimson;
        }
    </style>
</head>
<body>

    <a href="menu.php" class="back-button">Voltar</a>

    <h2>Meus Eventos</h2>

    <div class="search-container">
        <form action="meus_eventos.php" method="POST">
            <input type="text" name="nome_evento" placeholder="Buscar por nome do evento" value="<?php echo htmlspecialchars($nome_evento); ?>">
            <input type="text" name="estado" placeholder="Buscar por estado" value="<?php echo htmlspecialchars($estado_evento); ?>">
            <button type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="events-list">
        <?php
        // Exibir eventos
        if ($result && $result->num_rows > 0) {
            while ($evento = $result->fetch_assoc()) {
                ?>
                <div class="event-container">
                    <h3><?php echo htmlspecialchars($evento['nome']); ?></h3>
                    <img src="<?php echo htmlspecialchars($evento['foto']); ?>" alt="Foto do Evento">
                    <p><strong>Descrição:</strong> <?php echo htmlspecialchars($evento['descricao']); ?></p>
                    <p><strong>Cidade:</strong> <?php echo htmlspecialchars($evento['cidade']); ?></p>
                    <p><strong>Estado:</strong> <?php echo htmlspecialchars($evento['estado']); ?></p>
                    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($evento['endereco']); ?></p>
                    <a href="detalhes_evento.php?id=<?php echo $evento['id']; ?>" class="details-button">Ver Detalhes</a>
                </div>
                <?php
            }
        } else {
            echo "<p>Nenhum evento encontrado.</p>";
        }
        ?>
    </div>

</body>
</html>
