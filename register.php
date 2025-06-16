<?php
require 'config/db.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (empty($username) || empty($email) || empty($_POST['password'])) {
        $error = "Todos os campos são obrigatórios.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Erro ao registrar usuário.";
        }
        $stmt->close();
    }
}
?>

<link rel="stylesheet" href="css/style.css">

<form method="post">
  <input type="text" name="username" placeholder="Usuário" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Senha" required>
  <button type="submit">Registrar</button>
  <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>