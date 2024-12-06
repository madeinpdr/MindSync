<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.html?error=access_denied");
    exit();
}

$success = isset($_GET['success']) && $_GET['success'] == 1;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil do Psicólogo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('fundo3.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #013104;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        .profile-pic {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-pic img {
            max-width: 100px;
            max-height: 100px;
            margin-bottom: 10px;
            border-radius: 50%;
        }

        .alert {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            margin-bottom: 15px;
            display: none;
        }

        .alert.show {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if ($success): ?>
            <div class="alert show">
                Perfil atualizado com sucesso!
            </div>
        <?php endif; ?>

        <h2>Editar Perfil do Psicólogo</h2>
        <form action="processar_edicao.php" method="POST" enctype="multipart/form-data">
            <div class="profile-pic">
                <label for="foto">Foto de Perfil</label>
                <img id="foto-preview" src="default.png" alt="Foto do Psicólogo">
                <input type="file" name="foto" id="foto" accept="image/*" onchange="previewFoto()">
            </div>

            <label for="nome">Nome Completo</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" required>

            <label for="matricula">Matrícula</label>
            <input type="text" id="matricula" name="matricula" placeholder="Digite a matrícula" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Digite o e-mail" required>

            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone" placeholder="Digite o telefone" required>

            <label for="especialidade">Especialidade</label>
            <textarea id="especialidade" name="especialidade" placeholder="Digite as especialidades" rows="3"></textarea>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>

    <script>
        function previewFoto() {
            const fotoInput = document.getElementById('foto');
            const preview = document.getElementById('foto-preview');
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (fotoInput.files[0]) {
                reader.readAsDataURL(fotoInput.files[0]);
            }
        }
    </script>
</body>

</html>
