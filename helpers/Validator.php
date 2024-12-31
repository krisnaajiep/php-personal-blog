<?php

class Validator
{
  public static function setRules(array $data, array $rules): array|string|false
  {
    foreach ($rules as $field => $ruleset) {
      $value = $data[$field] ?? null;

      foreach ($ruleset as $rule) {
        if (!isset($_SESSION["validation_errors"][$field])) {
          $validated_value = self::validate($value, $rule, $field);
        }
      }

      $validated_data[$field] = $validated_value ?? null;
    }

    if (self::hasValidationErrors()) {
      $_SESSION['old_data'] = $data;
      header("Location: " . $_SERVER["HTTP_REFERER"]);
      exit;
    }

    if (is_array($validated_data[$field])) return $validated_data[$field];

    return $validated_data;
  }

  public static function validate($value, string $rule, string $field)
  {
    if ($rule === "required" && empty($value)) {
      self::setValidationError($field, $field . " field is required.");
    }

    if (!empty($value)) {
      if ($rule === "alpha" && !preg_match("/^[a-zA-Z\s\-]+$/", $value)) {
        self::setValidationError($field, $field . " input may only contain letters, spaces, and hyphens (-).");
      }

      if ($rule === "alpha_num") {
        if (!preg_match("/^[a-zA-Z0-9._-]+$/", $value)) {
          self::setValidationError($field, $field . " input may only contain letters, numbers, periods (.), underscores (_), and hyphens (-).");
        }
      }

      if ($rule === "alpha_num_space") {
        if (!preg_match("/^[a-zA-Z0-9. _-]+$/", $value)) {
          self::setValidationError($field, $field . " input may only contain letters, spaces, numbers, periods (.), underscores (_), and hyphens (-).");
        }
      }

      if ($rule === "num" && !is_numeric($value)) {
        self::setValidationError($field, $field . " input must be numeric");
      }

      if ($rule === "lowercase" && $value !== strtolower($value)) {
        self::setValidationError($field, $field . " input letters must be lowercase.");
      }

      if (strpos($rule, "min_length") !== false && strpos($rule, ":") !== false) {
        $rule = explode(":", $rule)[1];

        if (strlen($value) < (int)$rule) {
          self::setValidationError($field, $field . " input must be at least {$rule} characters long.");
        }
      }

      if (strpos($rule, "max_length") !== false && strpos($rule, ":") !== false) {
        $rule = explode(":", $rule)[1];

        if (strlen($value) > (int)$rule) {
          self::setValidationError($field, $field . " input must not exceed {$rule} characters.");
        }
      }

      if ($rule === "numeric" && !is_numeric($value)) {
        self::setValidationError($field, $field . " input must be numeric.");
      }

      if ($rule === "date") {
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $value)) {
          self::setValidationError($field, $field . " input format must be Y-m-d.");
          return;
        }

        $parts = explode("-", $value);
        if (!checkdate($parts[1], $parts[2], $parts[0])) {
          self::setValidationError($field, $field . " input must be a valid date.");
        }
      }
    }

    return $value;
  }

  public static function setValidationError($field, $message): void
  {
    $_SESSION["validation_errors"][$field] = $message;
  }

  public static function hasValidationErrors(): bool
  {
    return !empty($_SESSION["validation_errors"]);
  }

  public static function hasValidationError($field): bool
  {
    return isset($_SESSION["validation_errors"][$field]);
  }

  public static function getValidationError($field): string
  {
    return $_SESSION["validation_errors"][$field] ?? "";
  }
}
