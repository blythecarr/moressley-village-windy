<?php
// Konfigurasi database
$host = "localhost";
$user = "root";
$pass = "";
$db = "profildesa";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form ketika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $potret_desa = $_POST['potret_desa'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_update = date('Y-m-d H:i:s');

    // Proses upload file
    $target_dir = "uploads/";
    $file_name = basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file adalah gambar
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check === false) {
        die("File bukan gambar.");
    }

    // Cek apakah file sudah ada
    if (file_exists($target_file)) {
        die("File sudah ada.");
    }

    // Batas ukuran file (contoh: 2MB)
    if ($_FILES["foto"]["size"] > 2000000) {
        die("Ukuran file terlalu besar.");
    }

    // Hanya izinkan file tertentu
    if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg") {
        die("Hanya file JPG, JPEG, dan PNG yang diperbolehkan.");
    }

    // Jika semua cek lolos
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // Simpan data ke database
        $sql = "INSERT INTO data_desa (potret_desa, deskripsi, foto, tanggal_update) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $potret_desa, $deskripsi, $file_name, $tanggal_update);

        if ($stmt->execute()) {
            echo "Data berhasil diunggah.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}
$conn->close();
?>
