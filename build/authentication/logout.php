<?php
session_start();
session_unset();
setcookie('remember_token', '', time() - 3600, '/', '', true, true);
header("Location: index.php");
