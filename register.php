<?php
include 'koneksi.php';

// Check connection
if ($connection->connect_error) {
    die("Koneksi Gagal: " . $connection->connect_error);
}

// Get user input
// Disini aku bikin input buat masukin nama, email, dan password. Tapi yang kupakai untuk login hanya email dan password
// Kalau mau bikin inputan lain juga gapapa, tinggal copas dan ubah namanya sesuai yang ada di database
$nama = $_POST["nama"];
$email = $_POST["email"];
$password = $_POST["password"];

// Start a transaction
$connection->begin_transaction();

try {
    // sesuaikan namanya dengan yang ada di tabel database
    $query = "INSERT INTO user (nama, email, password) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        throw new Exception("Kesalahan persiapan pernyataan: " . $connection->error);
    }

    // Bind parameter to the statement
    $stmt->bind_param('sss', $nama, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: login.php');
        // Commit the transaction
        $connection->commit();
    } else {
        echo "Registrasi gagal: " . $stmt->error;
        // Rollback the transaction on failure
        $connection->rollback();
    }

    // Close the statement
    $stmt->close();
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
    // Rollback the transaction on exception
    $connection->rollback();
}

// Close the connection
$connection->close();
?>
