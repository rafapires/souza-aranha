<?php get_header();  ?>

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
		
		<div>
			<!--  REDES SOCIAIS -->
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_google_plusone_share"></a>
			<a class="addthis_button_orkut"></a>
			<a class="addthis_button_pinterest_share"></a>
			<a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ae0fea5719820b"></script>
			<!-- AddThis Button END -->		
		</div>

		<?php comments_template('', true); 
												
											
		?>
	</div>
	<div class="span4">
		<div id="sa_clientes_relacionados">
			<h3>Lista produtos relacionados</h3>
			<div class="row-fluid">
				<ul>
				
					<?php // Mostra os produtos relacionados Setados
					$terms = get_the_terms( $post->ID, 'sa_produtos_taxonomy' );
					foreach($terms as $term){
						$slug[] = $term->slug;
					}
					$qtd = count($slug);
					for($i=0;$i<$qtd; $i++){
						$the_slug = $slug[$i];
						$args=array(
							'name'				=>	$the_slug,
							'post_type'			=>	'produtos',
							'post_status'		=>	'publish',
							'posts_per_page'	=>	4
						);
						$my_posts = get_posts( $args );
						if( $my_posts ) {
							$permalink = get_permalink($my_posts[0]->ID);
							echo   '<li class="span4">
										<span>';
											the_category();
											//echo '<a href="'.$permalink.'">'.get_the_post_thumbnail($my_posts[0]->ID, 'thumbnail').'</a>';
											//echo get_the_post_thumbnail($my_posts[0]->ID, 'thumbnail').'
										echo '</span>
									</li>';
						}
					}?>
				</ul>
			</div>
		</div>
		<div id="sa_lista_whitepapers">
			<h3>Outros post do mesmo tema</h3>
			<ul>
				<?php // Mostra os Whitepapers relacionados dos Produtos
				$terms_wps = get_the_terms( $post->ID, 'sa_whitepaper_taxonomy' );
				foreach($terms_wps as $term_wps){
					$slug_wps[] = $term_wps->slug;
				}
				$qtd_wps = count($slug_wps);
				for($a=0;$a<$qtd_wps; $a++){
					$the_slug_wps = $slug_wps[$a];
					$args=array(
						'name'				=>	$the_slug_wps,
						'post_type'			=>	'whitepaper',
						'post_status'		=>	'publish',
						'posts_per_page'	=>	4
					);
					$my_posts_wps = get_posts( $args );
					if( $my_posts_wps ) {
						$permalink_wps = get_permalink($my_posts_wps[0]->ID);
						echo '<li>
								<a href="'.$permalink_wps.'">
								  	<h4>'
								  		.$my_posts_wps[0]->post_title.
								  	'</h4>'
									.$my_posts_wps[0]->post_excerpt.
								'</a>
							</li>';
					}
				}?>
			</ul>
		</div>

		
	</div>
</div>

<?php get_footer(); ?>