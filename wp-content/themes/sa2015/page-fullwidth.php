<?php 

/*Template Name: full width */
 
get_header(); ?>
<div id="sa_fullwidth" class="container">
	<div id="sa_conteudo">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
		?>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		<?php
			}
		};
		?>
	</div>
</div>
<?php get_footer(); ?>