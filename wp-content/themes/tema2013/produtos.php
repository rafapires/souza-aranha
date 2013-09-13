<?php 

/*Template Name: Produtos */
 
get_header(); ?>

<div id="sa_produtos">
	<div class="row-fluid">
		<ul class="thumbnails">
 			<?php
 			$newsArgs = array( 'post_type' => 'produtos', 'posts_per_page' => 4);                   
			$newsLoop = new WP_Query( $newsArgs );
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();?>
				<li class="span3">
					<div class="thumbnail">
						<?php the_post_thumbnail(); ?>
						<div class="caption">
							<h2><?php the_title(); ?></h2>
							<?php echo the_excerpt(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="btn btn-large btn-block btn-primary">Mais detalhes</a>				
                    </div>
				</li>
			<?php endwhile; // end of the loop. ?>
		</ul>
	</div>
</div>

<?php wp_reset_query(); ?>
<?php get_footer(); ?>
