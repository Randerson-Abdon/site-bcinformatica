<?php
include_once('conexao.php');
session_start();
?>

<?php
//verificação de login
if (empty($_POST['login_usuario']) || empty($_POST['senha_usuario'])) {
	//se estiver vazio redireciona para login
	header('location:login.php');
	//finalizando
	exit();
}


//validação de tipos de caracteres recebidos nos campos
$login_usuario = mysqli_real_escape_string($conexao, $_POST['login_usuario']);
$senha_usuario = mysqli_real_escape_string($conexao, $_POST['senha_usuario']);
//$senha_usuario = password_hash($senha_usuario, PASSWORD_DEFAULT);

//consulta para validação de login
$query = "select * from usuario_sistema where login_usuario = '$login_usuario' and senha_usuario = '$senha_usuario'";
$result = mysqli_query($conexao, $query);
$dado = mysqli_fetch_array($result);
$linha = mysqli_num_rows($result);
$id = $dado['id_usuario'];


if ($linha > 0) {
	//armazenamento de dados no memonto que o usuario fizer acesso
	$_SESSION['login_usuario'] 	= $login_usuario;
	$_SESSION['nome_usuario']  	= $dado['nome_usuario'];
	$_SESSION['nivel_usuario'] 	= $dado['nivel_usuario'];
	$_SESSION['cpf_usuario']   	= $dado['cpf_usuario'];
	$_SESSION['id_usuario']    	= $dado['id_usuario'];
	$_SESSION['status_usuario'] = $dado['status_usuario'];
	$_SESSION['foto'] 			= $dado['foto'];


	if ($_SESSION['status_usuario'] == 'I') {
		$_SESSION['inativado'] = true;
		header('location:login.php');
	} else {

		//se o nivel de usuario for admin ir para painel admin
		if ($_SESSION['nivel_usuario'] == '1') {
			header('location:painel_admin/admin.php');
			exit();
		}
	}
} else {
	//
	$_SESSION['nao_autenticado'] = true;
	header('location:login.php');
}


?>