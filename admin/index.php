<?php

require_once dirname(__FILE__) . "/classes/login.class.php";

$login = new Login();
$login->redirectToDashboardIfLogged();

header("location: login.php");

?>