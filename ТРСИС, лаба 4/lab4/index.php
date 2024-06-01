<?php

if (isset($_COOKIE['questions']) && isset($_COOKIE['current_question'])) {
	$questions = json_decode(gzinflate($_COOKIE['questions']));
	$questionNumber = intval($_COOKIE['current_question']);
	if (isset($questions[$questionNumber])) {
		header("Location: ./question.php");
	}
}

include 'board.php';

