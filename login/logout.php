<?php
session_start();

$_SESSION['login'] = FALSE;
$_SESSION['username'] = FALSE;
$_SESSION['alert'] = FALSE;
session_destroy();

header('Location: http://localhost/app-promethee');
