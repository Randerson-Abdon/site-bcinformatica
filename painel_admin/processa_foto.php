<?php
//função para imagem de perfil, se existir faça


//carregando foto
$caminho = '../img/logo_clientes/' . $_FILES['foto']['name'];
$nome = $_FILES['foto']['name'];
$nome_temp = $_FILES['foto']['tmp_name'];
move_uploaded_file($nome_temp, $caminho);

//redirecionando para atualizar a imagem
echo "<script language='javascript'>window.location='admin.php?acao=novo_cliente&img=$nome'; </script>";
