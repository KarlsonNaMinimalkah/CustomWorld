<!-- load_data1.php -->
<?php
require 'db2.php';

// Используйте объект $mysqli, созданный в db2.php
if (isset($_GET['table'])) {
    $tableName = $_GET['table'];

    $tables = ["women", "winter", "summer", "spring", "products", "men", "kids", "autumn"];

    if (in_array($tableName, $tables)) {
        $query = "SELECT * FROM $tableName";

        // Используйте $mysqli вместо $db
        $result = $mysqli->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product-card'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h2>" . $row['name'] . "</h2>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p>" . $row['price'] . " ₽ (" . $row['old_price'] . " ₽)</p>";
                echo "<button>В корзину</button>";
                echo "</div>";
            }
        } else {
            echo "Нет данных для отображения";
        }
    } else {
        echo "Ошибка: недопустимое имя таблицы.";
    }
} else {
    //echo "Ошибка: параметр 'table' не найден.";
}
?>
