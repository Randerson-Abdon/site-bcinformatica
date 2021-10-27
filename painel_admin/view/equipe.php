<?php
include_once('../conexao.php');
include_once('../verificar_autenticacao.php');

if ($_SESSION['nivel_usuario'] != '1' && $_SESSION['nivel_usuario'] != '0') {
    header('Location: ../login.php');
    exit();
}

?>
<div>

    <div class="container ml-4">
        <div class="row">

            <div class="col-lg-8 col-md-6">
                <h3>NOSSA EQUIPE</h3>
            </div>

            <div class="col-lg-9 col-md-6 col-sm-12">

                <button type="button" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-user-plus"> COLABORADOR </i>
                </button>

            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <form class="d-flex">
                    <input name="txtpesquisarColaborador" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                    <button name="buttonPesquisar" class="btn btn-orange" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>

    <div class="container ml-4">

        <br>

        <div class="content">


            <div class="card">
                <div class="card-header">
                    <!-- colocar aqui titulos -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <!--LISTAR TODOS OS USUÁRIOS -->
                        <?php
                        if (isset($_GET['buttonPesquisar']) and $_GET['txtpesquisarColaborador'] != '') {

                            $nome = '%' . $_GET['txtpesquisarColaborador'] . '%';
                            $cat = $_GET['txtpesquisarColaborador'];
                            $query = "SELECT * from equipe where nome LIKE '$nome' or cargo = '$cat' order by id_equipe asc ";

                            $result_count = mysqli_query($conexao, $query);
                        } else {
                            $query = "SELECT * from equipe order by id_equipe asc limit 10";

                            $query_count = "SELECT * from equipe";
                            $result_count = mysqli_query($conexao, $query_count);
                        }

                        $result = mysqli_query($conexao, $query);

                        $linha = mysqli_num_rows($result);
                        $linha_count = mysqli_num_rows($result_count);

                        if ($linha == '') {
                            echo "<h3> Não foram encontrados dados Cadastrados no Banco!! </h3>";
                        } else {

                        ?>

                            <table class="table table-striped table-sm">
                                <thead class="text-secondary">

                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Cargo
                                    </th>
                                    <th>
                                        Telefone
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
                                        $id_equipe  = $res["id_equipe"];
                                        $nome       = $res["nome"];
                                        $cargo      = $res["cargo"];
                                        $fone_movel = $res["fone_movel"];
                                        $imagem_equipe = $res["imagem_equipe"];

                                        //echo $imagem_equipe;

                                    ?>

                                        <tr>

                                            <td><?php echo $id_equipe; ?></td>
                                            <td><?php echo $nome; ?></td>
                                            <td><?php echo $cargo; ?></td>
                                            <td><?php echo $fone_movel; ?></td>
                                            <td><img src="../img/equipe/<?php echo $imagem_equipe; ?>" width="40"></td>

                                            <td>
                                                <a class="btn btn-orange btn-sm" href="admin.php?acao=servicos&func=edita&id=<?php echo $id_equipe; ?>"><i class="fas fa-edit"></i></a>

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


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Colaboradores</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" enctype="multipart/form-data">

                            <h5 class="modal-title">Dados Pessoais</h5>
                            <hr>
                            <div class="row">

                                <div class="form-group col-md-8">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="id_produto">Nome</label>
                                        <input type="text" class="form-control mr-2" name="nome" placeholder="Nome" required>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="id_produto">CPF</label>
                                        <input type="text" class="form-control mr-2" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                                    </div>
                                </div>

                                <div class="form-group col-md-5">
                                    <div class="input-group">
                                        <label class="input-group-text" for="fornecedor">Cargo</label>
                                        <select class="form-select mr-2" id="cargo" name="cargo">

                                            <?php

                                            $query_cat = "SELECT nome_cargo from cargos order by nome_cargo asc";
                                            $result_cat = mysqli_query($conexao, $query_cat);
                                            while ($res_cat = mysqli_fetch_array($result_cat)) {

                                            ?>

                                                <option value="<?php echo $res_cat['nome_cargo']; ?>"><?php echo $res_cat['nome_cargo']; ?></option>

                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-7">
                                    <div class="custom-file">

                                        <input type="file" class="form-control" id="imagem" name="imagem" aria-describedby="inputGroupFileAddon04" placeholder="teste" aria-label="Upload">
                                        <span class="d-md-flex justify-content-md-end text-danger">* Escolher Imagem</span>

                                        <!-- <label class="custom-file-label" for="customFile">Escolher Imagem</label>
                                        <input type="file" class="custom-file-input" name="imagem" id="imagem"> -->
                                    </div>
                                </div>



                            </div>

                            <h5 class="modal-title mt-4">Contato</h5>
                            <hr>
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="id_produto">Telefone</label>
                                        <input type="text" class="form-control mr-2" id="fone" name="fone_movel" placeholder="(00) 0000-0000" required>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="id_produto">Email</label>
                                        <input type="text" class="form-control mr-2" name="email" placeholder="exemplo@exemplo.com" required>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="id_produto">Twitter</label>
                                        <input type="text" class="form-control mr-2" name="twitter" placeholder="twitter">
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="id_produto">Facebook</label>
                                        <input type="text" class="form-control mr-2" name="facebook" placeholder="facebook">
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="id_produto">Instagram</label>
                                        <input type="text" class="form-control mr-2" name="instagram" placeholder="instagram">
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="id_produto">Linkedin</label>
                                        <input type="text" class="form-control mr-2" name="linkedin" placeholder="linkedin">
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-blue" name="salvar">Salvar </button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>




        <!--CADASTRO -->
        <?php
        if (isset($_POST['salvar'])) {

            $nome       = $_POST['nome'];
            $cpf        = $_POST['cpf'];
            $cargo      = $_POST['cargo'];
            $fone_movel = $_POST['fone_movel'];
            $email      = $_POST['email'];
            $twitter    = $_POST['twitter'];
            $facebook   = $_POST['facebook'];
            $instagram  = $_POST['instagram'];
            $linkedin   = $_POST['linkedin'];

            $caminho = '../img/equipe/' . $_FILES['imagem']['name'];
            $imagem = $_FILES['imagem']['name'];
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            move_uploaded_file($imagem_temp, $caminho);

            $cpf = preg_replace("/[^0-9]/", "", $cpf);
            $fone_movel = preg_replace("/[^0-9]/", "", $fone_movel);


            //VERIFICAR SE O USUARIO JÁ ESTÁ CADASTRADO
            $query_verificar_usu = "SELECT * from equipe where cpf = '$cpf' ";
            $result_verificar_usu = mysqli_query($conexao, $query_verificar_usu);
            $row_verificar_usu = mysqli_num_rows($result_verificar_usu);
            if ($row_verificar_usu > 0) {
                echo "<script language='javascript'>window.alert('Usuário já Cadastrado'); </script>";
                exit();
            }

            $query = "INSERT INTO equipe (nome, cpf, cargo, fone_movel, email, twitter, facebook, instagram, linkedin, imagem_equipe) values ('$nome', '$cpf', '$cargo', '$fone_movel', '$email', '$twitter', '$facebook', '$instagram', '$linkedin', '$imagem')";

            $result = mysqli_query($conexao, $query);

            if ($result == '') {
                echo "<script language='javascript'>window.alert('Ocorreu um erro ao Salvar!'); </script>";
            } else {
                echo "<script language='javascript'>window.alert('Salvo com Sucesso!'); </script>";
                echo "<script language='javascript'>window.location='admin.php?acao=equipe'; </script>";
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
                        echo "<script language='javascript'>window.location='admin.php?acao=equipe'; </script>";
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
            echo "<script language='javascript'>window.location='admin.php?acao=equipe'; </script>";
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

    </div>