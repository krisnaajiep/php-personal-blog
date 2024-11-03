<?php

require_once 'templates/head.php';

if (!is_null(Request::get('id'))) {
  $article->delete(intval(Request::get('id')));
}
