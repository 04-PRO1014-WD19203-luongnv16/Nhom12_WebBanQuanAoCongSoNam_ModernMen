<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: view/login.php");
    exit();
}

echo "Chào mừng, " . $_SESSION['username'] . "!";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trang chính</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Trang chính</h2>
    <p>Bạn đã đăng nhập thành công!</p>
    <a href="view/logout.php">Đăng xuất</a>
    <a href="index.html">admin</a>
</body>

</html>