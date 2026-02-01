<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit  = 5;

$stmt = $pdo->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT :offset, :limit");
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();

foreach ($posts as $post): ?>
<article>
  <header>
    <h3><a href="edit.php?id=<?= (int)$post['id']; ?>"><?= e($post['title']); ?></a></h3>
    <p>
      <span>By <?= e($post['author']); ?></span>
      <time datetime="<?= e($post['created_at']); ?>"><?= e($post['created_at']); ?></time>
    </p>
  </header>
  <p><?= e(mb_substr($post['content'], 0, 150)); ?>...</p>
  <footer>
    <span><?= e($post['category']); ?></span>
    <span> | Tags: <?= e($post['tags']); ?></span>
  </footer>
</article>
<?php endforeach; ?>
