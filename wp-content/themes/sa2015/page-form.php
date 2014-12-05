<?php 

/*Template Name: forms */
 
get_header(); ?>
<div id="sa_single" class="container">
	<div id="sa_fullwidth" class="row">
		<div class="col-sm-4">
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
		<div id="sa_form" class="col-sm-8">
			<?php
			$custom_fields = get_post_custom_values('frm_form_id');
			if ($custom_fields){
				echo do_shortcode('[formidable id='.$custom_fields[0].']');
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>