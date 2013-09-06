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
	</div>
	<div class="span4">
		<div id="sa_clientes_relacionados">
			<h3>Clientes atendidos</h3>
			<div class="row-fluid">
				<ul class="thumbnails">
					
					<?php
 
							 // Mostra as categorias dos Clientes Setados
							                                                              
							                         
							
							/*$newsArgs = array( 'post_type' => 'clientes', 'posts_per_page' => 4);
							
							$newsLoop = new WP_Query( $newsArgs );*/
							
							
							$terms = get_the_terms( $post->ID, 'sa_clientes_taxonomy' );
							
							foreach($terms as $term){
								$slug[] = $term->slug;
							}
							
							$qtd = count($slug);
							
							for($i=0;$i<$qtd; $i++){
							
							
							
									$the_slug = $slug[$i];
									$args=array(
											'name' => $the_slug,
											'post_type' => 'clientes',
											'post_status' => 'publish',
											'posts_per_page' => 4
									);
									$my_posts = get_posts( $args );
									if( $my_posts ) {
							
										
										$permalink = get_permalink($my_posts[0]->ID);
							
							
										echo '<li class="span4">
											  <span class="thumbnail">';
										     the_category();
										echo '<a href="'.$permalink.'">'.get_the_post_thumbnail($my_posts[0]->ID, 'thumbnail').'</a>
												</span>
											</li>';
							
									}
							}

                       
      				 ?>
		
					
				</ul>
			</div>
		</div>
		<div id="sa_lista_whitepapers">
			<h3>Whitepapers relacionados</h3>
			<ul>
			
					<?php
 
							 // Mostra os Whitepapers relacionados dos Produtos							                                                              
							                         
							$terms_wps = get_the_terms( $post->ID, 'sa_whitepaper_taxonomy' );
							
							//print_r($terms_wps);
							
							foreach($terms_wps as $term_wps){
								$slug_wps[] = $term_wps->slug;
							}
							
							$qtd_wps = count($slug_wps);
							
							for($a=0;$a<$qtd_wps; $a++){
							
							
							
									$the_slug_wps = $slug_wps[$a];
									$args=array(
											'name' => $the_slug_wps,
											'post_type' => 'whitepaper',
											'post_status' => 'publish',
											'posts_per_page' => 4
									);
									$my_posts_wps = get_posts( $args );
									
									if( $my_posts_wps ) {
							
										
										$permalink_wps = get_permalink($my_posts_wps[0]->ID);
							
							
										echo '<li>
											  <a href="'.$permalink_wps.'">
												<h4>'; 
											echo $my_posts_wps[0]->post_title;
											echo '</h4>';     
										echo $my_posts_wps[0]->post_excerpt;
										echo '</a>
												
											</li>';
							
									}
							}

                       
      				 ?>			
			
			</ul>
		</div>
		<div id="sa_lista_posts_relacionados">
			<h3>Posts relacionados</h3>
			<ul>
			
			
				<li>
					<a href="#">
						<h4>A Gestão Eficaz do Funil de Vendas</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie turpis in dui volutpat, ut iaculis est interdum</p>
					</a>
				</li>
				<li>
					<a href="#">
						<h4>A Gestão Eficaz do Funil de Vendas</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie turpis in dui volutpat, ut iaculis est interdum</p>
					</a>
				</li>
				<li>
					<a href="#">
						<h4>A Gestão Eficaz do Funil de Vendas</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie turpis in dui volutpat, ut iaculis est interdum</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>

<?php get_footer(); ?>