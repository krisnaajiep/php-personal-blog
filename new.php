<?php include 'includes/head.php' ?>

<!-- Header Section -->
<header>
  <h1>New Article</h1>
</header>

<!-- Main Section -->
<main>
  <form action="" method="post">
    <div class="form-input">
      <input type="text" name="article_title" id="article_title" placeholder="Article Title">
    </div>
    <div class="form-input">
      <input type="date" name="publishing_date" id="publishing_date" placeholder="Publishing Date">
    </div>
    <div class="form-input">
      <textarea name="content" id="content" rows="10" placeholder="Content"></textarea>
    </div>
    <button type="submit" name="publish">Publish</button>
  </form>
</main>

<?php include 'includes/foot.php' ?>