<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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

</style>
</head>
<body>
<header>
<div class="logo">
            <img src="image/beauty_salon__3_-removebg-preview.png" alt="Логотип">
        </div>
    <div class="top-menu">
        <ul>
            <li><a href="about.html">О компании</a></li>
            <li><a href="help.html">Справка</a></li>
            <li>8-455-234-12-12</li>
        </ul>
    </div>
    <<!--<div class="search-bar">
        <form action="search.php" method="GET">
            <input type="search" name="q" class="search-input" placeholder="Поиск по сайту"> 
            <input type="submit" class="search-button" value="Найти">
        </form>-->
    </div>
    <div class="account">
        <button>Аккаунт</button>
    </div>
</header>

<nav class="main-menu">
    <ul>
        <li><a href="index.html">Главная</a></li>
        <li><a href="Cutalog1.php">Каталог</a></li>
        <li><a href="add_to_cart.php">Корзина</a></li>
    </ul>
</nav>
</body>
</html>