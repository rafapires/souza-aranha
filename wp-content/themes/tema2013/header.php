<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ADFAP - Adm. de bens e condominios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="container">
        <div class="acima-menu">
      <a class="brand" href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/img/logo-souza-aranha.jpg"></a>
      <img src="<?php bloginfo('template_url'); ?>/img/slogan-souza-aranha.jpg">
        <form class="navbar-form pull-right">
            <input class="span2" type="text" placeholder="Email">
            <input class="span2" type="password" placeholder="Password">
            <button type="submit" class="btn">Sign in</button>
        </form>
        </div>
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            
            <div class="nav-collapse collapse">
              <ul class="nav">
                
                <?php wp_list_pages(array('title_li' => '', 'exclude' => 4)); ?>

              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>
    </div>
    <div class="container">
