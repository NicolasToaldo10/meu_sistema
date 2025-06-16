<?php



session_start();
require 'config/db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$item_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    if (!empty($title) && !empty($description)) {
        $stmt = $conn->prepare("UPDATE items SET title = ?, description = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ssii", $title, $description, $item_id, $user_id);
        $stmt->execute();
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Campos obrigatórios.";
    }
} else {
    $stmt = $conn->prepare("SELECT title, description FROM items WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $item_id, $user_id);
    $stmt->execute();
    $stmt->bind_result($title, $description);
    $stmt->fetch();
    $stmt->close();
}
?>
<link rel="stylesheet" href="css/style.css">

<form method="post">
  <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required>
  <textarea name="description" required><?= htmlspecialchars($description) ?></textarea>
  <button type="submit">Salvar</button>
  <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>