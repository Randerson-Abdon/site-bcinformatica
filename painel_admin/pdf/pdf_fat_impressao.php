<?php
session_start();
header('Content-type: text/html; charset=UTF-8');
include_once("../../conexao$bd.php");

$query = "SELECT * from view_resumo_sequencial_boletos";
$result = mysqli_query($conexao, $query);
$linha = mysqli_num_rows($result);

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

<style>
    table {
        width: 100%;
        border: 1px solid darkgray;
    }

    thead {
        background-color: darkgray;
    }

    .borda {
        background-color: darkgray !important;
        font-weight: bold;
    }

    tbody {
        background-color: #e4e4e4;
    }
</style>

<!DOCTYPE html>
<html lang="pt-BR" style="width: 110%;">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1 style="font-size: 30px;">
        <title> Relatório de Impressão </title>
    </h1>

</head>

<body>

    <!-- Cabeçalho -->
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">
                    <img src="http://www.bcinformatica.com.br/img/parametros/<?php echo $bd ?>/logo_saae.jpeg" alt="">
                </th>

                <th>
                    <p style="font-size: 10pt;">
                        <?php echo $nome_prefeitura . ' - ' . $uf_saae; ?> <br>
                        <?php echo $nome_saae; ?> <br>
                        SISTEMA DE GESTÃO COMERCIAL E OPERACIONAL SAAENET <br>
                    </p>
                </th>

                <th style="width: 10%;">
                    <img src="http://www.bcinformatica.com.br/img/parametros/<?php echo $bd ?>/logo_municipio.jpeg" alt="">
                </th>
            </tr>

            <tr>
                <th colspan="3" style="padding: 5px;">
                    Relatório de Faturamento: <?php echo date('m/Y', strtotime('-1 month', strtotime(date('d-m-Y')))); ?> - <?php echo 'Gerado em ' . $data; ?>
                </th>
            </tr>

        </thead>
    </table>

    <!-- corpo -->
    <table class="table table-striped table-bordered">
        <thead style="font-size: 14pt;">
            <tr>

                <th>
                    Nome do Logradouro
                </th>
                <th>
                    Seq. Ini
                </th>
                <th>
                    Seq. Fim
                </th>
                <th>
                    N.º Fat.
                </th>

            </tr>
        </thead>
        <tbody>

            <?php
            $bairro_anterior = '000';
            while ($res = mysqli_fetch_array($result)) {
                $id_localidade   = $res["ID LOC"];
                $id_bairro       = $res["ID BAI"];
                $id_logradouro   = $res["ID LOG"];
                $endereco        = $res["ENDEREÇO"];
                $inicio          = $res["SEQ INI"];
                $fim             = $res["SEQ FIM"];
                $total           = $res["TOTAL"];
                $nome_localidade = $res["NOME LOC"];
                $nome_bairro     = $res["NOME BAI"];

            ?>
                <?php if ($bairro_anterior != $id_bairro) { ?>
                    <tr>
                        <td class="borda" colspan="5">
                            BAIRRO <?php echo $nome_bairro; ?><?php echo $nome_localidade != 'CAMETA' ? '/' . $nome_localidade : ''; ?>
                        </td>
                    </tr>
                <?php } ?>

                <tr>
                    <td><?php echo $endereco; ?></td>
                    <td><?php echo $inicio; ?></td>
                    <td><?php echo $fim; ?></td>
                    <td><?php echo $total; ?></td>

                </tr>

            <?php
                $bairro_anterior = $id_bairro;
            }

            ?>

        </tbody>

    </table>

    <!-- rodapé -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>

                <th>
                    TOTAL GERAL DE FATURAS IMPRESSAS
                </th>
                <th>
                    <?php echo $linha; ?>
                </th>

            </tr>
        </thead>


    </table>

</body>

</html>