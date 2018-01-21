<?php
class QueryModificaUtente{
	function modificaut($cf, $cognome, $nome, $sesso, $telefono, $datadinascita, $citta, $indirizzo, $numcivico,$provincia, $cap, $email,$id2){
    require 'config.php';
    $conn = new mysqli($servername, $user, $pass, $database);
       $query=sprintf("UPDATE utente SET cf='%s', cognome='%s', nome='%s', sesso='%s', telefono='%s', datadinascita='%s', citta='%s', indirizzo='%s', numcivico='%s', provincia='%s', cap='%s' WHERE id='%s'",mysqli_real_escape_string($conn, $cf),mysqli_real_escape_string($conn, $cognome),mysqli_real_escape_string($conn, $nome),mysqli_real_escape_string($conn, $sesso),mysqli_real_escape_string($conn, $telefono),mysqli_real_escape_string($conn, $datadinascita),mysqli_real_escape_string($conn, $citta),mysqli_real_escape_string($conn, $indirizzo),mysqli_real_escape_string($conn, $numcivico),mysqli_real_escape_string($conn, $provincia),mysqli_real_escape_string($conn, $cap),mysqli_real_escape_string($conn, $id2));
                
                $result = $conn->query($query);
                $query=sprintf("UPDATE credenziale SET email='%s' WHERE utente='%s'",mysqli_real_escape_string($conn, $email),mysqli_real_escape_string($conn, $id2));
                $result2 = $conn->query($query);
				if($result === false || $result2 === false) {
                	$str =  '<span class="filtra">Impossibile salvare, controllare le modifiche effettuate</span>';
                    echo $str;
                } else {
                	$str = '<span class="filtra">Modifiche salvate con successo</span>';
                    echo $str;
                }
	}
}