<?php
//form must have enctype="multipart/form-data" attr
$resp = new stdclass();

	require 'phpmailer/class.phpmailer.php';
	require 'phpmailer/class.smtp.php';

try{
	
	$unidade = $_POST['unidade'];
	
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$fone = $_POST['fone'];
	$data = $_POST['data'];
	$cidade = $_POST['cidade'];
	$interesse = $_POST['interesse'];
	$comentario = $_POST['comentario'];
	
	$arquivo = $_FILES["anexo"];
	if ($_FILES['anexo']['error']!=0) throw new Exception("Selecione o currículo.");
	
	

			$mail = new PHPMailer;
			$mail->IsHTML(true);
			$AdminEmail = 'contato@cetelbras.com.br';
			$AdminName = 'CetelBras Educacional';

			$mail->Sender  = "{$email}";
			$mail->SetFrom($email,$nome);
			$mail->CharSet = 'utf-8';
			$mail->AddAddress($AdminEmail, $AdminName);
			$mail->AddAttachment($_FILES['anexo']['tmp_name'],$_FILES['anexo']['name']);
			$mail->Subject  = "Trabalhe Conosco | CetelBras Educacional";
			$body = "		<strong>Unidade:</strong>{$unidade}<br />
							<strong>Nome:</strong>{$nome}<br />
							<strong>E-mail:</strong> {$email}<br />
							<strong>Fone:</strong>{$fone}<br />
							<strong>Cidade:</strong>{$cidade}<br />
							<strong>Data:</strong>{$data}<br />
							<strong>Interesse:</strong>{$interesse}<br />
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