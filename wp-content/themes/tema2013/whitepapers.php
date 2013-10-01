<?php 

/*Template Name: Whitepapers */
 
get_header(); ?>

<div class="panel panel-primary">


			<?php
		$aRecentPosts = new WP_Query("post_type=whitepaper&post_por_page=1&showposts=1&order=desc&orderby=date");
		while($aRecentPosts->have_posts()) : $aRecentPosts->the_post();
		
		$id_ultimoWhitepaper =  $post->ID;
	
		 $link_pdf =  get_post_meta($post->ID,'wp_custom_attachment', true);
		 	
		 
		 //echo "<pre>";print_r($a['url']);echo "</pre>";
		?>
		
		<?php if($link_pdf['url']): ?>
			           <li class="span35">
		                <h1><?php the_title(); ?></h1>
		                	<?php the_content();?>
		                <a href="<?php echo $link_pdf['url']; ?>" class="btn btn-large btn-block btn-primary">Baixe aqui</a>
		                <hr>
		                
		            </li>
			<?php endif; endwhile; ?>
			<?php wp_reset_query(); ?>



	<div class="row">
		<ul class="thumbnails">
 			<?php
 			$newsArgs = array(
 					'post_type'=> 'whitepaper',
 					'post_per_page'=>5,
 					'showposts'=>-1,
 					'post__not_in' => array($id_ultimoWhitepaper),
 					'order'    => 'DESC',
 			);
 			
			$newsLoop = new WP_Query( $newsArgs );
			
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();
			
			
			$link_pdf2 =  get_post_meta($post->ID,'wp_custom_attachment', true);
			
			?>
		<?php if($link_pdf2['url']): ?>
	
				<li class="span35">
					<div class="thumbnail">
						<div class="caption">
							<h2><?php the_title(); ?></h2>
							<?php echo the_content(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="btn btn-large btn-block btn-primary">Baixe aqui</a>				
                    </div>
				</li>
			<?php endif;
			endwhile; // end of the loop. ?>
		</ul>
	</div>
</div>

<?php wp_reset_query(); ?>
<?php get_footer(); ?>
