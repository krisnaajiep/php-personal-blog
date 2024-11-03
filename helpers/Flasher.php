<?php

class Flasher
{
  public static function setFlash(string $message, string $action, string $type)
  {
    $_SESSION['flash'] = [
      'message' => $message,
      'action' => $action,
      'type' => $type
    ];
  }

  public static function getFlash()
  {
    if (isset($_SESSION['flash'])) {
      echo '<p class="' . $_SESSION['flash']['type'] . '">'
        . $_SESSION['flash']['message'] . ' <b>' . $_SESSION['flash']['action'] . '</b>
        </p>';

      unset($_SESSION['flash']);
    }
  }
}
