<?php
session_start();
include_once('config.php');

// Verificar login
if (!isset($_SESSION['email']) || !isset($_SESSION['tipo_usuario'])) {
    header('Location: login.php');
    exit();
}

// Recuperar tipo de usuário e email da sessão
$email = $_SESSION['email'];
$tipo_usuario = $_SESSION['tipo_usuario'];

// Ajustar consulta com base no tipo de usuário
if ($tipo_usuario == 'usuario') {
    $sql = "SELECT id, nome, foto_perfil FROM usuarios WHERE email = '$email'";
} else {
    $sql = "SELECT id, nome_fantasia AS nome, foto_perfil FROM artista WHERE email = '$email'";
}

// Executar consulta
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $usuario_id = $user['id']; // Para artistas, "id" é mapeado a partir de "tipo"
    $nome = $user['nome'];     // "nome_fantasia" é mapeado como "nome"
    $foto_usuario = $user['foto_perfil']; // Foto do perfil do usuário
} else {
    die('Erro: Usuário ou artista não encontrado.');
}

// Enviar nova postagem
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $conteudo = $_POST['conteudo'];
    $foto = $_FILES['foto']['name'];
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_destino = 'uploads/' . $foto;
    move_uploaded_file($foto_temp, $foto_destino);

    $sql_post = "INSERT INTO posts (usuario_id, tipo_usuario, conteudo, foto) 
                 VALUES ('$usuario_id', '$tipo_usuario', '$conteudo', '$foto_destino')";
    $conexao->query($sql_post);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed Estilo Twitter</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(0, 0, 0), rgb(110, 0, 0));
            margin: 0;
            padding: 0;
            color: white;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .post-box {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .post-box textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            resize: none;
            min-height: 100px;
        }

        .post-box input[type="file"] {
            padding: 10px;
            margin-bottom: 10px;
            display: inline-block;
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: white;
            font-size: 14px;
        }

        .post-box button {
            background-color: darkred;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        .post-box button:hover {
            background-color: red;
        }

        .post {
            display: flex;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
            overflow: hidden;
        }

        .user-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .post-content {
            flex: 1;
        }

        .post-content h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .post-content p {
            margin: 5px 0;
            font-size: 14px;
        }

        .post img.preview {
            max-width: 100%;
            max-height: 150px;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .post img.preview:hover {
            transform: scale(1.05);
        }

        .post-footer {
            font-size: 12px;
            color: gray;
            margin-top: 10px;
        }

        /* Modal de imagem expandida */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }

        .modal .close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Caixa de postagem -->
        <div class="post-box">
            <form action="" method="POST" enctype="multipart/form-data">
                <textarea name="conteudo" placeholder="O que você está pensando?" required></textarea>
                <input type="file" name="foto" accept="image/*,video/*">
                <button type="submit">Postar</button>
            </form>
        </div>

        <!-- Feed de Postagens -->
        <div id="feed">
            <?php
            // Buscar as postagens mais recentes
            $sql_posts = "
                (SELECT p.id, p.conteudo, p.foto, p.data_postagem, u.nome, u.foto_perfil 
                 FROM posts p 
                 JOIN usuarios u ON p.usuario_id = u.id 
                 WHERE p.tipo_usuario = 'usuario')
                UNION
                (SELECT p.id, p.conteudo, p.foto, p.data_postagem, a.nome_fantasia AS nome, a.foto_perfil 
                 FROM posts p 
                 JOIN artista a ON p.usuario_id = a.id 
                 WHERE p.tipo_usuario = 'artista')
                ORDER BY data_postagem DESC LIMIT 10";
            $result_posts = $conexao->query($sql_posts);
            while ($post = $result_posts->fetch_assoc()) {
            ?>
            <div class="post" id="post-<?php echo $post['id']; ?>">
                <img class="user-photo" src="<?php echo $post['foto_perfil'] ?: 'default-avatar.jpg'; ?>" alt="Foto do Usuário">
                <div class="post-content">
                    <h3><?php echo htmlspecialchars($post['nome']); ?></h3>
                    <p><?php echo htmlspecialchars($post['conteudo']); ?></p>
                    <div class="post-footer">
                        <?php echo date('d/m/Y H:i', strtotime($post['data_postagem'])); ?>
                    </div>
                </div>
                <?php if (!empty($post['foto'])) { ?>
                    <img src="<?php echo $post['foto']; ?>" class="preview" alt="">
                <?php } ?>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Modal para imagem expandida -->
    <div class="modal" id="imageModal">
        <span class="close">&times;</span>
        <img id="modalImage" src="" alt="Imagem expandida">
    </div>

    <script>
        // Modal para expandir imagem
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const closeModal = document.querySelector('.modal .close');

        document.querySelectorAll('.post img.preview').forEach(image => {
            image.addEventListener('click', () => {
                modal.style.display = 'flex';
                modalImage.src = image.src;
            });
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>
</html>

