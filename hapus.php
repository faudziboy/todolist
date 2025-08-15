<?php
$conn = new mysqli("localhost", "root", "", "todo_app");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$conn->query("DELETE FROM tasks WHERE id=$id");

header("Location: index.php");
?>
