<?php
include_once('../conexao.php');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BC Informática - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../img/logo22.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo mr-auto"><a href="index.html">BC Informática <h6>Soluções em Tecnologia</h6></a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.html" class="mr-auto"><img width="80%" src="assets/img/logo_bc2.png" alt="" class="img-fluid"></a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="#about">Sobre Nós</a></li>
          <li><a href="#services">Serviços</a></li>
          <li><a href="#portfolio">Portfólio</a></li>
          <li><a href="#team">Nossa Equipe</a></li>
          <li><a href="#contact">Contato</a></li>
          <li class="drop-down"><a href="">Login</a>
            <ul>
              <li><a target="_blank" href="../login.php">Gestor</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>

        </ul>
      </nav><!-- .nav-menu -->

      <!-- botão iniciar do menu top -->
      <!--  <a id="iniciar" href="#about" class="get-started-btn scrollto">Iniciar</a> -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Melhores soluções para o seu negócio</h1>
          <h2>Nossa empresa é especializado em Soluções e Consultoria em TI, como Sites, Sistemas WEB, APPs, Servidores, Infraestrutura de Redes e muito mais... </h2>
          <div class="d-lg-flex">
            <a href="#about" class="btn-get-started scrollto">Iniciar</a>
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox btn-watch-video" data-vbtype="video" data-autoplay="true"> Assista o vídeo <i class="icofont-play-alt-2"></i></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Cliens Section ======= -->
    <section id="cliens" class="cliens section-bg">
      <div class="container">

        <header class="section-header">
          <h3>Nossos Clientes</h3>
        </header>

        <div class="row" data-aos="zoom-in">

          <?php

          $query_clientes = "SELECT * from clientes";
          $result_clientes = mysqli_query($conexao, $query_clientes);
          $linha_clientes = mysqli_num_rows($result_clientes);

          while ($res_clientes = mysqli_fetch_array($result_clientes)) {
            $logo_cliente = $res_clientes["logo_cliente"];

          ?>

            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
              <img src="../img/logo_clientes/<?php echo $logo_cliente; ?>" class="img-fluid" alt="">
            </div>



          <?php } ?>

        </div>

      </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Sobre Nós</h2>
        </div>

        <?php

        $query = "SELECT * from sobre_nos where id_sobre = '1' ";
        $result = mysqli_query($conexao, $query);
        $linha = mysqli_num_rows($result);

        while ($res = mysqli_fetch_array($result)) {
          $text_start_in = $res["text_start"];
          $text_end_in = $res["text_end"];

        ?>

          <div class="row content">
            <div class="col-lg-6">
              <p class="text-justify">
                <?php echo $text_start_in; ?>
              </p>
              <ul>

                <?php

                $query_espec = "SELECT * from especialidades";
                $result_espec = mysqli_query($conexao, $query_espec);
                $linha_espec = mysqli_num_rows($result_espec);

                while ($res_espec = mysqli_fetch_array($result_espec)) {
                  $descricao_curta = $res_espec["descricao_curta"];

                ?>

                  <li><i class="ri-check-double-line"></i> <?php echo $descricao_curta; ?></li>

                <?php } ?>

              </ul>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0">
              <p class="text-justify">
                <?php echo $text_end_in; ?>
              </p>
              <a href="#" class="btn-learn-more">Laia mais</a>
            </div>
          </div>

        <?php } ?>

      </div>
    </section><!-- End About Us Section -->


    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Serviços</h2>
          <p>Confira a baixo nossa gama de serviços oferecidos para melhor atendender as necessidas de nossos clientes.</p>
        </div>

        <div class="row">

          <?php

          $query_servico = "SELECT * from servicos";
          $result_servico = mysqli_query($conexao, $query_servico);
          $linha_servico = mysqli_num_rows($result_servico);

          while ($res_servico = mysqli_fetch_array($result_servico)) {
            $descricao_curta = $res_servico["descricao_curta"];
            $descricao_longa = $res_servico["descricao_longa"];

          ?>

            <div class="col-xl-4 col-md-6 d-flex align-items-stretch mb-2" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <div class="icon"><i class="bx bxl-dribbble"></i></div>
                <h4><a href=""><?php echo $descricao_curta; ?></a></h4>
                <p class="text-center"><?php echo $descricao_longa; ?></p>
              </div>
            </div>

          <?php } ?>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Confira Nosso Portifólio</h2>
          <p>Nosso portifólio compreende uma grande variedade de soluções para sua empresa, se você não encontrar o que procura entre em contato, criamos e personalizamos aplicações ao seu estilo. <a href="#contact">Contate-nos...</a></p>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">Todos</li>

          <?php
          $query_servico_pf = "SELECT descricao_curta from servicos";
          $result_servico_pf = mysqli_query($conexao, $query_servico_pf);
          $linha_servico_pf = mysqli_num_rows($result_servico_pf);
          while ($res_servico_pf = mysqli_fetch_array($result_servico_pf)) {
            $descricao_curta_pf = $res_servico_pf["descricao_curta"];

            $filter = str_replace(' ', '', $descricao_curta_pf)

          ?>

            <li data-filter=".filter-<?php echo $filter; ?>"><?php echo $descricao_curta_pf; ?></li>

          <?php } ?>
        </ul>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <?php
          $query_portifolio = "SELECT * from portifolio";
          $result_portifolio = mysqli_query($conexao, $query_portifolio);
          $linha_portifolio = mysqli_num_rows($result_portifolio);
          while ($res_portifolio = mysqli_fetch_array($result_portifolio)) {
            $descricao_portifolio = $res_portifolio["descricao_portifolio"];
            $categoria_portifolio = $res_portifolio["categoria_portifolio"];
            $imagem_portifolio    = $res_portifolio["imagem_portifolio"];

            $filter_cat = str_replace(' ', '', $categoria_portifolio)

          ?>

            <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $filter_cat; ?>">
              <div class="portfolio-img"><img src="../img/portifolio/<?php echo $imagem_portifolio; ?>" class="img-fluid" alt=""></div>
              <div class="portfolio-info">
                <h4><?php echo $descricao_portifolio; ?></h4>
                <p><?php echo $categoria_portifolio; ?></p>
                <a href="../img/portifolio/<?php echo $imagem_portifolio; ?>" data-gall="portfolioGallery" class="venobox preview-link" title="<?php echo $descricao_portifolio; ?>"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>

          <?php } ?>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Nossa Equipe</h2>
          <p>Nossa equipe é formada por um time de profissionais capacitados e pronto para atender as necessidades de sua empresa.</p>
        </div>

        <div class="row">

          <?php

          $query_equipe = "SELECT * from equipe";
          $result_equipe = mysqli_query($conexao, $query_equipe);
          while ($res_equipe = mysqli_fetch_array($result_equipe)) {
            $nome_equipe = $res_equipe["nome"];
            $cargo_equipe = $res_equipe["cargo"];
            $face_equipe = $res_equipe["facebook"];
            $twitter_equipe = $res_equipe["twitter"];
            $instagram_equipe = $res_equipe["instagram"];
            $linkedin_equipe = $res_equipe["linkedin"];
            $imagem_equipe = $res_equipe["imagem_equipe"];

            $query_cargo = "SELECT * from cargos WHERE nome_cargo = '$cargo_equipe'";
            $result_cargo = mysqli_query($conexao, $query_cargo);
            $res_cargo = mysqli_fetch_array($result_cargo);
            $descricao_cargo = $res_cargo['descricao_cargo'];

          ?>


            <div class="col-lg-6">
              <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                <div class="pic"><img src="../img/equipe/<?php echo $imagem_equipe; ?>" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4><?php echo $nome_equipe; ?></h4>
                  <span><?php echo $cargo_equipe; ?></span>
                  <p><?php echo $descricao_cargo; ?></p>
                  <div class="social">
                    <a target="_blank" href="<?php echo $twitter_equipe; ?>"><i class="ri-twitter-fill"></i></a>
                    <a target="_blank" href="<?php echo $face_equipe; ?>"><i class="ri-facebook-fill"></i></a>
                    <a target="_blank" href="<?php echo $instagram_equipe; ?>"><i class="ri-instagram-fill"></i></a>
                    <a target="_blank" href="<?php echo $linkedin_equipe; ?>"> <i class="ri-linkedin-box-fill"></i> </a>
                  </div>
                </div>
              </div>
            </div>

          <?php } ?>


        </div>

      </div>
    </section><!-- End Team Section -->


    <!-- ======= Frequently Asked Questions Section ======= -->
    <!-- <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>PERGUNTAS FREQUENTES</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-parent=".faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-parent=".faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-parent=".faq-list">
                <p>
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div> -->
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contate-nos</h2>
          <p>Mande suas duvidas pelo e-mail, telefone ou formulário de contado a baixo, se preferir entre em contato pelo whatsapp clicando na imagem do mesmo a direira do site.</p>
        </div>

        <?php

        $query_bc = "SELECT * from dados_bc";
        $result_bc = mysqli_query($conexao, $query_bc);
        $res_bc = mysqli_fetch_array($result_bc);
        $endereco = $res_bc['endereco'];
        $email_bc = $res_bc['email'];
        $fone_01 = $res_bc['fone_01'];
        $nome_bc = $res_bc['nome_bc'];
        $slogan_bc = $res_bc['slogan_bc'];


        ?>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Endereço:</h4>
                <p><?php echo $endereco; ?></p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>E-mail:</h4>
                <p><?php echo $email_bc; ?></p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Telefone:</h4>
                <p>+55 <?php echo $fone_01; ?></p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7621990986!2d-48.45863158528251!3d-1.318340336033727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x92a46136e97881f7%3A0xdadfd1b3c253014f!2sAlameda%20das%20Palmeiras%20-%20Parque%20Guajar%C3%A1%2C%20Bel%C3%A9m%20-%20PA%2C%2066821-300!5e0!3m2!1spt-BR!2sbr!4v1603294434029!5m2!1spt-BR!2sbr" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Seu Nome</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Insira pelo menos 4 caracteres" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Seu E-mail</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Por favor digite um e-mail válido" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Assunto</label>
                <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Insira pelo menos 8 caracteres do assunto" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <label for="name">Mensagem</label>
                <textarea class="form-control" name="message" rows="10" data-rule="required" data-msg="Por favor escreva algo para nós"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">carregando</div>
                <div class="error-message"></div>
                <div class="sent-message">Sua mensagem foi enviada. Obrigado!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensagem</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Escreva-se em nossa Newsletter</h4>
            <p>Fique sabendo com antecedência das novidades de nossa empresa</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Escrever-se">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Arsha</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

              -->

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span><?php echo $nome_bc; ?> <?php echo $slogan_bc; ?></span></strong>. Todos os direitos reservados
      </div>
      <div class="credits">

        Designed by <a href="#">DataPremium</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>