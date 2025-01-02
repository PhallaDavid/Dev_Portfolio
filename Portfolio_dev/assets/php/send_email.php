<?php
// Include PHPMailer files (change the paths if needed)
require 'PHPMailer/PHPMailerAutoload.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create an instance of PHPMailer
    $mail = new PHPMailer;

    try {
        // SMTP configuration
        $mail->isSMTP();  // Use SMTP
        $mail->Host = 'smtp.gmail.com';  // Gmail SMTP server
        $mail->SMTPAuth = true;  // Enable SMTP authentication
        $mail->Username = 'your-email@gmail.com';  // Gmail address
        $mail->Password = 'your-app-password';  // Gmail App Password (if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
        $mail->Port = 587;  // TCP port to connect to

        // Set email addresses
        $mail->setFrom($email, $name);  // Sender's email and name
        $mail->addAddress('recipient-email@example.com');  // Recipient's email address

        // Set email content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'New message from ' . $name;
        $mail->Body    = "<strong>Name:</strong> $name <br><strong>Email:</strong> $email <br><strong>Message:</strong> $message";

        // Send the email
        if ($mail->send()) {
            echo 'Message has been sent successfully!';
        } else {
            echo 'Message could not be sent. Please try again.';
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
