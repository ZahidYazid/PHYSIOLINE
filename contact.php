<?php

include 'connect.php';

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
   $isSubscribed = true;
   // Fetch user profile when logged in
   $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
   $select_profile->execute([$user_id]);
   $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
}else{
   $user_id = '';
   $isSubscribed = false;
   $fetch_profile = ['name' => '', 'image' => '', 'email' => '']; // Provide default values
}

if(isset($_POST['send'])){
   // Filter input data to remove potential security issues

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_DEFAULT);
   
    // Provide a default value for 'name' if it's empty

   if (empty($name)) {
       $name = 'Unknown';
   }

   $image = $_POST['image'];
   $image = filter_var($image, FILTER_DEFAULT);

   if (empty($image)) {
      $image = null;
   } 


   $email = $_POST['email'];
   $email = filter_var($email, FILTER_DEFAULT);
 
   if (empty($email)) {
      $email = '';
   } 

   $number = $_POST['number'];
   $number = filter_var($number, FILTER_DEFAULT);
  
    if (empty($number)) {
      $number = 0;
   } 

   $subject = $_POST['subject'];

   $msg = $_POST['msg'];

   $subject = filter_var($subject, FILTER_DEFAULT);
   $msg = filter_var($msg, FILTER_DEFAULT);
  

   if ($isSubscribed) {
       // The user is subscribed, only rating, subject, and message are required.
       if (empty($number) || empty($subject) || empty($msg)) {
           $message[] = 'Rating, subject, and message are required fields.';
       } else {
           // Process the form for subscribed users
           $select_message = $conn->prepare("SELECT * FROM `messages` WHERE user_id = ? AND subject = ? AND message = ?");
           $select_message->execute([$user_id, $subject, $msg]);

           if ($select_message->rowCount() > 0) {
               $message[] = 'You have already sent this message!';
           } else {
               $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, image, email, number, subject, message) VALUES (?, ?, ?, ?, ?, ?, ?)");

               $result = $insert_message->execute([$user_id, $name, $image, $email, $number, $subject, $msg]);

               if (!$result) {
                  print_r($insert_message->errorInfo());
               } else {
                  $message[] = 'Message sent successfully!';

               }
           }
       }
   } else {
       // The user is not subscribed, all fields are required.
       if (empty($email) || empty($number) || empty($subject) || empty($msg)) {
           $message[] = 'All fields are required for non-subscribed users.';
       } else {
           // Process the form for non-subscribed users
           $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND image = ? AND email = ? AND number = ? AND subject = ? AND message = ?");
           $select_message->execute([$name, $image, $email, $number, $subject, $msg]);

           if ($select_message->rowCount() > 0) {
               $message[] = 'You have already sent this message!';
           } else {
               $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, image, email, number, subject, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
               // Replace empty 'name' with a default value if needed
               $name = !empty($name) ? $name : 'Unknown';
               $user_id = !empty($user_id) ? $user_id : 0;
               $result = $insert_message->execute([$user_id, $name, $image, $email, $number, $subject, $msg]);
               if (!$result) {
                  print_r($insert_message->errorInfo());
               } else {
                  $message[] = 'Message sent successfully!';
               }
           }
       }
   }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Contact Form</h3>

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
         <i class="fa fa-user"></i>
         <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box" value="<?= $fetch_profile["name"]; ?>">
      </div>
         <input type="hidden" name="image" placeholder="enter your image" required maxlength="20" class="box" value="<?= $fetch_profile["image"];?>">
      <div class="input-container">
         <i class="fa fa-envelope"></i>
         <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box" value="<?= $fetch_profile["email"]; ?>">
      </div>
      <div class="input-container">
         <i class="fa fa-star"></i>
         <input type="number" name="number" min="0" max="5" placeholder="rate your experence here from 1 to 5" required onkeypress="if(this.value.length == 5) return false;" class="box">
      </div>
      <div class="input-container">
         <i class="fa fa-book"></i>
         <input type="text" name="subject" placeholder="enter your subject" required maxlength="100" class="box">
      </div>
         <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="Submit" name="send" class="btn">
   </form>
</section>

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/Brooklyn-map.jpeg" alt="Physio" style="width:100%; height: 100%;">
      </div>

      <div class="text">
      
         <h1> Nous contacter </h1>
      
         <p>Our teams and our partners operate throughout the United States and around the world to provide you with quality service without borders.</p>

         <p>A team at the head office is at your disposal for any information, by email or telephone.</p>

         <p>PHYSIOLINE – PL Brooklyn NY, US 11209</p>

         <p href="tel:1234567890"><i class="fas fa-phone"></i> +1 (123) 456 7890 </p>
         <p href="tel:3216540987"><i class="fas fa-fax"></i> +1 (321) 654 0987</p>

      </div>

      

   </div>

</section>










<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>