<?php
// Incluir o arquivo que possui a conexão com banco de dados
include_once './conexao.php';
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Celke - Carousel</title>

    <!-- Incluir o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <?php
    // QUERY para recuperar os slides do banco de dados
    $query_slides = "SELECT id, imagem FROM slides WHERE situacao_id = 1";

    // Preparar a QUERY
    $result_slides = $conn->prepare($query_slides);

    // Executar a QUERY
    $result_slides->execute();

    // Contar a quantidade de registro recuperado do BD
    //$quantidade_slides = $result_slides->rowCount();
    //var_dump($quantidade_slides);

    ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

        <!-- Início indicadores para navegar nos slides do carousel -->
        <div class="carousel-indicators">
            <?php
            $controle = 0;
            while($controle < $result_slides->rowCount()){
                $ativo = "";
                if($controle == 0){
                    $ativo = "active";
                }
                echo "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='$controle' class='$ativo'
                aria-current='true' aria-label='Slide $controle'></button>";
                $controle++;
            }
            ?>
        </div>
        <!-- Fim indicadores para navegar nos slides do carousel -->

        <!-- Início slide carousel -->
        <div class="carousel-inner">
            <?php
            $controle = 0;
            while($row_slide = $result_slides->fetch(PDO::FETCH_ASSOC)){
                //var_dump($row_slide);
                extract($row_slide);
                $ativo = "";
                if($controle == 0){
                    $ativo = "active";
                }
                echo "<div class='carousel-item $ativo'>";
                echo "<img src='imagens/$id/$imagem' class='d-block w-100' alt='Categoria 1'>";
                echo "</div>";
                $controle++;
            }
            ?>
            <!--<div class="carousel-item active">
                <img src="imagens/1/banner_top_v1.jpg" class="d-block w-100" alt="Categoria 1">
            </div>
            <div class="carousel-item">
                <img src="imagens/2/banner_top_v2.jpg" class="d-block w-100" alt="Categoria 2">
            </div>
            <div class="carousel-item">
                <img src="imagens/3/banner_top_v3.jpg" class="d-block w-100" alt="Categoria 3">
            </div>-->
        </div>
        <!-- Fim slide carousel -->

        <!-- Início anterior e próximo slide carousel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <!-- Fim anterior e próximo slide carousel -->

    </div>

    <!-- Incluir o JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>