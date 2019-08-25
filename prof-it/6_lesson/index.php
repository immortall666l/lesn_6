<?php
// 4. Модифицируйте ваш проект: позволяйте загружать изображения в галерею только авторизованным пользователям, ведите лог (запись в файл) с данными: кто, когда и какое изображение загрузил
//стартуем сессию
session_start();
//подключаем файл с функциями
include __DIR__.'/functions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img {
            max-width: 200px;
            border: 3px solid red;
            margin-right: 20px;
        }
    </style>
</head>
<body>
<h1>Доброго времени суток</h1>

<div>Добавьте запись в нашу гостевую книгу)))</div>
<form action="/6_lesson/add_to_file.php" method="post" enctype="multipart/form-data">
    <textarea name="text" cols="60" rows="5"></textarea>
    <button type="submit">Добавить</button>
</form>

<!--Для удобства просмотра-->
<a href="/6_lesson/guestbook.txt">Посмотреть гостевую книгу</a><br><br>

<?php
//проверяем директорию на наличие файлов
$sdir = scandir(__DIR__.'/img');

//выводим файлы в браузер
if ( isset($sdir) && !empty($sdir) ) {
    foreach ($sdir as $key => $value) {
        if (!($key == 0 || $key == 1)) {
            echo '<img src="/6_lesson/img/'.$value.'" alt="">';
        }
    }
}


// проверяем вошел ли пользователь на страницу
if ( getCurrentUser() ) {
    ?>
    <div>Добавьте изображение в нашу галерею)))</div>
    <form action="/6_lesson/add_img.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="addimg">
        <button type="submit">добавить файл</button>
    </form>

    <!--Для удобства просмотра-->
    <a href="/6_lesson/log_img.txt">Посмотреть log</a>
    <?php
} else {
    ?>
    <h2>Если вы хотите загрузить изображение, то <a href="/6_lesson/login.php">авторизуйтесь</a></h2>
    <?php
}
?>

</body>
</html>