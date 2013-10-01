<?php 

/*Template Name: Home */
 
get_header(); ?>

<div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner">

          <?php 
			
				
			$active = true;

			$newsArgs = array( 'post_type' => 'produtos');
			$newsLoop = new WP_Query( $newsArgs );
			
			// The Loop
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();?>
    
        <div class="item <?php if ($active){echo 'active';}?>">
        
          <?php the_post_thumbnail( full, array('class' => 'sa_img_carrousel')) ?>
            <div class="carousel-caption">
                <a href="<?php the_permalink(); ?>">
	                <h4><?php the_title();?></h4>
	                <?php the_excerpt(); ?>
	            </a>
            </div>
        </div>
        			
			<?php $active =false;?>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
    

    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
</div>
<div id="sa_call_actions" class="row">
    <div class="span4">
        <h1 class="sa_title_call_action">Ultimos Blogs</h1>
        <ul>
        
        
		<?php
		$aRecentPosts = new WP_Query("&post_por_page=4&showposts=4&order=desc&orderby=date");
		while($aRecentPosts->have_posts()) : $aRecentPosts->the_post();?>
		
		           <li>
		                <h1><?php the_title(); ?></h1>
		                	<?php the_excerpt();?>
		                <a href="<?php the_permalink(); ?>" class="btn btn-small pull-right">leia mais</a>
		                <hr>
		            </li>
		
		<?php endwhile; ?>
        <?php wp_reset_query();?>
		<a href="#" class="btn btn-small">Lista completa</a>
     
         </ul>
    </div>
    <div id="sa_middle_action" class="span4">
        <h1 class="sa_title_call_action">Próximo Webinar</h1>
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
                    <p>Faça sua pré-inscrição no Fale Conosco e aproveite e faça o download de <a href="<?php the_permalink(); ?>">As Melhores Práticas na Gestão do Funil de Vendas – Sales Pipeline Management.</a></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">Reserve já sua vaga</a>
                </div>
                
                <?php endwhile;?>
        		<?php wp_reset_query();?>
                
            </li>
        </ul>
        <h1 class="sa_title_call_action">Webinars anteriores</h1>
        <ul>
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
    </div>
    <div class="span4">
        <h1 class="sa_title_call_action">Nosso diferencial</h1>
        <ul>
            <li>
                <h1>Mercado de Consumo</h1>
                <p>Desenvolvemos cases de sucesso em relacionamento para empresas nas mais diversas áreas do mercado de consumo</p>
                <hr>
            </li>
            <li>
                <h1>Mercado B to B</h1>
                <p>Programas de alto desempenho para aumentar a competitividade e produtividade da sua força de vendas.</p>
                <hr>
            </li>
            <li>
                <h1>Agências</h1>
                <p>Por ser uma consultoria indenpendente, a Souza Aranha é uma aliada das agências no desenvolvimento de soluções de relacionamento.</p>
                <hr>
            </li>
            <li>
                <h1>Informação</h1>
                <p>Para a área de informação de Marketing, a Souza Aranha auxilia a conhecer seus clientes e facilitar a atualização e integração de dados.</p>
                <hr>
            </li>
        </ul>
    </div>
</div>
<?php get_footer(); ?>
