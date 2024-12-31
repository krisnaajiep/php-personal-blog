<?php

include 'includes/head.php';

if (!isset($_GET['id'])) {
  header('Location: admin.php');
}

if (isset($_POST['update'])) {
  $article->update($_POST);
}

?>

<!-- Header Section -->
<header>
  <h1>Update Article</h1>
</header>

<!-- Main Section -->
<main>
  <form action="" method="post">
    <div class="form-input">
      <input type="hidden" name="id" value="<?= $data['id']; ?>">
      <label for="article_title">Article Title</label>
      <input type="text" name="article_title" id="article_title" placeholder="Article Title" <?php if (Validator::hasValidationError('article_title')): ?> style="border-color: red;" <?php endif; ?> value="<?= $_SESSION['old_data']['article_title'] ?? $data['article_title']; ?>">
      <p class="error">
        <?= Validator::getValidationError("article_title"); ?>
      </p>
    </div>
    <div class="form-input">
      <label for="publishing_date">Publishing Date</label>
      <input type="date" name="publishing_date" id="publishing_date" placeholder="Publishing Date" <?php if (Validator::hasValidationError('publishing_date')): ?> style="border-color: red;" <?php endif; ?> value="<?= $_SESSION['old_data']['publishing_date'] ?? $data['publishing_date']; ?>">
      <p class="error">
        <?= Validator::getValidationError("publishing_date"); ?>
      </p>
    </div>
    <div class="form-input">
      <label for="content">Content</label>
      <textarea name="content" id="content" rows="10" <?php if (Validator::hasValidationError('content')): ?> style="border-color: red;" <?php endif; ?>><?= $_SESSION['old_data']['content'] ?? $data['content']; ?></textarea>
      <p class="error">
        <?= Validator::getValidationError("content"); ?>
      </p>
    </div>
    <button type="submit" name="update">Update</button>
  </form>
</main>

<?php include 'includes/foot.php' ?>