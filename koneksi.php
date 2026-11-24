
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "to_do_list";

// Membuat koneksi ke database
$koneksi = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>
