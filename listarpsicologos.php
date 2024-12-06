<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.html?error=access_denied");
    exit();
}

$host = "localhost";
$dbname = "u108244310_mindsyncbanco";
$user = "u108244310_mindsyncbanco";
$password = "Mindsync@2";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

try {
    $stmt = $pdo->query("SELECT * FROM psicologos");
    $psicologos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Psicólogos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('fundo3.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 800px;
        }

        h2 {
            text-align: center;
            color: #013104;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #013104;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        img {
            max-width: 50px;
            max-height: 50px;
            border-radius: 50%;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Lista de Psicólogos</h2>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($psicologos)) : ?>
                    <?php foreach ($psicologos as $psicologo) : ?>
                        <tr>
                            <td>
                                <img src="<?= htmlspecialchars($psicologo['foto'] ?? 'default.png') ?>" alt="Foto">
                            </td>
                            <td><?= htmlspecialchars($psicologo['nome']) ?></td>
                            <td><?= htmlspecialchars($psicologo['matricula']) ?></td>
                            <td><?= htmlspecialchars($psicologo['email']) ?></td>
                            <td><?= htmlspecialchars($psicologo['telefone']) ?></td>
                            <td class="actions">
                                <a class="btn btn-edit" href="editar_psicologo.php?id=<?= $psicologo['id'] ?>">Editar</a>
                                <a class="btn btn-delete" href="deletar_psicologo.php?id=<?= $psicologo['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este psicólogo?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Nenhum psicólogo encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
