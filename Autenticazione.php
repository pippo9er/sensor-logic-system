<?php
class Autenticazione{
  function autenticazione(){
    require 'config.php';

        
        $conn = '';
        session_start();
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $query = sprintf("SELECT * FROM credenziale where email='".$email."' and password='".$password."'");
        if($conn === '') {
            $conn = new mysqli($servername, $user, $pass, $database);
        }
        $result = $conn->query($query);
        if($result === false || $result->num_rows !== 1){
                header('Location: http://sensorlogicsystemlogin.altervista.org/index.php');
        }
  }
}