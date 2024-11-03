<?php

include 'templates/header.php';

if (isset($_SERVER['PHP_AUTH_USER'])) header('Location: admin.php');

$articles = $article->read();

?>

<main>
  <h1>Personal Blog</h1>
  <section>
    <?php
    if (!empty($articles)):
      foreach ($articles as $article):
    ?>
        <div>
          <h2><a href="article.php?id=<?= $article['id']; ?>"><?= $article['article_title']; ?></a></h2>
          <h3 class="date"><?= date_format(date_create_from_format('Y-m-d', $article['publishing_date']), 'F d, Y'); ?></h3>
        </div>
    <?php
      endforeach;
    endif;
    ?>
  </section>
</main>

<?php include 'templates/foot.php' ?>