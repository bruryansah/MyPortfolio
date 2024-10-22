<?php
$servername = "localhost"; // Ganti dengan host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "kontak_db"; // Nama database yang dibuat

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Menyiapkan dan mengikat
    $stmt = $conn->prepare("INSERT INTO pesan (nama, email, subjek, pesan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Eksekusi
    if ($stmt->execute()) {
        echo "Pesan telah terkirim dan disimpan.";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    // Tutup pernyataan dan koneksi
    $stmt->close();
    $conn->close();
} else {
    echo "Metode tidak valid.";
}
?>
