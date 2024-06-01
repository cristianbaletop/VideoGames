<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <a href="/">Вернуться на главную</a>

    <h1>
        15. Пройти по дереву каталогов, начиная с текущего, и удалить все
        файлы на языке Си, содержащие внутри максимальное количество
        операторов if-else не менее 2, и имеющие шаблон имени файла: в названии
        файла имеются две точки и дата в виде YYMMDD в любом месте и младше
        месяца и старше недели с правами только на чтение.
    </h1>
    <div>
        <form action="../controllers/generate.php">
            <button type="submit">Сгенерировать случайные файлы</button>
        </form>
        <br>
    </div>
    <div>
        <form action="../controllers/delete.php">
            <button type="submit">Удалить файлы удовлетворяющие условию</button>
        </form>
        <br>
    </div>
    <div>
        <?php include('./show.php'); ?>
    </div>
</body>
</html>