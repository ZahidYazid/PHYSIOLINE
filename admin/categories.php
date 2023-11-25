<?php

include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_category'])){

   /*$category_name = $_POST['category_name'];*/
   $category_name = filter_var($_POST['category_name'], FILTER_SANITIZE_STRING);
   
   $category_image = $_FILES['category_image']['name'];
  /* $category_image = filter_var($category_image, FILTER_SANITIZE_STRING);*/
   $image_size_category = $_FILES['category_image']['size'];
   $image_tmp_name_category = $_FILES['category_image']['tmp_name'];
   $image_folder_category = 'uploaded_img/'.$category_image;

   $select_categories = $conn->prepare("SELECT * FROM `categories` WHERE category_name = ?");
   $select_categories->execute([$category_name]);

   if($select_categories->rowCount() > 0){
      $message[] = 'category name already exist!';
   }else{

      $insert_categories = $conn->prepare("INSERT INTO `categories`(category_name, category_image) VALUES(?, ?)");
      $insert_success = $insert_categories->execute([$category_name, $category_image]);

      if($insert_success){
         if($image_size_category > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_category, $image_folder_category);
            $message[] = 'new category added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_category_image = $conn->prepare("SELECT * FROM `categories` WHERE category_id = ?");
   $delete_category_image->execute([$delete_id]);
   $fetch_delete_image = $delete_category_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/'.$fetch_delete_image['category_image']);
  
   $delete_category = $conn->prepare("DELETE FROM `categories` WHERE category_id = ?");
   $delete_category->execute([$delete_id]);
   header('location:categories.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>categories</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="add-categories">

   <h1 class="heading">add category</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">

         <div class="inputBox">
            <span>category name (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter category name" name="category">
         </div>

         <div class="inputBox">
               <span>image category (required)</span>
               <input type="file" name="category_image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
         </div>

      </div>

      <input type="submit" value="add category" class="btn" name="add_category">
   </form>

</section>

<section class="show-categories">

   <h1 class="heading">categories added</h1>

   <div class="box-container">

   <?php
      $select_categories = $conn->prepare("SELECT * FROM `categories`");
      $select_categories->execute();
      if($select_categories->rowCount() > 0){
         while($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="uploaded_img/<?= $fetch_categories['category_image']; ?>" alt="">
      <div class="category"><?= $fetch_categories['category_name']; ?></div>
      
      <div class="flex-btn">
         <a href="update_categories.php?update=<?= $fetch_categories['category_id']; ?>" class="option-btn">update</a>
         <a href="categories.php?delete=<?= $fetch_categories['category_id']; ?>" class="delete-btn" onclick="return confirm('delete this category?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no categories added yet!</p>';
      }
   ?>
   
   </div>

</section>








<script src="js/admin_script.js"></script>
   
</body>
</html>