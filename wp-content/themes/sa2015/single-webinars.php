<?php 
remove_filter( 'the_excerpt', 'wpautop' );
get_header();
$custom_fields = get_post_custom();
?>

<div id="sa_single" class="container">
	<div id="sa_fullwidth" class="row">
		<div id="sa_conteudo" class="sa_webinar">
			<div class="row">
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
					<div class="row">
						<div class="col-sm-3">
							<?php the_post_thumbnail(large, array ('class'=>'img-responsive')); ?>
						</div>
						<div class='col-sm-9'>
							<h3><?php the_excerpt(); ?></h3>
							<span class='col-sm-6'><?php the_author_meta('description'); ?></span>
						</div>
					</div>
					<div class="col-sm-8 sa_destaque_link">
						<div class="row vbottom-align">
							<div class="col-sm-8">
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
							<div class="col-sm-4 sa_btn_inscricao">
								<a href="<?php echo get_post_meta(get_the_ID(),'sa_url_webinar',true);?>" target="_blank">
									<p>Clique aqui para se inscrever<span class='seta'>></span></p>
								</a>
							</div>
						</div>
					</div>
					<?php
						}
					};
					?>
			</div>
			<div class="row sa_webinars_anteriores">
				<?php
				$args_webinars_antigos = array (
					'post_type'			=> 'webinars',
					'post_status'		=> 'publish',
					'meta_key'			=> 'sa_status_webinar',
					'meta_value'		=> 'realizado'
					);
				$webinars_antigos = new WP_query($args_webinars_antigos);
				if ( $webinars_antigos->have_posts() ) {
					?>
						<h3>Webinars anteriores</h3>
					<?php
					while ($webinars_antigos->have_posts()){
						$webinars_antigos->the_post();
						?>
						<div class="thumbnail clearfix col-sm-4">
							<?php echo get_the_post_thumbnail( $webinars_antigos->ID, thumbnail, array('class'=>'img-responsive pull-left') ); ?>
							<div class="caption">
								<h2><?php echo get_the_title(); ?></h2>
								<p><?php
                                    if (!empty(get_the_excerpt($webinars_antigos->ID))){
                                        echo substr(strip_tags(get_the_excerpt($webinars_antigos->ID)),0,180);
                                    }else{
                                        echo substr(strip_tags(get_the_content($webinars_antigos->ID)),0,180);
                                    }
                                    ?>
                                </p>
							</div>
							<span class='seta-saibamais pull-right'>
                                Saiba mais
                                <img src="<?php bloginfo('template_url'); ?>/img/seta-link-azul.png">
                            </span>
						</div>

					<?php
					}
				}
				wp_reset_postdata();
				?>
			</div>
	        <a href="<?php echo esc_url( home_url( '/webinars' ) ) ;?>" class="btn btn-block btn-small btn-primary">Lista completa</a>

		</div>
	</div>
</div>
<?php get_footer(); ?>