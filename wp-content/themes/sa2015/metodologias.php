<?php 

/*Template Name: Metodologias */
 
get_header(); ?>

<div id="sa_metodologias" class="container">
	<div class="row">
		<ul class="thumbnails">
 			<?php
 			$newsArgs = array( 'post_type' => 'metodologias', 'posts_per_page' => 4);                   
			$newsLoop = new WP_Query( $newsArgs );
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();?>
				<li class="col-sm-3">
					<div class="thumbnail">
						<?php the_post_thumbnail('metodologia_list'); ?>
						<div class="caption">
							<h2 class="sa_title_links"><?php the_title(); ?></h2>
							<p><?php echo get_post_meta(get_the_ID(),'sa_diferencial_metodologia',true ); ?></p>
						</div>
						<a href="<?php the_permalink(); ?>" >
							<span class='seta-saibamais pull-right'>
								Saiba mais
	                            <img src="<?php bloginfo('template_url'); ?>/img/seta-link-azul.png">
	                        </span>
						</a>				
                    </div>
				</li>
			<?php endwhile; // end of the loop. ?>
		</ul>
	</div>
</div>

<?php wp_reset_query(); ?>
<?php get_footer(); ?>
