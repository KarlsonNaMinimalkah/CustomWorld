<?php
// registr.php
require 'db2.php';

function registerUser($mysqli) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($mysqli->query($query)) {
            header("Location: avtorization.php");
            exit();
        } else {
            echo "Error: " . $mysqli->error;
        }
    }
}

registerUser($mysqli);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
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

        .login-link {
            margin-top: 10px;
            text-align: center;
        }

        .login-link a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Имя пользователя:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Пароль:</label>
        <input type="password" name="password" required>

        <button type="submit">Зарегистрироваться</button>

        <div class="login-link">
            Уже есть аккаунт? <a href="avtorization.php">Войти</a>
        </div>
    </form>
</body>
</html>
