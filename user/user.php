<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>User</title>
    <link rel="stylesheet" type="text/css" href="footer.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
  </head>
  <body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary"  class=" bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Lojinha</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Usuario/login.php">entrar</a>
          </li>

          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Busca" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Pesquisa</button>
          </form>
        </div>
      </div>
    </nav> 

    <br><br>

    <h1 class="my-5">Oi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bem vindo ao nosso site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Redefina sua senha</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sair da conta</a>
    </p>




    <br> <br>
    <br> <br>
    <br> <br>
    <br> <br>
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h3>Contato</h3>
              <p>Endereço: Rua Tal, 123 - Bairro X - Cidade/Estado - CEP: 00000-000</p>
              <p>Telefone: (00) 0000-0000 | E-mail: contato@nomedaempresa.com.br</p>
            </div>
            <div class="col-md-6">
              <h3>Links importantes</h3>
              <ul>
                <li><a href="#">Sobre nós</a></li>
                <li><a href="#">Política de privacidade</a></li>
                <li><a href="#">Termos e condições</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
      
</body>
</html>