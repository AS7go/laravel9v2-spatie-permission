<?php
$host = 'mysqldb'; // Используем имя сервиса контейнера MySQL из docker-compose.yml
$db = 'ale3'; // Указываем имя базы данных
$user = 'root';
$pass = 'secret';
$table = 'testuser';
echo "Если нет ошибки, то есть соединение с базой данных -> $db<br>";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка соединения с БД ' . $e->getMessage();
    die();
}

// Запрос для создания таблицы и заполнение
$queryCreateTable = "
SET NAMES utf8;
SET time_zone = '+02:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `$table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `flag` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `$table` (`name`, `email`, `flag`) VALUES
('name1', 'name1@gmail.com', 1),
('name2', 'name2@gmail.com', 1),
('name3', 'name3@gmail.com', 1);
";

// Функция для выполнения запроса
function executeQuery($pdo, $query, $successMessage) {
    try {
        $pdo->exec($query);
        echo $successMessage;
    } catch (PDOException $e) {
        echo 'Ошибка при выполнении запроса: ' . $e->getMessage();
    }
}

// Создание таблицы
echo '<a href="?action=create_table">Создать тестовую таблицу, заполнить, показать данные</a><br>';

// Показать содержимое таблицы
echo '<a href="?action=show_table">Показать содержимое таблицы</a><br>';

// Удаление таблицы
echo '<a href="?action=delete_table">Удалить таблицу</a><br>';

// Обработка действий
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create_table':
            executeQuery($pdo, $queryCreateTable, "<br>Таблица $table успешно создана и заполнена данными.<br><br>");
            // break; //закомментировано<-что бы сразу создать и показывать, но показывать - можно вызывать отдельно, от создать
        case 'show_table':   
            $queryShowTable = "SELECT id, name, email FROM $table";
            $stmt = $pdo->query($queryShowTable);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo $row['name'] . ' - ' . $row['email'] . '<br>';
            }
            break;
        case 'delete_table':
            $queryDeleteTable = "DROP TABLE `$table`";
            executeQuery($pdo, $queryDeleteTable, "Таблица $table успешно удалена.<br>");
            break;
        default:
            echo 'Неверное действие';
    }

}
?>
