<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image; 


   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         try {
            $insert_user = $conn->prepare("INSERT INTO `users` (name, email, password, image) VALUES (?, ?, ?, ?)");
            $insert_user->execute([$name, $email, $cpass, $image]);
            if ($insert_user->rowCount() > 0) {
               $message[] = 'Registered successfully, login now please!';
            } else {
               $message[] = 'Registration failed. Please try again later.';}
            } catch (PDOException $e) {
               $message[] = 'Database Error: ' . $e->getMessage();
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
   <title>register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="form-container">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>register now</h3>
     

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
         <input type="text" name="name" maxlength="20" placeholder="enter your username" class="box" required >
      </div>
      <div class="input-container">
         <i class="fa fa-envelope"></i>
         <input type="email" name="email" maxlength="50" placeholder="enter your email" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div class="input-container">
         <i class="fa fa-key"></i>
         <input type="password" name="pass" maxlength="20" placeholder="enter your password" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div class="input-container">
         <i class="fa fa-key"></i>
         <input type="password" name="cpass" maxlength="20" placeholder="confirm your password" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
       <?php          
            if($fetch_profile['image'] == ''){
               echo '<img src="images/avatar.png" style="height: 100px; width:100px; border-radius: 50%; object-fit: cover; margin-bottom: 4px;">';
            }else{
               echo '<img src="uploaded_img/'.$fetch_profile['image'].'" style="height: 100px; width:100px; border-radius: 50%; object-fit: cover; margin-bottom: 4px;">';
            }
          ?>
      <div class="input-container">
         <input type="checkbox" id="terms">
         <label for="accept-terms">I agree to the <a class="terms" href="#0">Terms</a></label>
      </div>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>