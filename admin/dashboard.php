<?php

include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="dashboard">

   <h1 class="admin-heading">Admin Panel</h1>

   <h1 class="heading">Admins & users dashboard</h1>

   <div class="swiper dashboard-slider">
      <div class="swiper-wrapper">

         <div class="swiper-slide slide">

            <div class="box">
               <p><?= $fetch_profile['name']; ?></p>
               <h3>Welcome!</h3>
               <a href="update_profile.php" class="btn">update profile</a>
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="box">
            <?php
               $select_admins = $conn->prepare("SELECT * FROM `admins`");
               $select_admins->execute();
               $number_of_admins = $select_admins->rowCount()
            ?>
            <p>Admin users</p>
            <h3><?= $number_of_admins; ?></h3>
            
            <a href="admin_accounts.php" class="btn">see admins</a>
            </div>
         </div>

      <div class="swiper-slide slide">
         <div class="box">
            <?php
               $select_users = $conn->prepare("SELECT * FROM `users`");
               $select_users->execute();
               $number_of_users = $select_users->rowCount()
            ?>
            <p>Users</p>
            <h3><?= $number_of_users; ?></h3>
            
            <a href="users_accounts.php" class="btn">see users</a>
         </div>
      </div>
   </div>
      <div class="swiper-pagination"></div>

   </div>

</section>


<section class="dashboard">

   <h1 class="heading">Products & messages dashboard</h1>

   <div class="swiper dashboard-slider">
      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="box">
               <?php
                  $select_products = $conn->prepare("SELECT * FROM `products`");
                  $select_products->execute();
                  $number_of_products = $select_products->rowCount()
               ?>
               <p>Products added</p>
               <h3><?= $number_of_products; ?></h3>
               
               <a href="products.php" class="btn">see products</a>
            </div>
         </div>


      <div class="swiper-slide slide">
         <div class="box">
            <?php
               $select_categories = $conn->prepare("SELECT * FROM `categories`");
               $select_categories->execute();
               $number_of_categories = $select_categories->rowCount()
            ?>
            <p>Categories</p>
            <h3><?= $number_of_categories; ?></h3>
            
            <a href="categories.php" class="btn">see categories</a>
         </div>
      </div>


      <div class="swiper-slide slide">
         <div class="box">
            <?php
               $select_messages = $conn->prepare("SELECT * FROM `messages`");
               $select_messages->execute();
               $number_of_messages = $select_messages->rowCount()
            ?>
            <p>Messages</p>
            <h3><?= $number_of_messages; ?></h3>
            
            <a href="messages.php" class="btn">see messages</a>
         </div>
      </div>
   </div>
   <div class="swiper-pagination"></div>

   </div>

</section>



<section class="dashboard">

   <h1 class="heading">Orders dashboard</h1>

   <div class="swiper dashboard-slider">
      <div class="swiper-wrapper">

         <div class="swiper-slide slide">

            <div class="box">
               <?php
                  $total_pendings = 0;
                  $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                  $select_pendings->execute(['pending']);
                  if($select_pendings->rowCount() > 0){
                     while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                        $total_pendings += $fetch_pendings['total_price'];
                     }
                  }
               ?>
               <p>Total pendings</p>
               <h3><span>$</span><?= $total_pendings; ?><span></span></h3>
               <a href="placed_orders.php" class="btn">see orders</a>
            </div>
         </div>

         <div class="swiper-slide slide">
             <div class="box">
               <?php
                  $total_completes = 0;
                  $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                  $select_completes->execute(['completed']);
                  if($select_completes->rowCount() > 0){
                     while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                        $total_completes += $fetch_completes['total_price'];
                     }
                  }
               ?>
               <p>Completed orders</p>
               <h3><span>$</span><?= $total_completes; ?><span></span></h3>
               
               <a href="placed_orders.php" class="btn">see orders</a>
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="box">
               <?php
                  $select_orders = $conn->prepare("SELECT * FROM `orders`");
                  $select_orders->execute();
                  $number_of_orders = $select_orders->rowCount()
               ?>
               <p>Orders placed</p>
               <h3><?= $number_of_orders; ?></h3>
               
               <a href="placed_orders.php" class="btn">see orders</a>
            </div>
         </div>
      </div>

         <div class="swiper-pagination"></div>

   </div>

</section>





<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script src="js/admin_script.js"></script>


<script>
   var swiper = new Swiper(".dashboard-slider", {
      loop:true,
      grabCursor: true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable:true,
      },
      breakpoints: {
         550: {
           slidesPerView: 2,
         },
         768: {
           slidesPerView: 2,
         },
         1024: {
           slidesPerView: 3,
         },
      },
   });
</script>


   
</body>
</html>