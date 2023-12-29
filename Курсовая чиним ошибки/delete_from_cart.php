<?php
session_start();
require 'db2.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $cart_item_id = isset($_POST['cart_item_id']) ? (int)$_POST['cart_item_id'] : 0;

    if ($user_id && $cart_item_id) {
        // Подключение к базе данных
        $db = new mysqli('localhost', 'root', '', 'CustomWorldTest');

        // Проверка соединения
        if ($db->connect_error) {
            die("Ошибка соединения: " . $db->connect_error);
        }

        // Удаление товара из корзины
        $delete_query = "DELETE FROM cart WHERE user_id = ? AND id = ?";
        $delete_stmt = $db->prepare($delete_query);
        $delete_stmt->bind_param('ii', $user_id, $cart_item_id);

        if ($delete_stmt->execute()) {
            echo "Товар успешно удален из корзины!";
        } else {
            echo "Ошибка при удалении товара из корзины: " . $delete_stmt->error;
        }

        // Закрываем соединение с базой данных
        $db->close();
    } else {
        echo "Неверные данные для удаления товара из корзины.";
    }
} else {
    echo "Недопустимый метод запроса.";
}
header("Location: cart.php");
?>
