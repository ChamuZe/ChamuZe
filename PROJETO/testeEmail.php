<?php
$para = "julianaaparecidavecchi@gmail.com";
$assunto = "Teste envio de E-mail";
$mensagem = "A mensagem que você deseja enviar vai aqui!";
$headers = 'From: aaaparecidajuliana@gmail.com' . "\r\n" . 'Reply-To: aaaparecidajuliana@gmail.com';

mail($para, $assunto, $mensagem, $headersder);

print "Enviado!";
?>