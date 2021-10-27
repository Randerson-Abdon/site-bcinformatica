<?php
include_once('../conexao.php');

?>

<div class="container ml-4">
    <div class="row">

        <div class="col-lg-8 col-md-6 col-sm-12">
            <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#modalExemplo"> <i class="fas fa-user-plus"> USUÁRIOS </i> </button>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <form class="form-inline my-2 my-lg-0">
                <input name="txtpesquisarUsuarios" class="form-control mr-sm-2" type="search" placeholder="Pesquisar Usuários" aria-label="Pesquisar">
                <button name="buttonPesquisar" class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
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
                            if (isset($_GET['buttonPesquisar']) and $_GET['txtpesquisarUsuarios'] != '') {



                                $nome = $_GET['txtpesquisarUsuarios'] . '%';
                                $cpf = $_GET['txtpesquisarUsuarios'];
                                $query = "SELECT * from usuario_sistema where nome_usuario LIKE '$nome' or cpf_usuario = '$cpf' order by nome_usuario asc ";

                                $result_count = mysqli_query($conexao, $query);
                            } else {
                                $query = "SELECT * from usuario_sistema order by id_usuario desc limit 10";

                                $query_count = "SELECT * from usuario_sistema";
                                $result_count = mysqli_query($conexao, $query_count);
                            }

                            $result = mysqli_query($conexao, $query);

                            $linha = mysqli_num_rows($result);
                            $linha_count = mysqli_num_rows($result_count);

                            if ($linha == '') {
                                echo "<h3> Não foram encontrados dados Cadastrados no Banco!! </h3>";
                            } else {

                            ?>




                                <table class="table">
                                    <thead class="text-secondary">

                                        <th>
                                            Nome
                                        </th>
                                        <th>
                                            CPF
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Nível
                                        </th>
                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Ações
                                        </th>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($res = mysqli_fetch_array($result)) {
                                            $nome           = $res["nome_usuario"];
                                            $cpf            = $res["cpf_usuario"];
                                            $usuario        = $res["login_usuario"];
                                            $nivel          = $res["nivel_usuario"];
                                            $status_usuario = $res["status_usuario"];
                                            $id             = $res["id_usuario"];

                                            if ($status_usuario == 'A') {
                                                $status_usuario = 'Ativo';
                                            } elseif ($status_usuario == 'I') {
                                                $status_usuario = 'Inativo';
                                            }

                                            //$data2 = implode('/', array_reverse(explode('-', $data)));

                                        ?>

                                            <tr>

                                                <td><?php echo $nome; ?></td>
                                                <td id="cpf"><?php echo $cpf; ?></td>
                                                <td><?php echo $usuario; ?></td>
                                                <td><?php echo $nivel; ?></td>
                                                <td><?php echo $status_usuario; ?></td>

                                                <td>
                                                    <a class="btn btn-info" href="admin.php?acao=usuarios&func=edita&id=<?php echo $id; ?>"><i class="fas fa-edit"></i></a>

                                                    <a class="btn btn-danger" href="admin.php?acao=usuarios&func=excluir&id=<?php echo $id; ?>"><i class="fa fa-minus-square"></i></a>

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






        <!-- Modal -->
        <div id="modalExemplo" class="modal fade" role="dialog">
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
                                <input type="text" class="form-control mr-2" name="nome" placeholder="Nome" required>
                            </div>

                            <div class="form-group">
                                <label for="id_produto">CPF</label>
                                <input type="text" class="form-control mr-2" name="cpf" placeholder="CPF" id="cpf" required>
                            </div>

                            <div class="form-group">
                                <label for="id_produto">Email / Usuário</label>
                                <input type="email" class="form-control mr-2" name="usuario" placeholder="Usuário" required>
                            </div>

                            <div class="form-group">
                                <label for="fornecedor">Senha</label>
                                <input type="text" class="form-control mr-2" name="senha" placeholder="Senha" required>
                            </div>

                            <div class="form-group">
                                <label for="fornecedor">Nível</label>
                                <select class="form-control mr-2" id="category" name="nivel">

                                    <option value="1">Administrador</option>
                                    <option value="2">Atendente</option>
                                    <option value="3">Suporte</option>
                                    <option value="4">Operacional</option>

                                </select>
                            </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success mb-3" name="salvar">Salvar </button>


                        <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <!--CADASTRO -->

        <?php
        if (isset($_POST['salvar'])) {
            $nome    = $_POST['nome'];
            $cpf     = $_POST['cpf'];
            $usuario = $_POST['usuario'];
            $senha   = $_POST['senha'];
            $nivel   = $_POST['nivel'];

            $cpf = preg_replace("/[^0-9]/", "", $cpf);

            //VERIFICAR SE O CPF JÁ ESTÁ CADASTRADO
            $query_verificar_cpf = "SELECT * from usuario_sistema where cpf_usuario = '$cpf' ";
            $result_verificar_cpf = mysqli_query($conexao, $query_verificar_cpf);
            $row_verificar_cpf = mysqli_num_rows($result_verificar_cpf);
            if ($row_verificar_cpf > 0) {
                echo "<script language='javascript'>window.alert('CPF já Cadastrado'); </script>";
                exit();
            }


            //VERIFICAR SE O USUARIO JÁ ESTÁ CADASTRADO
            $query_verificar_usu = "SELECT * from usuario_sistema where nome_usuario = '$usuario' and nivel_usuario = '$nivel' ";
            $result_verificar_usu = mysqli_query($conexao, $query_verificar_usu);
            $row_verificar_usu = mysqli_num_rows($result_verificar_usu);
            if ($row_verificar_usu > 0) {
                echo "<script language='javascript'>window.alert('Usuário já Cadastrado'); </script>";
                exit();
            }

            $query = "INSERT INTO usuario_sistema (nome_usuario, cpf_usuario, login_usuario, senha_usuario, nivel_usuario) values ('$nome', '$cpf', '$usuario', '$senha', '$nivel')";

            $result = mysqli_query($conexao, $query);


            /*             //INSERINDO NA TABELA DE ALUNOS
            if ($nivel == 'Aluno') {

                $query_alunos = "INSERT INTO alunos (nome, cpf, email, senha, foto, data) values ('$nome', '$cpf', '$usuario', '$senha', 'sem-perfil.png', curDate())";

                $result_alunos = mysqli_query($conexao, $query_alunos);
            }


            if ($nivel == 'Professor') {

                $query_alunos = "INSERT INTO professores (nome, cpf, email, senha, foto, data) values ('$nome', '$cpf', '$usuario', '$senha', 'sem-perfil.png', curDate())";

                $result_alunos = mysqli_query($conexao, $query_alunos);
            } */



            if ($result == '') {
                echo "<script language='javascript'>window.alert('Ocorreu um erro ao Salvar!'); </script>";
            } else {
                echo "<script language='javascript'>window.alert('Salvo com Sucesso!'); </script>";
                echo "<script language='javascript'>window.location='admin.php?acao=usuarios'; </script>";
            }
        }
        ?>




        <!--EDITAR -->
        <?php
        if (@$_GET['func'] == 'edita') {
            $id = $_GET['id'];

            $query_u = "select * from usuario_sistema where id_usuario = '$id' ";
            $result_u = mysqli_query($conexao, $query_u);

            while ($res = mysqli_fetch_array($result_u)) {
                $nome    = $res['nome_usuario'];
                $cpf     = $res['cpf_usuario'];
                $usuario = $res['login_usuario'];
                $senha   = $res['senha_usuario'];
                $nivel   = $res['nivel_usuario'];

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
                                        <input type="text" class="form-control mr-2" name="nome" value="<?php echo $nome ?>" placeholder="Nome" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_produto">CPF</label>
                                        <input type="text" class="form-control mr-2" name="cpf" placeholder="CPF" id="cpf" value="<?php echo $cpf ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_produto">Email / Usuário</label>
                                        <input type="email" class="form-control mr-2" name="usuario" placeholder="Usuário" value="<?php echo $usuario ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="fornecedor">Senha</label>
                                        <input type="text" class="form-control mr-2" name="senha" placeholder="Senha" value="<?php echo $senha ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="fornecedor">Nível</label>
                                        <select class="form-control mr-2" id="category" name="nivel">

                                            <option value="1" <?php if ($nivel == '1') { ?> selected <?php } ?>>Administrador</option>
                                            <option value="2" <?php if ($nivel == '2') { ?> selected <?php } ?>>Atendente</option>
                                            <option value="3" <?php if ($nivel == '3') { ?> selected <?php } ?>>Suporte</option>
                                            <option value="4" <?php if ($nivel == '4') { ?> selected <?php } ?>>Operacional</option>

                                        </select>
                                    </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success mb-3" name="editar">Editar </button>


                                <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


        <?php


                if (isset($_POST['editar'])) {
                    $nome = $_POST['nome'];
                    $cpf = $_POST['cpf'];
                    $usuario = $_POST['usuario'];
                    $senha = $_POST['senha'];
                    $nivel = $_POST['nivel'];

                    $cpf = preg_replace("/[^0-9]/", "", $cpf);

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

                    echo $nome . ', ' . $cpf . ', ' . $usuario . ', ' . $senha . ', ' . $nivel;


                    $query = "UPDATE usuario_sistema SET nome_usuario = '$nome', cpf_usuario = '$cpf', login_usuario = '$usuario', senha_usuario = '$senha', nivel_usuario = '$nivel' where id_usuario  = '$id' ";

                    $result = mysqli_query($conexao, $query);


                    /*                     //atualização dos alunos
                    if ($nivel == 'Aluno') {
                        $query_alunos = "UPDATE alunos SET nome = '$nome', cpf = '$cpf', email = '$usuario', senha = '$senha' where cpf = '$res[cpf]' ";

                        $result_alunos = mysqli_query($conexao, $query_alunos);
                    }


                    //atualização dos alunos
                    if ($nivel == 'Professor') {
                        $query_alunos = "UPDATE professores SET nome = '$nome', cpf = '$cpf', email = '$usuario', senha = '$senha' where cpf = '$res[cpf]' ";

                        $result_alunos = mysqli_query($conexao, $query_alunos);
                    } */



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
            $id = $_GET['id'];



            //recuperar cpf do usuário
            $query_cpf = "select * from usuarios where id = '$id' ";
            $result_cpf = mysqli_query($conexao, $query_cpf);

            while ($res = mysqli_fetch_array($result_cpf)) {

                $cpf = $res["cpf"];
                $nivel = $res["nivel"];



                //exclusao dos alunos
                if ($nivel == 'Aluno') {
                    $query_alunos = "DELETE FROM alunos where cpf = '$cpf' ";

                    $result_alunos = mysqli_query($conexao, $query_alunos);
                }
            }



            $query = "DELETE FROM usuarios where id = '$id' ";
            $result = mysqli_query($conexao, $query);
            echo "<script language='javascript'>window.location='painel_admin.php?acao=usuarios'; </script>";
        }

        ?>



        <script>
            $("#modalEditar").modal("show");
        </script>


        <!--MASCARAS -->
        <script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
        <script>
            $("td[id*='cpf']").inputmask({
                mask: ['999.999.999-99'],
                keepStatic: true
            });

            $("input[id*='cpf']").inputmask({
                mask: ['999.999.999-99'],
                keepStatic: true
            });
        </script>