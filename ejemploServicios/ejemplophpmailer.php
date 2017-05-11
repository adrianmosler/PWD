<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
//error_reporting(E_STRICT);


require_once('libs/PHPMailer_5.2.1/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = '<body style="margin: 10px;">
			<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
			<br>
			&nbsp;Mail de Test.<br>
			<br>
			PHPMailer: HOLA.................<br />
			</div>
			</body>';


$mail->IsSMTP(); // telling the class to use SMTP

$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "midireccion@gmail.com";  // GMAIL username
$mail->Password   = "miclave";            // GMAIL password

/* Para enviar por gmail se debe habilitar la extencion openssl */
$mail->SetFrom('midireccion@gmail.com', 'Prueba Dinamica');
$mail->AddAddress('midireccion@gmail.com','Nombre Destino');
$mail->Subject    = "PHPMailer Ejemplo de Uso";

$mail->AltBody    = "El mensaje tiene contenido HTML"; // optional, comment out and test

$mail->MsgHTML($body);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
