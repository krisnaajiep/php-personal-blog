<?php

include 'templates/head.php';

$url = explode('.', $_SERVER['PHP_SELF'])[0];
$href = ($url == '/admin') ? 'index.php' : 'admin.php';
$nav = $url == '/index' ? 'admin' : ($url == '/admin' ? 'logout' : '');

if ($url != '/index' && $url != '/article') $auth->login();

if ($url == '/article' || $url == '/edit') {
  if (is_null(Request::get('id'))) exit;
  $id = Request::get('id');
  $data = $article->read($id);
  $url .= "/$id";
}


?>

<header>
  <h3 class="url"><?= $url == '/index' ? '/home' : $url; ?></h3>
  <?php if ($url == '/index'): ?>
    <h3 class="nav"><a href="<?= $href; ?>"><?= $nav; ?></a></h3>
  <?php else: ?>
    <form class="logout" method="post">
      <button type="submit" name="logout" class="logout">
        <h3>logout</h3>
      </button>
    </form>
  <?php endif; ?>
</header>