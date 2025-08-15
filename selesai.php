<?php
$conn = new mysqli("localhost", "root", "", "todo_app");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$conn->query("UPDATE tasks SET status='Completed' WHERE id=$id");

header("Location: index.php");
?>
