<?php 
error_reporting(0);

$alert_success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div>Alteração feita  com sucesso!</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  </head>
  <body>

  <p class="descricao">Exemplo de texto</p>

<script>

    var publicacoes = $('.descricao');
    var textoComplementar = "&nbsp;";

    for (var i = 0; i < publicacoes.length; i++) {
        var restante = 299 - publicacoes[i].innerHTML.length;

        for (var j = 0; j < restante; j++) {
            publicacoes[i].innerHTML = publicacoes[i].innerHTML + textoComplementar;
        }

    }

</script>
    
  <?php
      echo $alert_error;
      echo $alert_success;
  ?>
    
    <button type="button" class="btn btn-primary" id="alert_success" >alert</button>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script> -->

</html>