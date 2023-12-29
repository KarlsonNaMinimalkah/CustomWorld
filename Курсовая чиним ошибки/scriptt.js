document.addEventListener("DOMContentLoaded", function() {
    const productContainer = document.querySelector(".product-container");
    const buttons = document.querySelectorAll(".filter-button");

    buttons.forEach(button => {
        button.addEventListener("click", function() {
            const table = this.getAttribute("data-table");
            fetchData(table);
        });
    });

    function fetchData(table) {
        // Очистка контейнера перед загрузкой новых данных
        productContainer.innerHTML = '';

        // Запрос на сервер для получения данных из выбранной таблицы
        fetch(`load_data1.php?table=${table}`)
            .then(response => response.text())
            .then(data => {
                productContainer.innerHTML = data;

                // Добавление обработчиков событий для кнопок "В корзину"
                const addToCartButtons = document.querySelectorAll(".add-to-cart-button");
                addToCartButtons.forEach(cartButton => {
                    cartButton.addEventListener("click", function() {
                        // Получение данных о товаре
                        const productId = this.getAttribute("data-product-id");
                        const productName = this.getAttribute("data-product-name");
                        const productPrice = this.getAttribute("data-product-price");

                        // Отправка данных на сервер для добавления в корзину
                        addToCart(productId, productName, productPrice);
                    });
                });
            })
            .catch(error => {
                console.error("Ошибка при загрузке данных: " + error);
            });
    }

    function addToCart(productId, productName, productPrice) {
        // Отправка данных на сервер для добавления в корзину
        fetch(`add_to_cart.php?id=${productId}&name=${productName}&price=${productPrice}`)
            .then(response => response.text())
            .then(data => {
                console.log("Товар добавлен в корзину: " + data);

                // Обновление интерфейса или выполнение других действий
                // (например, обновление суммы цен заказов в корзине)
                updateCartTotal();
            })
            .catch(error => {
                console.error("Ошибка при добавлении в корзину: " + error);
            });
    }

    function updateCartTotal() {
        // Здесь можно добавить код для обновления суммы цен заказов в корзине
        // Например, отправить запрос на сервер для получения обновленного HTML-кода и отобразить его на странице
        fetch(`get_cart_total.php`)
            .then(response => response.text())
            .then(html => {
                console.log("Сумма цен заказов в корзине обновлена.");
                // Обновить интерфейс суммы цен заказов
                document.getElementById('cart-total-container').innerHTML = html;
            })
            .catch(error => {
                console.error("Ошибка при получении суммы цен заказов: " + error);
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Находим все кнопки "Удалить" и назначаем обработчик события на каждую из них
        var deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Получаем идентификатор товара из data-атрибута
                var cartItemId = button.getAttribute('data-cart-item-id');
                
                // Отправляем асинхронный запрос на сервер для удаления товара
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_from_cart.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Обновляем содержимое страницы после успешного удаления
                        location.reload();
                    }
                };
                xhr.send('cart_item_id=' + cartItemId);
            });
        });
    });
    
});
