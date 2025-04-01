<?php
session_start();
unset($_SESSION['Username']);
unset($_SESSION['Store']);
header(("location:Login.php"));
exit;
