<?php

class Auth
{
  private $username = 'admin', $password = 'password';

  private function authenticate()
  {
    header('WWW-Authenticate: Basic realm="Admin Realm"');
    header('HTTP/1.0 401 Unauthorized');
  }

  public function login()
  {
    if (
      !isset($_SERVER['PHP_AUTH_USER']) ||
      !isset($_SERVER['PHP_AUTH_PW'])
    ) {
      $this->authenticate();
      echo '<a href="index.php">Back to home</a>';
      exit;
    }

    if (
      $_SERVER['PHP_AUTH_USER'] !== $this->username ||
      $_SERVER['PHP_AUTH_PW'] !== $this->password
    ) {
      $this->authenticate();
      exit;
    }
  }

  public function logout()
  {
    $this->authenticate();
  }
}
