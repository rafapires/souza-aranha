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
							'posts_per_page'	=>	4,
							'show_posts'		=>	4
						);
						$my_posts = get_posts( $args );
						//print_r($my_posts);
						if( $my_posts) {
							$permalink = $my_posts[$i]->guid;
							echo   '<li class="span4">
										<span>';
											echo '<a href="'.$permalink.'">'. $my_posts[$i]->post_title;
											echo '</a>'; 
										echo '</span>
									</li>';
						}
						$my_posts="";
					}
					?>
				</ul>
			</div>
			<?php } ?>
		</div>
		<div id="sa_lista_whitepapers">
		
				<?php // Mostra os Whitepapers relacionados dos Produtos
				$termo_wps = get_the_terms( $post->ID, 'sa_whitepaper_taxonomy' );
				
				if(count($termo_wps) >1) {
					foreach($termo_wps as $term_wps){
						$slug_wps[] = $term_wps->slug;
					}
				}
				
				
				$qtd_wps = count($slug_wps);
				
				if ($qtd_wps > 0){
						
		?>
		
		
		
			<h3>Outros post do mesmo tema</h3>
			<ul>
				<?php // Mostra os Whitepapers relacionados dos Produtos
				
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
			
			<?php } ?>
		</div>

		
	</div>
</div>

<?php get_footer(); ?>