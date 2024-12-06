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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $especialidade = $_POST['especialidade'];
    $foto = $_FILES['foto'];

    $fotoPath = null;
    if ($foto && $foto['tmp_name']) {
        $fotoNome = uniqid() . '-' . $foto['name'];
        $fotoPath = 'uploads/' . $fotoNome;
        move_uploaded_file($foto['tmp_name'], $fotoPath);
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO psicologos (nome, matricula, email, telefone, especialidade, foto) 
                               VALUES (:nome, :matricula, :email, :telefone, :especialidade, :foto)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':especialidade', $especialidade);
        $stmt->bindParam(':foto', $fotoPath);

        if ($stmt->execute()) {
            header("Location: dashboard.php?success=1");
        } else {
            header("Location: editar_psicologo.php?error=1");
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>