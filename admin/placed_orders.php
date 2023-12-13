<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
}


// Initialize an empty array for messages
$message = [];

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];

   if (isset($_POST['payment_status'])) {
      $payment_status = filter_var($_POST['payment_status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      // Rest of your logic
   }


   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   //$message[] = 'payment status updated!';

    // Push a message to the array based on the payment status update result
    if ($update_payment) {
        $message[] = 'Payment status updated successfully!';
    } else {
        $message[] = 'Payment status update failed!';
    }



   // Inventory update logic starts here
   $order_id = $_POST['order_id'];
   $select_order_details = $conn->prepare("SELECT * FROM `order_details` WHERE order_id = ?");
   $select_order_details->execute([$order_id]);
   $orderedProducts = $select_order_details->fetchAll(PDO::FETCH_ASSOC);

   foreach ($orderedProducts as $product) {

    $cart_id = $product['product_id']; // Assuming 'product_id' is the correct column name in the order_details table
    $quantity_ordered = $product['quantity'];

    $product_id = null; // Initialize $product_id here to avoid undefined variable warnings


    // Retrieve product information from the cart table
    $select_product = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
    $select_product->execute([$cart_id]);
    $cartInfo = $select_product->fetch(PDO::FETCH_ASSOC);


    if ($cartInfo && is_array($cartInfo)) {
        $product_id = $cartInfo['pid']; // Assuming 'pid' is the correct column name in the cart table for product_id

        // Retrieve product information from the products table
        $select_product_info = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_product_info->execute([$product_id]);
        $productInfo = $select_product_info->fetch(PDO::FETCH_ASSOC);

        // Update the stock quantity in the cart table
        if ($productInfo && is_array($productInfo)) {
           // Perform the stock quantity update based on cart table's information
           $current_quantity = $productInfo['stock_quantity']; // Assuming 'stock_quantity' is the correct column name in the cart table

           $new_quantity = $current_quantity - $quantity_ordered;

           $update_product = $conn->prepare("UPDATE `products` SET stock_quantity = ? WHERE id = ?");
           $update_product->execute([$new_quantity, $product_id]);
         } else {
             echo "No product found for ID: $product_id";
         }
    } else {
         echo "No product found for ID: $cart_id";
         }

    // Inventory update for 'pid' in cart table
    $select_inventory = $conn->prepare("SELECT * FROM `inventory` WHERE product_id = ?");
    $select_inventory->execute([$product_id]);
    $inventory = $select_inventory->fetch(PDO::FETCH_ASSOC);

    if ($inventory !== false) {
        $new_quantity = $inventory['stock_quantity'] + $quantity_ordered;

        $update_inventory = $conn->prepare("UPDATE `inventory` SET stock_quantity = ? WHERE product_id = ?");
        $update_inventory->execute([$new_quantity, $product_id]);
    } else {
        echo "No inventory found for product ID: $product_id";
    }
}
    // Inventory update logic ends here


}


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="orders">

<h1 class="heading">placed orders</h1>

   <div class="box-container">


         <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
         ?>
               <div class="box">
             
                  <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
                  <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
                  <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
                  <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
                  <p> total products : <span><?= $fetch_orders['total_products']; ?></span> </p>
                  <p> total price : <span>$<?= $fetch_orders['total_price']; ?></span> </p>
                  <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
                  <form action="" method="post">
                     <?php

                        if (is_array($message) && !empty($message)) {
                           foreach ($message as $msg) {
                              echo '
                              <div class="message">
                                 <span>' . $msg . '</span>
                                 <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                              </div>
                                ';
                            }
                        }

                     ?>
                     <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">

                     <!-- Inside the form tag -->
                     <input type="hidden" name="payment_status" value="<?= $fetch_orders['payment_status']; ?>">

                     <select name="payment_status" class="select">
                        <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
                       <!-- <option value="pending">pending</option> -->
                        <option value="completed">completed</option>
                     </select>
                    <div class="flex-btn">
                     <input type="submit" value="update" class="option-btn" name="update_payment">
                     <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
                    </div>
                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>

   </div>

</section>












<script src="js/admin_script.js"></script>
   
</body>
</html>