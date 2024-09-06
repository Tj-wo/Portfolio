<?php
$recipient = 'jovanssemivule@gmail.com'; 

$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$message = htmlspecialchars(trim($_POST['message']));

if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo 'All fields are required.';
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo 'Invalid email address.';
    exit;
}

$subject = 'Contact Form Submission from ' . $name;
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$mailBody = "Name: $name\n";
$mailBody .= "Email: $email\n";
$mailBody .= "Message:\n$message\n";

if (mail($recipient, $subject, $mailBody, $headers)) {
    http_response_code(200);
    echo 'Message sent successfully!';
} else {
    http_response_code(500);
    echo 'Failed to send message.';
}
?>

