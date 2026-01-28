<?php
// 1. Konfigurasi Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_wapa";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. Tangkap data dari Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gunakan mysqli_real_escape_string untuk keamanan
    $nama   = mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $subjek = mysqli_real_escape_string($conn, $_POST['category']);
    $pesan  = mysqli_real_escape_string($conn, $_POST['message']);

    // 3. Buat Query SQL (Urutannya harus di sini)
    $sql = "INSERT INTO pesan_kontak (nama, email, subjek, pesan) 
            VALUES ('$nama', '$email', '$subjek', '$pesan')";

    // 4. Jalankan Query
    if (mysqli_query($conn, $sql)) {
        // Redirect ke halaman kontak dengan tanda sukses untuk memicu pop-up
        header("Location: kontak.html?status=success");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>