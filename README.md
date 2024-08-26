Contact Form with Email Functionality:

This project is a basic contact form built with HTML, PHP, and PHPMailer. 
It allows users to submit their name, email, and message through a form. 
The form data is validated, sanitized, and then sent via email using PHPMailer.

How it works:
User Submits the Form: The contact form is a simple HTML page with fields for the user's name, email, and message. 
When the user fills out the form and clicks "Send Message," the data is sent to a PHP script (send_message.php) via the POST method.
The PHP script first checks if the form data was submitted correctly using $_SERVER["REQUEST_METHOD"] === "POST". 
It then validates that all fields are filled out and that the email is in a valid format. The data is sanitized using htmlspecialchars() to prevent XSS attacks.
