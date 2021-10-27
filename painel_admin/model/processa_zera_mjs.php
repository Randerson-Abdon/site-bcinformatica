<?php
session_start();

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>post1</title>
</head>

<body>

    <?php

    $bd = $_POST['bd'];
    $id = $_POST['id_unidade_consumidora'];
    $competencia = $_POST['competencia'];

    /* if ($bd == null || $id == null || $competencia == null) {
        echo "<h3>&nbsp;&nbsp;&nbsp;Preencha pelomenos o campo de CPF/CNPJ!!!</h3>";
        echo "<br/>";
        exit();
    } */

    $comp = explode("/", $competencia);
    $competencia = $comp[1] . '/' . $comp[0];

    include_once("../../conexao$bd.php");

    $query_u = "SELECT nome_razao_social, numero_cpf_cnpj FROM unidade_consumidora WHERE id_unidade_consumidora = '$id' ";
    $result_u = mysqli_query($conexao, $query_u);
    $row_u = mysqli_fetch_array($result_u);
    $nome_razao_social = $row_u['nome_razao_social'];
    $numero_cpf_cnpj = $row_u['numero_cpf_cnpj'];

    $sql = "SELECT * FROM historico_financeiro WHERE id_unidade_consumidora = '$id' AND mes_faturado = '$competencia'";
    $query = mysqli_query($conexao, $sql);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
    ?>
        <div class="container ml-4">
            <br>
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <!-- colocar aqui titulos -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead class="text-secondary">
                                    <tr>

                                        <th scope="col">
                                            Tarifa
                                        </th>
                                        <th scope="col">
                                            Juros
                                        </th>
                                        <th scope="col">
                                            Multas
                                        </th>
                                        <th scope="col">
                                            Serviços
                                        </th>
                                        <th scope="col">
                                            Total Tarifa
                                        </th>


                                        <th scope="col">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($sqlline = mysqli_fetch_array($query)) {
                                        $total_geral_tarifa        = $sqlline["total_geral_tarifa"];
                                        $total_multas_faturadas    = $sqlline["total_multas_faturadas"];
                                        $total_juros_faturados     = $sqlline["total_juros_faturados"];
                                        $total_servicos_requeridos = $sqlline['total_servicos_requeridos'];
                                        $total_geral_faturado      = $sqlline['total_geral_faturado'];

                                        //trabalhando a data
                                        //$data2 = implode('/', array_reverse(explode('-', $data)));

                                    ?>

                                        <tr>

                                            <td><?php echo $total_geral_tarifa; ?></td>
                                            <td><?php echo $total_multas_faturadas; ?></td>
                                            <td><?php echo $total_juros_faturados; ?></td>
                                            <td><?php echo $total_servicos_requeridos; ?></td>
                                            <td><?php echo $total_geral_faturado; ?></td>


                                            <td>
                                                <a class="btn btn-orange btn-sm" href="admin.php?acao=mjs&func=zerar&id=<?php echo $id; ?>&mes_faturado=<?php echo $competencia; ?>&tarifa=<?php echo $total_geral_tarifa; ?>&bd=<?php echo $bd; ?>&servicos=<?php echo $total_servicos_requeridos; ?>"><i class="fas fa-edit"></i></a>

                                            </td>
                                        </tr>


                                    <?php } ?>
                                </tbody>
                            </table>


                        </div>
                    <?php } else { ?>

                        <p class="danger">Não foram encontrados registros com esses parametros!</p>

                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>