<?php
include "conexao.php";
 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome_do_produto = (isset($_POST["nome_do_produto"]) && $_POST["nome_do_produto"] != null) ? $_POST["nome_do_produto"] : "";
    $preco = (isset($_POST["preco"]) && $_POST["preco"] != null) ? $_POST["preco"] : "";
    $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : NULL;
} else if (!isset($id)) {   
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome_do_produto = NULL;
    $preco = NULL;
    $descricao = NULL;
}


                                                      
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome_do_produto != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE produtos SET nome_do_produto=?, preco=?,descricao=? WHERE id = ?");
            $stmt->bindParam(4, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO produtos (nome_do_produto, preco, descricao) VALUES (?, ?, ?)");
        }
        $stmt->bindParam(1, $nome_do_produto);
        $stmt->bindParam(2, $preco);
        $stmt->bindParam(3, $descricao);
 
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {

            // echo '<script type="text/javascript">'; 
            //  echo 'alert("Dados Alterados com sucesso!");'; 
            //  echo 'window.location.href = "http://localhost/meus%20projetos/produto/produtos.php";';
            //  echo '</script>';

             echo '<script> $(function() {
             var toastElList = [].slice.call(document.querySelectorAll(".toast"))
             var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl)
               })
               toastList.forEach(toast => toast.show())
               };</script>'; 
             
                $id = null;
                $nome_do_produto = null;
                $preco= null;
                $descricao = null;
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
  try {
      $stmt = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
      $stmt->bindParam(1, $id, PDO::PARAM_INT);
      if ($stmt->execute()) {
          $rs = $stmt->fetch(PDO::FETCH_OBJ);
          $id = $rs->id;
          $nome_do_produto = $rs->nome_do_produto;
          $preco = $rs->preco;
          $descricao = $rs->descricao;
      } else {
          throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
  } catch (PDOException $erro) {
      echo "Erro: ".$erro->getMessage();
  }
}
 
?>

<!DOCTYPE html>
<html lang ="pt-br">
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 ">
    <title>Produto</title>
    <link rel="stylesheet" type="text/css" href="sei.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head >

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary"  class=" bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Lojinha</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span> 
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Busca" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Pesquisa</button>
        </form>
      </div>
    </div>
  </nav>  
<!-- ----------------------------------------------------------------------------------------------------------------- -->


<div class="toast show " role="alert" aria-live="assertive" aria-atomic="true" style='position:absolute;margin-left:10px;margin-top:10px;width:300px;height:140px;z-index:1'>
        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
  <div class="toast-body">
            <strong>Dados alterados com sucesso!!</strong>
    <div class="mt-2 pt-2 border-top">
      <a href = "produtos.php"><button type="button" class="btn btn-primary btn-sm">Voltar</button></a>
     
    </div>
  </div>
</div>
      <br>
<!-- ----------------------------------------------------------------------------------------------------------------- -->


<form  class="formulario" action="?act=save" method="POST" name="form1" >

  <h1 class="title"><i class="icon icon-mail-1"></i>Alteração do Produto</h1> 
            <hr>
            <input type="hidden" name="id"
             <?php
            if (isset($id) && $id != null || $id != "") {
                echo "value=\"{$id}\"";
            }
            ?> />
          
            <label class="label">
            Nome do produto:
            <input type="text" name="nome_do_produto" class="campo" placeholder="Digite seu nome" required="" 
            <?php
            if (isset($nome_do_produto) && $nome_do_produto != null || $nome_do_produto != ""){
                echo "value=\"{$nome_do_produto}\"";
            }
            ?> />

            </label>
            <label class="label">
            Preço:
            <input type="text" name="preco" class="campo" placeholder="R$--/--" required=""
            <?php
            if (isset($preco) && $preco!= null || $preco != ""){
                echo "value=\"{$preco}\"";
            }
            ?> />

             </label>
            <label class="label">
            Descrição:
            <textarea name="descricao" class="campo" placeholder="Descrição do produto" required=""
            <?php
            if (isset($descricao) && $descricao!= null || $descricao != ""){
                echo "value=\"{$descricao}\"";
            }
            ?>></textarea>

          
        </label>

       
          <label class="label">
        <input type="submit" value="Alterar"  />

      
  
   
          <!-- <div class="toast show">
  <div class="toast-header">
    Alteração
    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
  </div>
  <div class="toast-body">
 Alterado com sucesso
  </div>
</div> -->
        
           <hr>
          </label>
        
        </form>
         </table>
      


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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">


</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>