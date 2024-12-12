<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №8</title>
</head>
<body>
    <?php
    // Если форма отправлена, обработать данные
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Проверка на пустоту
        $fio = $_POST['fio'] ?? '';
        $hobbies = $_POST['hobbies'] ?? [];
        $sport = $_POST['sport'] ?? '';
        $animals = $_POST['animals'] ?? [];
        $comment = $_POST['comment'] ?? '';

        $errors = [];
        if (empty($fio)) {
            $errors[] = "Ошибка: поле ФИО не заполнено.";
        }
        if (empty($sport)) {
            $errors[] = "Ошибка: не выбран любимый вид спорта.";
        }

        if (!empty($errors)) {
            echo "<h3 style='color: red;'>Обнаружены ошибки:</h3>";
            echo "<ul style='color: red;'>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        } else {
            // Формирование строки для записи
            $dataString = "ФИО: $fio\nХобби: " . implode(', ', $hobbies) .
                          "\nЛюбимый вид спорта: $sport\nЗвери в зоопарке: " . implode(', ', $animals) .
                          "\nКомментарий: $comment\n\n";

            // Запись в файл
            $file = 'variant8_data.txt';
            file_put_contents($file, $dataString, FILE_APPEND);

            // Вывод содержимого файла
            echo "<h2>Содержимое файла после обновления:</h2>";
            echo nl2br(file_get_contents($file));
        }
    } else {
        // Отобразить форму
        echo '
        <h1 style="color: red;">Лабораторная работа №3</h1>
        <p>Группа: 21ИП6т</p>
        <p>Автор: Колобова А.В.</p>
        <form action="" method="POST">
            <label>Введите ФИО:</label><br>
            <input type="text" name="fio" required><br><br>

            <label>Выберите хобби:</label><br>
            <select name="hobbies[]" multiple size="4">
                <option value="Нумизматика">Нумизматика</option>
                <option value="Шашки">Шашки</option>
                <option value="Кроссворды">Кроссворды</option>
                <option value="Книги">Книги</option>
            </select><br><br>

            <label>Любимый вид спорта:</label><br>
            <input type="radio" name="sport" value="Скалолазание" required> Скалолазание<br>
            <input type="radio" name="sport" value="Футбол"> Футбол<br>
            <input type="radio" name="sport" value="Хоккей"> Хоккей<br><br>

            <label>Звери в зоопарке:</label><br>
            <input type="checkbox" name="animals[]" value="Барс"> Барс<br>
            <input type="checkbox" name="animals[]" value="Волк"> Волк<br>
            <input type="checkbox" name="animals[]" value="Гепард"> Гепард<br>
            <input type="checkbox" name="animals[]" value="Олень"> Олень<br><br>

            <label>Комментарий:</label><br>
            <textarea name="comment" rows="4" cols="50"></textarea><br><br>

            <button type="submit">Передать</button>
        </form>';
    }
    ?>
</body>
</html>
