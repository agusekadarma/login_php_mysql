<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan user database Anda
$pass = ""; // Sesuaikan jika ada password
$dbname = "login_php";

$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>