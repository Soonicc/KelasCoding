<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_contact = $conn->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_contact->execute([$name, $email, $number, $msg]);

   if ($select_contact->rowCount() > 0) {
      $message[] = 'message sent already!';
   } else {
      $insert_message = $conn->prepare("INSERT INTO `contact`(name, email, number, message) VALUES(?,?,?,?)");
      $insert_message->execute([$name, $email, $number, $msg]);
      $message[] = 'message sent successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   <link rel="shortcut icon" href="kc.png" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<body>

   <?php include 'components/user_header.php'; ?>

   <!-- contact section starts  -->

   <section class="contact">

      <div class="row">

         <div class="image">
            <img src="images/contact-img.svg" alt="">
         </div>

         <form action="" method="post">
            <h3>Hubungi Kami</h3>
            <input type="text" placeholder="Nama " required maxlength="100" name="name" class="box">
            <input type="email" placeholder="Email" required maxlength="100" name="email" class="box">
            <input type="number" min="0" max="9999999999" placeholder="Nomor Telepon" required maxlength="10" name="number" class="box">
            <textarea name="msg" class="box" placeholder="Pesan Anda" required cols="30" rows="10" maxlength="1000"></textarea>
            <input type="submit" value="Kirim Pesan" class="inline-btn" name="submit">
         </form>

      </div>

      <div class="box-container">

         <div class="box">
            <i class="fas fa-phone"></i>
            <h3>Nomor Telepon</h3>
            <a>Admin 1</a>
            <a href="tel:1234567890">0885-5455-9566</a>
            <a>Admin 2</a>
            <a href="tel:1112223333">0891-6778-9363</a>
         </div>

         <div class="box">
            <i class="fas fa-envelope"></i>
            <h3>Email</h3>
            <a href="mailto:alvinputra246@gmail.com">alvinputraa246@gmail.com</a>
            <a href="mailto:bhismapamungkas0@gmail.com">bhismapamungkas0@gmail.com</a>
         </div>

         <div class="box">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Alamat Lengkap</h3>
            <a href="#">Jl. Mertojoyo Blk. L, Merjosari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144</a>
         </div>


      </div>

   </section>

   <!-- contact section ends -->











   <?php include 'components/footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>