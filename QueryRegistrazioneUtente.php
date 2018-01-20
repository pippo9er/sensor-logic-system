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
    
    function addutente($cf, $cognome, $nome, $sesso, $telefono, $datadinascita, $citta, $indirizzo, $numcivico, $provincia, $cap, $dataregistrazione, $email, $csrf){
   				require 'config.php';
                
                $query = sprintf("insert into utente (cf, cognome, nome, sesso, telefono, datadinascita, citta, indirizzo, numcivico, provincia, cap, dataregistrazione) values ('".$cf."','".$cognome."','".$nome."','".$sesso."','".$telefono."','".$datadinascita."','".$citta."','".$indirizzo."','".$numcivico."','".$provincia."',".$cap.",'".$dataregistrazione."')");
               	            
            	$conn = new mysqli($servername, $user, $pass, $database);
                $result = $conn->query($query);
                if($result !== false) {
               
                	$query = sprintf("select id from utente where cf = '".$cf."'");
                	$result = $conn->query($query);
                    $row = mysqli_fetch_row($result);
                    $id= $row[0];
                    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
   					$pass = array();
    				$alphaLength = strlen($alphabet) - 1;
    				for ($i = ZERO; $i < OTTO; $i++) {
       	 				$n = rand(0, $alphaLength);
       					$pass[] = $alphabet[$n];
   					}
   					$psw = implode($pass);
                    $query = sprintf("insert into credenziale (email, password, permesso, utente) values ('".$email."','".$psw."','a',".$id.')');
                    $result = $conn->query($query);
                    if($result !== false) {
                    	$mailregistrazione= new QueryRegistrazioneUtente();
                        $mailregistrazione->reginviomail($email, $psw, $csrf);
                    } else {
                    	$query = sprintf("delete from utente where cf='".$cf."'");
                        $conn->query($query);
                    	$str = '<span class="filtra">Registrazione non riuscita</span>';
                        echo $str;
                    }
                } else {
                	$str = '<span class="filtra">Registrazione non riuscita</span>';
                    echo $str;
                }
    }
    				
}