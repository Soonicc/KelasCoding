<?php
try {
   $db_name = 'mysql:host=localhost;dbname=course_db';
   $user_name = 'root';
   $user_password = '';

   $conn = new PDO($db_name, $user_name, $user_password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // Contoh query untuk mengambil data
   $query = "SELECT * FROM users";
   $result = $conn->query($query);

   foreach ($result as $row) {
      echo "ID: " . $row['id'] . ", Nama: " . $row['nama'] . "<br>";
   }
} catch (PDOException $e) {
   echo "Kesalahan koneksi: " . $e->getMessage();
}
