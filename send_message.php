<?php
//Imports the main PHPMailer class
use PHPMailer\PHPMailer\PHPMailer;
// Imports the Exception class for handling PHPMailer-specific errors
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if a form was submitted using the HTTP POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input to prevent XSS attacks for variables form the form contact.html
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Input validation. If one of the field will not be filled you will get error "All field are required"
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit; // Stop script, if the field wasn`t filled.
    }

    //checks if the email is not valid. If the email is invalid, the expression will evaluate to true, 
    //which allows you to handle the error (for example, by displaying an error message)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit; // Stop script.
    }

    // Prepare email content
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        //Choosing an host adress
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        // Input your e-mail adress
        $mail->Username = 'andrewpdk4444@gmail.com';
        // "Google App" security key
        $mail->Password = 'dhfhzyqfyyavhxnl';
        //This property defines the encryption protocol that PHPMailer should use when connecting to the SMTP server.
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        // Chosed port
        $mail->Port = 465;

        // Sender and recipient
        $mail->setFrom('andrewpdk4444@gmail.com');
        $mail->addAddress('andrewpdk4444@gmail.com'); // type here ' ' your e-mail adress

        // is used to indicate that the email content is in HTML format rather than plain text.
        $mail->isHTML(true);
        // Body is used to set the content of the email in HTML format.
        $mail->Body = "<h3>Name: $name</h3>
                       <h3>Email: $email</h3>
                       <p>Message:<br>$message</p>";

        // Check if the mail was sent. If not - give message with explanation tex.
        if ($mail->send()) {
            echo "<script>
                    alert('Message sent successfully!');
                    window.location.href = 'contact.html';
                  </script>";
        } else {
            echo "Message could not be sent. Error: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
