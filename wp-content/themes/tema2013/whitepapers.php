<?php 

/*Template Name: Whitepapers */
 
get_header(); ?>

<div class="panel panel-primary">


			<?php
		$aRecentPosts = new WP_Query("post_type=whitepaper&post_por_page=1&showposts=1&order=desc&orderby=date");
		while($aRecentPosts->have_posts()) : $aRecentPosts->the_post();
		
		$id_ultimoWebinar =  $post->ID;
		?>
			           <li class="span35">
		                <h1><?php the_title(); ?></h1>
		                	<?php the_content();?>
		                <!-- <a href="<?php the_permalink(); ?>" class="btn btn-small pull-right">leia mais</a> -->
		                <hr>
		            </li>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>



	<div class="row">
		<ul class="thumbnails">
 			<?php
 			$newsArgs = array( 'post_type' => 'whitepaper', 'posts_per_page' => 4);                   
			$newsLoop = new WP_Query( $newsArgs );
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();?>
				<li class="span35">
					<div class="thumbnail">
						<?php the_post_thumbnail(); ?>
						<div class="caption">
							<h2><?php the_title(); ?></h2>
							<?php echo the_excerpt(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="btn btn-large btn-block btn-primary">Baixe aqui</a>				
                    </div>
				</li>
			<?php endwhile; // end of the loop. ?>
		</ul>
	</div>
</div>

<?php wp_reset_query(); ?>
<?php get_footer(); ?>
