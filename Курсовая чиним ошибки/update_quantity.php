<?php
session_start();
require 'db2.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartItemId = $_POST["cart_item_id"];
    $newQuantity = $_POST["new_quantity"];

    // Добавьте необходимые проверки данных, чтобы избежать SQL-инъекций

    // Подключение к базе данных
    $db = new mysqli('localhost', 'root', '', 'CustomWorldTest');

    // Проверка соединения
    if ($db->connect_error) {
        die("Ошибка соединения: " . $db->connect_error);
    }

    // Выполнение SQL-запроса для обновления количества в базе данных
    $query = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $newQuantity, $cartItemId);

    if ($stmt->execute()) {
        echo "Количество успешно обновлено!";
    } else {
        echo "Ошибка при обновлении количества: " . $stmt->error;
    }

    // Закрываем соединение с базой данных
    $db->close();
}
?>
