<?php
include_once __DIR__ . '/../includes/header.php';

$q = trim($_GET['q'] ?? '');
$posts = [];

if ($q !== '') {
    $like = '%' . $q . '%';
    $stmt = $pdo->prepare(
      "SELECT * FROM posts
       WHERE title LIKE :q
          OR content LIKE :q
          OR author LIKE :q
       ORDER BY created_at DESC"
    );
    $stmt->execute([':q' => $like]);
    $posts = $stmt->fetchAll();
}
?>
<section>
  <h2>Search results for: <?= e($q); ?></h2>
  <?php if (!$posts): ?>
    <p>No posts found.</p>
  <?php else: ?>
    <?php foreach ($posts as $post): ?>
      <article>
        <header>
          <h3><?= e($post['title']); ?></h3>
          <p>By <?= e($post['author']); ?></p>
        </header>
        <p><?= e(mb_substr($post['content'], 0, 150)); ?>...</p>
      </article>
    <?php endforeach; ?>
  <?php endif; ?>
</section>
<?php
include_once __DIR__ . '/../includes/footer.php';
?>
