
<?php

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get form data
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
  $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

  // Validate form data
  $errors = [];
  if (empty($name)) {
    $errors['name'] = 'Please enter your name.';
  }
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
  }
  if (empty($subject)) {
    $errors['subject'] = 'Please enter a subject.';
  }
  if (empty($message)) {
    $errors['message'] = 'Please enter your message.';
  }

  // Send email if no errors
  if (empty($errors)) {
    $to = 'nandumanojpk@gmail.com'; // Replace with your email address
    $from = "$name <$email>";
    $subject = "Contact Form Submission: $subject";
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $from\nReply-To: $email";

    if (mail($to, $subject, $body, $headers)) {
      $success = 'Your message has been sent successfully.';
    } else {
      $errors['send'] = 'There was an error sending your message. Please try again later.';
    }
  }

}

// Display form or success message
if (!empty($errors)) {
  echo 'Please correct the following errors:';
  foreach ($errors as $error) {
    echo '<p>' . $error . '</p>';
  }
} else if (!empty($success)) {
  echo $success;
} else {
  // Include your HTML contact form here
  // ...
}

?>
