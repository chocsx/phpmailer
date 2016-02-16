<?php

$resp = new stdclass();

	require 'phpmailer/class.phpmailer.php';
	require 'phpmailer/class.smtp.php';

try{
	
	$unidade = $_POST['unidade'];
	
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$fone = $_POST['fone'];
	$cidade = $_POST['cidade'];
	$data = $_POST['data'];
	$interesse = $_POST['interesse'];
	$assunto = $_POST['assunto'];
	$comentario = $_POST['comentario'];
	
	

			$mail = new PHPMailer;
			$mail->IsHTML(true);
			$AdminEmail = 'contato@cetelbras.com.br';
			$AdminName = 'CetelBras Educacional';

			$mail->Sender  = "{$email}";
			$mail->SetFrom($email,$nome);
			$mail->CharSet = 'utf-8';
			$mail->AddAddress($AdminEmail, $AdminName);
			$mail->Subject  = "Contato Via WebSite | CetelBras Educacional";
			$body = "
							<strong>Unidade:</strong>{$unidade}<br />
							<strong>Nome:</strong>{$nome}<br />
							<strong>E-mail:</strong> {$email}<br />
							<strong>Fone:</strong>{$fone}<br />
							<strong>Cidade:</strong>{$cidade}<br />
							<strong>Data:</strong>{$data}<br />
							<strong>Interesse:</strong>{$interesse}<br />
							<strong>Assunto:</strong>{$assunto}<br />
							<strong>Comentario:</strong>{$comentario}<br />	";

			$mail->Body = $body;
			$mail->MsgHTML($body);
			$mail->Send();

	$resp->success = true;
	$resp->msg = "Formulário enviado com sucesso.";

}catch (Exception $e) {

	$resp->success = false;
	$resp->msg = $e->getMessage();
	$resp->line = $e->getLine();
}
echo json_encode($resp,JSON_HEX_QUOT);