<?php

include "conexao.php";
$id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";                                               

// if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
//   try {
//       $stmt = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
//       $stmt->bindParam(1, $id, PDO::PARAM_INT);
//       if ($stmt->execute()) {
//           $rs = $stmt->fetch(PDO::FETCH_OBJ);
//           $id = $rs->id;
//           $nome_do_produto = $rs->nome_do_produto;
//           $preco = $rs->preco;
//           $descricao = $rs->descricao;
//       } else {
//           throw new PDOException("Erro: Não foi possível executar a declaração sql");
//       }
//   } catch (PDOException $erro) {
//       echo "Erro: ".$erro->getMessage();
//   }
// }


  if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "" ) {
  try {
      $stmt = $conexao->prepare("DELETE FROM produtos WHERE id = ?");
      $stmt->bindParam(1, $id, PDO::PARAM_INT);
      if ($stmt->execute()) {
          echo "Registo foi excluído com êxito";
          $id = null;
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
    <title>Produtos</title>
    <link rel="stylesheet" type="text/css" href="sei.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head >
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #d4d4d4;
}
td button{
  text-align: right;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
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
<br>
<!-- ------------------------------------------------------------------------------------------ -->
<table>
                <tr>
                    <th>Nome do Produto</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                <?php
             
                try {
                    $stmt = $conexao->prepare("SELECT * FROM produtos");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo "<tr>";
                            echo "<td>".$rs->nome_do_produto ."</td><td>".$rs->preco."</td><td>".$rs->descricao
                                       ."</td><td><center><a href= \" editor.php ?act=upd&id=".$rs->id."\">[Alterar]</a>"
                                       ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                       ."<a href=\"?act=del&id=".$rs->id."\">[Excluir]</a></center></td>";
                            echo "</tr>";
                            
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: ".$erro->getMessage();
                }
                ?>
            </table>
  <!-- -------------------------------------------------------------------------------------------------------- -->
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
