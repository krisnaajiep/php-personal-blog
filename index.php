<?php include 'includes/head.php' ?>

<!-- Header Section -->
<header>
  <h1>Personal Blog</h1>
</header>

<!-- Main Section -->
<main>
  <?php foreach ($articles as $article): ?>
    <article>
      <h3 class="title"><a href="article.php?id=<?= $article['id'] ?>"><?= $article['article_title'] ?></a></h3>
      <h3 class="date"><?= date_format(date_create_from_format('Y-m-d', $article['publishing_date']), 'F d, Y'); ?></h3>
    </article>
  <?php endforeach; ?>
</main>

<?php include 'includes/foot.php' ?>