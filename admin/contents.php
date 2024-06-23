<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
   $tutor_id = $_COOKIE['tutor_id'];
} else {
   $tutor_id = '';
   header('location:login.php');
}

if (isset($_POST['delete_video'])) {
   $delete_id = $_POST['video_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $verify_video = $conn->prepare("SELECT * FROM `content` WHERE id = ? LIMIT 1");
   $verify_video->execute([$delete_id]);
   if ($verify_video->rowCount() > 0) {
      $delete_video_thumb = $conn->prepare("SELECT * FROM `content` WHERE id = ? LIMIT 1");
      $delete_video_thumb->execute([$delete_id]);
      $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
      unlink('../uploaded_files/' . $fetch_thumb['thumb']);
      $delete_video = $conn->prepare("SELECT * FROM `content` WHERE id = ? LIMIT 1");
      $delete_video->execute([$delete_id]);
      $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
      unlink('../uploaded_files/' . $fetch_video['video']);
      $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE content_id = ?");
      $delete_likes->execute([$delete_id]);
      $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE content_id = ?");
      $delete_comments->execute([$delete_id]);
      $delete_content = $conn->prepare("DELETE FROM `content` WHERE id = ?");
      $delete_content->execute([$delete_id]);
      $message[] = 'video deleted!';
   } else {
      $message[] = 'video already deleted!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="shortcut icon" href="kc.png" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="contents">

      <h1 class="heading">your contents</h1>

      <div class="box-container">

         <div class="box" style="text-align: center;">
            <h3 class="title" style="margin-bottom: .5rem;">create new content</h3>
            <a href="add_content.php" class="btn">add content</a>
         </div>

         <?php
         $select_videos = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ? ORDER BY date DESC");
         $select_videos->execute([$tutor_id]);
         if ($select_videos->rowCount() > 0) {
            while ($fecth_videos = $select_videos->fetch(PDO::FETCH_ASSOC)) {
               $video_id = $fecth_videos['id'];
         ?>
               <div class="box">
                  <div class="flex">
                     <div><i class="fas fa-dot-circle" style="<?php if ($fecth_videos['status'] == 'active') {
                                                                  echo 'color:limegreen';
                                                               } else {
                                                                  echo 'color:red';
                                                               } ?>"></i><span style="<?php if ($fecth_videos['status'] == 'active') {
                                                                                          echo 'color:limegreen';
                                                                                       } else {
                                                                                          echo 'color:red';
                                                                                       } ?>"><?= $fecth_videos['status']; ?></span></div>
                     <div><i class="fas fa-calendar"></i><span><?= $fecth_videos['date']; ?></span></div>
                  </div>
                  <img src="../uploaded_files/<?= $fecth_videos['thumb']; ?>" class="thumb" alt="">
                  <h3 class="title"><?= $fecth_videos['title']; ?></h3>
                  <form action="" method="post" class="flex-btn">
                     <input type="hidden" name="video_id" value="<?= $video_id; ?>">
                     <a href="update_content.php?get_id=<?= $video_id; ?>" class="option-btn">update</a>
                     <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this video?');" name="delete_video">
                  </form>
                  <a href="view_content.php?get_id=<?= $video_id; ?>" class="btn">view content</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no contents added yet!</p>';
         }
         ?>

      </div>

   </section>















   <?php include '../components/footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>

</html>