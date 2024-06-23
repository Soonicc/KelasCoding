<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
}

if (isset($_POST['remove'])) {

   if ($user_id != '') {
      $content_id = $_POST['content_id'];
      $content_id = filter_var($content_id, FILTER_SANITIZE_STRING);

      $verify_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND content_id = ?");
      $verify_likes->execute([$user_id, $content_id]);

      if ($verify_likes->rowCount() > 0) {
         $remove_likes = $conn->prepare("DELETE FROM `likes` WHERE user_id = ? AND content_id = ?");
         $remove_likes->execute([$user_id, $content_id]);
         $message[] = 'removed from likes!';
      }
   } else {
      $message[] = 'please login first!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>liked videos</title>

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

   <!-- courses section starts  -->

   <section class="liked-videos">

      <h1 class="heading">liked videos</h1>

      <div class="box-container">

         <?php
         $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
         $select_likes->execute([$user_id]);
         if ($select_likes->rowCount() > 0) {
            while ($fetch_likes = $select_likes->fetch(PDO::FETCH_ASSOC)) {

               $select_contents = $conn->prepare("SELECT * FROM `content` WHERE id = ? ORDER BY date DESC");
               $select_contents->execute([$fetch_likes['content_id']]);

               if ($select_contents->rowCount() > 0) {
                  while ($fetch_contents = $select_contents->fetch(PDO::FETCH_ASSOC)) {

                     $select_tutors = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
                     $select_tutors->execute([$fetch_contents['tutor_id']]);
                     $fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC);
         ?>
                     <div class="box">
                        <div class="tutor">
                           <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
                           <div>
                              <h3><?= $fetch_tutor['name']; ?></h3>
                              <span><?= $fetch_contents['date']; ?></span>
                           </div>
                        </div>
                        <img src="uploaded_files/<?= $fetch_contents['thumb']; ?>" alt="" class="thumb">
                        <h3 class="title"><?= $fetch_contents['title']; ?></h3>
                        <form action="" method="post" class="flex-btn">
                           <input type="hidden" name="content_id" value="<?= $fetch_contents['id']; ?>">
                           <a href="watch_video.php?get_id=<?= $fetch_contents['id']; ?>" class="inline-btn">watch video</a>
                           <input type="submit" value="remove" class="inline-delete-btn" name="remove">
                        </form>
                     </div>
         <?php
                  }
               } else {
                  echo '<p class="emtpy">content was not found!</p>';
               }
            }
         } else {
            echo '<p class="empty">nothing added to likes yet!</p>';
         }
         ?>

      </div>

   </section>










   <?php include 'components/footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>