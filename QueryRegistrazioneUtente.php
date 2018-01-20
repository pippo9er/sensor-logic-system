<?php
class QueryRegistrazioneUtente{
	function reginviomail($email,$psw, $csrf){
    
    		$str = '<span class="filtra">Registrazione riuscita</span>';
                        echo $str;
                        $nome_mittente = 'SensorLogicSystem';
                        $mail_mittente = 'sensorlogicsystem@gmail.com';
                        $mail_oggetto = 'Benvenuto/a nella nostra azienda';
                        $mail_headers = 'From: ' .  $nome_mittente . ' <' .  $mail_mittente . '>\r\n';
                        $mail_headers .= 'Reply-To: ' .  $mail_mittente . '\r\n';
                        $mail_corpo = 'Gentile cliente, la ringraziamo per averci scelto. Ecco di seguito le sue credenziali per poter accedere ai suoi servizi. Password: '.$psw;

                        $regexemail = '/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/';
						$send = false;
                        if (preg_match($regexemail, $email) === 1) {
                        	if($csrf->check(CSRF, $_POST, false, SIZE, true) === true){
                        		$send = mail($email, $mail_oggetto, $mail_corpo, $mail_headers);
                            }
                        }
                        if($send === true){
                        	$str = '<br /><span class="filtra">E-mail inviata al cliente</span>';
                            echo $str;
                        } else {
                        	$str = '<br /><span class="filtra">'."Invio dell'e-mail non riuscito".'</span>';
                            echo $str;
                        }
    }
    				
}