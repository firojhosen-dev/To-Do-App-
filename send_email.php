<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'firojactivenow@gmail.com';   // ✅ Your Gmail
        $mail->Password   = 'fjwixzcquccridvf';           // ✅ App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('firojactivenow@gmail.com', 'To-Do App Website'); // ✅ From your own email
        $mail->addAddress('firojactivenow@gmail.com', 'Firoj Hosen');    // ✅ Where you receive the message
        $mail->addReplyTo($email, $name); // ✅ So reply goes to visitor

        // Content
        $mail->isHTML(true);
        $mail->Subject = "To-Do App (Owner Firoj Hosen): $subject";
        $mail->Body    = "
            <h3>Assalamualaikum</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        echo "<script>alert('✅ Your message was sent successfully!'); window.location.href='contact.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('❌ Message not sent. Error: {$mail->ErrorInfo}');</script>";
    }
} else {
    echo "Invalid request.";
}
?>
