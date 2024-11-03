<?php

include 'templates/header.php';

if (!is_null(Request::post('logout'))) $auth->logout();

$articles = $article->read();

?>

<main>
  <div class="main-header">
    <h1>Personal Blog</h1>
    <h3 class="add"><a href="new.php">+ Add</a></h3>
  </div>
  <section>
    <?= Flasher::getFlash(); ?>
    <?php
    if (!empty($articles)):
      foreach ($articles as $article):
    ?>
        <div>
          <h2><a href="article.php?id=<?= $article['id']; ?>"><?= $article['article_title']; ?></a></h2>
          <h3 class="crud">
            <a href="edit.php?id=<?= $article['id']; ?>">Edit</a>
            <a href="delete.php?id=<?= $article['id']; ?>">Delete</a>
          </h3>
        </div>
    <?php
      endforeach;
    endif;
    ?>
  </section>
</main>

<?php include 'templates/foot.php' ?>