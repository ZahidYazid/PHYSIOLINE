<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $cpass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         $message[] = 'password updated successfully!';
      }else{
         $message[] = 'please enter a new password!';
      }
   }

   // Define the upload directory
   $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/PHYSIOLINE/uploaded_img/';

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];

   if(!empty($update_image)) {
      if($update_image_size > 2000000){
         $message[] = 'image is too large.';
      }else{
         // Check if the upload directory exists, and create it if not
         if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
         }

         $image_update_query = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
         $image_update_query->execute([$update_image, $user_id]);

         $update_image_folder = $uploadDirectory . $update_image;

          if (move_uploaded_file($update_image_tmp_name, $update_image_folder)) {
            $message[] = 'image updated successfully!';
         } else {
            $message[] = 'Failed to upload the image. Please check the directory permissions.';
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
   <title>update account</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>update now</h3>

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

      <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
      <div class="input-container">
         <i class="fa fa-user"></i>
         <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" value="<?= $fetch_profile["name"]; ?>">
      </div>
      <div class="input-container">
         <i class="fa fa-envelope"></i>
         <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>">
      </div>
      <div class="input-container">
         <i class="fa fa-key"></i>
         <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div class="input-container">
         <i class="fa fa-key"></i>
         <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div class="input-container">
         <i class="fa fa-key"></i>
         <input type="password" name="cpass" placeholder="confirm your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div>
         <label class="label">profile picture</label>
         <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
          <?php          
            if($fetch_profile['image'] == ''){
               echo '<img src="images/avatar.png" style="height: 100px; width:100px; border-radius: 50%; object-fit: cover; margin-bottom: 4px;">';
            }else{
               echo '<img src="uploaded_img/'.$fetch_profile['image'].'" style="height: 100px; width:100px; border-radius: 50%; object-fit: cover; margin-bottom: 4px;">';
            }
          ?>
      </div>
      <input type="submit" value="update now" class="btn" name="submit">
      <a href="index.php" class="option-btn">go back home page</a>
   </form>

</section>













<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>