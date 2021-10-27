<?php
include_once('../../conexao.php');
include_once('../controller/controller_contas_recebidas.php');

/* //trazendo info bairro
$query_ps = "SELECT * FROM bairro WHERE id_localidade = '$id_localidade' AND id_bairro = '$id_bairro' ";
$result_ps = mysqli_query($conexao, $query_ps);
$row_ps = mysqli_fetch_array($result_ps);
$nome_bairro = $row_ps['nome_bairro'];

$titulo = strtolower($nome_bairro); */

$id_banco        = $_POST['id_banco'];
$periodo_inicial = $_POST['periodo_inicial'];
$periodo_final   = $_POST['periodo_final'];

if ($periodo_inicial != '' && $periodo_final != '') {

    if ($periodo_inicial > $periodo_final) {
        echo "<script language='javascript'>window.alert('A Data Inícial não pode ser maior que a Data Final!!!'); </script>";
        echo "<script language='javascript'>window.close(); </script>";
        exit();
    }
}

if ($periodo_inicial != '') {
    $periodo_inicial = date('d/m/Y', strtotime($_POST['periodo_inicial'])); //recebe data já convertida
}

if ($periodo_final != '') {
    $periodo_final = date('d/m/Y', strtotime($_POST['periodo_final'])); //recebe data já convertida
}

$result = lista_documento_arrecadacao($id_banco, $periodo_inicial, $periodo_final);

$linha_count = mysqli_num_rows($result);

//echo $id_banco . ', ' . $periodo_inicial . ', ' . $periodo_final . ', ' . $linha_count;

//trazendo info bancos
$query_banco = "SELECT * FROM banco_conveniado WHERE id_febraban = '$id_banco'";
$result_banco = mysqli_query($conexao, $query_banco);
$row_banco = mysqli_fetch_array($result_banco);
$nome_banco = $row_banco['nome_banco'];

$titulo = strtolower($nome_banco);

?>

