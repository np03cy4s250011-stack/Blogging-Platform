<?php
include_once __DIR__ . '/../includes/header.php';
check_csrf();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->execute([':id' => $id]);
$post = $stmt->fetch();
if (!$post) {
    exit('Post not found');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = trim($_POST['title'] ?? '');
    $author   = trim($_POST['author'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $tags     = trim($_POST['tags'] ?? '');
    $content  = trim($_POST['content'] ?? '');

    if ($title === '' || $author === '' || $content === '') {
        $errors[] = 'Title, author, and content are required.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
          "UPDATE posts
           SET title = :title, author = :author, category = :category,
               tags = :tags, content = :content
           WHERE id = :id"
        );
        $stmt->execute([
          ':title'    => $title,
          ':author'   => $author,
          ':category' => $category,
          ':tags'     => $tags,
          ':content'  => $content,
          ':id'       => $id,
        ]);
        header('Location: index.php');
        exit;
    }
}
?>
<section>
  <h2>Edit Post</h2>
  <?php foreach ($errors as $e): ?>
    <p><?= e($e); ?></p>
  <?php endforeach; ?>
  <form method="post">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()); ?>">
    <label>Title
      <input type="text" name="title" value="<?= e($post['title']); ?>" required>
    </label>
    <label>Author
      <input type="text" name="author" value="<?= e($post['author']); ?>" required>
    </label>
    <label>Category
      <input type="text" name="category" value="<?= e($post['category']); ?>">
    </label>
    <label>Tags
      <input type="text" name="tags" value="<?= e($post['tags']); ?>">
    </label>
    <label>Content
      <textarea name="content" required><?= e($post['content']); ?></textarea>
    </label>
    <button type="submit">Update</button>
  </form>
</section>
<?php
include_once __DIR__ . '/../includes/footer.php';
?>
