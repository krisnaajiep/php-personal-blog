<?php

/**
 * Class Auth
 * 
 * This class handles basic HTTP authentication for restricted access.
 * It ensures that only users with the correct credentials can proceed.
 */
class Auth
{
  /**
   * Invoke the authentication process.
   *
   * - Checks for the presence of `PHP_AUTH_USER` and `PHP_AUTH_PW`.
   * - Verifies the credentials against hardcoded values ('admin' and 'password').
   * - If authentication fails, sends HTTP headers to request credentials and terminates the script.
   * - If authentication succeeds, the user can proceed to access the resource.
   * @return void
   */
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
      // Sends HTTP headers to prompt for credentials.
      header('WWW-Authenticate: Basic realm="Admin Realm"');
      header('HTTP/1.0 401 Unauthorized');

      // Terminates the script with an unauthorized message.
      die('Unauthorized');
    }
  }
}
