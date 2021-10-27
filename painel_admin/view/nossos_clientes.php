<?php
include_once('../conexao.php');
include_once('../verificar_autenticacao.php');
?>

<?php

if ($_SESSION['nivel_usuario'] != '1' && $_SESSION['nivel_usuario'] != '0') {
    header('Location: ../login.php');
    exit();
}

?>

<div class="container ml-4">
    <div class="row">

        <div class="col-lg-8 col-md-6">
            <h3>CLIENTES</h3>
        </div>

        <div class="col-lg-9 col-md-6 col-sm-12">

            <button type="button" class="btn btn-orange" onclick="location.href='admin.php?acao=novo_cliente'">
                <i class="fas fa-user-plus"> CLIENTES </i>
            </button>

        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <form class="d-flex">
                <input name="txtpesquisarClientes" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
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
                            if (isset($_GET['buttonPesquisar']) and $_GET['txtpesquisarClientes'] != '') {



                                $nome = $_GET['txtpesquisarClientes'] . '%';
                                $cnpj = $_GET['txtpesquisarClientes'];
                                $query = "SELECT * from clientes where nome_razao_social LIKE '$nome' or cnpj = '$cnpj' order by nome_razao_social asc ";

                                $result_count = mysqli_query($conexao, $query);
                            } else {
                                $query = "SELECT * from clientes order by id_cliente desc limit 10";

                                $query_count = "SELECT * from clientes";
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
                                            Nome/Razão Social
                                        </th>
                                        <th>
                                            Cidade
                                        </th>
                                        <th>
                                            UF
                                        </th>
                                        <th>
                                            Responsável
                                        </th>
                                        <th>
                                            Contato
                                        </th>

                                        <th>
                                            Ações
                                        </th>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($res = mysqli_fetch_array($result)) {
                                            $nome_razao_social = $res["nome_razao_social"];
                                            $cnpj              = $res["cnpj"];
                                            $cidade            = $res["cidade"];
                                            $uf                = $res["uf"];
                                            $nome_responsavel  = $res["nome_responsavel"];
                                            $fone_movel        = $res["fone_movel"];
                                            $fone_fixo         = $res["fone_fixo"];

                                            if ($fone_movel == '') {
                                                $contato = $fone_fixo;
                                            } else {
                                                $contato = $fone_movel;
                                            }

                                            //$data2 = implode('/', array_reverse(explode('-', $data)));

                                        ?>

                                            <tr>

                                                <td><?php echo $nome_razao_social; ?></td>
                                                <td><?php echo $cidade; ?></td>
                                                <td><?php echo $uf; ?></td>
                                                <td><?php echo $nome_responsavel; ?></td>
                                                <td id="cel"><?php echo $contato; ?></td>

                                                <td>
                                                    <a class="btn btn-orange btn-sm" href="admin.php?acao=usuarios&func=edita&id=<?php echo $id; ?>"><i class="fas fa-edit"></i></a>


                                                    <!-- <?php if ($status == 'I') { ?>
                                                        <a class="btn btn-success btn-sm" href="admin.php?acao=usuarios&func=ativa&id=<?php echo $id; ?>"><i title="Ativar novamente usuário" class="fas fa-check-square"></i></a>
                                                    <?php } ?> -->

                                                    <!-- <?php if ($status == 'A') { ?>
                                                        <a class="btn btn-danger btn-sm" href="admin.php?acao=usuarios&func=inativa&id=<?php echo $id; ?>"><i title="Inativar Usuário(a)" class="fa fa-minus-square"></i></a>
                                                    <?php } ?> -->

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

        </div>


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

            $("label[id*='numero_cpf_cnpj']").inputmask({
                mask: ['999.999.999-99', '99.999.999/9999-99'],
                keepStatic: true
            });

            $("td[id*='numero_cpf_cnpj']").inputmask({
                mask: ['999.999.999-99', '99.999.999/9999-99'],
                keepStatic: true
            });

            $("td[id*='cel']").inputmask({
                mask: ['(99) 9999-9999'],
                keepStatic: true
            });
        </script>