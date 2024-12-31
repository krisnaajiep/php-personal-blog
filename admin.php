<?php include 'includes/head.php' ?>

<header>
  <h1>Personal Blog</h1>
  <a href="new.php">+ Add</a>
</header>

<!-- Main Section -->
<main>
  <?= Flasher::getFlash(); ?>
  <?php foreach ($articles as $article): ?>
    <article>
      <h3 class="title"><a href="article.php?id=<?= $article['id'] ?>"><?= $article['article_title'] ?></a></h3>
      <h3 class="action">
        <a href="edit.php" class="edit">Edit</a>
        <a href="#" class="delete">Delete</a>
      </h3>
    </article>
  <?php endforeach; ?>
</main>

<?php include 'includes/foot.php' ?>