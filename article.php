<?php include 'includes/head.php' ?>

<!-- Header Section -->
<header>
  <h1><?= $article['article_title'] ?></h1>
  <h3><?= date_format(date_create_from_format('Y-m-d', $article['publishing_date']), 'F d, Y'); ?></h3>
</header>

<!-- Main Section -->
<main>
  <p><?= $article['content'] ?></p>

  <a href="index.php" class="back">Go back</a>
</main>