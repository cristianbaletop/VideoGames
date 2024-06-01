<?php
$COOKIE_EXPIRES_AFTER = 60606006;

$currentQuestion = intval($_COOKIE['current_question']);
$nextQuestionNumber = $currentQuestion + 1;

if ($nextQuestionNumber < 10) {
	$userAnswer = intval($_POST['question']);
	$questions = json_decode(gzinflate($_COOKIE['questions']));
	$targetQuestion = $questions[$currentQuestion];
	$currentAttemptId = intval($_COOKIE['attempt_id']);
	if (isset($_COOKIE['attempts']) && $_COOKIE['attempts']) {
		$userAttemptsArray = json_decode($_COOKIE['attempts'], true);
		$currentAttempt = $userAttemptsArray[$currentAttemptId];
	} else {
		$userAttemptsArray = [];
		$currentAttempt = [];
	}
	$currentAttempt[] = [
		'user_answer' => $userAnswer,
		'target_answer' => $targetQuestion->answer,
		'question' => $targetQuestion->question[0]
	];
	$userAttemptsArray[$currentAttemptId] = $currentAttempt;
	setcookie('attempts', json_encode($userAttemptsArray), time() + $COOKIE_EXPIRES_AFTER);
	setcookie('current_question', $nextQuestionNumber, time() + $COOKIE_EXPIRES_AFTER);
	header("Location: ./question.php");
} else {
	date_default_timezone_set('Europe/Moscow');
	$fileName = bin2hex(openssl_random_pseudo_bytes(10)) . '.txt';
	file_put_contents($fileName, "Ваше имя: " . $_COOKIE['name']. "\n");
	file_put_contents($fileName, "Попытка тестирования. ID: " . $_COOKIE['attempt_id']. "\n", FILE_APPEND);
	file_put_contents($fileName, "Время тестирования: " . date('d.m.Y h:i:s a', time()) . "\n\n", FILE_APPEND);
	$currentAttemptId = intval($_COOKIE['attempt_id']);
	if (isset($_COOKIE['attempts']) && $_COOKIE['attempts']) {
		$userAttemptsArray = json_decode($_COOKIE['attempts'], true);
		$currentAttempt = $userAttemptsArray[$currentAttemptId];
		foreach ($currentAttempt as $key => $questionData) {
			$questions = json_decode(gzinflate($_COOKIE['questions']), true);
			$targetQuestion = $questions[$key]['question'];
			file_put_contents($fileName, "Вопрос: " . $questionData['question']. "\n", FILE_APPEND);
			file_put_contents($fileName, "Правильный ответ: " . $targetQuestion[intval($questionData['target_answer'])] . "\n", FILE_APPEND);
			file_put_contents($fileName, "Ваш ответ: " . $targetQuestion[intval($questionData['user_answer'])]. "\n\n", FILE_APPEND);
		}
	}

	$zip = new ZipArchive();
	$zip->open("./archive.zip", ZipArchive::CREATE);
	$zip->addFile($fileName);
	$zip->close();

	setcookie('attempt_id', null, time() + $COOKIE_EXPIRES_AFTER);
	setcookie('attempts', null, time() + $COOKIE_EXPIRES_AFTER);
	setcookie('questions', null, time() + $COOKIE_EXPIRES_AFTER);
	setcookie('current_question', null, time() + $COOKIE_EXPIRES_AFTER);
	?>

	Ссылка на скачивание результатов: <a href='./download.php?file=<?php echo $fileName ?>'>Скачать</a>
	<br>
	<a href="./index.php">Вернуться назад</a>
	<br><br>
	<?php
	echo nl2br(file_get_contents($fileName));
	unlink($fileName);
	?>
<?php
}


