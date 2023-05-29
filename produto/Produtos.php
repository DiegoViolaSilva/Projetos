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
    echo "Erro: " . $erro->getMessage();
  }
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
                          return new bootstrap.Toast(toastEl, option)
                          })
                         toastList.forEach(toast => toast.show())
                          };
                  </script>';
        $id = null;
        $nome_do_produto = null;
        $preco = null;
        $descricao = null;
      } else {
        echo "Erro ao tentar efetivar cadastro";
      }
    } else {
      throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
  } catch (PDOException $erro) {
    echo "Erro: " . $erro->getMessage();
  }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
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
    echo "Erro: " . $erro->getMessage();
  }
}

?>
<!-- FIM PHP -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 ">
  <title>Produtos</title>
  <link rel="stylesheet" type="text/css" href="sei.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="js/bootstrap.mim.js" rel="styleshhet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<style>
  #div2 {
    white-space: nowrap;
    width: 24em;
    overflow: hidden;
    text-overflow: ellipsis;

  }



  table {
    border-collapse: collapse;
    width: 50%;
  }

  tr {
    height: 10px;
  }

  td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #d4d4d4;
  }

  td button {
    text-align: center;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2
  }
</style>
<!-- -------------------------------------------------------------------------------------------------------------------------- -->

<body>
  <!-- barra de pesquisa -->
  <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary" class=" bg-dark" data-bs-theme="dark">
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
    </nav> -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Lojinha</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <button type="button" class="btn btn-default navbar-btn">Entrar</button>

        <form class="navbar-form navbar-right">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">

            <button type="submit" class="btn btn-default">Pesquisar</button>
          </div>
        </form>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <!-- barra de pesquisa -->


  <!-- MAIN -->
  <div class="container theme-showcase" role="main">
    <div class="page-header">
      <h1>Produtos</h1>
    </div>

    <div class="pull-right">
      <button type="button" class="btn btn-lg btn-success" data-toggle="modal" data-target="#myModalcad">Cadastrar</button>
    </div>
    <!-- Inicio Modal -->
    <div class="modal fade" id="myModalcad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">Cadastrar Curso</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="?act=save" enctype="multipart/form-data">
              <input type="hidden" name="id" <?php
                                              if (isset($id) && $id != null || $id != "") {
                                                echo "value=\"{$id}\"";
                                              }
                                              ?> />
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nome do Produto:  </label>
                <input name="nome_do_produto" type="text" class="form-control" <?php
                                                                    if (isset($nome_do_produto) && $nome_do_produto != null || $nome_do_produto != "") {
                                                                      echo "value=\"{$nome_do_produto}\"";
                                                                    }
                                                                    ?> />
                                                                  
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Preço: </label>  
                <input name="preco" type="text" class="form-control" <?php
                                                                      if (isset($preco) && $preco != null || $preco != "") {
                                                                        echo "value=\"{$preco}\"";
                                                                      }
                                                                      ?> />
              
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Descrição:  </label> 
                <textarea name="descricao" class="form-control" <?php
                                                                if (isset($descricao) && $descricao != null || $descricao != "") {
                                                                  echo "value=\"{$descricao}\"";
                                                                }
                                                                ?>></textarea>
             
              </div>
              <div class="modal-footer">
             
             <input type="submit" class="btn btn-primary" value="salvar"/>
            <input type="reset" value="Novo"  class ="btn btn-danger"/>
           <hr>
         
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Fim Modal -->

    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th>Nome do Produto</th>
              <th>Preço</th>
              <th>Descrição</th>
              <th style="text-align: center">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $stmt = $conexao->prepare("SELECT * FROM produtos");
            ($stmt->execute());
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
              <tr>
                <td><?php echo $rs->nome_do_produto; ?></td>
                <td><?php echo $rs->preco; ?></td>
                <td>
                  <div id="div2">
                    <?php echo $rs->descricao; ?>
                  </div>

                </td>
                <td>

                  <button type="button" class="btn btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo $rs->id; ?>"><i class="bi bi-search"></i></button>

                  <button type="button" class="btn btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $rs->id; ?>" data-whatevernome="<?php echo $rs->nome_do_produto; ?>" data-whateverpreco="<?php echo $rs->preco; ?>" data-whateverdescricao="<?php echo $rs->descricao; ?>"><i class="bi bi-pencil"></i></button>

                  <a href="?act=del&id=<?php echo $rs->id; ?>"><button type="button" class="btn btn btn-danger"><i class="bi bi-trash"></i></button></a>

                </td>
              </tr>
              <!-- Inicio Modal Visualizar -->
              <div class="modal fade" id="myModal<?php echo $rs->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="modal-title text-center" id="myModalLabel"><strong><?php echo  $rs->nome_do_produto; ?></strong></h3>
                    </div>
                    <div class="modal-body">

                      <h4><strong> Nome do Produto: </strong> </h4>

                      <p><?php echo $rs->nome_do_produto; ?></p>

                      <h4><strong> Preço: </strong></h4>

                      <p><?php echo $rs->preco; ?></p>

                      <h4><strong> Descrição: </strong></h4>

                      <p><?php echo $rs->descricao; ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Fim Modal Visualizar -->
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Inicio Modal Alterar -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Alteração de Produtos</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="?act=save" enctype="multipart/form-data">
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nome:</label>
                <input name="nome_do_produto" type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Preço:</label>
                <input name="preco" type="text" class="form-control" id="preco-text">
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Descrição:</label>
                <textarea name="descricao" class="form-control" id="descricao-text"></textarea>
              </div>
              <input name="id" type="hidden" id="id_produto"<?php
                                              if (isset($id) && $id != null || $id != "") {
                                                echo "value=\"{$id}\"";
                                              }
                                              ?> />
              <div class="modal-footer">
                <label class="label">
        
                <input type="submit"class="btn btn-danger"  value="Alterar"  />
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                </label>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Fim Modal Alterar -->


  </div>
  <!-- MAIN -->
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


  <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
  <!-- Toast -->
  <!-- <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style='position:absolute;margin-left:10px;margin-top:10px;width:300px;height:140px;z-index:1'>
          <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    <div class="toast-body">
              <strong>Dados alterados com sucesso!!</strong>
      <div class="mt-2 pt-2 border-top">
        <a href = "produtos.php"><button type="button" class="btn btn-primary btn-sm">Voltar</button></a>
      
      </div>
    </div>
    </div> -->

  <!-- <div class="toast">
          <div class="toast-header">
            <strong class="mr-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
              <span>&times;</span>
            </button>
          </div>
          <div class="toast-body">
            Hello, world! This is a toast message.
          </div>
        </div> -->
  <!-- ---------------------------------------------------------------------------------------------------------------------------- -->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var recipientnome = button.data('whatevernome')
      var recipientpreco = button.data('whateverpreco')
      var recipientdescricao = button.data('whateverdescricao')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Id do Produto: ' + recipient)
      modal.find('#id_produto').val(recipient)
      modal.find('#recipient-name').val(recipientnome)
      modal.find('#preco-text').val(recipientpreco)
      modal.find('#descricao-text').val(recipientdescricao)
    })
  </script>
</body>

</html>