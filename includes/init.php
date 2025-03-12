<?php

session_start();

// initialize csrf token
if (!isset($_SESSION['csrf_token']))
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// require classes and helpers
require_once 'classes/Article.php';
require_once 'classes/Auth.php';
require_once 'helpers/Validator.php';
require_once 'helpers/Flasher.php';
require_once 'helpers/Request.php';

// check if user is logged in
$url = explode('.', $_SERVER['PHP_SELF'])[0];
if ($url != '/index' && $url != '/article') (new Auth())();

// initialize Article class
$article = new Article();

// get all articles
$articles = $article->list();

// get article by id
$data = [];
if (isset($_GET['id'])) {
    $data = $article->show($_GET['id']);
}
