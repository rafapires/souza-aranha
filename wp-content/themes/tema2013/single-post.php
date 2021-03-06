<?php get_header();  ?>

<div class="row">
	<div class="span8">
		<div id="sa_conteudo_produto">
			<?php if ( have_posts() ) :the_post();  
			$id_ultimo_post =  $post->ID;
			// $titulo_post_atual = $post->post_title;
			?>                        
				<div class="well">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div>
			<?php endif;?>
			<?php wp_reset_query(); ?>			
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
		<?php // Mostra os produtos relacionados Setados
		
		/** Função que busca o id da taxonomia (de nome tipo)**/
		$termo = get_the_terms( $post->ID , 'sa_produtos_taxonomy');
	
		if(count($termo) >1) {
			foreach( $termo as $term ) {
				$slug[] = $term->slug;
			}
		}
		
		
		$qtd = count($slug);
		if ($qtd > 0){

		?>
		
			<h3>Lista produtos relacionados</h3>
			<div class="row-fluid">
				<ul>
				
					<?php for($i=0;$i<$qtd; $i++){ 
						$the_slug = $slug[$i];
						$args=array(
							'name'				=>	$the_slug,
							'post_type'			=>	'produtos',
							'post_status'		=>	'publish',
							'posts_per_page'	=>	1,
							'show_posts'		=>	1
						);
						$my_posts = get_posts( $args );
						//print_r($my_posts);
						if( $my_posts) {
							$permalink =  get_permalink($my_posts[0]->ID);
							echo   '<li class="span4" style="width:100%">
										<span>';
											echo '<a href="'.$permalink.'">'. $my_posts[0]->post_title;
											echo '</a>'; 
										echo '</span>
									</li>';
						}
						
					}
					?>
				</ul>
			</div>
			<?php } ?>
			<?php wp_reset_postdata(); ?>
		</div>
		
		
		<div id="sa_lista_whitepapers">
		
				<?php // Mostra os Whitepapers relacionados dos Produtos
				$terms_wps = get_the_terms( $post->ID, 'sa_whitepaper_taxonomy' );

				if(count($terms_wps) >1) {
				
					foreach($terms_wps as $term_wps){
						$slug_wps[] = $term_wps->slug;
					}
				}
				$qtd_wps = count($slug_wps);
				?>

				<h3>Whitepapers relacionados</h3>
				<ul>
				
				<?php
				if ($qtd_wps > 0):
					for($a=0;$a<$qtd_wps; $a++){
						$the_slug_wps = $slug_wps[$a];
						$args=array(
							'name'				=>	$the_slug_wps,
							'post_type'			=>	'whitepaper',
							'post_status'		=>	'publish',
							'posts_per_page'	=>	4
						);
						$my_posts_wps = get_posts( $args );
						//print_r($my_posts_wps);
						if( $my_posts_wps ) {
							$permalink_wps = get_permalink($my_posts_wps[0]->ID);
							echo '<li style="width:100%">
									<a href="'.$permalink_wps.'">
									  	<h4>'
									  		.$my_posts_wps[0]->post_title.
									  	'</h4>'
										.$my_posts_wps[0]->post_excerpt.
									'</a>
								</li>';
						}
						?>
						</ul>
						<?php 
					} else: ?>
						<ul><p>Não há Whitepapers Relacionados</p></ul>
					<?php endif;?>
					<?php wp_reset_postdata(); ?>						


		</div>

			<div id="sa_lista_whitepapers">
				<?php // Mostra os posts relacionados

					$cats = get_the_category($post->ID);
					$catlist = '';
					foreach ($cats as $c) { //escreve categorias do post na forma 12,34,3554,34,... SIMPLES ASSIM
						if ($catlist!='') {
							$catlist.=',';
						}
						$catlist.=$c->cat_ID;

					}

?>

				<h3>Posts relacionados</h3>
				<ul>
<?php

						// 1. Loop
						$queryA = new WP_Query(array(
								'posts_per_page' => 5,
								'cat' => $catlist,
								'post__not_in' => array($id_ultimo_post)
						));

						
						while ( $queryA->have_posts() ) : $queryA->the_post();
																
						echo '<li style="width:100%">
									<a href="'.get_permalink().'">
									  	<h4>';
						
								the_title();
								
						echo '</h4></a>
								</li>';
							

						endwhile;	

?>														

				</ul>
		
											


		</div>
		
	</div>
</div>

<?php get_footer(); ?>
