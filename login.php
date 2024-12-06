<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['username'];
    $senha = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM login_psicologo WHERE matricula = :matricula");
    $stmt->bindParam(':matricula', $matricula);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($senha, $user['senha'])) {
            session_start();
            $_SESSION['user'] = $matricula;
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: index.html?error=1");
            exit();
        }
    } else {
        header("Location: index.html?error=1");
        exit();
    }
}
?>
