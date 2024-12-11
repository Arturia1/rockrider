<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quem Você é?</title>
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
        a {
            text-decoration: none;
        }
        /* Botão voltar */
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
            background-color: red;
            cursor: pointer;
        }
        .page-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .header {
            margin-bottom: 30px;
        }
        .icon-container {
            display: flex;
            justify-content: center;
            gap: 50px;
        }
        .icon-wrapper {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 20px;
            padding: 30px;
            width: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .icon-wrapper:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }
        .responsive-image {
            width: 200px;
            height: 200px;
            object-fit: contain;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .icon-label {
            margin-top: 10px;
            font-size: 18px;
            color: white;
        }
    </style>
</head>
<body>
    <a href="home.php" class="btnVoltar">Voltar</a>
    <div class="page-wrapper">
        <div class="header">
            <h1>Qual a tua vibe?</h1>
        </div>
        <div class="icon-container">
            <div class="icon-wrapper" onclick="window.location.href='formularioUsuario.php'">
                <img src="\assets\rockriderlogo.png" alt="Logo" class="responsive-image">
                <div class="icon-label">Usuário</div>
            </div>
            <div class="icon-wrapper" onclick="window.location.href='formularioArtista.php'">
                <img src="\assets\guitar.png" alt="Logo" class="responsive-image">
                <div class="icon-label">Artista</div>
            </div>
        </div>
    </div>
</body>
</html>