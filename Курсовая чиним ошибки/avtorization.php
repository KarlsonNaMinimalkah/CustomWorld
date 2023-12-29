<?php
// avtorization.php
require 'db2.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // После успешной авторизации
if (password_verify($password, $user["password"])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username']; // Сохраняем имя пользователя в сессии
    $user_id = $user['id'];
    header("Location: Cutalog1.php");
    exit();
}
else {
            $error = "Неверное имя пользователя или пароль";
        }
    } else {
        $error = "Неверное имя пользователя или пароль";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <style>
        body {
            background-color: #4e54c8;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #8f94fb;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #2c3181;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #5164cb;
        }

        .error {
            color: #ff6b6b;
            margin-bottom: 10px;
        }

        .form.reg{
            text-align: right;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Имя пользователя:</label>
        <input type="text" name="username" required>

        <label for="password">Пароль:</label>
        <input type="password" name="password" required>

        <button type="submit">Войти</button>
        <a href="registr.php" class="reg">Зарегистрироваться</a>

        <?php
        // Вывод ошибки, если есть
        if (isset($error)) {
            echo '<div class="error">' . $error . '</div>';
        }
        ?>
    </form>
</body>
</html>
