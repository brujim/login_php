<?php
session_start();
ob_start();
include_once 'connection.php';

if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    header("Location: index.php");
    $_SESSION['msg'] = "<p style='color: red'>Erro: Você deve fazer o login para acessar a página!</p>";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
          <meta charset="UTF-8">
          <link rel="shortcut icon" href="images/favicon.ico" type="image/x-ico">
          <title>Simple login page in PHP</title>
    </head>
    <body>
        <h1>Bem vindo <?php echo $_SESSION['nome'] ?>!</h1>
        <a href="logout.php">Logout</a>
    </body>
</html>