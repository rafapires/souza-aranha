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
	<div class="span4">
		<div id="sa_clientes_relacionados">
			<h3>Clientes atendidos</h3>
			<div class="row-fluid">
				<ul class="thumbnails">
					<?php // Mostra as categorias dos Clientes Setados
					$terms = get_the_terms( $post->ID, 'sa_clientes_taxonomy' );
					
					if(count($terms) >1) {
						foreach($terms as $term){
							$slug[] = $term->slug;
						}
					}
					$qtd = count($slug);
					if ($qtd > 0):
						for($i=0;$i<$qtd; $i++){
							$the_slug = $slug[$i];
							$args=array(
								'name'				=>	$the_slug,
								'post_type'			=>	'clientes',
								'post_status'		=>	'publish',
								'posts_per_page'	=>	4
							);
							$my_posts = get_posts( $args );
							if( $my_posts ) {
								$permalink = get_permalink($my_posts[0]->ID);
								echo   '<li class="span4">
											<span class="thumbnail">';
												the_category();
												//echo '<a href="'.$permalink.'">'.get_the_post_thumbnail($my_posts[0]->ID, 'thumbnail').'</a>
												echo get_the_post_thumbnail($my_posts[0]->ID, 'thumbnail').'
											</span>
										</li>';
							}
						} else: ?>
							<ul><p>Não há Clientes Relacionados</p></ul>					
					<?php endif;?>
				</ul>
			</div>
		</div>
		<div id="sa_lista_whitepapers">
			<h3>Whitepapers relacionados</h3>
			<ul>
				<?php // Mostra os Whitepapers relacionados dos Produtos
				$terms_wps = get_the_terms( $post->ID, 'sa_whitepaper_taxonomy' );
				
				if(count($terms_wps) >1) {
				
					foreach($terms_wps as $term_wps){
						$slug_wps[] = $term_wps->slug;
					}
				}
				$qtd_wps = count($slug_wps);
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
					} else: ?>
						<ul><p>Não há Whitepapers Relacionados</p></ul>
					<?php endif;?>
			</ul>
		</div>
		<div id="sa_lista_posts_relacionados">
			<h3>Posts relacionados</h3>
			<ul>
				<?php // Mostra os Posts relacionados dos Produtos pelo slug do titulo
			       $slug_produto_principal = sanitize_title( get_the_title(), $fallback_title );
			       $recent = new WP_Query("sa_produtos_taxonomy=".$slug_produto_principal."&post_type=post&showposts=5");
			        if($recent->have_posts()): 
			          while($recent->have_posts()) : $recent->the_post();?>
			            <li>
			              <a href="<?php the_permalink(); ?>">
			                <h4><?php the_title(); ?></h4>
			                <?php the_excerpt(); ?>
			              </a>
			            </li>
			          <?php endwhile;
			        	else: ?>
			          <ul><p>Não há Posts Relacionados</p></ul>
				<?php endif; ?>  
			</ul>
		</div>
	</div>
</div>

<?php get_footer(); ?>