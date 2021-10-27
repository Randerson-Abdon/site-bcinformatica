<?php
//inlimitando memoria usada pelo script
ini_set('memory_limit', '-1');
include_once('../verificar_autenticacao.php');

?>

<!-- para o load -->
<style>
    #imgpos {
        margin-left: 30%;
        top: 80%;
        /* posiciona a 70px para baixo */
        display: none;
        z-index: 2 !important;

    }
</style>


<div class="modal-body" style="margin-top: -50px;">
    <form method="POST" action="">
        <h5 class="modal-title">Update Fatura</h5>

        <hr>
        <div class="row">

            <!-- CONSULTA POR UNIDADE CONSUMIDORA-->
            <div id="uc" name="uc">
                <div class="row">

                    <div class="form-group col-md-3 mb-3">
                        <label for="fornecedor">Município</label>
                        <select class="form-select mr-2" id="bd" name="bd" style="text-transform:uppercase;">

                            <option value="002">Cametá</option>
                            <option value="001">Santa Izabel</option>

                        </select>
                    </div>


                    <div class="form-group col-md-2 mb-3">
                        <label for="id_produto">UC</label>
                        <input type="number" class="form-control" minlength="2" name="id_unidade_consumidora" placeholder="UC" required>
                    </div>

                    <div class="form-group col-md-2 mb-3">
                        <label for="id_produto">Competência</label>
                        <input type="text" class="form-control" name="competencia" id="competencia" required>
                    </div>


                    <div class="form-group col-md-2">
                        <label for="id_produto">Buscar</label>
                        <button type="button" class="btn btn-blue form-control" id="buscar3" style="height: 38px;"><i class="fas fa-search"></i></button>
                    </div>

                </div>

            </div>
            <div class="form-group" id="dados3" style="display: none; margin-left: -25px;"></div>

        </div>

        <div class="modal-footer">


    </form>
</div>


<!-- EXIBIÇÃO ZERAR -->
<?php
if (@$_GET['func'] == 'zerar') {
    $id = $_GET['id'];
    $mes_faturado = $_GET['mes_faturado'];
    $tarifa = $_GET['tarifa'];
    $bd = $_GET['bd'];
    $serv = $_GET['servicos'];

    include_once("../conexao$bd.php");

?>
    <!-- Modal -->
    <div class="modal fade" id="zera_mjs" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Selecione as variaveis a serem processadas</h5>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="multas">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Zerar Multas
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="juros">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Zerar Juros
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="servicos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Zerar Serviços
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button name="salvar" type="submit" class="btn btn-blue">Processar</button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['salvar'])) {

        $multa    = isset($_POST['multas']) ? true : false;
        $juros    = isset($_POST['juros']) ? true : false;
        $servicos = isset($_POST['servicos']) ? true : false;

        $tarifa_total = $tarifa + $serv;

        //echo $id . ', ' . $mes_faturado . ', ' . $tarifa_total;

        if ($multa && $juros && $servicos) {
            $query = "UPDATE historico_financeiro SET total_multas_faturadas = '0.00', total_juros_faturados = '0.00',total_servicos_requeridos = '0.00', total_geral_faturado = '$tarifa' WHERE id_unidade_consumidora = '$id' AND mes_faturado = '$mes_faturado'";
            $result = mysqli_query($conexao, $query);
            if ($result == '') {
                echo "<script language='javascript'>window.alert('Ocorreu um erro ao Iniciar!'); </script>";
            } else {
                echo "<script language='javascript'>window.alert('Processado com Sucesso!'); </script>";
                echo "<script language='javascript'>window.location='admin.php?acao=mjs'; </script>";
            }
        } elseif ($multa && $juros) {
            $query = "UPDATE historico_financeiro SET total_multas_faturadas = '0.00', total_juros_faturados = '0.00', total_geral_faturado = '$tarifa_total' WHERE id_unidade_consumidora = '$id' AND mes_faturado = '$mes_faturado'";
            $result = mysqli_query($conexao, $query);
            if ($result == '') {
                echo "<script language='javascript'>window.alert('Ocorreu um erro ao Iniciar!'); </script>";
            } else {
                echo "<script language='javascript'>window.alert('Processado com Sucesso!'); </script>";
                echo "<script language='javascript'>window.location='admin.php?acao=mjs'; </script>";
            }
        } else {
            echo "<script language='javascript'>window.alert('Selecione uma opção!!!'); </script>";
        }

    ?>

<?php }
} ?>



<script>
    $("#buscar3").click(function() {
        $("#dados3").hide();
        $("#imgpos").show();
        $.ajax({
            url: "model/processa_zera_mjs.php",
            type: "POST",
            data: ({
                bd: $("select[name='bd']").val(),
                id_unidade_consumidora: $("input[name='id_unidade_consumidora']").val(),
                competencia: $("input[name='competencia']").val()
            }), //estamos enviando o valor do input
            success: function(resposta) {
                $("#imgpos").hide();
                $("#dados3").show();
                $('#dados3').html(resposta);
            }

        });
    });
</script>


<script>
    var myModal = document.getElementById('zera_mjs')
    var myInput = document.getElementById('myInput')

    $(document).ready(function() {
        $('#zera_mjs').modal('show');
    })

    myModal.addEventListener('shown.bs.modal', function() {
        myInput.focus()
    })
</script>


<!--MASCARAS -->

<script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
    $("input[id*='numero_cpf_cnpj']").inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true
    });
</script>

<script>
    $("input[id*='competencia']").inputmask({
        mask: ['99/9999'],
        keepStatic: true
    });
</script>

<img src="../img/load.gif" width="25%" alt="logo do site Maujor" id="imgpos" />