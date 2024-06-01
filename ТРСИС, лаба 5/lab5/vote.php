<?php
$COOKIE_EXPIRES_AFTER = 60606006;
if (!empty($_POST['vote'])) {
	$result = $_POST['vote'];
	if (!empty($_COOKIE['votes'])) {
		$currentVotes = json_decode($_COOKIE['votes'], true);
		$currentVotes[$result] += 1;
	} else {
		$currentVotes = [];
		$currentVotes[$result] = 1;
	}
	setcookie('votes', json_encode($currentVotes), time() + $COOKIE_EXPIRES_AFTER);
}

header("Location: ./diagram.php");