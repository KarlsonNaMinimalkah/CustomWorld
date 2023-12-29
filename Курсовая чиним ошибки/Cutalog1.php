<?php
header('Content-Type: text/html; charset=utf-8');
require 'db2.php';
require 'load_data1.php'; 

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Теперь у вас есть доступ к user_id
} else {
    // Пользователь не авторизован, выполните необходимые действия
    header("Location: avtorization.php"); // Например, перенаправьте его на страницу авторизации
    exit();
}
$user_id; // Установка $user_id по умолчанию

// Ваш код для обработки поиска товаров
if (isset($_GET['q'])) {
    $searchQuery = $_GET['q'];
    $tableName = isset($_GET['table']) ? $_GET['table'] : 'products';
    
    $db = new mysqli('localhost', 'root', '', 'CustomWorldTest');

    if ($db->connect_error) {
        die("Ошибка соединения: " . $db->connect_error);
    }

    $query = "SELECT * FROM $tableName WHERE name LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
    $result = $db->query($query);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="style.css">

    <style>
      
      .product-card {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start; /* Изменено на flex-start */
    width: 95%;
    position: relative;
}

.product-card img {
    max-width: 30%;
    max-height: 100%;
    margin-right: 10px;
}

.product-details {
    flex: 2;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center;
    width: 70%;
}

.product-details h2,
.product-details p {
    font-size: 14px;
    margin: 5px 0;
}

.add-to-cart-button {
    background: linear-gradient(to right, #4e54c8, #8f94fb);
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    width: 100%; /* Изменено на 100% */
    margin-top: auto; /* Изменено на auto */
    cursor: pointer;
    transition: background 0.3s;
}

.product-card button {
    background: linear-gradient(to right, #4e54c8, #8f94fb);
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background 0.3s;
}

.product-card button:hover {
    background: linear-gradient(to right, #3c44b1, #6782e9);
}

.product-card button:active {
    background: linear-gradient(to right, #2c3181, #5164cb);
}



.product-card button {
    background: linear-gradient(to right, #4e54c8, #8f94fb);
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background 0.3s;
}

.product-card button:hover {
    background: linear-gradient(to right, #3c44b1, #6782e9);
}

.product-card button:active {
    background: linear-gradient(to right, #2c3181, #5164cb);
}




.product-card button {
    background: linear-gradient(to right, #4e54c8, #8f94fb);
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background 0.3s;
}

.product-card button:hover {
    background: linear-gradient(to right, #3c44b1, #6782e9);
}

.product-card button:active {
    background: linear-gradient(to right, #2c3181, #5164cb);
}

/* Стили для шапки (header) */
header {
  background: linear-gradient(to right, #4e54c8, #8f94fb); /* Градиент от синего к фиолетовому */
  color: #fff;
  padding: 10px 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Тень */
}

.logo {
  width: 150px;
  height: 100px;
}

.logo img {
  width: 100%;
  height: 100%;
}

.top-menu ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  margin-left: 10px;
}

.top-menu li {
  margin-right: 20px;
}

.search-bar {
  flex: 2;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  margin-left: 10px;
}

.search-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  transition: border-color 0.3s; /* Эффект при наведении на поле ввода */
}

.search-button {
  background: linear-gradient(to right, #4e54c8, #8f94fb); /* Градиент от красного к розовому */
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
  margin-left: 10px;
  transition: background 0.3s; /* Эффект при наведении на кнопку "Найти" */
}

.search-input:hover {
  border-color: #ff9a9e; /* Эффект при наведении на поле ввода */
}

.search-button:hover {
  background: linear-gradient(to right, #ff6b6b, #fecfef); /* Изменение цвета при наведении */
}

.account button {
  background: linear-gradient(to right, #4e54c8, #8f94fb);
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
  transition: background 0.3s;
}

.account button:hover {
  background: linear-gradient(to right, #ff6b6b, #fecfef);
}

/* Стили для кнопок "В корзину" и "Избранное" */
.action-button, .filter-button {
  position: relative;
  background: linear-gradient(to right, #4e54c8, #8f94fb);
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 12px 24px;
  margin-right: 20px;
  cursor: pointer;
  transition: background 0.3s;
}

.action-button::before, .filter-button::before {
  content: "";
  position: absolute;
  top: -2px;
  left: -2px;
  right: -2px;
  bottom: -2px;
  z-index: -1;
  background-color: transparent;
  border: 2px solid #ff6b6b;
  border-radius: 7px;
  filter: blur(4px);
  pointer-events: none;
}

.action-button:hover, .filter-button:hover {
  background: linear-gradient(to right, #3c44b1, #6782e9);
}

.action-button:active, .filter-button:active {
  background: linear-gradient(to right, #2c3181, #5164cb);
}

/* Стили для нумерика */
.numeric-badge {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #4e54c8;
    color: #fff;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    font-size: 14px;
    font-weight: bold;
    z-index: 999;
}

.account{
    margin-right: 5%;
}
</style>

</head>
<body>
<header>
<div class="logo">
            <img src="beauty_salon__3_-removebg-preview.png" alt="Логотип">
        </div>
    <div class="top-menu">
        <ul>
            <li><a href="about.html">О компании</a></li>
            <li><a href="help.html">Справка</a></li>
            <li>8-455-234-12-12</li>
        </ul>
    </div>
   <!-- <div class="search-bar">
        <form action="search.php" method="GET">
            <input type="search" name="q" class="search-input" placeholder="Поиск по сайту"> 
            <input type="submit" class="search-button" value="Найти">
        </form>-->
    </div>
    <div class="account">
    <a href="registr.php"><button><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Вход'; ?></button></a>
</div>

</header>

<nav class="main-menu">
    <ul>
        <li><a href="Cutalog1.php">Главная</a></li>
        <li><a href="Cutalog1.php">Каталог</a></li>
        <li><a href="cart.php">Корзина</a></li>
    </ul>
</nav>

<div class="buttons">
            <button class="filter-button" data-table="products">Все товары</button>
            <button class="filter-button" data-table="summer">Летние товары</button>
            <button class="filter-button" data-table="autumn">Осенние товары</button>
            <button class="filter-button" data-table="winter">Зимние товары</button>
            <button class="filter-button" data-table="spring">Весенняя одежда</button>
            <button class="filter-button" data-table="men">Мужская одежда</button>
            <button class="filter-button" data-table="women">Женская одежда</button>
            <button class="filter-button" data-table="kids">Детская одежда</button>
        </div>
<div class="product-list">
        

        <!-- В этот контейнер будут добавляться карточки товаров -->
        <div class="product-container"></div>
  
<?php
// Проверяем, задан ли параметр "table" в запросе
if (isset($_GET['table'])) {
    // Если параметр "table" задан, получаем его значение
    $tableName = $_GET['table'];
} else {
    // Если параметр "table" не задан, используем "products" по умолчанию
    $tableName = "products";
}

// Создайте и выполните SQL-запрос для выборки данных из выбранной таблицы
$query = "SELECT * FROM $tableName";

// Установите соединение с базой данных, выполните запрос и получите результат
$db = new mysqli('localhost', 'root', '', 'CustomWorldTest');

if ($db->connect_error) {
    die("Ошибка соединения: " . $db->connect_error);
}



$result = $db->query($query);

while ($row = $result->fetch_assoc()) {
    echo "<div class='product-card'>"; 
    echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
    echo "<h2>" . $row['name'] . "</h2>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>" . $row['price'] . " ₽ (" . $row['old_price'] . " ₽)</p>";
    echo "<label for='quantity-" . $row['id'] . "'>Количество:</label>";
    echo "<input type='number' id='quantity-" . $row['id'] . "' name='quantity' min='1' value='1'>";
    echo "<button class='add-to-cart-button' data-product-id='" . $row['id'] . "' data-product-name='" . $row['name'] . "' data-product-price='" . $row['price'] . "' data-product-quantity='quantity-" . $row['id'] . "'>В корзину</button>";
    echo "</div>";
}

// Закройте соединение с базой данных
$db->close();
?>
</div>
<div class="numeric-badge" id="numeric-badge">1</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const addToCartButtons = document.querySelectorAll(".add-to-cart-button");

    addToCartButtons.forEach(button => {
        button.addEventListener("click", function() {
            const productId = this.getAttribute("data-product-id");
            const productName = encodeURIComponent(this.getAttribute("data-product-name"));
            const productPrice = this.getAttribute("data-product-price");
            const productQuantity = encodeURIComponent(document.getElementById(this.getAttribute("data-product-quantity")).value);

            // Отправляем данные о товаре на сервер для добавления в корзину
            fetch(`add_to_cart.php?id=${productId}&name=${productName}&price=${productPrice}&quantity=${productQuantity}`)
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    // Можете добавить обработку ответа сервера, если это необходимо
                })
        });
    });
});



</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myElement = document.getElementById("myElement");

        myElement.addEventListener("click", function() {
            // Добавить/удалить класс при каждом клике
            this.classList.toggle("add-to-cart-button");
        });
    });
</script>

<script src="scriptt.js?v=<?php echo time(); ?>"></script>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            const numericBadge = document.getElementById("numeric-badge");

            numericBadge.addEventListener("click", function() {
                // Получите текущее значение нумерика
                const currentValue = parseInt(this.innerText);

                // Увеличьте значение на 1 и обновите текст нумерика
                this.innerText = currentValue + 1;

                // Создайте новый элемент input с новым значением
                const inputElement = document.createElement("input");
                inputElement.type = "number";
                inputElement.id = "quantity-" + currentValue;
                inputElement.name = "quantity";
                inputElement.min = "1";
                inputElement.value = "1";

                // Добавьте новый элемент input в документ
                document.body.appendChild(inputElement);
            });
        });
    </script>
</body>
</html>