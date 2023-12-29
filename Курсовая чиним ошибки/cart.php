
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
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

.account{
    margin-left: 25%;
}


        /* Ваши стили здесь */

        /* Новые стили для карточек товаров */
        .product-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 8px;
            position: relative;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .delete-btn,
        .quantity-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .delete-btn:hover,
        .quantity-btn:hover {
            background-color: #45a049;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
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
        <div class="account">
    
        </div>
    </header>

    <nav class="main-menu">
        <ul>
            <li><a href="Cutalog1.php">Главная</a></li>
            <li><a href="Cutalog1.php">Каталог</a></li>
            <li><a href="cart.php">Корзина</a></li>
        </ul>
    </nav>

    <?php
    require 'db2.php';
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }

    $db = new mysqli('localhost', 'root', '', 'CustomWorldTest');

    if ($db->connect_error) {
        die("Ошибка соединения: " . $db->connect_error);
    }

    $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $productImage = $db->real_escape_string($_GET['image']);
    $productName = $db->real_escape_string($_GET['name']);
    $productDescription = $db->real_escape_string($_GET['description']);
    $productPrice = (float)$_GET['price'];
    $productQuantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = array(
        'id' => $productId,
        'image' => $productImage,
        'name' => $productName,
        'description' => $productDescription,
        'price' => $productPrice,
        'quantity' => $productQuantity
    );

    $query = "SELECT id, name, image, description, quantity, price FROM cart WHERE user_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Ошибка при выполнении запроса: " . $db->error);
    }

    $totalPrice = 0;

    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        $itemTotal = $row['price'] * $row['quantity'];
        ?>
        <div class="product-card">
    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
    <h3><?php echo $row['name']; ?></h3>
    <p><?php echo $row['description']; ?></p>
    <p>Количество: <?php echo $row['quantity']; ?></p>
    <p>Цена за единицу: <?php echo $row['price']; ?> ₽</p>
    <p class="kolich">
        <!-- Добавлены кнопки для увеличения и уменьшения количества -->
        
        <input id="quantity-<?php echo $row['id']; ?>" class="quantity-input" type="text" value="<?php echo $row['quantity']; ?>" readonly>
        <button class="quantity-btn" onclick="updateQuantity(<?php echo $row['id']; ?>, 1)" style="padding-right: 21%">+</button>
        <button class="quantity-btn" onclick="updateQuantity(<?php echo $row['id']; ?>, -1)">-</button>
    </p>
    <form method="post" action="delete_from_cart.php">
        <input type="hidden" name="cart_item_id" value="<?php echo $row['id']; ?>">
        <button type="submit">Удалить из корзины</button>
        
    </form>
</div>


        <?php
        $totalPrice += $itemTotal;
    }

    echo "<h2>Общая сумма цен: " . $totalPrice . " ₽</h2>";

    $db->close();
    ?>


<script>
    function updateQuantity(cartItemId, change) {
        var quantityInput = document.querySelector('#quantity-' + cartItemId);
        var currentQuantity = parseInt(quantityInput.value);
        var newQuantity = currentQuantity + change;

        if (newQuantity < 1) {
            newQuantity = 1;
        }

        $.ajax({
            type: 'POST',
            url: 'update_quantity.php',
            data: {
                cart_item_id: cartItemId,
                new_quantity: newQuantity
            },
            success: function(response) {
                console.log(response);
                // После успешного обновления, перезагрузите страницу
                location.reload();
            },
            error: function(error) {
                console.error(error);
            }
        });

        quantityInput.value = newQuantity;
    }
</script>


    <script src="scriptt.js?v=<?php echo time(); ?>"></script>
</body>

</html>