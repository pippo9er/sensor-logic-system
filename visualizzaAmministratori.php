<?php
	require 'config.php';
    include_once 'QueryVisualizzaUtente.php';
    include_once 'Autenticazione.php';
    
	$autentica= new Autenticazione();
    $autentica-> autenticazione();
    ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="generator" content="AlterVista - Editor HTML"/>
  <title></title>
  <link href="adminDesktop.css" media="only screen and (min-width: 401px)" rel="stylesheet" type="text/css">
  <link href="adminMobile.css" media="only screen and (max-width: 400px)" rel="stylesheet" type="text/css">
</head>
<body>
	<br />
	<span class="visClient">Visualizza Amministratori</span>
    <br /><br />
      <div class="contenitoreFiltri">
      	<form class="form"  action="visualizzaAmministratori.php" method="post">
        <?php
        include_once 'Layout.php';
         
          
                    	require 'config.php';
                        $conn='';
                        $query='';
            			$viewamm= new QueryVisualizzaUtente();
                		$query=$viewamm->viewutente($_POST['id'],$_POST['nome'],$_POST['cognome'], $_POST['email'],$_POST['citta'], 'a');
                
                        $visualamm= new QueryVisualizzaUtente();
                         $layoutS= new Layout();
                        $stampa = '';
                        if($stampa === '') {
                          $stampa = $layoutS->layoutSearch($id, $nome, $cognome, $email, $citta);
                        }
                        echo $stampa;
                        if($conn === '') {
                            $conn = new mysqli($servername, $user, $pass, $database);
                        }
                        if(isset($query) === true) {
                        	$query= $visualamm-> visualizzaut($query, mysqli_real_escape_string($conn, $id),mysqli_real_escape_string($conn, $nome),mysqli_real_escape_string($conn, $cognome), mysqli_real_escape_string($conn, $email), mysqli_real_escape_string($conn, $citta));
						}            

                        $result = '';
                        if(isset($_SESSION['email']) === true && isset($_SESSION['password']) === true ) {
                        	$result = $conn->query($query);
                        }  
                        
                        $tabquery= new QueryVisualizzaUtente();
                        $tabquery->tablequery($result);
                    ?>
         </form>
      </div>
</body>
</html>