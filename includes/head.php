<?php

session_start();

require_once 'classes/Article.php';
require_once 'classes/Auth.php';
require_once 'helpers/Validator.php';
require_once 'helpers/Flasher.php';

$url = explode('.', $_SERVER['PHP_SELF'])[0];
if ($url != '/index' && $url != '/article') (new Auth())();

$article = new Article();

$articles = $article->list();

if (isset($_GET['id'])) {
  $data = $article->show($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Blog</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>