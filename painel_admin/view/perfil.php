<?php
include_once('../conexao.php');

//RECUPERAR CAMPOS PARA EDIÇAO

$cpf = $_GET['cpf'];

$query = "select * from usuario_sistema where cpf_usuario = '$cpf' ";
$result = mysqli_query($conexao, $query);

while ($res = mysqli_fetch_array($result)) {
    $nome = $res["nome_usuario"];
    $cpf = $res["cpf_usuario"];
    $email = $res["login_usuario"];
    $senha = $res["senha_usuario"];

    if (isset($_GET['img'])) {
        $foto = $_GET['img'];
    } else {
        $foto = $res["foto"];
    }

?>


    <div class="container ml-4">

        <form class="mr-4" method="post">

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="inputEmail4">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo $nome; ?>">
                </div>

                <div class="form-group col-md-3">
                    <label for="inputPassword4">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="<?php echo $cpf; ?>">
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputPassword4">Senha</label>
                    <input type="text" class="form-control" name="senha" placeholder="Senha" value="<?php echo $senha; ?>">
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-2 mt-5">

                    <button name="salvar" type="submit" class="btn btn-primary">Salvar</button>

                </div>

        </form>


        <div class="form-group col-md-3">
            <label for="inputAddress">Foto</label>
            <div class="custom-file">
                <form method="post" enctype="multipart/form-data">
                    <input type="file" class="custom-file-input" name="foto" id="foto">
                    <label class="custom-file-label" for="customFile">Escolher Foto</label>

            </div>
        </div>

        <div class="form-group col-md-1">
            <label for="inputAddress">Atualizar</label><br>

            <button type="submit" name="atualizar" class="btn btn-secondary"><i class="fas fa-sync-alt"></i></button>

        </div>


        <div class="form-group col-md-2">

            <img src="../img/equipe/<?php echo $foto; ?>" width="120">

        </div>
    </div>



    </form>


    </div>


    <?php
    if (isset($_POST['atualizar'])) {

        $caminho = '../img/equipe/' . $_FILES['foto']['name'];
        $nome = $_FILES['foto']['name'];
        $nome_temp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($nome_temp, $caminho);

        echo "<script language='javascript'>window.location='admin.php?acao=perfil&cpf=$cpf&img=$nome'; </script>";
    }

    ?>


    <?php
    if (isset($_POST['salvar'])) {

        $nome_post = $_POST['nome'];
        $cpf_post = $_POST['cpf'];
        $email_post = $_POST['email'];
        $senha_post = $_POST['senha'];

        $cpf_post = preg_replace("/[^0-9]/", "", $cpf_post);


        if ($res["cpf_usuario"] != $cpf_post) {
            //VERIFICAR SE O CPF JÁ ESTÁ CADASTRADO
            $query_verificar_cpf = "SELECT * from usuario_sistema where cpf_usuario = '$cpf_post' ";
            $result_verificar_cpf = mysqli_query($conexao, $query_verificar_cpf);
            $row_verificar_cpf = mysqli_num_rows($result_verificar_cpf);
            if ($row_verificar_cpf > 0) {
                echo "<script language='javascript'>window.alert('CPF já Cadastrado'); </script>";
                exit();
            }
        }

        if ($res["login_usuario"] != $email_post) {
            //VERIFICAR SE O USUARIO JÁ ESTÁ CADASTRADO
            $query_verificar_usu = "SELECT * from usuario_sistema where login_usuario = '$email_post' ";
            $result_verificar_usu = mysqli_query($conexao, $query_verificar_usu);
            $row_verificar_usu = mysqli_num_rows($result_verificar_usu);
            if ($row_verificar_usu > 0) {
                echo "<script language='javascript'>window.alert('Usuário já Cadastrado'); </script>";
                exit();
            }
        }


        $query_post = "UPDATE usuario_sistema SET nome_usuario = '$nome_post', cpf_usuario = '$cpf_post', login_usuario = '$email_post', senha_usuario = '$senha_post', foto = '$foto' where cpf_usuario = '$res[cpf_usuario]' ";

        $result_post = mysqli_query($conexao, $query_post);

        $_SESSION['cpf_usuario'] = $cpf_post;

        $_SESSION['foto'] = $foto;

        echo "<script language='javascript'>window.alert('Dados Alterados!!'); </script>";

        echo "<script language='javascript'>window.location='admin.php?acao=perfil&cpf=$cpf_post'; </script>";
    }

    ?>



<?php

    //fechamento do while

}

?>


<!--MASCARAS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#telefone').mask('(00) 00000-0000');
        $('#cpf').mask('000.000.000-00');
    });
</script>