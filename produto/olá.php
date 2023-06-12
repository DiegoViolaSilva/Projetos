<?php

include "conexa.php";

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lojinha</title>
  <link rel="stylesheet" type="text/css" href="css/footer.css" />
  <link rel="stylesheet" type="text/css" href="sei.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary" class=" bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Lojinha</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">


        </ul>
        <form class="d-flex" role="search">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="user/login.php">entrar</a>
            </li>
        </form>
      </div>
    </div>
  </nav>
  <!-- ---------------------------------------------------------------------------------------------------------------- -->


  <!-- ------------------------------------------------------------------------------------------- -->
  <br><br><br>




  <?php
  $stmt = $conexao->prepare("SELECT * FROM produtos Order By Rand() Limit 6");
  ($stmt->execute());

  $count = 0;
  $newRow = true;

  while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {

    $diretorio = 'imagens/' . $rs->id . '/' . $rs->imagem;

    if ($newRow) {
      echo ' <div class="row row-cols-1 row-cols-md-3 g-4">';
      $newRow = false;
    }


  ?>
    <div class="col">
      <div class="card h-100">
        <img src="<?php echo $diretorio; ?>" class="card-img-top" alt="..." style="width:60%; height: 75%";>
        <div class="card-body">
          <h5 class="card-title" ><?php echo $rs->nome_do_produto; ?></h5>
        
          <p class="card-text"><?php echo $rs->descriao; ?></p>
        </div>
        <div class="card-footer ">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Comprar
          </button>
        </div>
      </div>
    </div>
<br>
    <?php

    $count++;

    if ($count == 3) {
 
      echo '</div>';
      $newRow = true;
      $count = 0;
    }

    ?>

  <?php } ?>
  <!--modal de compra   -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
    <!-- modal de compra  -->

    <!-- footer -->
    <br>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>