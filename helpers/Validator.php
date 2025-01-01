<?php

/**
 * Class Validator
 *
 * A utility class for handling input validation.
 * It supports multiple validation rules, error handling, and data sanitation.
 */
class Validator
{
  /**
   * Validate the given data against specified rules.
   *
   * @param array $data The input data to validate.
   * @param array $rules The validation rules to apply, structured as field => ruleset.
   * @return array|string|false Validated data if successful, or redirects back with validation errors.
   *
   * This method validates each field in the input data based on the given rules. 
   * If validation fails, it stores errors in the session and redirects back to the previous page.
   */
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

  /**
   * Perform a single validation check.
   *
   * @param mixed $value The value to validate.
   * @param string $rule The rule to apply.
   * @param string $field The name of the field being validated.
   * @return mixed The original value if validation passes.
   *
   * This method applies a single validation rule to a given value and sets an error message if it fails.
   */
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

  /**
   * Set a validation error message for a specific field.
   *
   * @param string $field The field that failed validation.
   * @param string $message The error message.
   */
  public static function setValidationError($field, $message): void
  {
    $_SESSION["validation_errors"][$field] = $message;
  }

  /**
   * Check if there are any validation errors.
   *
   * @return bool True if there are errors, false otherwise.
   */
  public static function hasValidationErrors(): bool
  {
    return !empty($_SESSION["validation_errors"]);
  }

  /**
   * Check if a specific field has a validation error.
   *
   * @param string $field The field to check.
   * @return bool True if the field has an error, false otherwise.
   */
  public static function hasValidationError($field): bool
  {
    return isset($_SESSION["validation_errors"][$field]);
  }

  /**
   * Retrieve the validation error message for a specific field.
   *
   * @param string $field The field whose error message is to be retrieved.
   * @return string The error message, or an empty string if no error exists.
   */
  public static function getValidationError($field): string
  {
    return $_SESSION["validation_errors"][$field] ?? "";
  }
}
