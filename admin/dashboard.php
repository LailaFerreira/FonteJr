<?php

require_once dirname(__FILE__) . "/classes/login.class.php";

$login = new Login();
$login->mustBeLogged();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Fonte Jr. Controle de Presença</title>
</head>
<body>
	<h1>Olá, <?php echo $login->getUserName(); ?></h1>
	<a href="logout.php">Sair</a>

</body>
</html>