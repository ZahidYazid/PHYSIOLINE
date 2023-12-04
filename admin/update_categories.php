<?php

include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
}

if(isset($_POST['update'])){

   $category_id = $_POST['category_id'];
   $category_name = $_POST['category_name'];
   $category_name = filter_var($category_name, FILTER_SANITIZE_STRING);

   $update_categories = $conn->prepare("UPDATE `categories` SET category_name = ? WHERE category_id = ?");
   $update_categories->execute([$category_name, $category_id]);

   $message[] = 'category updated successfully!';



   $category_old_image = $_POST['category_old_image'];
   $category_image = $_FILES['category_image']['name'];
   $category_image = filter_var($category_image, FILTER_SANITIZE_STRING);
   $image_size_category = $_FILES['image_category']['size'];
   $image_tmp_name_category = $_FILES['image_category']['tmp_name'];
   $image_folder_category = 'uploaded_img/'.$category_image;

   if(!empty($category_image)){
      if($image_size_category > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_category = $conn->prepare("UPDATE `categories` SET category_image = ? WHERE category_id = ?");
         $update_image_category->execute([$category_image, $category_id]);
         move_uploaded_file($image_tmp_name_category, $image_folder_category);
         unlink('uploaded_img/'.$category_old_image);
         $message[] = 'image category updated successfully!';
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
   <title>update category</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="heading">update category</h1>

   <?php
      $update_id = $_GET['update'];
      $select_categories = $conn->prepare("SELECT * FROM `categories` WHERE category_id = ?");
      $select_categories->execute([$update_id]);
      if($select_categories->rowCount() > 0){
         while($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
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
      <input type="hidden" name="category_id" value="<?= $fetch_categories['category_id']; ?>">
      <input type="hidden" name="category_old_image_" value="<?= $fetch_categories['category_image']; ?>">


       <div class="image-container">
         <div class="main-image">
            <img src="uploaded_img/<?= $fetch_categories['category_image']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="uploaded_img/<?= $fetch_categories['category_image']; ?>" alt="">
         </div>
      </div>
      
      
      <span>update category name</span>
      <input type="text" name="category_name" required class="box" maxlength="100" placeholder="enter category name" value="<?= $fetch_categories['category_name']; ?>">
      <span>update category image</span>
      <input type="file" name="category_image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
     
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="categories.php" class="option-btn">go back</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">no category found!</p>';
      }
   ?>

</section>












<script src="js/admin_script.js"></script>
   
</body>
</html>