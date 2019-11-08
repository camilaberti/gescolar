<?php
if (isset($_REQUEST['sair'])) {

unset($_SESSION['gescolar_dados_usuario']);
header("location: login.php");
}

if(isset($_SESSION['gescolar_dados_usuario'])) {

    header ("location: login.php");
}

$usuario = $_SESSION['gescolar_dados_usuario'];

?>

<!DOCTYPE html>
<html>
    <head>
         <link href = "css/estilos.css" type= "text/css" rel= "stylesheet" />

    </head>
    <body>
        <div id ="global">

           <h1>GESCOLAR <small>, Bem-vindo <?= $usuario['nome'] ?> </small> </h1>

            <?php include_once 'includes/cabecalho.php' ?>
        </div>
    </body>
</html>
