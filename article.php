<?php include 'templates/header.php' ?>

<main>
  <h1><?= $data['article_title']; ?></h1>

  <section>

    <h3 class="article-date"><?= date_format(date_create_from_format('Y-m-d', $data['publishing_date']), 'F d, Y'); ?></h3>

    <article><?= $data['content']; ?></article>

  </section>
</main>

<?php include 'templates/foot.php' ?>