<?php

include './download_module.php';

$zip = new ZipArchive();
$zip->open("./archive.zip");
$zip->extractTo(__DIR__, [$_GET['file']]);

file_download($_GET['file']);

unlink($_GET['file']);

die();