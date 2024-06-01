<?php
$COOKIE_EXPIRES_AFTER = 606066;

setcookie('current_question', -1, time() + $COOKIE_EXPIRES_AFTER);

header("Location: ./index.php");