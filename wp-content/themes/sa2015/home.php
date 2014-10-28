<?php 

/*Template Name: Home */
 
get_header(); ?>
<div class="row-fluid">
<div id="myCarousel" class="carousel slide col-sm-12">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        <li data-target="#myCarousel" data-slide-to="3" class=""></li>
    </ol>
    <div class="carousel-inner">
          <?php 
			$active = true;
			$newsArgs = array( 'post_type' => 'metodologias');
			$newsLoop = new WP_Query( $newsArgs );
			
			// The Loop
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();?>
    
        <div class="item <?php if ($active){echo 'active';}?>">
        
          <?php the_post_thumbnail( full, array('class' => 'sa_img_carrousel')) ?>
            <div class="carousel-caption">
                <a href="<?php the_permalink(); ?>">
	                <h4><?php the_title();?></h4>
	                <?php the_excerpt(); ?>
                    <p class="conheca">Conheça<span class="seta">></span></p>
	            </a>
            </div>
        </div>
        			
			<?php $active =false;?>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
</div>
<div class="container">
<div id="sa_call_actions" class="row">
    <div class="col-sm-4 sa-col-1">
        <h1 class="sa_title_links">SOLUÇÕES S.A.</h1>
        <?php the_content(); ?>
        <?php the_post_thumbnail( full, array('class' => 'sa-thumbnail-col-1 img-responsive')) ?>
        <span class="sa-mais pull-right">+ SAIBA MAIS</span>
    </div>
    <div class="col-sm-4 sa-col-2">
        <div class="sa-titulo">
            <?php  // ###### cria título da coluna com imagem pela pagina obrigatória Webinars.
                $page_webinar_root = array(
                    'post_type' => 'page',
                    'name'      => 'webinars'
                    );
                $query = new WP_Query($page_webinar_root);
                if ($query->have_posts()){
                    $query->the_post();
                    echo '<h1>'.get_the_title().'</h1>';
                    the_post_thumbnail( full, array('class'=>'sa-thumbnail-col-2 img-responsive'));
                }
                wp_reset_postdata();
            // ###### fim título ?>
        </div>
        <div class="row-fluid">
            <?php //######## imprime ultimos dois webinars realizados
            function limit_webinar(){
                return 'LIMIT 3';
            }
            add_filter('post_limits', 'limit_webinar');
            $webinars_anteriores = array(
                    'post_type'=> 'webinars',
                    'posts_per_page'=>1,
                    'showposts'=>-1,
                    'post__not_in' => array($post_webinar) ,
                    'order'    => 'ASC',
            );
            $query_webinars = new WP_Query($webinars_anteriores);
            remove_filter('post_limits', 'limit_webinar');
            if ($query_webinars->have_posts()){
                while ( $query_webinars->have_posts()) {
                    $query_webinars->the_post();
                    ?>
                    <div class="thumbnail clearfix sa-webinar">
                        <a href="<?php the_permalink(); ?>">
                            <div class="row-fluid vertical-align">
                                <div class="col-sm-9">
                                    <div class="caption pull-right">
                                        <h2><?php the_title(); ?></h2>
                                        <p><?php echo substr(get_the_excerpt(),0,90); ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/seta-dir-circulo-branco.png" class='center-block'>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            } else {
                // não há webinars
            }
            wp_reset_query();

            $page_webinar_root = array(
                'post_type' => 'page',
                'name'      => 'whitepapers'
                );
            $query = new WP_Query($page_webinar_root);
            if ($query->have_posts()){
                $query->the_post();
                echo '<h1>'.get_the_title().'</h1>';
                the_content();
            }
            wp_reset_postdata();
        ?>  

        </div>
    </div>
    <div class="col-sm-4 sa-col-3">
        <div class="sa-titulo">
             <?php  // ###### cria título da coluna com imagem pela pagina obrigatória Webinars.
                $page_blog_root = array(
                    'post_type' => 'page',
                    'name'      => 'blog-s-a'
                    );
                $query = new WP_Query($page_blog_root);
                if ($query->have_posts()){
                    $query->the_post();
                    echo '<h1>'.get_the_title().'</h1>';
                    the_post_thumbnail( full, array('class'=>'sa-thumbnail-col-3 img-responsive'));
                }
                wp_reset_postdata();
            // ###### fim título ?>  
        </div>
        <ul>
        
        
		<?php
        $posts_args = array(
            'numberposts'   => 4,
            'post_type'     => 'post',
            'post_status'   => 'publish'
            );
        $ultimos_posts = wp_get_recent_posts($posts_args, ARRAY_A);
        foreach ($ultimos_posts as $ultimos_post) {
//            echo '<pre>';
  //          print_r($ultimos_post);
    //        echo '</pre>';
      //      die();
            ?>
            <li>
                <a href="<?php echo get_permalink($ultimos_post['ID']); ?>">
                    <div class="sa-date">
                        <?php $sa_date = explode(" ", get_the_date('j M',$ultimos_post["ID"])); ?>
                        <span class='sa-day'><?php echo $sa_date[0]; ?></span>
                        <span class='sa-month'><?php echo $sa_date[1]; ?></span>
                    </div>
                    <div class="sa-post-resume">
                        <h2 class='sa-title-post'><?php echo $ultimos_post['post_title']; ?></h2>
                        <span class='sa-author'><?php echo the_author_meta('display_name',$ultimos_post['post_author']); ?></span>
                        <p><?php
                            if (!empty($ultimos_post['post_excerpt'])){
                                echo substr($ultimos_post['post_excerpt'],0,140);
                            }else{
                                echo substr($ultimos_post['post_content'],0,140);
                            }

                        ?></p>

                    </div>
                </a>
            </li>
        <?php


        }



        ?>
		<a href="#" class="btn btn-block btn-small">Lista completa</a>
     
         </ul>
    </div>
    
</div>
</div>
<?php get_footer(); ?>
