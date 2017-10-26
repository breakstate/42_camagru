<?php

/*
** params: $required_fields | array containing list of required fields
** return: $form_errors | array containing the errors reported by this function
*/
function check_empty_fields($required_fields)
{
  // initialize array to store error messages
  $form_errors = array();

  // check if the required fields are filled
  foreach($required_fields as $name_of_field)
  {
    if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL)
    {
      // if not filled add message to $form_errors array
      $form_errors[] = $name_of_field . " is a required field.";
    }
  }
  return ($form_errors);
}

/*
** params: $field_lengths | array containing minimum length of fields
** return: $form_errors | array containing the errors reported by this function
*/
function check_min_length($field_lengths)
{
  $form_errors = array();

  foreach ($field_lengths as $field => $length)
  {
    if (strlen(trim($_POST[$field])) < $length && strlen(trim($_POST[$field])) > 0)
    {
      $form_errors[] = $field . " min length is " . $length . ".";
    }
  }
  return ($form_errors);
}

function check_email($data)
{
  $form_errors = array();
  $key = 'email';
  if (array_key_exists($key, $data))
  {
    if ($data[$key] != NULL)
    {
      if (filter_var($data[$key], FILTER_VALIDATE_EMAIL) === FALSE)
      {
        $form_errors[] = $data[$key] . " is not a valid email address.";
      }
    }
  }
  return ($form_errors);
}

function show_form_errors($form_errors)
{
  $result = "<p>Errors: " . count($form_errors) . "<br>";
  $result .= "<ul>";
  foreach($form_errors as $error)
  {
    $result .= "<li>{$error}</li>";
  }
  $result .= "</ul></p>";
  return ($result);
}
?>
