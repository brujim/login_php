<?php
session_start();
ob_start();
include_once 'connection.php'
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
          <meta charset="UTF-8">
          <link rel="shortcut icon" href="images/favicon.ico" type="image/x-ico">
          <link rel="stylesheet" type="text/css" href="layout/style.css">
          <title>Simple login page in PHP</title>
    </head>
    <body>
        <h1>Login Panel</h1>

        <?php
        //Criptografar senha através da biblioteca do PHP
        //echo password_hash("xnhzmu53", PASSWORD_DEFAULT);
        ?>

        <?php
     
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // Não permite que o usuário logado retorne a página de login sem que faça logout
        if($_SESSION['id'] != NULL){
            header("Location: dashboard.php");
        }

        if(!empty($dados['SendLogin'])){
            $query_usuario = "SELECT id, nome, usuario, senha_usuario FROM usuarios WHERE usuario =:usuario LIMIT 1";
            $result_usuario = $conn->prepare($query_usuario);
            $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
            $result_usuario->execute();

            if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){
                    $_SESSION['id'] = $row_usuario['id'];
                    $_SESSION['nome'] = $row_usuario['nome'];
                    header("Location: dashboard.php");
                }else{
                    $_SESSION['msg'] = "<p style='color: red'; text-align: center>Erro: Usuário ou senha inválidos!</p>";
                }
            }else{
                $_SESSION['msg'] = "<p style='color: red; text-align: center'>Erro: Usuário ou senha inválidos!</p>";
            }
        }
        
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }           
        ?>
        <div id="formulario">
            <form method="POST" id="login">
                <label>User</label><br>
                <input type="text" name="usuario" id="box-login" placeholder="Insert your user login"><br><br>

                <label>Password</label><br>
                <input type="password" name="senha_usuario" id="box-pass" placeholder="Insert your user password"><br><br> 
                
                <input type="submit" value="Login" id="box-submit" name="SendLogin">
            </form>
        </div>
    </body>
</html>