<?php
include_once('../conexao.php');
include_once('../verificar_autenticacao.php');
?>

<?php

if ($_SESSION['nivel_usuario'] != '1' && $_SESSION['nivel_usuario'] != '0') {
    header('Location: ../login.php');
    exit();
}

$query = "SELECT * from sobre_nos where id_sobre = '1' ";
$result = mysqli_query($conexao, $query);
$linha = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós</title>
</head>

<body>

    <?php

    while ($res = mysqli_fetch_array($result)) {
        $text_start_in = $res["text_start"];
        $text_end_in = $res["text_end"];
        $text_end_in = $res["text_end"];

    ?>

        <form method="POST" action="">
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1"><b>Textarea Start</b></label>
                <textarea class="form-control" name="text_start" id="exampleFormControlTextarea1" rows="5"><?php echo $text_start_in; ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1"><b>Textarea End</b></label>
                <textarea class="form-control" name="text_end" id="exampleFormControlTextarea1" rows="5"><?php echo $text_end_in; ?></textarea>
            </div>

            <button type="button" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Adicionar Especialidade
            </button>

            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
        </form>

    <?php } ?>


    <!--CADASTRO -->
    <?php
    if (isset($_POST['enviar'])) {
        $text_start = $_POST['text_start'];
        $text_end = $_POST['text_end'];

        if ($linha == 0) {
            $query = "INSERT INTO sobre_nos (text_start, text_end) values ('$text_start', '$text_end')";
        } else {
            $query = "UPDATE sobre_nos SET text_start = '$text_start', text_end = '$text_end' where id_sobre = '1' ";
        }

        $result = mysqli_query($conexao, $query);

        if ($result == '') {
            echo "<script language='javascript'>window.alert('Ocorreu um erro ao Salvar!'); </script>";
        } else {
            echo "<script language='javascript'>window.alert('Salvo com Sucesso!'); </script>";
            echo "<script language='javascript'>window.location='admin.php?acao=sobre_nos'; </script>";
        }
    }
    ?>



    <!--ADICIONANDO ESPECIALIDADES--->
    <?php

    //consulta para numeração automatica
    $query_num_cad = "SELECT * from especialidades order by id_especialidade  desc ";
    $result_num_cad = mysqli_query($conexao, $query_num_cad);
    $res_num_cad = mysqli_fetch_array($result_num_cad);

    ?>

    <!-- Modal serviço -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Nova Especialidade</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">

                        <div class="form-group col-md-12 mb-3">
                            <label for="id_produto">Descrição Curta</label>
                            <input type="text" class="form-control" name="descricao_curta" />
                        </div>

                        <div class="form-group col-md-12 mb-3">
                            <label for="exampleFormControlTextarea1">Descrição Longa</label>
                            <textarea class="form-control" name="descricao_longa" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="col-md-12 d-md-flex justify-content-md-end" style="margin-top: 20px;">
                            <label for="id_produto"></label>
                            <button type="submit" class="btn btn-blue" name="salvar_sevico">Adicionar</button>
                        </div>
                    </form>


                    <!--INICIO DA TABELA -->
                    <div class="table-responsive ml-3 mr-3">

                        <!--LISTAR TODOS OS CURSOS -->
                        <?php

                        $query_espec = "SELECT * from especialidades";
                        $result_espec = mysqli_query($conexao, $query_espec);

                        $linha_espec = mysqli_num_rows($result_espec);

                        if ($linha_espec == 0) {
                            echo "<p> Não há especialidades cadastradas!!! </p>";
                        } else {

                        ?>


                            <!--- table-sm= small = menor-->
                            <table class="table table-sm">
                                <thead class="text-secondary">


                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Descrição
                                    </th>


                                    <th>
                                        Ações
                                    </th>
                                </thead>
                                <tbody>

                                    <?php
                                    $soma = 0;
                                    while ($res = mysqli_fetch_array($result_espec)) {
                                        $id_especialidade = $res["id_especialidade"];
                                        $descricao_curta = $res["descricao_curta"];

                                    ?>

                                        <tr>


                                            <td><?php echo $id_especialidade; ?></td>
                                            <td><?php echo $descricao_curta; ?></td>



                                            <td>
                                                <!--- botão com função dupla na modal, sem isso não fica na mesma tela-->
                                                <a class="text-orange" title="Editar" href="#"><i class="fas fa-edit"></i></a>


                                                <a class="text-danger" title="Excluir" href="#"><i class="fa fa-minus-square"></i></a>


                                            </td>
                                        </tr>

                                    <?php } ?>


                                </tbody>
                                <tfoot>
                                    <tr>

                                        <td></td>
                                        <td></td>


                                        <td>
                                            <span class="text-muted">Registros: <?php echo $linha_espec ?> </span>
                                        </td>
                                    </tr>

                                </tfoot>
                            </table>

                        <?php
                        }
                        ?>

                    </div>



                    <!--fim da linha-->
                </div>



            </div>

        </div>
    </div>


    <?php

    //salvando seviços do requerimento, se tiver post no botão salvar aula, recupera o nome e o link
    if (isset($_POST['salvar_sevico'])) {
        $descricao_curta = $_POST['descricao_curta'];
        $descricao_longa = $_POST['descricao_longa'];

        $query = "INSERT INTO especialidades (descricao_curta, descricao_longa) values ('$descricao_curta', '$descricao_longa')";

        $result = mysqli_query($conexao, $query);

        if ($result == '') {
            echo "<script language='javascript'>window.alert('Ocorreu um erro ao Salvar!'); </script>";
        } else {
            echo "<script language='javascript'>window.alert('Adicionado com sucesso!'); </script>";
            echo "<script language='javascript'>window.location='admin.php?acao=sobre_nos'; </script>";
        }
    }

    ?>



</body>

</html>