<?php
//include ("PHPMailer_5.2.0/class.phpmailer.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/PHPMailer_5.2.0/class.phpmailer.php';
require_once 'conectar_a_bbdd.php';
$base_url = $_SERVER['USER'];
$query = "SELECT email_rep, empresa, nif, tipo_tramite, convocatoria FROM pindust_expediente WHERE  id = " . $_POST["id"];
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
       $correoDestino = $row["email_rep"];
       $solicitante = $row["empresa"];
       $nif = $row["nif"];
       $tipoTramite = $row["tipo_tramite"];
       $convocatoria = $row["convocatoria"];
    }
} else {
    echo "0";
}
$mail = new PHPMailer();
// set mailer to use SMTP
$mail->IsSMTP();

// As this email.php script lives on the same server as our email server
// we are setting the HOST to localhost
//$mail->SMTPSecure = 'tls';
$mail->Host = "localhost";  // specify main and backup server
$mail->CharSet = 'UTF-8';
$mail->XMailer = 'ADR Balears';
$mail->SMTPAuth = true;     // turn on SMTP authentication
// When sending email using PHPMailer, you need to send from a valid email address
// In this case, we setup a test email account with the following credentials:
// email: send_from_PHPMailer@bradm.inmotiontesting.com
// pass: password

if ($base_url === "pre-tramitsidi") {
    $mail->Username = "pre-tramits@pre-tramits.idi.es";  // SMTP username
} else {
    $mail->Username = "tramits@tramits.idi.es";  // SMTP username
}
$mail->Password = "Lvsy2r7[4,4}*1"; // SMTP password
$mail->Port = 587; //el puerto smtp
$mail->SMTPDebug = 0;
if ($base_url === "pre-tramitsidi") {
    $mail->From = "pre-tramits@pre-tramits.idi.es";  // SMTP username
    $mail->FromName = "PRE-ADR Balears";
} else {
    $mail->From = "tramits@tramits.idi.es";  // SMTP username
    $mail->FromName = "ADR Balears";
}
// Lo que verá del remitente el destinatario
if ($base_url === "pre-tramitsidi") {
    $mail->SetFrom("noreply@pre-tramits.idi.es","PRE-ADR Balears");
} else {
    $mail->SetFrom("noreply@tramits.idi.es","ADR Balears");
}
// La dirección a la que contestará el destinatario
if ($base_url === "pre-tramitsidi") {
    $mail->AddReplyTo("response@pre-tramits.idi.es","PRE-ADR Balears"); 
} else {
    $mail->AddReplyTo("response@tramits.idi.es","ADR Balears"); 
}

// Con copia oculta
$mail->AddBCC("illado@idi.caib.es", "Servei de Politica Indústrial");
// El destinatario.
$mail->AddAddress($correoDestino, $correoDestino);
$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);

$mail->CharSet = 'UTF-8'; 
$mail->Subject = "Justificar xecs de consultoria Illes Balears - ADR Balears";
$mensajeLayout = file_get_contents('contents-justificacion.html');
$mensajeLayout = str_replace("%ID%", $_POST["id"], $mensajeLayout);
$mensajeLayout = str_replace("%NIF%", $nif, $mensajeLayout);
$mensajeLayout = str_replace("%TIPOTRAMITE%", $tipoTramite, $mensajeLayout);
$mensajeLayout = str_replace("%CONVOCATORIA%", $convocatoria, $mensajeLayout);

$mail->msgHTML( $mensajeLayout , __DIR__);

//Replace the plain text body with one created manually
$mail->AltBody = $mensajeLayout;

if(!$mail->Send())
{
	$result = "Message could not be sent.";
	$result .= "Mailer Error: " . $mail->ErrorInfo;
	$mail->ClearAddresses();
	$mail->ClearAttachments(); 
}
else 
{
/* 	$fechaLimJustificar = date_create(date("Y-m-d"));
    date_add($fechaLimJustificar,date_interval_create_from_date_string("20 days"));
    $result = "<strong>S'ha enviat el formulari de justificació a la adreça de notificació: " .$correoDestino."</strong>";
    $query = "UPDATE pindust_expediente SET situacion = 'pendienteJustificar', fecha_limite_justificacion =".$fechaLimJustificar."  WHERE  id = " . $_POST["id"];
    echo $query;
    $result = mysqli_query($conn, $query); */
    $result = "<strong>S'ha enviat el formulari de justificació a la adreça de notificació: " .$correoDestino."</strong>";
}

echo $result;
?>