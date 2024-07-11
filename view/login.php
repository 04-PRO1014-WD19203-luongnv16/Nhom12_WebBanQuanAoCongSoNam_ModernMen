<?php
session_start();
include '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Mật khẩu không đúng!";
        }
    } else {
        $error = "Email không tồn tại!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <h2 class='text-light fw-bolder'>Đăng Nhập</h2>
        <?php
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>
        <form method="post" action="login.php">
            <div class=" row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold text-info">Email</label>
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
            <button type="submit" class="btn btn-primary">login</button>
            <a href="register.php" class="btn btn-primary"> register
            </a>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>