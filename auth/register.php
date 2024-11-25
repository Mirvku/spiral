<?php
include("../lib/connection.php");
session_start();

if (isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "author") {
        header("Location: /spiral/dashboard/user/index.php");
    } else if ($_SESSION["role"] == "admin") {
        header("Location: /spiral/dashboard/admin/index.php");
    }
}

$previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/default-page.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="header">
        <div class="spiral-font">
            <img src="/spiral/img/removebg.png" alt="Spiral Logo" class="logo-img" />
            <span>Spiral</span>
        </div>
    </div>
    <div class="sub-header">blog</div>

    <div class="container">
        <div class="form-container">
            <div class="login-header">
                <a href="<?php echo $previousPage; ?>"><button class="back-button">&larr;</button></a>
            </div>
            <div class="col col-1">
                <div class="image">
                    <img src="/spiral/img/image.png" class="form-image-main" alt="Form Image">
                </div>
                <h2 class="judul">Register</h2>
                <p class="deskripsi">Hey, enter your details to Register your account</p>
            </div>
            <div class="col col-2">
                <form action="register.php" method="post" name="form_register">
                    <div class="register-form">
                        <div class="form-inputs">
                            <div class="input-box">
                                <i class="bx bx-user icon"></i>
                                <input type="text" class="input-field" name="nama" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="input-box">
                                <i class='bx bx-envelope'></i>
                                <input type="email" class="input-field" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-box">
                                <i class="bx bx-user icon"></i>
                                <input type="text" class="input-field" name="username" placeholder="Username" required>
                            </div>
                            <div class="input-box">
                                <i class='bx bx-key'></i>
                                <input type="password" class="input-field" name="password" placeholder="Password" required>
                            </div>
                            <div class="input-box">
                                <button type="submit" name="submit" class="input-submit">
                                    <span>Register!</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="text">
                <p class="register-text">Already have an account? <a href="/spiral/auth/login.php">Sign In!!</a></p>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST["submit"])) {
        $nama      = $_POST["nama"];
        $email     = $_POST["email"];
        $username  = $_POST["username"];
        $password  = hash("sha256", $_POST["password"]);

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        if (!$result->num_rows > 0) {
            $add = mysqli_query($conn, "INSERT INTO users VALUES ('','$email','$username', '$password', '$nama', 'author')");
            if ($add) {
                echo "<script>alert('Pendaftaran berhasil!')</script>";
                header("Location: /spiral/auth/login.php");
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Username sudah digunakan!')</script>";
        }
    }
    ?>
</body>

</html>