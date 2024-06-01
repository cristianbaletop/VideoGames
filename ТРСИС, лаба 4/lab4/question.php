<?php

$isAvailableQuestion = false;
if (isset($_COOKIE['questions']) && isset($_COOKIE['current_question'])) {
	$questions = json_decode(gzinflate($_COOKIE['questions']));
	$questionNumber = intval($_COOKIE['current_question']);
	if (isset($questions[$questionNumber])) {
        $isAvailableQuestion = true;
	}
}
if (!$isAvailableQuestion) {
	header("Location: ./index.php");
}

$questions = json_decode(gzinflate(isset($_COOKIE['questions']) ? $_COOKIE['questions'] : "[]"));
$questionNumber = intval(isset($_COOKIE['current_question']) ? $_COOKIE['current_question'] : 1);
$question = $questions[$questionNumber];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вопрос №<?php echo $questionNumber + 1 ?></title>
</head>
<body>
<div>
    <div>
        Ваш прогресс <?php echo $questionNumber ?> из <?php echo count($questions) ?> вопросов:
    </div>
    <progress id="file" max="<?php echo count($questions) ?>" value="<?php echo $questionNumber ?>"> 70% </progress>
</div>
<form action="./give_answer.php" method="post">
    <h1><?php echo $question->question[0] ?></h1>
	<?php for ($i = 1; $i < count($question->question); $i++): ?>
      <input
        type="radio"
        name="question"
        id="q-<?php echo $i ?>"
        value="<?php echo $i ?>"
        <?php if ($i === 1) echo 'checked autofocus' ?>
      >
      <label for="q-<?php echo $i ?>">
        <?php echo $question->question[$i] ?>
      </label>
        <br>
	<?php endfor ?>
    <br><br>
    <div>
        <button type="submit">Ответить</button>
    </div>
</form>
<br>
<form action="./cancel.php">
    <button>Мне надоело</button>
</form>
</body>
</html>
