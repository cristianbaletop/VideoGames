<?php

$filename = __DIR__ . '/main.txt';
$array = file($filename);
$out = preg_grep('/\b(\w)(\w)[\w]\2\1\b/', $array);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Лабораторная работа #2</title>
</head>
<body>
    <h1>
        15. Найти в файле слова-палиндромы длиною пять. Выдать на печать строки с этими словами.
    </h1>
    <p>Оставшиеся строки файла, содержащие палиндромы: </p>
    <?php foreach ($out as $element): ?>
        <div>
            <?php print_r($element); ?>
        </div>
    <?php endforeach; ?>
</body>
</html>

