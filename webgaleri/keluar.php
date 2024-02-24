<?php
// Memulai atau melanjutkan sesi
session_start();


// Menghapus sesi dari penyimpanan
session_destroy();

// Mengarahkan pengguna kembali ke halaman login
header("Location: index.php");// Keluar dari skrip setelah pengalihan halaman
?>