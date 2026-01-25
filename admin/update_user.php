<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'connect.php';
header('Content-Type: application/json');

$id = $_POST['id_account'] ?? '';
$username = $_POST['username_account'] ?? '';
$password = $_POST['password_account'] ?? '';
$role = $_POST['role_account'] ?? '';

if (!$id || !$username || !$password) {
    echo json_encode([
        'status' => 'error',
        'message' => 'ข้อมูลไม่ครบ'
    ]);
    exit;
}

$sql = "UPDATE account
        SET username_account = ?, 
            password_account = ?,
            role_account = ?
        WHERE id_account = ?";

$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "sssi", 
    $username,
    $password,
    $role,
    $id
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => mysqli_error($connect)
    ]);
}