<!DOCTYPE html>
<html lang="en" style="width: 110%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1 style="font-size: 30px;">
        <title> Relatório Banco <?php echo ucwords($titulo); ?> </title>
    </h1>
    <!-- LINK DO BOOTSTRAP via cdn(navegador) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- LINK DO fontawesome via cdn(navegador) para icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body style="width: 110%;">


    <script>
        window.print();
        window.addEventListener("afterprint", function(event) {
            window.close();
        });
        window.onafterprint();
    </script>

    <style>
        @media print {
            tr:nth-child(even) td {
                background-color: #e9e9e9 !important;
                -webkit-print-color-adjust: exact;
            }

        }

        img.face {
            float: right;
            border: transparent thin solid;
            padding: 5px;
            margin: 0px 10px 10px 0px;
            max-width: 1386px;
            margin-left: 1270px;
            margin-top: 30px;

        }

        img.face2 {
            float: left;
            border: transparent thin solid;
            padding: 5px;
            margin: 0px -250px 10px 0;
            max-width: 1386px;
            margin-top: 30px;
        }
    </style>



    <div class="container ml-4" style="width: 110%;">

        <br>

        <div class="content" style="width: 110%;">
            <div class="row" style="width: 110%;">
                <div class="col-md-12" style="width: 110%;">

                    <!--TAMANHO DA TABELA -->
                    <div class="card-body" style="width: 110%;">
                        <div class="card" style="width: 120%; margin-left: -50px;">
                            <div class="table-responsive">

                                <?php

                                //trazendo info perfil_saae
                                $query_ps = "SELECT * from perfil_saae";
                                $result_ps = mysqli_query($conexao, $query_ps);
                                $row_ps = mysqli_fetch_array($result_ps);
                                @$nome_prefeitura = $row_ps['nome_prefeitura'];
                                //mascarando cnpj
                                @$cnpj_saae = $row_ps['cnpj_saae'];
                                $p1 = substr($cnpj_saae, 0, 2);
                                $p2 = substr($cnpj_saae, 2, 3);
                                $p3 = substr($cnpj_saae, 5, 3);
                                $p4 = substr($cnpj_saae, 8, 4);
                                $p5 = substr($cnpj_saae, 12, 2);
                                $saae_cnpj = $p1 . '.' . $p2 . '.' . $p3 . '/' . $p4 . '-' . $p5;
                                @$nome_bairro_saae = $row_ps['nome_bairro_saae'];
                                @$nome_logradouro_saae = $row_ps['nome_logradouro_saae'];
                                @$numero_imovel_saae = $row_ps['numero_imovel_saae'];
                                @$nome_municipio_saae = $row_ps['nome_municipio_saae'];
                                @$uf_saae = $row_ps['uf_saae'];
                                @$nome_saae = $row_ps['nome_saae'];
                                @$email_saae = $row_ps['email_saae'];
                                @$logo_orgao = $row_ps['logo_orgao'];

                                $data = date('d/m/Y');


                                ?>

                                <table style="margin-bottom: 15px; margin-left: 30px;">
                                    <thead>
                                        <tr>
                                            <th>

                                                <img class="face2" width="10%" src="../../img/sIzabel/saae.png" alt="">

                                                <img class="face" width="10%" src="../../img/sIzabel/prefeitura.png" alt="">

                                                <p class="text-center" style="margin-top: 40px; margin-left: 450px; position: absolute;">


                                                    <?php echo $nome_prefeitura . ' - ' . $uf_saae; ?> <br>
                                                    <?php echo $nome_saae; ?> <br>
                                                    SISTEMA DE GESTÃO COMERCIAL E OPERACIONAL ‐ SAAENET <br>
                                                    RELATÓRIO DE ARRECADAÇÃO - <?php echo $data . ' - BANCO ' . $nome_banco; ?> <br>

                                                </p>

                                            </th>
                                        </tr>
                                </table>



                                <table class="table table-sm table-bordered table-striped" style="margin-top: -20px;">

                                    <thead>

                                        <th style="background-color: darkgrey !important;">
                                            DATA DO ARQUIVO
                                        </th>
                                        <th style="background-color: darkgrey !important;">
                                            NOME DO ARQUIVO
                                        </th>
                                        <th style="background-color: darkgrey !important;">
                                            QTDE. DE DOC
                                        </th>
                                        <th style="background-color: darkgrey !important;">
                                            VALOR
                                        </th>
                                        <th style="background-color: darkgrey !important;">
                                            SEQUENCIAL
                                        </th>

                                    </thead>
                                    <tbody>

                                        <?php
                                        $qty = 0;
                                        $qty1 = 0;
                                        while ($res = mysqli_fetch_array($result)) {
                                            $data_arquivo = $res["DTA. ARQUIVO"];
                                            $nome_arquivo = $res["NOME ARQUIVO"];
                                            $quantidade   = $res["QTDE. DOC."];
                                            $valor        = $res["VALOR DOC."];
                                            $valor02      = $res["VALOR DOCII"];
                                            $sequencial   = $res["SEQ.DOC."];

                                            $qty += $quantidade;
                                            $totalQuantidade = $qty;

                                            $qty1 += $valor;
                                            $totalGeralDebitos = $qty1;

                                        ?>

                                            <tr>

                                                <td><?php echo $data_arquivo; ?></td>
                                                <td><?php echo $nome_arquivo; ?></td>
                                                <td><?php echo $quantidade; ?></td>
                                                <td><?php echo $valor02; ?></td>
                                                <td><?php echo $sequencial; ?></td>

                                            </tr>

                                        <?php }
                                        ?>

                                    </tbody>



                                </table>


                                <table class="table table-sm table-bordered" style="margin-top: 40px; color: #d70000 !important; background-color: #c0c0c0 !important;">
                                    <thead>

                                        <th style="background-color: darkgrey !important; color: black;">
                                            TOTAL DE REGISTROS BAIXADOS
                                        </th>
                                        <th style="background-color: darkgrey !important; color: black;">
                                            VALOR TOTAL ARRECADADO
                                        </th>


                                    </thead>

                                    <tbody>

                                        <tr>

                                            <td><?php echo $totalQuantidade; ?></td>
                                            <td>R$ <?php echo number_format($totalGeralDebitos, 2, ",", "."); ?></td>

                                        </tr>

                                    </tbody>

                                </table>


                                </form>

                            </div>

                        </div>
                    </div>

                </div>

            </div>


</body>

</html>