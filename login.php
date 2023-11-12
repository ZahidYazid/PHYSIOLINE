<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
      $message[] = 'login successful!';
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<!-- user login section starts -->

<section class="form-container">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>login now</h3>
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
         <input type="email" name="email" maxlength="50" placeholder="enter your email" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div class="input-container">
         <i class="fa fa-key"></i>
         <div class="password-container">
            <input id="eyeInput" type="password" name="pass" maxlength="20" placeholder="enter your password" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
            <span class="eye" onclick="eye()">
               <i id="hide" class="fa fa-eye"></i>
               <i id="expose" class="fa fa-eye-slash"></i>
            </span>
         </div>
      </div>

         <input type="submit" name="submit" value="login now" class="btn">
         <p class="form-bottom-message">Forgot your <a href="register.php">password?</a></p>
         <p>Don't have an account? <a href="register.php">register now</a></p>
   </form>

</section>

<script type="text/javascript">
   function eye() {
   // body...
   var a = document.getElementById("eyeInput");
   var b = document.getElementById("hide");
   var c = document.getElementById("expose");
   if(a.type === 'password') {
      a.type = "text";
      b.style.display = "block";
      c.style.display = "none";
   }else{
      a.type = "password";
      b.style.display = "none";
      c.style.display = "block";
   }
}
</script>











<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>