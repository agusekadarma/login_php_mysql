<?php
include 'config.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password)) {
        echo "Username dan password harus diisi!";
    } else {
        // Cek apakah username sudah ada
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Username sudah digunakan, pilih username lain!";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan user baru ke database
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                echo "Registrasi berhasil! <a href='login.php'>Login di sini</a>";
            } else {
                echo "Terjadi kesalahan, coba lagi.";
            }
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Registrasi</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>