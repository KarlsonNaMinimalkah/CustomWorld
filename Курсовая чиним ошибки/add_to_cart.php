<?php
session_start();
require 'db2.php';
require 'Cutalog1.php';


// Подключение к базе данных
$db = new mysqli('localhost', 'root', '', 'CustomWorldTest');

// Проверка соединения
if ($db->connect_error) {
    die("Ошибка соединения: " . $db->connect_error);
}

// Получение данных от клиента
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$productImage = $db->real_escape_string($_GET['image']);
$productName = $db->real_escape_string($_GET['name']);
$productDescription = $db->real_escape_string($_GET['description']);
$productPrice = (float)$_GET['price'];
$productQuantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1; // Изменено на использование переданного значения quantity
//$user_id; // Здесь укажите актуальный user_id

// Проверяем, есть ли корзина в сессии
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Добавляем товар в корзину в сессии
$_SESSION['cart'][] = array(
    'id' => $productId,
    'image' => $productImage,
    'name' => $productName,
    'description' => $productDescription,
    'price' => $productPrice,
    'quantity' => $productQuantity // Добавлено количество товара
);

// Добавляем товар в базу данных (cart таблицу)
$query = "INSERT INTO cart (id, image, name, description, price, quantity, user_id) 
          VALUES ('$productId', '$productImage', '$productName', '$productDescription', '$productPrice', '$productQuantity', '$user_id')";
$result = $db->query($query);

if ($result === false) {
    die("Ошибка при добавлении товара в базу данных: " . $db->error);
}

echo "Товар успешно добавлен в корзину!";
?>
