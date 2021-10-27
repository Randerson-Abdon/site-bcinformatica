<?php
include_once('../conexao.php');
?>


<?php

//se existir o get comimg na url a foto recebe o caminho da url
if (isset($_GET['img'])) {
    //guardando img
    @$foto = $_GET['img'];
} else {
    @$foto = $res["logo_orgao"];
}

?>

<!--contenner-->
<div class="container ml-4">

    <div class="row">

        <div class="form-group col-md-6">
            <label for="inputAddress">Logo Cliente</label>
            <div class="custom-file">
                <!--multipart/form-data é sempre utilizado para subir arquivos-->
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="input-group">
                            <input type="file" class="form-control" id="foto" name="foto" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <button class="btn btn-orange" type="submit" name="atualizar">Visualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="form-group col-md-1">
            <!--trazendo foto do bd pelo while conforme login realizado-->
            <img src="../img/logo_clientes/<?php echo @$foto; ?>" width="120">
        </div>

    </div>


    <!--formulario-->
    <form class="mr-4" method="post">

        <!--linha01-->
        <div class="row">

            <div class="form-group col-md-6">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="id_produto">Nome/Razão Social</label>
                    <input type="text" class="form-control mr-2" name="nome_razao_social" placeholder="Nome/Razão Social" style="text-transform:uppercase;">
                </div>
            </div>

            <div class="form-group col-md-3">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="id_produto">CNPJ</label>
                    <input type="text" class="form-control mr-2" name="cnpj" placeholder="CNPJ" id="cnpj" style="text-transform:uppercase;">
                </div>
            </div>

            <div class="form-group col-md-3">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="id_produto">Email</label>
                    <input type="email" class="form-control mr-2" name="email" placeholder="Email">
                </div>
            </div>

            <div class="form-group col-md-5">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fornecedor">Cidade</label>
                    <input type="text" class="form-control mr-2" name="cidade" placeholder="Cidade" style="text-transform:uppercase;">
                </div>
            </div>

            <div class="form-group col-md-2">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fornecedor">UF</label>
                    <select class="form-select mr-2" name="uf" style="text-transform:uppercase;">

                        <option value="PA">PA</option>
                        <option value="MG">MG</option>
                        <option value="AP">AP</option>
                        <option value="MA">MA</option>

                    </select>
                </div>
            </div>

            <div class="form-group col-md-3">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="cep">CEP</label>
                    <input type="text" class="form-control mr-2" id="cep" name="cep" placeholder="CEP">
                </div>
            </div>

            <div class="form-group col-md-2">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="numero">N°</label>
                    <input type="text" class="form-control mr-2" id="numero" name="numero" placeholder="N°">
                </div>
            </div>

            <div class="form-group col-md-5">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fornecedor">Complemento</label>
                    <input type="text" class="form-control mr-2" name="complemento" placeholder="Complemento" style="text-transform:uppercase;">
                </div>
            </div>

            <div class="form-group col-md-4">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="id_produto">Fone Fixo</label>
                    <input type="text" class="form-control mr-2" name="fone_fixo" placeholder="Telefone" id="fone">
                </div>
            </div>

            <div class="form-group col-md-3">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="id_produto">Celular</label>
                    <input type="text" class="form-control mr-2" name="fone_movel" placeholder="Celular" id="cel">
                </div>
            </div>


            <div class="form-group col-md-3">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fornecedor">WhatsApp</label>
                    <select class="form-select mr-2" id="category" name="fone_zap" style="text-transform:uppercase;">

                        <option value="N">Não</option>
                        <option value="S">Sim</option>

                    </select>
                </div>
            </div>

            <div class="form-group col-md-5">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fornecedor">Responsável</label>
                    <input type="text" class="form-control mr-2" name="nome_responsavel" placeholder="Responsável" style="text-transform:uppercase;">
                </div>
            </div>

            <div class="form-group col-md-4">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="cpf">CPF do Responsável</label>
                    <input type="text" class="form-control mr-2" id="cpf" name="cpf_responsavel" placeholder="CPF">
                </div>
            </div>

            <div class="form-group col-md-8">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fornecedor">Observações</label>
                    <input type="text" class="form-control mr-2" name="observacoes" placeholder="Observações" style="text-transform:uppercase;">
                </div>
            </div>

        </div>

        <div class="col-12 d-md-flex justify-content-md-end">
            <button name="salvar" type="submit" class="btn btn-blue">Salvar Cliente</button>
            <button type="button" onclick="location.href='admin.php?acao=clientes'" class="btn btn-danger me-md-2">Cancelar</button>
        </div>

    </form>



