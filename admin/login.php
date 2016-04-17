<?php

require_once dirname(__FILE__) . "/classes/login.class.php";

$message = "";

$login = new Login();
$login->redirectToDashboardIfLogged();

if(isset($_POST["sector"]) && isset($_POST["password"])){
	
	$login->enter($_POST["sector"], $_POST["password"]);

	if(! $login->isLogged())
		$message = "Login/Senha não existentes ou incorretos";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Fonte Jr. - Controle de Presença</title>
</head>
<body>
	<div>
		<form action="login.php" method="POST">
			<input type="text" placeholder="Setor" name="sector" />
			<input type="password" placeholder="Senha" name="password" />
			<input type="submit" value="Entrar" />
			<br/>
			<div style="color:#f00"><?php echo $message; ?></div>
		</form>
	</div>
</body>
</html>