<?php

include 'connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve entered email from the form
    $email = $_POST['email'];

    // Validate email (you can add more validation checks)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email format
        $message[] = 'Invalid email format!';
    } else {
        // Logic to send a password reset link to the provided email
        // Implement your reset password logic here

        // Example placeholder functions
        $resetToken = generateResetToken();
        storeTokenInDatabase($email, $resetToken);
        sendResetLinkToEmail($email, $resetToken);

        // Redirect to a confirmation page or display a success message
        $message[] = 'Password reset link sent to your email!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot password</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>


<?php include 'header.php'; ?>

<section class="form-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>forgot password</h3>
        <?php
         if(isset($message)){
           foreach($message as $message){
            echo '
            <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
           }
         }

        ?>
        <div class="input-container">
            <i class="fa fa-envelope"></i>
            <input type="email" id="email" name="email" maxlength="50" placeholder="enter your email" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
        </div>
        <input type="submit" name="submit" value="Reset Password" class="btn">
    </form>
</section>

<?php
// Functions placeholders (to be implemented)
function generateResetToken() {
    // Generate a unique token (you can use random_bytes() or other methods)
    return bin2hex(random_bytes(16)); // Example: Generate a 16-byte token in hexadecimal format
}

function storeTokenInDatabase($email, $token) {
    // Store the token in the database for the corresponding user/email
    // You'll need a users table or similar to store emails and reset tokens
    // Example: Update a users table to store the token for the given email
}

function sendResetLinkToEmail($email, $token) {
    // Use PHP's mail() function or an email service/library to send a reset link
    // Example: Send an email to the provided email address with a link to reset_password_page.php?token=your_token
}
?>



<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
