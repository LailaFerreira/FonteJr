<?php

$nome    = isset($_POST["name"]) ? $_POST["name"] : "";
$email   = isset($_POST["email"]) ? $_POST["email"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";

if(empty($nome) || empty($email) || empty($message)){
	echo "0";
} else {
	echo "1";
	sendAndSave($nome, $email, $message);
}


function sendAndSave($nome, $email, $message){
	$content =  $nome."\n".$email."\n".$message;
	file_put_contents(dirname(__FILE__) . "/messages/".date("YmdHis").".txt",$content);

	$to      = 'laila.orsayferreira@gmail.com';
	$subject = 'Contato Fonte Jr - Site';
	$headers = 'From: site@fontejr.com' . "\r\n" .'Reply-To: site@fontejr.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $content, $headers);
}
?>

