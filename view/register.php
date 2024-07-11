<?php
include '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Kiểm tra xem email đã tồn tại chưa
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $error = "Email này đã được sử dụng!";
    } else {
        $sql = "INSERT INTO users (username, phone, email, password) VALUES ('$username', '$phone', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $success = "Đăng ký thành công!";
        } else {
            $error = "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <h2>Đăng ký</h2>
        <?php
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        if (isset($success)) {
            echo "<div class='success'>$success</div>";
        }
        ?>
        <form method="post" action="register.php">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Đăng ký">
        </form>
    </div>
</body>

</html>