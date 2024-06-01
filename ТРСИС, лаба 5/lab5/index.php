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

    <img src="/lab5/images/votes.png?v=<?php echo time() ?>" alt="#" style="float: right">

	<form action="/lab5/vote.php" method="POST">

		<input id="c1" type="radio" name="vote" value="60E"/>
        <label for="c1">60E</label>
        <br>

		<input id="c2" type="radio" name="vote" value="74C"/>
        <label for="c2">74C</label>
        <br>

		<input id="c3" type="radio" name="vote" value="75B"/>
        <label for="c3">75B</label>
        <br>

		<input id="c4" type="radio" name="vote" value="89B"/>
        <label for="c4">89B</label>
        <br>

		<input id="c5" type="radio" name="vote" value="90A"/>
        <label for="c5">90A</label>
        <br>

		<input id="c6" type="radio" name="vote" value="100A"/>
        <label for="c6">100A</label>
        <br>
        <br>

        <button type="submit">Голосовать</button>

	</form>
</body>
</html>