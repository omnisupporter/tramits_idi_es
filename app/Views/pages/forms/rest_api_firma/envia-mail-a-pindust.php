<?php
include ("PHPMailer_5.2.0/class.phpmailer.php");
$empresa = $_POST["empresa"];
$nif = $_POST["nif"];
$domicilio = $_POST["domicilio"];
$nom_consultor = $_POST["nom_consultor"];
$emailDest = "ignacio.llado@idi.es";
$tel_consultor = $_POST["tel_consultor"];

$firma = lang('message_lang.firma');
$firma .= "<p>Tel. 971 17 65 65</p>";

$notalegal = "<label class='c1_ctl' style='text-align:left;font-size:9px;'>";
$notalegal .= lang('message_lang.rgpd_txt');
$notalegal .= lang('message_lang.notalegal');
$notalegal .= lang('message_lang.no_imprimir');
$notalegal .= "</label>";

//$mail = new PHPMailer();
	// set mailer to use SMTP
	$mail->IsSMTP();

	// As this email.php script lives on the same server as our email server
	// we are setting the HOST to localhost
	$mail->SMTPSecure = 'tls';
	$mail->Host = "smtp.gmail.com";  // specify main and backup server
	$mail->CharSet = 'UTF-8';
	$mail->XMailer = 'IDI';
	$mail->SMTPAuth = true;     // turn on SMTP authentication
// When sending email using PHPMailer, you need to send from a valid email address
	// In this case, we setup a test email account with the following credentials:
	// email: send_from_PHPMailer@bradm.inmotiontesting.com
	// pass: password
	$mail->Username = "notificacion@idi.es";  // SMTP username
	$mail->Password = "x5L4Sx@58"; // SMTP password
	$mail->Port = 587; //el puerto smtp
	$mail->SMTPDebug = 3;
	$mail->From = "notificacion@idi.es";
	$mail->FromName = "IDI";
	
	// Lo que verá del remitente el destinatario
	$mail->SetFrom("noreply@idi.es","IDI");
		
	// La dirección a la que contestará el destinatario
	$mail->AddReplyTo("pindust@idi.es","IDI");
	
	// Con copia oculta
	// $mail->AddBCC("pindust@idi.es", "Servei de Política Industrial");
	// El destinatario.
	$mail->AddAddress($emailDest, $emailDest);

$mail->WordWrap = 50;
	// set email format to HTML
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8'; 
	$mail->Subject = "iDigital - IDI";
	
	$email_message = "<!DOCTYPE html>";
	$email_message .= "<html lang='es'>";
	$email_message .= "<html>";
	$email_message .= "<head>";
	$email_message .= "<meta charset = 'utf-8'>";
    $email_message .= "<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>";
	$email_message .= "<title>iDigital - IDI</title>";
	$email_message .= "<link rel='stylesheet' href='https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css'>";
	$email_message .= "<script src='https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js'></script>";
	$email_message .= "</head>";
	$email_message .= "<body>";
	$email_message .= "<div class='container'>";
	$email_message .= "<table data-toggle='table'";
	$email_message .= "<tbody>";
	$email_message .= "<tr style='width:100%;text-align:left;'><td><span style='font-size: 14px;'>Nova sol·licitud de:</td></tr>";
	$email_message .= "<tr style='width:100%;text-align:left;'><td><a title='pindust.idi.es' href = 'http://pindust.idi.es/expedientes/edit/$last_insert_id'><strong>". $empresa ."</strong></a></span></td></tr>";
	$email_message .= "<tr style='width:100%;text-align:left;'><td><span style='font-size: 14px;'>".lang('message_lang.atentamente')."</span></td></tr>";

	$email_message .= "</tbody>";
	$email_message .= "</table>";
	$email_message .= $firma;
	$email_message .= $notalegal;
	$email_message .= "</div>";
	$email_message .= "</body>";
	$email_message .= "</html>";

	$mail->Body    = $email_message;
	$mail->AltBody = $email_message;

if(!$mail->Send())
{
	echo "Message could not be sent.";
	echo "Mailer Error: " . $mail->ErrorInfo;
	$mail->ClearAddresses();
	$mail->ClearAttachments(); 
	exit;
}
?>