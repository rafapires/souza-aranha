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
					<?php // chama a categoria clientes
						$newsArgs = array( 'post_type' => 'clientes', 'posts_per_page' => 4);                   
						$newsLoop = new WP_Query( $newsArgs );                  
						while ( $newsLoop->have_posts() ) : $newsLoop->the_post();  ?>
							<li class="span4">
								<span class="thumbnail">
		                                                    
								<a href="<?php the_permalink(); ?>"><?php  the_post_thumbnail(); ?></a>
								</span>
							</li>
					<?php  endwhile;   ?>
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