
<!doctype html>
<html lang="en">
<head>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/signin.css" rel="stylesheet">

  <script src='js/jquery.min.js'></script>
  <script src='js/jquery-ui.min.js'></script>
  <script src='js/bootstrap.min.js'></script>
  <?php 
  include ("classes/mensagem.php");
  ?>
</head>

<body class="text-center">

  <form class="form-signin" method="POST" novalidate action="classes/validacao.php">

    <img class="mb-4" src="imagens/logo.jpg" alt="" width="72" height="72">

    <h1 class="h3 mb-3 font-weight-normal">Bem vindo</br></h1>
     <p> Agenda 2ª Auditoria da 3ª CJM</p>

   
        <?php 
        if (isset($_GET["erro"])){
          echo $mensagem_erro_acesso;
        }

        ?>

    <label for="login" class="sr-only">Login</label>
    <input type="text" id="login" style="margin-bottom: 10px" class="form-control" placeholder="Login" name="login" required autofocus>
    <label for="senha" class="sr-only">Senha</label>
    <input type="password" id="senha" class="form-control" placeholder="Senha" name="senha" required>
  
    <button class="btn btn-lg btn-info btn-block" type="submit" name="entrar">Logar</button>
  </form>
</p>
</body>
</html>
