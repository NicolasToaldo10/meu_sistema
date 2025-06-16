<?php


session_start();
require 'config/db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title']) && isset($_POST['description'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (!empty($title) && !empty($description)) {
        $stmt = $conn->prepare("INSERT INTO items (user_id, title, description) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $description);
        $stmt->execute();
        $stmt->close();
    }
}

$result = $conn->prepare("SELECT id, title, description FROM items WHERE user_id = ?");
$result->bind_param("i", $user_id);
$result->execute();
$result->store_result();
$result->bind_result($item_id, $title, $description);
?>
<h2>Bem-vindo!</h2>

<link rel="stylesheet" href="css/style.css">

<form method="post">
  <input type="text" name="title" placeholder="Título" required>
  <textarea name="description" placeholder="Descrição" required></textarea>
  <button type="submit">Adicionar Item</button>
</form>
<h3>Seus Itens:</h3>
<ul>
<?php while ($result->fetch()): ?>
  <li>
    <strong><?= htmlspecialchars($title) ?></strong>: <?= htmlspecialchars($description) ?>
    <a href="edit_item.php?id=<?= $item_id ?>">Editar</a>
  </li>
<?php endwhile; ?>
</ul>
<a href="logout.php">Sair</a>