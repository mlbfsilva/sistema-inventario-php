<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])){

    if(strlen($_POST['email']) == 0){
        echo '<p class="error-message">Preencha o campo "E-mail"</p>';
    }else if(strlen($_POST['senha']) == 0){
        echo '<p class="error-message">Preencha o campo "Senha"</p>';
    }else{
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die('<p class="error-message">Falha na execução da requisição ao banco de dados: '. $mysqli->error . '</p>');

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1){

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header('Location: template.php');
            exit(); 
        } else {
            echo '<p class="error-message">Falha ao logar. As credenciais estão incorretas, tente novamente ou contate o administrador.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../sistema/css/login.css">
</head>
<body>
    
  </body>
  <header>
     <h1>Sistema Inventário - SPO</h1>
  </header>
    <section>
        <form action="" class="form-login" method="post">
        <div class="form-login">
            <h3>Login</h3>
            <p>Insira os Dados a baixo para entra:</p>
            <p>
            <label class="label-form">E-mail:</label>
                <input type="text" class="input-form" name="email">
            </p>
            <p>
                <label class="label-form">Senha:</label>
                <input type="password" class="input-form" name="senha">
            </p>
            <p>
                <button type="submit" class="button-login">Entrar</button>
            </p>
        </div>
    </form>
    </section>
    
</body>
</html>