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
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class='text-light fw-bolder'>Đăng ký</h2>
        <?php
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        if (isset($success)) {
            echo "<div class='success'>$success</div>";
        }
        ?>
        <form method="post" action="register.php">
            <div class=" row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold text-info">Tên đăng nhập:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label text-info fw-bold">Số điện thoại:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="phone" name="phone" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label text-info fw-bold">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label text-info fw-bold">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">register</button>
            <a href="login.php" class="btn btn-primary"> login</a>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>