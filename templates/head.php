<?php

session_start();

require_once 'helpers/Request.php';
require_once 'helpers/Validator.php';
require_once 'helpers/Flasher.php';
require_once 'classes/Article.php';
require_once 'classes/Auth.php';

$article = new Article();
$auth = new Auth();

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