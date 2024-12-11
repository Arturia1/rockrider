<?php if (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>
    <script>
        alert('Usuário ou senha inválido!');
    </script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(0, 0, 0), rgb(110, 0, 0));
            text-align: center;
            color: white;
        }
        div {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color: #fff;
        }
        input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }
        .inputSubmit {
            background-color: darkred;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        }
        .inputSubmit:hover {
            background-color: red;
            cursor: pointer;
        }
        a {
            text-decoration: none;
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
        .linkRegistro {
            color: darkred;
            font-size: 15px;
            transition: color 0.3s ease;
        }
        .linkRegistro:hover {
            color: red;
            cursor: pointer;
        }
        .responsive-image {
            max-width: 15%;
            height: auto;
            margin-bottom: 10px;
        }
        /* Estilo do alerta */
        .alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: darkred;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            font-size: 16px;
            display: none;
            z-index: 1000;
        }
        .alert.show {
            display: block;
        }
    </style>
</head>
<body>
    <a href="home.php" class="btnVoltar">Voltar</a>
    <div>
        <img src="\assets\rockriderlogo.png" alt="Logo" class="responsive-image">
        <h1>ROCKRIDER</h1>
        <form action="testLogin.php" method="POST">
            <input type="text" name="email" placeholder="Email" required>
            <br><br>
            <input type="password" name="senha" placeholder="Senha" required>
            <br><br>
            <input class="inputSubmit" type="submit" value="Enviar">
         </form>

<a href="formulario.php" class="linkRegistro">Não possui conta? Clique aqui</a>

<!-- Alerta -->
<div class="alert" id="alertBox">Usuário ou senha inválido!</div>

<script>
    const form = document.getElementById("loginForm");
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita o envio automático
        const formData = new FormData(form);

        fetch("testLogin.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    window.location.href = data.redirectUrl; // Redireciona para a URL recebida
                } else {
                    showAlert(data.message); // Exibe mensagem de erro
                }
            })
            .catch((error) => {
                console.error("Erro:", error);
            });
    });

    function showAlert(message) {
        const alertBox = document.getElementById("alertBox");
        alertBox.textContent = message;
        alertBox.classList.add("show");
        setTimeout(() => {
            alertBox.classList.remove("show");
        }, 3000);
    }
</script>

</body>
</html>
