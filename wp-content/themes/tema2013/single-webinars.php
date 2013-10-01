<?php get_header();  ?>

<?php global $slug; ?>
<div class="row">
	<div class="span8">
	
		<div id="sa_conteudo_produto">

			
			<?php if ( have_posts() ) : the_post();  
	
			$id_ultimoWebinar =  $post->ID;
						

			?>
			           <li class="span35">
		                <h1><?php the_title(); ?></h1>
		                	<?php the_content();?>
		                <hr>
		                
		            </li>
	
		<?php endif;?>		
		<?php wp_reset_query(); ?>
		
		
		
		
		</div>
	</div>
	
	
	
		<div class="row">
		<ul class="thumbnails">
 			<?php
 			
 			$newsArgs = array(
 					'post_type'=> 'webinars',
 					'showposts'=>-1,
 					'post__not_in' => array($id_ultimoWebinar) ,
 					'order'    => 'DESC',
 			);
 			
			$newsLoop = new WP_Query( $newsArgs );
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();?>
				<li class="span35">
					<div class="thumbnail">				
						<div class="caption">
							<h2><?php the_title(); ?></h2>
							<?php echo the_content(); ?>
						</div>
						<a href="<?php the_permalink(); ?>">Mais detalhes</a>	
						</div>			
				</li>
			<?php endwhile; // end of the loop. ?>
		</ul>
	</div>
	
	
	
</div>

<?php get_footer(); ?>