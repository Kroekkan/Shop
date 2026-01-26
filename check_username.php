<?php
header('Content-Type: application/json');
require('admin/connect.php');

if (isset($_GET['username'])) {
    $username = mysqli_real_escape_string($connect, $_GET['username']);
    
    $sql = "SELECT username_account FROM account WHERE username_account = '$username'";
    $result = mysqli_query($connect, $sql);
    
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo json_encode(['exists' => true]);
        } else {
            echo json_encode(['exists' => false]);
        }
    } else {
        echo json_encode(['exists' => false, 'error' => mysqli_error($connect)]);
    }
} else {
    echo json_encode(['exists' => false, 'error' => 'No username provided']);
}
?>