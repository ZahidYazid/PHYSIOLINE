<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>PHYSIOLINE</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body class="<?php echo isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled' ? 'dark-mode' : ''; ?>">

<?php include 'header.php'; ?>

<div class="home-grand">
   
   <section class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="image-sw">
               <img src="images/shockwave-therapy.png" alt="">
            </div>
            <div class="content-sw">
               <span>upto 30% off with free shopping</span>
               <h3>Shockwave therapy</h3>
               <a href="shop.php" class="btn">Order now</a>
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="image-sw">
               <img src="images/Electro.png" alt="">
            </div>
            <div class="content-sw">
               <span>upto 30% off with free shopping</span>
               <h3>Electrotherapy for massage</h3>
               <a href="shop.php" class="btn">Order now</a>
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="image-sw">
               <img src="images/3-4-plans-table.png" alt="">
            </div>
            <div class="content-sw">
               <span>upto 30% off with free shopping</span>
               <h3>New arrival of tables</h3>
               <a href="shop.php" class="btn">Order now</a>
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </section>

</div>

   <section class="category">
      <h1 class="heading">Products by category</h1>

      <?php
      // Fetch category names from the database
      $select_categories = $conn->prepare("SELECT * FROM `categories`");
      $select_categories->execute();
      ?>

      <div class="swiper category-slider">
         <div class="swiper-wrapper">
            <?php
            while ($fetch_category = $select_categories->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="swiper-slide slide">
               <a href="category.php?category=<?= $fetch_category['category_name']; ?>">
               <img src="images/<?= $fetch_category['category_image']; ?>" alt="">
               <h3><?= $fetch_category['category_name']; ?></h3>
               </a>
            </div>
               <?php } ?>
         </div>
         <div class="swiper-pagination"></div>
      </div>
   </section>


   <section class="home-products">
      <h1 class="heading">shop products</h1>

      <div class="swiper products-slider">

      <div class="swiper-wrapper">

      <?php
        $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
        $select_products->execute();
        if($select_products->rowCount() > 0){
        while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="swiper-slide slide">
         <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
         <button class="option-btn" type="submit" name="add_to_wishlist">add to wishlist</button>
         <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="option-btn">Product detail</a>
         <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
         <div class="name"><?= $fetch_product['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_product['price']; ?><span></span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
         </div>
         <input type="submit" value="add to cart" class="btn" name="add_to_cart">
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
      </div>

      <div class="swiper-pagination"></div>
   </div>

   </section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

<script>
   var swiper = new Swiper(".home-slider", {
      loop:true,
      grabCursor: true,
      spaceBetween:20,
      pagination: {
         el: ".swiper-pagination",
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

<script>
   var swiper = new Swiper(".category-slider", {
      loop:true,
      grabCursor: true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable:true,
      },
      breakpoints: {
         0: {
            slidesPerView: 2,
          },
         650: {
           slidesPerView: 3,
         },
         768: {
           slidesPerView: 4,
         },
         1024: {
           slidesPerView: 5,
         },
      },
   });
</script>

<script>
   var swiper = new Swiper(".products-slider", {
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