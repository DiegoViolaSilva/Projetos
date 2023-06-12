<?php

include "conexa.php";

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lojinha</title>
  <link rel="stylesheet" type="text/css" href="css/footer.css" />
  <link rel="stylesheet" type="text/css" href="sei.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <style>
    .img {
      left: 200px;
      position: absolute;


    }

    #bord {
      border: 1px solid black;
      outline-style: double;
      height: 25%;
      width: 25%;
    }

    .hS {
      color: black;
      text-align: right;
      margin-bottom: 100px;
    }

    .p1 {
      color: black;
      text-align: right;
      margin-bottom: 100px;
    }

    #tam {
      width: 1250px;
      height: 450px;
      object-fit: fill;
    }
  </style>
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
  <div id="carouselExampleDark" class="carousel carousel-dark slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <?php
    $stmt = $conexao->prepare("SELECT * FROM produtos Order By Rand() Limit 3");
    ($stmt->execute());
    $count_01 = 0;
    $newRow_01 = true;


    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {

      $diretorio = 'imagens/' . $rs->id . '/' . $rs->imagem;


      if ($newRow_01) {
        echo '  <div class="carousel-inner">';
        $newRow_01 = false;
      }

    ?>


      <div class="carousel-item active" data-bs-interval="10000">
        <img src="<?php echo $diretorio; ?>" class="d-block w-50" alt="... " id="tam">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="hS"><?php echo $rs->nome_do_produto; ?></h5>
          <p class="p1"><?php echo $rs->preco; ?></p>
          <p class="p1"><?php echo $rs->descriao; ?></p>
        </div>
      </div>



      <?php

      $count_01++;

      if ($count_01 == 3) {

        echo '</div>';
        $newRow_01 = true;
        $count_01 = 0;
      }

      ?>

    <?php } ?>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
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
        <img src="<?php echo $diretorio; ?>" class="card-img-top h-180 w-259" alt="..." >
        <div class="card-body">
          <h5 class="card-title"><?php echo $rs->nome_do_produto; ?></h5>

          <p class="card-text"><?php echo $rs->descriao; ?></p>
        </div>
        <div class="card-footer ">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $rs->id; ?>">
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
      echo '<br>';
      $newRow = true;
      $count = 0;
    }

    ?>


    <!--modal de compra   -->
    <div class="modal fade" id="staticBackdrop<?php echo $rs->id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title text-center" id="myModalLabel"><strong><?php echo  $rs->nome_do_produto; ?></strong></h3>
          </div>
          <div class="modal-body">
            <div class="container">

              <div class=row>
                <div id="img-container" class="img">
                  <h6> <strong> Imagem: </strong> </h6>
                  <img src="<?php echo $diretorio; ?>" id="bord">
                </div>
              </div>

              <div class=row>
                <h6> <strong> Nome: </strong></h6>
                <p id="p"><?php echo $rs->nome_do_produto; ?></p>
              </div>
              <div class=row>
                <h6><strong> Preço: </strong></h6>
                <p id="p"><?php echo $rs->preco; ?></p>
              </div>
              <div class=row>
                <h6> <strong> Descrição: </strong></h6>
                <p id="p2"><?php echo $rs->descriao; ?> </p>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success">Comprar</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- modal de compra  -->
  <?php } ?>
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