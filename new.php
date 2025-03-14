<?php

include 'includes/head.php';

if (isset($_POST['publish'])) {
  $article->create([
    'article_title' => Request::post('article_title'),
    'publishing_date' => Request::post('publishing_date'),
    'content' => Request::post('content')
  ]);
}

?>

<!-- Header Section -->
<header>
  <h1>New Article</h1>
</header>

<!-- Main Section -->
<main>
  <form action="" method="post">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
    <div class="form-input">
      <label for="article_title">Article Title</label>
      <input type="text" name="article_title" id="article_title" placeholder="Article Title" <?php if (Validator::hasValidationError('article_title')): ?> style="border-color: red;" <?php endif; ?> value="<?= $_SESSION['old_data']['article_title'] ?? ""; ?>">
      <p class="error">
        <?= Validator::getValidationError("article_title"); ?>
      </p>
    </div>
    <div class="form-input">
      <label for="publishing_date">Publishing Date</label>
      <input type="date" name="publishing_date" id="publishing_date" <?php if (Validator::hasValidationError('publishing_date')): ?> style="border-color: red;" <?php endif; ?> value="<?= $_SESSION['old_data']['publishing_date'] ?? ""; ?>">
      <p class="error">
        <?= Validator::getValidationError("publishing_date"); ?>
      </p>
    </div>
    <div class="form-input">
      <label for="content">Content</label>
      <textarea name="content" id="content" rows="10" placeholder="Content" <?php if (Validator::hasValidationError('content')): ?> style="border-color: red;" <?php endif; ?>><?= $_SESSION['old_data']['content'] ?? ""; ?></textarea>
      <p class="error">
        <?= Validator::getValidationError("content"); ?>
      </p>
    </div>
    <button type="submit" name="publish">Publish</button>
  </form>
</main>

<?php include 'includes/foot.php' ?>