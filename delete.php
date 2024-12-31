<?php

require_once 'includes/head.php';

if (isset($_GET['id'])) {
  $article->delete(intval($_GET['id']));
}
