<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $subject = $_POST['subject'];
   $subject = filter_var($subject, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND subject = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $subject, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, subject, message) VALUES(?,?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $subject, $msg]);

      $message[] = 'sent message successfully!';

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

<section class="contact">

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

      <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box" value="<?= $fetch_profile["name"]; ?>">
      <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box" value="<?= $fetch_profile["email"]; ?>">
      <input type="number" name="number" min="0" max="10" placeholder="enter your rating number" required onkeypress="if(this.value.length == 10) return false;" class="box">
      <input type="text" name="subject" placeholder="enter your subject" required maxlength="100" class="box">
      <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
      
      <input type="submit" value="Submit" name="send" class="btn">
   </form>

   <div>
      <div class="text">
      
         <h1> Nous contacter </h1>
      
         <h2>Our teams and our partners operate throughout the United States and around the world to provide you with quality service without borders.</h2>

         <h2>A team at the head office is at your disposal for any information, by email or telephone.</h2>

         <h2>PHYSIOLINE – PL Brooklyn NY, US 11209</h2>

         <h2 href="tel:1234567890"><i class="fas fa-phone"></i> +1 (123) 456 7890 </h2>
         <h2 href="tel:3216540987"><i class="fas fa-fax"></i> +1 (321) 654 0987</h2>
      </div>
      <div class="image">
         <img src="images/Brooklyn-map.jpeg" alt="Physio" style="width:100%; height: 100%;">
      </div>
   </div>

</section>













<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>