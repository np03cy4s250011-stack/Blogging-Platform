<?php
include_once __DIR__ . '/../includes/header.php';
check_csrf();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT title FROM posts WHERE id = :id");
$stmt->execute([':id' => $id]);
$post = $stmt->fetch();
if (!$post) {
    exit('Post not found');
}
?>
<section>
  <h2>Delete Post</h2>
  <p>Are you sure you want to delete "<?= e($post['title']); ?>"?</p>
  <form method="post">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()); ?>">
    <button type="submit">Yes, delete</button>
    <a href="index.php">Cancel</a>
  </form>
</section>
<?php
include_once __DIR__ . '/../includes/footer.php';
?>
