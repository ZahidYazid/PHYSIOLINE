<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/physiotherapy-equipment.png" alt="">
      </div>

      <div class="content">
         <h3>Our mission.</h3>
         <p>Ensuring quality care with our supplies.</p>
         <h3>Our vision.</h3>
         <p>We seek leadership in selling our products by providing medical products that improve people's quality of life.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">client's reviews</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <?php
            // Modify your SQL query to retrieve data from both tables using a JOIN operation
            $select_message = $conn->prepare("SELECT m.*, u.image AS user_image FROM `messages` AS m 
                                              JOIN `users` AS u ON m.user_id = u.id 
                                              LIMIT 6");
            $select_message->execute();

            if ($select_message->rowCount() > 0) {
               while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {
      ?>

   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_message['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_message['name']; ?>">
      <input type="hidden" name="subject" value="<?= $fetch_message['subject']; ?>">
      <input type="hidden" name="message" value="<?= $fetch_message['message']; ?>">

      <div>
          <?php          
            if($fetch_message['image'] == ''){
               echo '<img src="images/avatar.png" style="height: 100px; width:100px; border-radius: 50%; object-fit: cover; margin-bottom: 4px;">';
            }else{
               echo '<img src="uploaded_img/'.$fetch_message['image'].'" style="height: 100px; width:100px; border-radius: 50%; object-fit: cover; margin-bottom: 4px;">';
            }
          ?>
      </div>
      <div class="client-name"><?= $fetch_message['name']; ?></div>
      <div class="client-rate"><?php $number = $fetch_message['number']; // Replace with your desired number
      // Ensure the rating is limited to a maximum of 5
      $number = min(max($number, 0), 5);
      for ($i = 0; $i < $number; $i++) {
        echo '<img src="images/starfill.jpg" style="height:10px; width:10px;">'; // You can use any character or icon you like here
      }
      // Output white stars for the remaining spaces
      for ($i = $number; $i < 5; $i++) {
        echo '<img src="images/starempty.png" style="height:10px; width:10px;">'; // White star symbol
      }
        echo "</p>";?></div>
      
      <div class="client-subject"><?= $fetch_message['subject']; ?></div>
      <div class="client-mess"><?= $fetch_message['message']; ?></div>

   </form>

   <?php
      }
   }else{
      echo '<p class="empty">no reviews added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>