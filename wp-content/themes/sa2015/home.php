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
            <div class="container">
            <div class="row">
            <div class="carousel-caption">
                <a href="<?php the_permalink(); ?>">
	                <h4><?php the_title();?></h4>
	                <?php the_excerpt(); ?>
	            </a>
            </div>
            </div>
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

<div id="sa_call_actions" class="row">
    <div class="span4">
        <h1 class="sa_title_links">Ultimos Blogs</h1>
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
    <div id="sa_middle_action" class="span4">
        <h1 class="sa_title_links">Próximo Webinar</h1>
        <ul>
            <li>
            <?php 
            
            $webinars = array(
				'post_type'=> 'webinars',
				'post_per_page'=>1,
				'showposts'=>1,
				'order'    => 'DESC'
		);

			// The Query
			query_posts( $webinars );
			
			// The Loop
			while ( have_posts() ) : the_post();
			$post_webinar =  $post->ID;
            ?>
                <h1><?php the_title(); ?></h1>
                <?php the_excerpt(); ?>
                <div class="well well-small well-warning">
                    <h2>Inscrições Gratuítas</h2>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">Reserve já sua vaga</a>
                </div>
                
                <?php endwhile;?>
        		<?php wp_reset_query();?>
                
            </li>
        </ul>
        <?php         
        		$webinars_anteriores = array(
						'post_type'=> 'webinars',
						'post_per_page'=>5,
						'showposts'=>-1,
        				'post__not_in' => array($post_webinar) ,
						'order'    => 'DESC',
				);

			// The Query
			query_posts( $webinars_anteriores );
            if (have_posts()) { ?>
                <h1 class="sa_title_links">Webinars anteriores</h1>
                <ul>
        			<?php
        			// The Loop
        			while ( have_posts() ) : the_post();
        			
        			?>
                
                    <li>
                        <h1><?php the_title(); ?></h1>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-small pull-right">Assista</a>
                        <hr>
                    </li>
                        <?php endwhile;?>
                		<?php wp_reset_query();?>
          
          
          
                   <a href="#" class="btn btn-small btn-info btn-block">Lista completa</a>
                </ul>
            <?php } ?>
    </div>
    <div class="span4">
        <h1 class="sa_title_links">Nosso diferencial</h1>
        <ul>

        <?php echo do_shortcode('[nosso_diferencial]'); ?>
        
        </ul>
    </div>
</div>
<?php get_footer(); ?>
