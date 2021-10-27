<?php
include_once('../conexao.php');
include_once('../verificar_autenticacao.php');

if ($_SESSION['nivel_usuario'] != '1' && $_SESSION['nivel_usuario'] != '0') {
  header('Location: ../login.php');
  exit();
}

?>

<div class="container ml-4">
  <div class="row">

    <div class="col-lg-8 col-md-6">
      <h3>SERVIÇOS</h3>
    </div>

    <div class="col-lg-9 col-md-6 col-sm-12">

      <button type="button" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fas fa-user-plus"> SERVIÇOS </i>
      </button>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
      <form class="d-flex">
        <input name="txtpesquisarServicos" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
        <button name="buttonPesquisar" class="btn btn-orange" type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
  </div>
</div>

<div class="container ml-4">

  <br>

  <div class="content">
    <div class="row mr-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

          </div>
          <div class="card-body">
            <div class="table-responsive">

              <!--LISTAR TODOS OS USUÁRIOS -->
              <?php
              if (isset($_GET['buttonPesquisar']) and $_GET['txtpesquisarServicos'] != '') {



                $nome = '%' . $_GET['txtpesquisarServicos'] . '%';
                $cat = $_GET['txtpesquisarServicos'];
                $query = "SELECT * from servicos where descricao_curta LIKE '$nome' or categoria = '$cat' order by descricao_curta asc ";

                $result_count = mysqli_query($conexao, $query);
              } else {
                $query = "SELECT * from servicos order by id_servico asc limit 10";

                $query_count = "SELECT * from servicos";
                $result_count = mysqli_query($conexao, $query_count);
              }

              $result = mysqli_query($conexao, $query);

              $linha = mysqli_num_rows($result);
              $linha_count = mysqli_num_rows($result_count);

              if ($linha == '') {
                echo "<h3> Não foram encontrados dados Cadastrados no Banco!! </h3>";
              } else {

              ?>




                <table class="table table-sm">
                  <thead class="text-secondary">

                    <th>
                      ID
                    </th>
                    <th>
                      Nome
                    </th>
                    <th>
                      Categoria
                    </th>


                    <th>
                      Ações
                    </th>
                  </thead>
                  <tbody>

                    <?php
                    while ($res = mysqli_fetch_array($result)) {
                      $id_servico  = $res["id_servico"];
                      $descricao_curta = $res["descricao_curta"];
                      $categoria = $res["categoria"];

                    ?>

                      <tr>

                        <td><?php echo $id_servico; ?></td>
                        <td><?php echo $descricao_curta; ?></td>
                        <td><?php echo $categoria; ?></td>

                        <td>
                          <a class="btn btn-orange btn-sm" href="admin.php?acao=servicos&func=edita&id=<?php echo $id_servico; ?>"><i class="fas fa-edit"></i></a>

                        </td>
                      </tr>

                    <?php } ?>


                  </tbody>
                  <tfoot>
                    <tr>

                      <td></td>
                      <td></td>
                      <td></td>


                      <td>
                        <span class="text-muted">Registros: <?php echo $linha_count ?> </span>
                      </td>
                    </tr>

                  </tfoot>
                </table>

              <?php
              }

              ?>

            </div>
          </div>
        </div>
      </div>

    </div>






    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Serviços</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="">

              <div class="form-group mb-3">
                <label for="id_produto">Descrição Curta</label>
                <input type="text" class="form-control mr-2" name="descricao_curta" placeholder="Descrição Curta" required>
              </div>

              <div class="form-group mb-3">
                <label for="id_produto">Descrição Longa</label>
                <textarea type="text" class="form-control mr-2" rows="3" name="descricao_longa" placeholder="Descrição Longa" required></textarea>
              </div>

              <div class="form-group">
                <label for="fornecedor">Categoria</label>
                <select class="form-select mr-2" id="categoria" name="categoria">

                  <option value="Desenvolvimento Web">Desenvolvimento Web</option>
                  <option value="Infraestrutura">Infraestrutura</option>
                  <option value="Consultoria">Consultoria</option>
                  <option value="Banco de Dados">Banco de Dados</option>

                </select>
              </div>


          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-blue mb-3" name="salvar">Salvar </button>


            <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>
            </form>
          </div>
        </div>
      </div>
    </div>




    <!--CADASTRO -->
    <?php
    if (isset($_POST['salvar'])) {
      $descricao_curta = $_POST['descricao_curta'];
      $descricao_longa = $_POST['descricao_longa'];
      $categoria = $_POST['categoria'];


      /*       //VERIFICAR SE O USUARIO JÁ ESTÁ CADASTRADO
      $query_verificar_usu = "SELECT * from usuario_sistema where   login_usuario = '$usuario' and nivel_usuario = '$nivel' ";
      $result_verificar_usu = mysqli_query($conexao, $query_verificar_usu);
      $row_verificar_usu = mysqli_num_rows($result_verificar_usu);
      if ($row_verificar_usu > 0) {
        echo "<script language='javascript'>window.alert('Usuário já Cadastrado'); </script>";
        exit();
      } */

      $query = "INSERT INTO servicos (descricao_curta, descricao_longa, categoria) values ('$descricao_curta', '$descricao_longa', '$categoria')";

      $result = mysqli_query($conexao, $query);

      if ($result == '') {
        echo "<script language='javascript'>window.alert('Ocorreu um erro ao Salvar!'); </script>";
      } else {
        echo "<script language='javascript'>window.alert('Salvo com Sucesso!'); </script>";
        echo "<script language='javascript'>window.location='admin.php?acao=servicos'; </script>";
      }
    }
    ?>


    <!--EDITAR -->
    <?php
    if (@$_GET['func'] == 'edita') {
      $id = $_GET['id'];

      $query = "select * from servicos where id_servico = '$id' ";
      $result = mysqli_query($conexao, $query);

      while ($res = mysqli_fetch_array($result)) {
        $descricao_curta = $res["descricao_curta"];
        $descricao_longa = $res["descricao_longa"];
        $categoria = $res["categoria"];

    ?>

        <!-- Modal Editar -->
        <div id="modalEditar" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">

                <h5 class="modal-title">Serviços</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form method="POST" action="">

                  <div class="form-group">
                    <label for="id_produto">Descrição Curta</label>
                    <input type="text" class="form-control mr-2" name="descricao_curta" placeholder="Descrição Curta" value="<?php echo $descricao_curta; ?>">
                  </div>

                  <div class="form-group">
                    <label for="id_produto">Descrição Longa</label>
                    <textarea type="text" class="form-control mr-2" rows="3" name="descricao_longa" placeholder="Descrição Longa"><?php echo $descricao_longa; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="fornecedor">Categoria</label>
                    <select class="form-control mr-2" id="categoria" name="categoria">

                      <option value="Desenvolvimento Web" <?php if ($categoria == 'Desenvolvimento Web') { ?> selected <?php } ?>>Desenvolvimento Web</option>
                      <option value="Infraestrutura" <?php if ($categoria == 'Infraestrutura') { ?> selected <?php } ?>>Infraestrutura</option>
                      <option value="Consultoria" <?php if ($categoria == 'Consultoria') { ?> selected <?php } ?>>Consultoria</option>
                      <option value="Banco de Dados" <?php if ($categoria == 'Banco de Dados') { ?> selected <?php } ?>>Banco de Dados</option>

                    </select>
                  </div>

              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-success mb-3" name="editar">Salvar </button>


                <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>
                </form>
              </div>
            </div>
          </div>
        </div>


    <?php


        if (isset($_POST['editar'])) {
          $descricao_curta = $_POST['descricao_curta'];
          $descricao_longa = $_POST['descricao_longa'];
          $categoria = $_POST['categoria'];

          $query = "UPDATE servicos SET descricao_curta = '$descricao_curta', descricao_longa = '$descricao_longa', categoria = '$categoria' where id_servico = '$id' ";

          $result = mysqli_query($conexao, $query);


          //atualização dos alunos
          // if($nivel == 'Aluno'){
          //   $query_alunos = "UPDATE alunos SET nome = '$nome', cpf = '$cpf', email = '$usuario', senha = '$senha' where cpf = '$res[cpf]' ";

          //  $result_alunos = mysqli_query($conexao, $query_alunos);
          // }



          if ($result == '') {
            echo "<script language='javascript'>window.alert('Ocorreu um erro ao Editar!'); </script>";
          } else {
            echo "<script language='javascript'>window.alert('Salvo com Sucesso!'); </script>";
            echo "<script language='javascript'>window.location='admin.php?acao=servicos'; </script>";
          }
        }
      }
    }

    ?>



    <!--EXCLUIR -->
    <?php
    if (@$_GET['func'] == 'excluir') {
      $id = $_GET['id_usuario'];



      //recuperar cpf do usuário
      $query_cpf = "select * from usuario_sistema where id_usuario = '$id' ";
      $result_cpf = mysqli_query($conexao, $query_cpf);

      while ($res = mysqli_fetch_array($result_cpf)) {

        $cpf = $res["cpf_usuario"];
        $nivel = $res["nivel_usuario"];



        //exclusao dos alunos
        // if($nivel == 'Aluno'){
        //   $query_alunos = "DELETE FROM alunos where cpf = '$cpf' ";

        // $result_alunos = mysqli_query($conexao, $query_alunos);
        // } 

        // } 



        $query = "DELETE FROM usuario_sistema where id_usuario = '$id' ";
        $result = mysqli_query($conexao, $query);
        echo "<script language='javascript'>window.location='admin.php?acao=usuarios'; </script>";
      }
    }

    ?>


    <!--ATIVAR O USUÁRIO-->
    <?php if (@$_GET['func'] == 'ativa') {
      $id = $_GET['id'];
      $sql = "UPDATE usuario_sistema SET status_usuario = 'A' WHERE id_usuario = '$id'";
      mysqli_query($conexao, $sql);

      echo "<script language='javascript'>window.alert('Ativado Sucesso!'); </script>";
      echo "<script language='javascript'>window.location='admin.php?acao=usuarios'; </script>";
    } ?>




    <!--INATIVAR O USUÁRIO-->
    <?php if (@$_GET['func'] == 'inativa') {
      $id = $_GET['id'];
      $sql = "UPDATE usuario_sistema SET status_usuario = 'I' WHERE id_usuario = '$id'";
      mysqli_query($conexao, $sql);

      echo "<script language='javascript'>window.alert('Inativado com Sucesso!'); </script>";
      echo "<script language='javascript'>window.location='admin.php?acao=usuarios'; </script>";
    } ?>



    <script>
      $("#modalEditar").modal("show");
    </script>


    <!--MASCARAS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


    <script type="text/javascript">
      $(document).ready(function() {
        $('#cell').mask('(00) 00000-0000');
        $('#fone').mask('(00) 0000-0000');
        $('#cpf').mask('000.000.000-00');

      });
    </script>


    <script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script>
      $("input[id*='numero_cpf_cnpj']").inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true
      });
    </script>
    <script>
      $("label[id*='numero_cpf_cnpj']").inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true
      });
    </script>
    <script>
      $("td[id*='numero_cpf_cnpj']").inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true
      });
    </script>