<?php
if (isset($_POST['submit-register'])) {
   $username = trim($_POST['username']); //ambil nilai inputan username
   $email    = $_POST['email']; //ambil nilai inputan email
   $password = md5($_POST['password']); //ambil nilai inputan password
   $cek      = $_POST['cek']; //ambil nilai inputan cek
   $angka1   = $_SESSION['angka1']; //angka pertama yang akan dicek
   $angka2   = $_SESSION['angka2']; //angka kedua yang akan dicek

   $valid = $angka1 + $angka2; //menjumlahkan angka1 dan angka2
   if ($cek == $valid) { //jika penjumlahan angka1 dan angka2 sama dengan angka yang diinputkan user
      $query = mysqli_query($konek, "INSERT INTO users (email, username, password, status, level, login_at) VALUES ('$email','$username','$password', 'Y','2', CURRENT_TIMESTAMP())");

      if ($query) {
         $_SESSION['register_success'] = 'Registrasi Berhasil. Silahkan Login!';
         unset($_SESSION['angka1']);
         unset($_SESSION['angka2']);
         header('Location: ?page=register');
      } else {
         $_SESSION['register_failed'] = 'Registrasi Gagal';
         unset($_SESSION['angka1']);
         unset($_SESSION['angka2']);
         header('Location: ?page=register');
      }
   } else {
      $_SESSION['register_cek_failed'] = 'Validasi tidak sesuai';
      unset($_SESSION['angka1']);
      unset($_SESSION['angka2']);
      header('Location: ?page=register');
   }
}
