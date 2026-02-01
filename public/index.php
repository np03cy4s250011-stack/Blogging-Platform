<?php
include_once __DIR__ . '/../includes/header.php';

$limit  = 5;
$stmt = $pdo->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT ?");
$stmt->bindValue(1, $limit, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();
?>
<section aria-labelledby="latest-posts-heading">
  <header><h2 id="latest-posts-heading">Latest posts</h2></header>
  <div id="post-list">
    <?php foreach ($posts as $post): ?>
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
  </div>
  <button id="load-more" type="button" data-offset="<?= $limit; ?>">Load more</button>
</section>
<?php
include_once __DIR__ . '/../includes/footer.php';
?>
