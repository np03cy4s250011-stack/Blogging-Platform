<?php
include_once __DIR__ . '/../includes/header.php';
check_csrf();

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
          "INSERT INTO posts (title, author, category, tags, content, created_at)
           VALUES (:title, :author, :category, :tags, :content, NOW())"
        );
        $stmt->execute([
          ':title'    => $title,
          ':author'   => $author,
          ':category' => $category,
          ':tags'     => $tags,
          ':content'  => $content,
        ]);
        header('Location: index.php');
        exit;
    }
}
?>
<section>
  <h2>Add Post</h2>
  <?php foreach ($errors as $e): ?>
    <p><?= e($e); ?></p>
  <?php endforeach; ?>
  <form method="post">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()); ?>">
    <label>Title
      <input type="text" name="title" required>
    </label>
    <label>Author
      <input type="text" name="author" required>
    </label>
    <label>Category
      <input type="text" name="category">
    </label>
    <label>Tags
      <input type="text" name="tags" placeholder="php, ajax, security">
    </label>
    <label>Content
      <textarea name="content" required></textarea>
    </label>
    <button type="submit">Save</button>
  </form>
</section>
<?php
include_once __DIR__ . '/../includes/footer.php';
?>
