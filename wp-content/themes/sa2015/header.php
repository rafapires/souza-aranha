<!DOCTYPE html>

<html lang="pt-br"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico">

    <title>Souza Aranha</title>

    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]
    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <meta name="chromesniffer" id="chromesniffer_meta" content="{&quot;jQuery&quot;:&quot;1.11.1&quot;}"><script type="text/javascript" src="chrome-extension://homgcnaoacgigpkkljjjekpignblkeae/detector.js"></script>
  <?php wp_enqueue_script("jquery"); ?>
  <?php wp_head(); ?>
  </head>
    <body cz-shortcut-listen="true">

    <div id="<?php echo $post->post_name; ?>" <?php post_class('container'); ?>>

    <section id="header">
      <div class="container-fluid">
      <div class="row">
        <div class="col-sm-8">
          <div class="row">
            <a href="<?php echo site_url(); ?>">
              <div class="col-sm-6">
                <img src="<?php bloginfo('template_url'); ?>/img/logo-souza-aranha.jpg">
              </div>
              <div class="col-sm-6">
                <img src="<?php bloginfo('template_url'); ?>/img/slogan-souza-aranha.jpg" class="img-responsive">
              </div>
            </a>
          </div>
          <div class="row">
            <nav class="navbar navbar-default" role="navigation">
              <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php
                  wp_nav_menu(
                    array(
                      'theme_location'  =>  'main-menu',
                      'container'       =>  false,
                      'items_wrap'      =>  '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>'
                      )
                    );
                ?>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
          </div>

        </div>
        <div id="login-form" class="col-sm-4">
          <div id="login-area" class="row-fluid">
            <form class="form-inline" role="form">
              <div class="form-group">
                <label class="sr-only" for="user-email">Email</label>
                <input type="email" class="form-control input-sm" id="user-email" placeholder="email">
              </div>
              <div class="form-group">
                <label class="sr-only" for="user-pass">Senha</label>
                <input type="password" class="form-control input-sm" id="user-pass" placeholder="senha">
              </div>
              <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-arrow-right"></span></button>
            </form>
          </div>
          <div id="links-header" class="row-fluid">
            <a href="#"><img src="<?php bloginfo('template_url'); ?>/img/linkedin.png"></a>
            <a href="#"><img src="<?php bloginfo('template_url'); ?>/img/slideshare.png"></a>
            <a href="#" class="pull-right"><img class="fone" src="<?php bloginfo('template_url'); ?>/img/fone.png"><span class="fale-conosco">Fale Conosco</span></a>

          </div>

        </div>
      </div>
      </div>

    </section>