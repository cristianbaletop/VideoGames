<?php

$filename = __DIR__ . '/main.txt';
$filenameOut = __DIR__ . '/out.txt';

$array = file($filename);
$lines = [];
$out = [];
foreach ($array as $line) {
	$lines[] = explode(' ', $line);
}
foreach ($lines as $lineKey => $line) {
	foreach ($line as $wordKey => $word) {
		$line[$wordKey] = preg_replace_callback('/([^\b\s]{2})(.\b)?/', function ($word) {
			return
				strtoupper($word[1][0]) .
				$word[1][1] .
				strtoupper(isset($word[2][0]) ? $word[2][0] : '');
		}, $word);
	}
	$out[$lineKey] = join(' ', $line);
}

foreach ($out as $line) {
	file_put_contents($filenameOut, $line, FILE_APPEND);
}

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
	    15. Заменить все нечетные буквы каждого слова строк файла англоязычного текста на верхний регистр
    </h1>
    <p>Исправленный текст: </p>
    <?php foreach ($out as $element): ?>
        <div>
            <?php print_r($element); ?>
        </div>
    <?php endforeach; ?>
</body>
</html>