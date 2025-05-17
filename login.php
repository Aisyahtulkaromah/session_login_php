<?php
include 'config.php';

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
         } else {
        $error = "Username atau password salah!";
    }
}
?>

<!-- Form Login -->
<form method="post">
    <input type="text" name="username" required placeholder="Username" />
    <input type="password" name="password" required placeholder="Password" />
    <button type="submit" name="login">Login</button>
</form>
<?php if (isset($error)) echo $error; ?>
<a href="register.php">Daftar</a>