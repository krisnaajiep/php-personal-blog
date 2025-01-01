<?php

include 'includes/head.php';

if (!isset($_GET['id'])) {
  header('Location: index.php');
}

?>

<!-- Header Section -->
<header>
  <h1><?= $data['article_title'] ?></h1>
  <h3><?= date_format(date_create_from_format('Y-m-d', $data['publishing_date']), 'F d, Y'); ?></h3>
</header>

<!-- Main Section -->
<main>
  <p><?= $data['content'] ?></p>

  <?php if (!is_null($_SERVER['HTTP_REFERER'])): ?>
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="back">Go back</a>
  <?php endif; ?>
</main>