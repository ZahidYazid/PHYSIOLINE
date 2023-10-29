

<header class="header">

   <section class="flex">

      <!-- <a href="index.php" class="logo">physioline<span>.</span></a> -->
      <a href="index.php" class="logo"><img src="images/Logo.png" alt=""></a>

      <nav class="navbar">
         <a href="index.php">home</a>
         <a href="about.php">about us</a>
         <a href="orders.php">orders</a>
         <a href="shop.php">shop</a>
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();

         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="theme-toggler" class="fas fa-moon"></div>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span><?= $total_wishlist_counts; ?></span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span><?= $total_cart_counts; ?></span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            if($fetch_profile['image'] == ''){
               echo '<img src="images/avatar.png" style= "display: flex; justify-content: center; align-items: center; height: 80px; width: 80px; border-radius: 50%; overflow: hidden; margin-bottom: 3px; margin-left:9.6rem">';
            }else{
               echo '<div class="image-container" style= "display: flex; justify-content: center; align-items: center; height: 80px; width: 80px; border-radius: 50%; overflow: hidden; margin-bottom: 3px; margin-left:9.6rem">';
               echo '<img src="uploaded_img/'.$fetch_profile['image'].'"alt="Profile Image" class="profile-image" style= "height: 100%; width: auto; object-fit: cover;">';
               echo '</div>';

            }
         ?>
         <nav type = "navbar" class="flex-btn">
            
            <p><?= $fetch_profile["name"]; ?></p>
            <a href="update_account.php" class="update-btn">update profile</a>
            <a href="logout.php" class="logout-btn" onclick="return confirm('logout from the website?');">logout</a>
         </nav>
          
         <?php
            }else{
         ?>
         <nav type = "navbar" class="flex-btn">
            <a href="login.php" class="login-btn">login</a>
            <a href="register.php" class="register-btn">register</a>
         </nav>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>