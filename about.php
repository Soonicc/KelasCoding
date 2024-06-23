<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Students | Kelas Coding</title>
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

   <!-- quick select section starts  -->

   <section class="quick-select">

      <h1 class="heading">Students</h1>

      <div class="box-container">

         <?php
         if ($user_id != '') {
         ?>
            <div class="box">
               <h3 class="title">Likes and Comments</h3>
               <p>Total Likes : <span><?= $total_likes; ?></span></p>
               <a href="likes.php" class="inline-btn">view likes</a>
               <p>Total Comments : <span><?= $total_comments; ?></span></p>
               <a href="comments.php" class="inline-btn">view comments</a>
               <p>Saved Playlist : <span><?= $total_bookmarked; ?></span></p>
               <a href="bookmark.php" class="inline-btn">view bookmark</a>
            </div>
         <?php
         } else {
         ?>
            <div class="box" style="text-align: center;">
               <h3 class="title">Login | Register</h3>
               <div class="flex-btn" style="padding-top: .5rem;">
                  <a href="login.php" class="option-btn">Login</a>
                  <a href="register.php" class="option-btn">Register</a>
               </div>
            </div>
         <?php
         }
         ?>

         <div class="box">
            <h3 class="title">Topics</h3>
            <div class="flex">
               <a href="courses.php"><i class="fab fa-html5"></i><span>HTML</span></a>
               <a href="courses.php"><i class="fab fa-css3"></i><span>CSS</span></a>
               <a href="courses.php"><i class="fab fa-js"></i><span>Javascript</span></a>
               <a href="courses.php"><i class="fab fa-react"></i><span>React</span></a>
               <a href="courses.php"><i class="fab fa-php"></i><span>PHP</span></a>
               <a href="courses.php"><i class="fab fa-bootstrap"></i><span>Bootstrap</span></a>
            </div>
         </div>

      </div>

   </section>

   <!-- quick select section ends -->

   <!-- courses section starts  -->

   <section class="courses">

      <h1 class="heading">Latest courses</h1>

      <div class="box-container">

         <?php
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC LIMIT 6");
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
                  <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">view playlist</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">Belum ada kursus yang ditambahkan</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="courses.php" class="inline-option-btn">View more</a>
      </div>

   </section>

   <!-- courses section ends -->












   <!-- footer section starts  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer section ends -->

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>