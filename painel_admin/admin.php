<?php
ini_set('memory_limit', '-1');
session_start();
include_once('../verificar_autenticacao.php');

if ($_SESSION['nivel_usuario'] != '1' && $_SESSION['nivel_usuario'] != '0') {
  header('Location: ../login.php');
  exit();
}

?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html>
<!--Linguagem -->
<html lang="pt-br">

<head>
  <!-- reconhecer caracteres especiais -->
  <meta charset="utf8_encode">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- adaptação para qualquer tela -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- mecanismos de busca -->
  <meta name="description" content="Descrição das buscas">
  <meta name="author" content="Autores">
  <meta name="keywords" content="palavras chaves de busca, palavra, palavra">

  <title>BC Informática - Gestor</title>

  <link href="../img/logo22.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <script type="text/javascript" src="../js/painel.js"></script>
  <script type="text/javascript" src="../js/script.js"></script>
  <script type="text/javascript" src="../js/javascript.js"></script>
  <script type="text/javascript" src="../js/post.js"></script>

  <!-- LINK DO fontawesome via cdn(navegador) para icones -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

  <!-- link com a folha de stilos -->
  <link rel="stylesheet" type="text/css" href="../css/estilos-site.css">
  <link rel="stylesheet" type="text/css" href="../css/estilos-padrao.css">
  <link rel="stylesheet" type="text/css" href="../css/cursos.css">
  <link rel="stylesheet" type="text/css" href="../css/painel.css">
  <link rel="stylesheet" type="text/css" href="../css/cards.css">

  <!-- OS SCRIPTS DEVEM SEMPRE VIM DEPOIS DAS FOLHAS DE ESTILO -->
  <!-- script cdn(pelo navegador) jquery.min.js para menu em resoluções menores -->


  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>


</head>


<!-- body com id para link interno -->

<body id="page-top">

  <!-- configuração do navbar preto e fixado ao topo -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php" target="_blank">
        <img src="../img/logo.png" class="img_logo">
        <span class="texto_logo">BC INFORMÁTICA - GESTOR</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="d-md-flex justify-content-md-end collapse navbar-collapse" id="navbarSupportedContent">
        <form class="d-flex" style="margin-left: 45%;">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-4">

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../img/equipe/<?php echo $_SESSION['foto']; ?>" class="rounded-circle z-depth-0" alt="avatar image" width="35" height="35">
                <span style="margin-right: 10px;" class="text-muted nome_usuario"><?php echo $_SESSION['nome_usuario']; ?> </span><i class="fas fa-user"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="admin.php?acao=perfil&cpf=<?php echo $_SESSION['cpf_usuario']; ?>">Perfil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <a class="dropdown-item" href="../logout.php">Sair</a>
              </ul>



            </li>

            <!--    <li>
              <img src="../img/equipe/<?php echo $_SESSION['foto']; ?>" class="rounded-circle z-depth-0" alt="avatar image" width="35" height="35">
              <span class="text-muted nome_usuario"><?php echo $_SESSION['nome_usuario']; ?> </span>
            </li> -->



          </ul>
        </form>
      </div>
    </div>
  </nav>

  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark fa-2x" href="#">
      <i class="fas fa-bars "></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper bg-dark">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="admin.php">Painel Administrativo</a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>

        <!-- sidebar-header  -->

        <div class="sidebar-menu">
          <ul>

            <li class="header-menu">
              <span>Módulo Gerencial</span>
            </li>

            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-user-tag"></i>
                <span>Landing Page</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="admin.php?acao=sobre_nos">Sobre Nós</a>
                  </li>
                  <li>
                    <a href="admin.php?acao=clientes">Nossos Clientes</a>
                  </li>
                  <li>
                    <a href="admin.php?acao=servicos">Serviços</a>
                  </li>
                  <li>
                    <a href="admin.php?acao=portifolio">Portifólio</a>
                  </li>
                  <li>
                    <a href="admin.php?acao=equipe">Nossa Equipe</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-user-tag"></i>
                <span>Ações</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="admin.php?acao=mjs">Update Fatura</a>
                  </li>

                </ul>
              </div>
            </li>

            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-user-tag"></i>
                <span>Relatórios</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="admin.php?acao=relFatImp">Faturamento e Impressão</a>
                  </li>

                </ul>
              </div>
            </li>


            <li class="header-menu">
              <span>Módulo de Estoque</span>
            </li>

            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-dolly"></i>
                <span>Cadastros</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="admin.php?acao=usuarios">Usuários do Sistema</a>
                    </a>
                  </li>
                  <li>
                    <a href="#">Itens Administrativo</a>
                  </li>
                  <li>
                    <a href="#">Fornecedores</a>
                  </li>
                  <li>
                    <a href="#">Requerimentos de saídas de material</a>
                  </li>
                  <li>
                    <a href="#">Nota de Devolução de Material</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-chart-line"></i>
                <span>Relatórios</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="#">Resumo de Entradas e Saídas de Material</a>
                  </li>
                  <li>
                    <a href="#">Saldo de Estoque</a>
                  </li>
                  <li>
                    <a href="#">Pedidos de Material</a>
                  </li>
                </ul>
              </div>
            </li>


            <li class="header-menu">
              <span>Extra</span>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Documentação</span>
                <span class="badge badge-pill badge-primary">Beta</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Calendario</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-folder"></i>
                <span>Examplos</span>
              </a>
            </li>
            <br>
          </ul>
        </div>
        <!-- sidebar-menu  -->
      </div>
      <!-- sidebar-content  -->
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="page-content">

      <!-- adaptação aos tamanhos de tela/ grande/medio/pequena -->
      <div style="width: 90%;">

        <!--CARREGAMENTO DAS DEMAIS PÁGINAS DO PAINÉL -->
        <?php
        if (@$_GET['acao'] == 'usuarios' or isset($_GET['txtpesquisarUsuarios'])) {
          include_once('view/usuarios_sistema.php');
        } elseif (@$_GET['acao'] == 'sobre_nos') {
          include_once('view/sobre_nos.php');
        } elseif (@$_GET['acao'] == 'clientes' or isset($_GET['txtpesquisarClientes'])) {
          include_once('view/nossos_clientes.php');
        } elseif (@$_GET['acao'] == 'novo_cliente') {
          include_once('view/cadastro_clientes.php');
        } elseif (@$_GET['acao'] == 'servicos' or isset($_GET['txtpesquisarServicos'])) {
          include_once('view/servicos.php');
        } elseif (@$_GET['acao'] == 'portifolio' or isset($_GET['txtpesquisarPortifolio'])) {
          include_once('view/portifolio.php');
        } elseif (@$_GET['acao'] == 'equipe' or isset($_GET['txtpesquisarColaborador'])) {
          include_once('view/equipe.php');
        } elseif (@$_GET['acao'] == 'relFatImp') {
          include_once('view/fat_impressao.php');
        } elseif (@$_GET['acao'] == 'perfil') {
          include_once('view/perfil.php');
        } elseif (@$_GET['acao'] == 'mjs') {
          include_once('view/zera_mjs.php');
        } else {
          include_once('home.php');
        }

        ?>

      </div>

    </main>
    <!-- page-content" -->
  </div>

</body>

</html>