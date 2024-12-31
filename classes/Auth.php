<?php

class Auth
{
  public function __invoke()
  {
    if (
      (
        !isset($_SERVER['PHP_AUTH_USER']) ||
        !isset($_SERVER['PHP_AUTH_PW'])
      ) || (
        $_SERVER['PHP_AUTH_USER'] !== 'admin' ||
        $_SERVER['PHP_AUTH_PW'] !== 'password'
      )
    ) {
      header('WWW-Authenticate: Basic realm="Admin Realm"');
      header('HTTP/1.0 401 Unauthorized');
      die('Unauthorized');
    }
  }
}
