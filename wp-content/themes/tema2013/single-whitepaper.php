<?php get_header();  ?>

<?php global $slug; ?>
<div class="row">
	<div class="span8">
		<div id="sa_conteudo_produto">
			<?php if ( have_posts() ) :the_post();  ?>                        
				<div class="well">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div>
			<?php endif;?>
		</div>
	</div>
</div>

<?php get_footer(); ?>