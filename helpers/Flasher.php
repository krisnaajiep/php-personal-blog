<?php

/**
 * Class Flasher
 *
 * This class provides functionality to set and display flash messages.
 * Flash messages are temporary notifications that persist only for the duration of a single session.
 */
class Flasher
{
  /**
   * Set a flash message to the session.
   *
   * @param string $message The main message content.
   * @param string $action Additional context or action description.
   * @param string $type The type of message (e.g., 'success', 'error', 'info', etc.).
   *
   * Stores the flash message details in the `$_SESSION` array, including its type and content.
   */
  public static function setFlash(string $message, string $action, string $type)
  {
    $_SESSION['flash'] = [
      'message' => $message,
      'action' => $action,
      'type' => $type
    ];
  }

  /**
   * Display and clear the flash message from the session.
   *
   * If a flash message exists in the `$_SESSION`, it will:
   * - Echo the message in an HTML paragraph tag with a class based on its type.
   * - Remove the flash message from the session to ensure it only displays once.
   */
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
