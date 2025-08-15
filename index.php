<?php
// Koneksi database
$conn = new mysqli("localhost", "root", "", "todo_app");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil semua tugas dari database
$result = $conn->query("SELECT * FROM tasks ORDER BY deadline ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Tugas</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-top: 40px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .btn-add {
            display: inline-block;
            padding: 8px 15px;
            background: #28a745;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 15px;
        }
        .btn-add:hover {
            background: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .priority.low {
            background: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .priority.medium {
            background: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .priority.high {
            background: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .status.done {
            background: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .status.pending {
            background: #ffc107;
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .btn-finish, .btn-delete {
            text-decoration: none;
            padding: 5px 8px;
            border-radius: 5px;
            margin: 0 2px;
        }
        .btn-finish {
            background: #17a2b8;
            color: white;
        }
        .btn-finish:hover {
            background: #138496;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>📋 Daftar Tugas</h1>
    <a href="tambah.php" class="btn-add">+ Tambah Tugas</a>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Prioritas</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td>
                    <span class="priority <?= strtolower($row['priority']) ?>">
                        <?= $row['priority'] ?>
                    </span>
                </td>
                <td><?= $row['deadline'] ?></td>
                <td>
                    <?php if ($row['status'] == 'Completed'): ?>
                        <span class="status done">Selesai</span>
                    <?php else: ?>
                        <span class="status pending">Belum</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="selesai.php?id=<?= $row['id'] ?>" class="btn-finish">✔</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Hapus tugas ini?')">🗑</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
