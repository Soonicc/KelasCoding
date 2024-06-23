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
   <title>Welcome to Kelas Coding</title>
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

   <!-- about section starts  -->

   <section class="about">

      <div class="row">


         <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
               <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
               <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="d-block w-100" src="wall1.jpg" alt="First slide">
               </div>
               <div class="carousel-item">
                  <img class="d-block w-100" src="wall2.jpg" alt="Second slide">
               </div>
               <div class="carousel-item">
                  <img class="d-block w-100" src="wall3.jpg" alt="Third slide">
               </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
            </a>
         </div>


         <div class="box-container">

            <div class="box">
               <i class="fas fa-graduation-cap"></i>
               <div>
                  <h3>+1k</h3>
                  <span>Online courses</span>
               </div>
            </div>

            <div class="box">
               <i class="fas fa-user-graduate"></i>
               <div>
                  <h3>+15k</h3>
                  <span>Brilliants Students</span>
               </div>
            </div>

            <div class="box">
               <i class="fas fa-chalkboard-user"></i>
               <div>
                  <h3>+1k</h3>
                  <span>Expert Teachers</span>
               </div>
            </div>

            <div class="box">
               <i class="fas fa-briefcase"></i>
               <div>
                  <h3>100%</h3>
                  <span>Job Placement</span>
               </div>
            </div>

         </div>

   </section>

   <!-- about section ends -->

   <!-- reviews section starts  -->

   <section class="reviews">

      <h1 class="heading">Student's reviews</h1>

      <div class="box-container">

         <div class="box">
            <p>
               Saya baru saja menyelesaikan kelas ‘Dasar-dasar HTML’ di KelasCoding.com. Pengalaman belajar saya sangat positif.
               <br>Materi yang disampaikan sangat lengkap dan mudah dipahami. Instruktur berpengalaman dan mampu menjelaskan konsep yang kompleks dengan baik. Saya merasa lebih percaya diri dengan keterampilan yang saya peroleh dan siap untuk menerapkan ilmu ini dalam proyek-proyek nyata lainnya.
            </p>
            <div class="user">
               <img src="images/pic-2.jpg" alt="">
               <div>
                  <h3>Satria Mahathir</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>
               Bagi pemula yang ingin memasuki dunia pemrograman, Kelas Coding merupakan pilihan terbaik.
               <br>Di sini, kamu akan menemukan beragam video dan tantangan interaktif yang mudah dipahami. Dengan konten menarik yang disediakan, Kelas Coding sangat cocok bagi mereka yang ingin belajar koding secara online.
            </p>
            <div class="user">
               <img src="images/pic-3.jpg" alt="">
               <div>
                  <h3>Handoko</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>
               Saya sangat merekomendasikan KelasCoding untuk pemula yang ingin mempelajari pemrograman secara gratis.
               <br>Mereka menawarkan kurikulum yang komprehensif, termasuk HTML, CSS, JavaScript, dan banyak lagi. Selain itu, Anda dapat upgrade skill setelah menyelesaikan proyek-proyek mereka.
            </p>
            <div class="user">
               <img src="images/pic-4.jpg" alt="">
               <div>
                  <h3>Alex Siregar</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>
               Kelas Coding memiliki berbagai kursus pemrograman dari universitas terkemuka di seluruh dunia.
               <br>Yang diajarkan sangat berkualitas, dan Anda dapat memilih kursus yang sesuai dengan minat dan kebutuhan Anda.
            </p>
            <div class="user">
               <img src="images/pic-5.jpg" alt="">
               <div>
                  <h3>Antonio</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>Kelas Coding adalah platform pembelajaran daring yang menawarkan kursus dari para ahli dibidangnya.
               <br>Mereka memiliki beragam kursus pemrograman yang dapat membantu Anda memperdalam pengetahuan dan keterampilan Anda.
            </p>
            <div class="user">
               <img src="images/pic-6.jpg" alt="">
               <div>
                  <h3>Brodin</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>Kelas Coding fokus pada pembelajaran berbasis video interaktif.
               <br> menawarkan nanodegree dalam berbagai bidang, termasuk pemrograman. Jika Anda ingin mengembangkan keterampilan praktis, Kelas Coding bisa menjadi pilihan yang baik.
            </p>
            <div class="user">
               <img src="images/pic-7.jpg" alt="">
               <div>
                  <h3>Sadewa</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>