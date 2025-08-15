<?php
$conn = new mysqli("localhost", "root", "", "todo_app");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    $sql = "INSERT INTO tasks (title, description, priority, deadline) 
            VALUES ('$title', '$description', '$priority', '$deadline')";

    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "Gagal menambah tugas: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tugas</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; }
        .container { width: 400px; margin: auto; margin-top: 50px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h2 { text-align: center; }
        label { display: block; margin-top: 10px; }
        input, textarea, select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        button { margin-top: 15px; background: #28a745; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; }
        button:hover { background: #218838; }
        a { display: inline-block; margin-top: 10px; text-decoration: none; color: #555; }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Tugas</h2>
    <form method="POST">
        <label>Judul</label>
        <input type="text" name="title" required>

        <label>Deskripsi</label>
        <textarea name="description"></textarea>

        <label>Prioritas</label>
        <select name="priority">
            <option value="Low">Rendah</option>
            <option value="Medium">Sedang</option>
            <option value="High">Tinggi</option>
        </select>

        <label>Deadline</label>
        <input type="date" name="deadline">

        <button type="submit">Simpan</button>
    </form>
    <a href="index.php">⬅ Kembali</a>
</div>
</body>
</html>
