<!-- koneksi.php -->
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "klinik";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// Mengatur karakter set koneksi ke UTF-8
mysqli_set_charset($conn, "utf8");
?>
