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
    </div>
    <div class="col-sm-4 sa-col-2">
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
        <ul>
            <?php //######## imprime ultimos dois webinars realizados
            $webinars_anteriores = array(
                    'post_type'=> 'webinars',
                    'post_per_page'=>2,
                    'showposts'=>-1,
                    'post__not_in' => array($post_webinar) ,
                    'order'    => 'ASC',
            );
            $query_webinars = new WP_Query($webinars_anteriores);
            if ($query_webinars->have_posts()){
                while ( $query_webinars->have_posts()) {
                    $query_webinars->the_post();
                    ?>
                    <li class="sa-webinar">
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                            <?php the_excerpt(); ?>
                            <span class='sa-seta'>></span>
                        </a>
                    </li>
                    <?php
                }
            } else {
                // não há webinars
            }
            wp_reset_postdata();

            ?>

        </ul>
    </div>
    <div class="col-sm-4">
        <h1 class="sa_title_links">Blog S.A.</h1>
        <ul>
        
        
		<?php
		$aRecentPosts = new WP_Query("&post_por_page=3&showposts=3&order=desc&orderby=date");
		while($aRecentPosts->have_posts()) : $aRecentPosts->the_post();?>
		
		           <li>
		                <h1><?php the_title(); ?></h1>
		                	<?php the_excerpt();?>
		                <a href="<?php the_permalink(); ?>" class="btn btn-small pull-right">leia mais</a>
		                <hr>
		            </li>
		
		<?php endwhile; ?>
        <?php wp_reset_query();?>
		<a href="#" class="btn btn-block btn-small">Lista completa</a>
     
         </ul>
    </div>
    
</div>
</div>
<?php get_footer(); ?>
