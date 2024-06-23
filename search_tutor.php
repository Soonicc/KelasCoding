<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Courses</title>
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

   <section class="teachers">

      <h1 class="heading">Expert tutors</h1>

      <form action="" method="post" class="search-tutor">
         <input type="text" name="search_tutor" maxlength="100" placeholder="search tutor..." required>
         <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
      </form>

      <div class="box-container">

         <?php
         if (isset($_POST['search_tutor']) or isset($_POST['search_tutor_btn'])) {
            $search_tutor = $_POST['search_tutor'];
            $select_tutors = $conn->prepare("SELECT * FROM `tutors` WHERE name LIKE '%{$search_tutor}%'");
            $select_tutors->execute();
            if ($select_tutors->rowCount() > 0) {
               while ($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)) {

                  $tutor_id = $fetch_tutor['id'];

                  $count_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
                  $count_playlists->execute([$tutor_id]);
                  $total_playlists = $count_playlists->rowCount();

                  $count_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
                  $count_contents->execute([$tutor_id]);
                  $total_contents = $count_contents->rowCount();

                  $count_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
                  $count_likes->execute([$tutor_id]);
                  $total_likes = $count_likes->rowCount();

                  $count_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
                  $count_comments->execute([$tutor_id]);
                  $total_comments = $count_comments->rowCount();
         ?>
                  <div class="box">
                     <div class="tutor">
                        <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
                        <div>
                           <h3><?= $fetch_tutor['name']; ?></h3>
                           <span><?= $fetch_tutor['profession']; ?></span>
                        </div>
                     </div>
                     <p>Playlists : <span><?= $total_playlists; ?></span></p>
                     <p>Total videos : <span><?= $total_contents ?></span></p>
                     <p>Total likes : <span><?= $total_likes ?></span></p>
                     <p>Total comments : <span><?= $total_comments ?></span></p>
                     <form action="tutor_profile.php" method="post">
                        <input type="hidden" name="tutor_email" value="<?= $fetch_tutor['email']; ?>">
                        <input type="submit" value="view profile" name="tutor_fetch" class="inline-btn">
                     </form>
                  </div>
         <?php
               }
            } else {
               echo '<p class="empty">Tidak ada hasil yang ditemukan</p>';
            }
         } else {
            echo '<p class="empty">Tolong cari sesuatu</p>';
         }
         ?>

      </div>

   </section>

   <!-- teachers section ends -->










   <?php include 'components/footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>