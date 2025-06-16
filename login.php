<?php
session_start();
require 'config/db.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Senha incorreta.";
        }
    } else {
        $error = "Usuário não encontrado.";
    }
    $stmt->close();
}
?>
<!-- HTML básico do formulário de login -->

<link rel="stylesheet" href="css/style.css">


    <form method="post">

        <input type="text" name="username" placeholder="Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
                <button type="submit">Entrar</button>
                    <?php if (isset($error)) echo "<p>$error</p>"; ?>
  
    </form>

<p> <center> <a href="register.php">Criar conta</a>  </center> </p>