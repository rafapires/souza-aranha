<?php 

 
get_header(); ?>
<div id="sa_single" class="container">
	<div id="sa_fullwidth" class="row">
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
</div>
<?php get_footer(); ?>