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
                                                              
                         

$newsArgs = array( 'post_type' => 'clientes', 'posts_per_page' => 4);

$newsLoop = new WP_Query( $newsArgs );


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

//echo get_the_post_thumbnail('103', 'thumbnail');



                       
      				 ?>
					
					
					
				</ul>
			</div>
		</div>
		<div id="sa_lista_whitepapers">
			<h3>Whitepapers relacionados</h3>
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