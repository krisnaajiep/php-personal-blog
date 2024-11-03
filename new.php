<?php

include 'templates/header.php';

if (!is_null(Request::post('submit'))) {
  $article->create(Request::post());
}

?>

<main>
  <h1>New Article</h1>
  <form action="" method="post">
    <div class="form-input">
      <input type="text" name="article_title" id="article_title" placeholder="Article Title" <?php if (Validator::hasValidationError('article_title')): ?> style="border-color: red;" <?php endif; ?> value="<?= Request::getOldData("article_title") ?? ""; ?>">
      <p class="error">
        <?= Validator::getValidationError("article_title"); ?>
      </p>
    </div>
    <div class="form-input">
      <input type="date" name="publishing_date" id="publishing_date" <?php if (Validator::hasValidationError('publishing_date')): ?> style="border-color: red;" <?php endif; ?> value="<?= Request::getOldData('publishing_date') ?? date('Y-m-d'); ?>">
      <p class="error">
        <?= Validator::getValidationError("publishing_date"); ?>
      </p>
    </div>
    <div class="form-input">
      <textarea name="content" id="content" rows="10" placeholder="Content" <?php if (Validator::hasValidationError('content')): ?> style="border-color: red;" <?php endif; ?>><?= Request::getOldData('content') ?? ''; ?></textarea>
      <p class="error">
        <?= Validator::getValidationError("content"); ?>
      </p>
    </div>
    <button type="submit" name="submit">Publish</button>
  </form>
</main>

<?php include 'templates/foot.php' ?>