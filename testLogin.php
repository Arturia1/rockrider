<?php
session_start();
include_once('config.php'); // Certifique-se de incluir o arquivo de configuração

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // Verificar na tabela de usuários
    $queryUsuarios = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $resultUsuarios = $conexao->query($queryUsuarios);

    // Verificar na tabela de artistas
    $queryArtistas = "SELECT * FROM artista WHERE email = '$email' AND senha = '$senha'";
    $resultArtistas = $conexao->query($queryArtistas);

    if ($resultUsuarios->num_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['tipo_usuario'] = 'usuario';
        header('Location: menu.php'); // Redirecionar para página de usuário
    } elseif ($resultArtistas->num_rows > 0) {
        $artista = $resultArtistas->fetch_assoc();
        // Salvar o ID do artista na sessão
        $_SESSION['id'] = $artista['id']; // Armazena o ID do artista
        $_SESSION['email'] = $artista['email'];
        $_SESSION['tipo_usuario'] = 'artista'; // Garantir que o tipo de usuário seja 'artista'
        
        header('Location: menu.php'); // Redirecionar para a página de menu do artista
    exit();
    } else {
        header('Location: login.php?error=invalid'); // Retornar ao login em caso de falha
    }
} else {
    header('Location: login.php?error=missing'); // Dados ausentes
}
?>