</div>


<?php
//função para imagem de perfil, se existir faça
if (isset($_POST['atualizar'])) {

    //carregando foto
    $caminho = '../img/logo_clientes/' . $_FILES['foto']['name'];
    $nome = $_FILES['foto']['name'];
    $nome_temp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($nome_temp, $caminho);

    //redirecionando para atualizar a imagem
    echo "<script language='javascript'>window.location='admin.php?acao=novo_cliente&img=$nome'; </script>";
}

?>

<?php
//quando o post vier do botão salvar faça
if (isset($_POST['salvar'])) {

    $nome_razao_social  = mb_strtoupper($_POST['nome_razao_social']);

    $cnpj  = $_POST['cnpj'];
    $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

    $email = $_POST['email'];
    $cidade = mb_strtoupper($_POST['cidade']);

    $cep = $_POST['cep'];
    $cep = str_replace('-', '', $cep);

    $uf = $_POST['uf'];

    $numero = $_POST['numero'];
    $complemento = mb_strtoupper($_POST['complemento']);

    $fone_fixo = $_POST['fone_fixo'];
    $fone_fixo = preg_replace("/[^0-9]/", "", $fone_fixo);

    $fone_movel = $_POST['fone_movel'];
    $fone_movel = preg_replace("/[^0-9]/", "", $fone_movel);

    $fone_zap = $_POST['fone_zap'];
    $observacoes = mb_strtoupper($_POST['observacoes']);
    $nome_responsavel = mb_strtoupper($_POST['nome_responsavel']);

    $cpf_responsavel = $_POST['cpf_responsavel'];
    $cpf_responsavel = preg_replace("/[^0-9]/", "", $cpf_responsavel);

    echo $nome_razao_social . ', ' . $cnpj . ', ' . $email . ', ' . $cidade . ', ' . $cep . ', ' . $uf . ', ' . $numero . ', ' . $complemento . ', ' . $fone_fixo . ', ' . $fone_movel . ', ' . $fone_zap . ', ' . $observacoes . ', ' . $nome_responsavel . ', ' . $cpf_responsavel . ', ' . $foto;

    /* //atualização do perfil
    $query_user = "UPDATE perfil_saae SET nome_bairro_saae = '$bairro', nome_logradouro_saae = '$logradouro', numero_imovel_saae = '$numero', complemento_endereco_saae = '$complemento', cep_saae = '$cep', uf_saae = '$uf', uf_saae = '$uf', fone_saae = '$telefone', email_saae = '$email', home_page_saae = '$home_page', nome_gestor_saae = '$gestor', cpf_gestor_saae = '$cpf_gestor', numero_decreto_nomeacao = '$decreto', logo_orgao = '$foto' "; */

    $query_cliente = "INSERT INTO clientes (nome_razao_social, cnpj, email, cidade, cep, uf, numero, complemento, fone_fixo, fone_movel, fone_zap, observacoes, nome_responsavel, cpf_responsavel, logo_cliente) values ('$nome_razao_social', '$cnpj', '$email', '$cidade', '$cep', '$uf', '$numero', '$complemento', '$fone_fixo', '$fone_movel', '$fone_zap', '$observacoes', '$nome_responsavel', '$cpf_responsavel', '$foto')";

    $result_cliente = mysqli_query($conexao, $query_cliente);

    if ($result_cliente == '') {
        echo "<script language='javascript'>window.alert('Erro ao editar dados, tente novamente mais tarde!!!'); </script>";
    } else {
        echo "<script language='javascript'>window.alert('Cliente cadastrado com sucesso!!!'); </script>";
        //redirecionando para atualizar a imagem
        echo "<script language='javascript'>window.location='admin.php?acao=clientes'; </script>";
    }
}

?>

<!--MASCARAS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#fone').mask('(00) 0000-0000');
        $('#cel').mask('(00) 0000-0000');
        $('#cpf').mask('000.000.000-00');
        $('#cnpj').mask('00.000.000/0000-00');
        $('#cep').mask('00000-000');
    });
</script>