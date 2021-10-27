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
            <h3>PORTIFÓLIO</h3>
        </div>

        <div class="col-lg-9 col-md-6 col-sm-12">

            <button type="button" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-user-plus"> PORTIFÓLIO </i>
            </button>

        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <form class="d-flex">
                <input name="txtpesquisarPotifolio" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
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
                            if (isset($_GET['buttonPesquisar']) and $_GET['txtpesquisarPotifolio'] != '') {

                                $nome = '%' . $_GET['txtpesquisarPotifolio'] . '%';
                                $cat = $_GET['txtpesquisarPotifolio'];
                                $query = "SELECT * from portifolio where descricao_portifolio LIKE '$nome' or categoria_portifolio = '$cat' order by id_portifolio asc ";

                                $result_count = mysqli_query($conexao, $query);
                            } else {
                                $query = "SELECT * from portifolio order by id_portifolio asc limit 10";

                                $query_count = "SELECT * from portifolio";
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
                                            Descrição
                                        </th>
                                        <th>
                                            Categoria
                                        </th>
                                        <th>
                                            Imagem
                                        </th>


                                        <th>
                                            Ações
                                        </th>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($res = mysqli_fetch_array($result)) {
                                            $id_portifolio        = $res["id_portifolio"];
                                            $descricao_portifolio = $res["descricao_portifolio"];
                                            $categoria_portifolio = $res["categoria_portifolio"];
                                            $imagem_portifolio    = $res["imagem_portifolio"];

                                        ?>

                                            <tr>

                                                <td><?php echo $id_portifolio; ?></td>
                                                <td><?php echo $descricao_portifolio; ?></td>
                                                <td><?php echo $categoria_portifolio; ?></td>
                                                <td><img src="../img/portifolio/<?php echo $imagem_portifolio; ?>" width="40"></td>

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






        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Portifólio</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" enctype="multipart/form-data">

                            <div class="form-group mb-3">
                                <label for="id_produto">Descrição</label>
                                <input type="text" class="form-control mr-2" name="descricao_portifolio" placeholder="Descrição" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="fornecedor">Categoria</label>
                                <select class="form-select mr-2" id="category" name="categoria">

                                    <?php

                                    $query_cat = "SELECT descricao_curta from servicos order by descricao_curta asc";
                                    $result_cat = mysqli_query($conexao, $query_cat);
                                    while ($res_cat = mysqli_fetch_array($result_cat)) {

                                    ?>

                                        <option value="<?php echo $res_cat['descricao_curta']; ?>"><?php echo $res_cat['descricao_curta']; ?></option>

                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Imagem</label>
                                <div class="custom-file">

                                    <input type="file" class="form-control" id="imagem" name="imagem" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                                    <!--  <input type="file" class="custom-file-input" name="imagem" id="imagem">
                                    <label class="custom-file-label" for="customFile">Escolher Imagem</label> -->

                                </div>
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
            $descricao_portifolio = $_POST['descricao_portifolio'];
            $categoria = $_POST['categoria'];

            $caminho = '../img/portifolio/' . $_FILES['imagem']['name'];
            $imagem = $_FILES['imagem']['name'];
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            move_uploaded_file($imagem_temp, $caminho);


            /*       //VERIFICAR SE O USUARIO JÁ ESTÁ CADASTRADO
      $query_verificar_usu = "SELECT * from usuario_sistema where   login_usuario = '$usuario' and nivel_usuario = '$nivel' ";
      $result_verificar_usu = mysqli_query($conexao, $query_verificar_usu);
      $row_verificar_usu = mysqli_num_rows($result_verificar_usu);
      if ($row_verificar_usu > 0) {
        echo "<script language='javascript'>window.alert('Usuário já Cadastrado'); </script>";
        exit();
      } */

            $query = "INSERT INTO portifolio (descricao_portifolio, categoria_portifolio, imagem_portifolio) values ('$descricao_portifolio', '$categoria', '$imagem')";

            $result = mysqli_query($conexao, $query);

            if ($result == '') {
                echo "<script language='javascript'>window.alert('Ocorreu um erro ao Salvar!'); </script>";
            } else {
                echo "<script language='javascript'>window.alert('Salvo com Sucesso!'); </script>";
                echo "<script language='javascript'>window.location='admin.php?acao=portifolio'; </script>";
            }
        }
        ?>


        <!--EDITAR -->
        <?php
        if (@$_GET['func'] == 'edita') {
            $id = $_GET['id'];

            $query = "select * from usuario_sistema where id_usuario = '$id' ";
            $result = mysqli_query($conexao, $query);

            while ($res = mysqli_fetch_array($result)) {
                $nome = $res["nome_usuario"];
                $cpf = $res["cpf_usuario"];
                $usuario = $res["login_usuario"];
                $senha = $res["senha_usuario"];
                $nivel = $res["nivel_usuario"];
                $data = $res["data_cadastro_usuario"];

        ?>

                <!-- Modal Editar -->
                <div id="modalEditar" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title">Usuários</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="">

                                    <div class="form-group">
                                        <label for="id_produto">Nome</label>
                                        <input type="text" class="form-control mr-2" name="nome" value="<?php echo $nome ?>" placeholder="Nome" style="text-transform:uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_produto">CPF</label>
                                        <input type="text" class="form-control mr-2" name="cpf" placeholder="CPF" id="cpf" value="<?php echo $cpf ?>" style="text-transform:uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_produto">Email / Usuário</label>
                                        <input type="email" class="form-control mr-2" name="usuario" placeholder="Usuário" value="<?php echo $usuario ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="fornecedor">Senha</label>
                                        <input type="text" class="form-control mr-2" name="senha" placeholder="Senha" value="<?php echo $senha ?>" required>
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
                    $nome = mb_strtoupper($_POST['nome']);
                    $cpf = mb_strtoupper($_POST['cpf']);
                    $usuario = $_POST['usuario'];
                    $senha = $_POST['senha'];


                    if ($res["cpf_usuario"] != $cpf) {
                        //VERIFICAR SE O CPF JÁ ESTÁ CADASTRADO
                        $query_verificar_cpf = "SELECT * from usuario_sistema where cpf_usuario = '$cpf' ";
                        $result_verificar_cpf = mysqli_query($conexao, $query_verificar_cpf);
                        $row_verificar_cpf = mysqli_num_rows($result_verificar_cpf);
                        if ($row_verificar_cpf > 0) {
                            echo "<script language='javascript'>window.alert('CPF já Cadastrado'); </script>";
                            exit();
                        }
                    }

                    if ($res["login_usuario"] != $usuario) {
                        //VERIFICAR SE O USUARIO JÁ ESTÁ CADASTRADO
                        $query_verificar_usu = "SELECT * from usuario_sistema where login_usuario = '$usuario' and nivel_usuario = '$nivel' ";
                        $result_verificar_usu = mysqli_query($conexao, $query_verificar_usu);
                        $row_verificar_usu = mysqli_num_rows($result_verificar_usu);
                        if ($row_verificar_usu > 0) {
                            echo "<script language='javascript'>window.alert('Usuário já Cadastrado'); </script>";
                            exit();
                        }
                    }


                    $query = "UPDATE usuario_sistema SET nome_usuario = '$nome', cpf_usuario = '$cpf', login_usuario = '$usuario', senha_usuario = '$senha' where id_usuario = '$id' ";

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
                        echo "<script language='javascript'>window.location='admin.php?acao=usuarios'; </script>";
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