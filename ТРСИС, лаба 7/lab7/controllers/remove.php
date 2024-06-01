<?php
require_once('../autoload.php');

use lab7\CatalogManager;

$catalogManager = new CatalogManager();
$catalogManager->remove($_POST['remove']);