<?php 

get_header();
$custom_fields = get_post_custom();
?>

<div id="sa_single" class="container">
	<div id="sa_fullwidth" class="row">
		<div id="sa_conteudo">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
			?>
				<span class='sa_data_webinar'>
					<?php echo strftime('%d de %B de %Y, %A', strtotime(str_replace("-","/",get_post_meta( get_the_ID(), 'sa_data_webinar', true)))); ?> | <?php echo get_post_meta(get_the_ID(),'sa_hora_webinar',true); ?>
				</span>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<div class="row-fluid">
					<div class="col-sm-3">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class='col-sm-9'>
						<?php the_excerpt(); ?>
					</div>
					<div class="col-sm-12 sa_destaque_link">
						<div class="row">
							<div class="col-sm-9">
								<p>Inscreva-se gratuitamente
								<?php
								$whitepapers_relacionados = get_the_terms( $post->ID, 'sa_whitepapers_taxonomy');

								if ($whitepapers_relacionados) {
									foreach ($whitepapers_relacionados as $whitepaper_item) {
										$args_whitepaper = array(
											'post_type'			=> 'whitepapers',
											'post_status'		=> 'publish',
											'order'				=> 'DESC',
											'orderby'			=> 'date',
											'post_name'			=> $whitepaper_item->slug
											);
										$whitepaper_posts = get_posts($args_whitepaper);
									}
									?>
									e aproveite para fazer o download de <a href="<?php echo get_the_permalink($whitepaper_posts[0]->ID); ?>"><strong>
									<?php echo $whitepaper_posts[0]->post_title; ?></strong></a>
									<?php
								}else{
									echo '.';
								}

								?>
								</p>
							</div>
							<div class="col-sm-3 sa_btn_inscricao">
								<a href="<?php echo get_post_meta(get_the_ID(),'sa_url_webinar',true);?>" target="_blank">
									<p>Clique aqui para se inscrever<span class='seta'>></span></p>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php
				}
			};
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>