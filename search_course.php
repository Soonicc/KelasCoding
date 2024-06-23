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

   <!-- courses section starts  -->

   <section class="courses">

      <h1 class="heading">Hasil Pencarian</h1>

      <div class="box-container">

         <?php
         if (isset($_POST['search_course']) or isset($_POST['search_course_btn'])) {
            $search_course = $_POST['search_course'];
            $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE title LIKE '%{$search_course}%' AND status = ?");
            $select_courses->execute(['active']);
            if ($select_courses->rowCount() > 0) {
               while ($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)) {
                  $course_id = $fetch_course['id'];

                  $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
                  $select_tutor->execute([$fetch_course['tutor_id']]);
                  $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
         ?>
                  <div class="box">
                     <div class="tutor">
                        <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
                        <div>
                           <h3><?= $fetch_tutor['name']; ?></h3>
                           <span><?= $fetch_course['date']; ?></span>
                        </div>
                     </div>
                     <img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
                     <h3 class="title"><?= $fetch_course['title']; ?></h3>
                     <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">Lihat Playlist</a>
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

   <!-- courses section ends -->










   <?php include 'components/footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>