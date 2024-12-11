<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(0, 0, 0), rgb(110, 0, 0));
            text-align: center;
            color: white;
        }
        .box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 15px;
            color: #fff;
        }
        a {
            text-decoration: none;
            color: white;
            border: 3px solid darkred;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: crimson;
        }
        .responsive-image {
            max-width: 15%;
            height: auto;
            margin-bottom: 10px;
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
            cursor: pointer;
        }
    </style>
</head>
<body>
    <a href="#" class="btnVoltar">Voltar</a>
    <div class="box">
        <img src="\assets\rockriderlogo.png" alt="Logo" class="responsive-image">
        <h1>ROCKRIDER</h1>
        <a href="login.php">Login</a>
        <a href="formulario.php">Cadastre-se</a>
    </div>
</body>
</html>
