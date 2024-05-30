<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = htmlspecialchars($_POST['first_name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $massage_type = htmlspecialchars($_POST['massage_type']);
  $date = htmlspecialchars($_POST['date']);
  $time = htmlspecialchars($_POST['time']);

  $mail = new PHPMailer(true);

  try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true;
    $mail->Username = 'techviraj007@gmail.com'; // SMTP username
    $mail->Password = 'cizrfxpyrqrptmmk'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    // Recipients
    $mail->setFrom('tech007@gmail.com', 'LotusThaiSpa');
    $mail->addAddress('virajmahadik2016@gmail.com', ''); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body    = "<h3>You have a new customer requirement</h3>
                          <p><b>First Name:</b> $first_name</p>
                          <p><b>Email:</b> $email</p>
                          <p><b>Phone:</b> $phone</p>
                          <p><b>Massage Type:</b> $massage_type</p>
                          <p><b>Date:</b> $date</p>
                          <p><b>Time:</b> $time</p>";
    $mail->AltBody = "You have a new contact form submission\n
                          First Name: $first_name\n
                          Email: $email\n
                          Phone: $phone\n
                          Massage Type: $massage_type\n
                          Date: $date\n
                          Time: $time";

    $mail->send();
    $_SESSION['message'] = 'Message has been sent successfully!';
    echo '<script>
                alert("Message has been sent successfully!");
                window.location.href = "index.html";
              </script>';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
} else {
  echo 'Invalid request method';
}
