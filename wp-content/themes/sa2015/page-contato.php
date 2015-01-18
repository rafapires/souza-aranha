<?php 

/*Template Name: contato */
 
get_header(); ?>
<div id="sa_single" class="container">
	<div id="sa_fullwidth" class="sa_cadastro">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
		?>
			<h1>Contato</h1>
			<div class="col-sm-6 col-sm-offset-3">
				<?php the_content(); ?>
			</div>
		<?php
			}
		};
		?>
	</div>
</div>
<?php get_footer(); ?>