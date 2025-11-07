<?php
session_start();

// Jika user sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

// Variabel untuk pesan error
$error = "";

// Jika form dikirim (tombol login ditekan)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Data login statis
    $user_valid = "admin";
    $pass_valid = "1234";

    // Cek kecocokan username & password
    if ($username === $user_valid && $password === $pass_valid) {
        // Simpan username ke session
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        // Jika salah, tampilkan pesan error
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POLGAN MART</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login POLGAN MART</h2>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>
        <form action="" method="POST">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan Username" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>