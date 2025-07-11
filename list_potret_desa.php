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

// Proses delete data
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql = "DELETE FROM data_desa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<p>Data berhasil dihapus.</p>";
    } else {
        echo "<p>Gagal menghapus data: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Ambil data dari database
$sql = "SELECT * FROM data_desa ORDER BY tanggal_update DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Potret Desa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>List Potret Desa</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Potret Desa</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Tanggal Update</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['potret_desa']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td>
                            <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" alt="Foto" width="100">
                        </td>
                        <td><?= $row['tanggal_update'] ?></td>
                        <td>
                            <a href="update_data_desa.php?id=<?= $row['id'] ?>">Update</a> | 
                            <a href="list_potret_desa.php?delete_id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php $conn->close(); ?>
