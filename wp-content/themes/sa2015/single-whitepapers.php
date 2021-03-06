<?php
if ( !is_user_logged_in() ) {
	wp_redirect( home_url('cadastro') );
	exit;
}

$link_whitepaper = get_post_meta( get_the_ID(), 'wp_custom_attachment');
$nome_aquivo_whitepaper = get_post_meta ( get_the_ID(),'wp_name_attachment');
get_header();

?>

<div id="sa_single" class="container">
	<div id="sa_colunado" class="row-fluid">
		<div id="sa_conteudo" class="col-sm-8">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
			?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
					<h3>Faça o download aqui</h3>
					<a href="<?php echo $link_whitepaper[0]['url']; ?>" download class='btn btn-block btn-primary btn-lg'>
						<?php echo $nome_aquivo_whitepaper[0]; ?>
					</a>

			<?php
				}
			};
			?>
		</div>
		<div id="sa_coluna" class="col-sm-4">
			<div id="sa_clientes" class="row">
				<?php
				// ######### monta título ###########
				$lista_clientes_do_post = get_the_terms($post->ID,'sa_clientes_taxonomy');
				if ($lista_clientes_do_post) {
					$page_clientes_root = array(
						'post_type'		=> 'page',
						'name'			=> 'clientes'
						);
					$queryTitle = new WP_query ($page_clientes_root);
					if ( $queryTitle->have_posts() AND $lista_clientes_do_post ){
						$queryTitle->the_post();
						echo '<div class="sa-titulo-clientes">';
	                    echo '<h1 class="col-sm-12">'.get_the_title().'</h1>';
	                    the_post_thumbnail( full, array('class'=>'sa-sidebar-titulo img-responsive'));
	                    echo '</div>';
					}
	                wp_reset_postdata();
	                ?>
	            </div>
	            <div class="row">
	                <?php
					// ######### lista clientes ###########
					foreach ($lista_clientes_do_post as $item_cliente_do_post) {
						$argsClientes = array(
							'post_type'		=> 'clientes',
							'post_status'	=> 'publish',
							'name'			=> $item_cliente_do_post->slug,
							);
						$clientes_posts = get_posts($argsClientes);
						foreach ($clientes_posts as $cliente) {
							?>
							<div class="thumbnail clearfix col-sm-4">
								<div class="sa_mold_logos">
								<div class="sa_img_logos">
								<?php echo get_the_post_thumbnail($cliente->ID,full,array('class' => 'img-responsive')); ?>
								</div>
								<h2><?php echo get_the_title($cliente->ID); ?></h2>
								</div>
							</div>
							<?php
						}
	                wp_reset_postdata();
					}
				}
					?>
			</div>

			<div id="sa_blogs" class="row">
				<?php
				// ######### monta título ###########
				$page_blogs_root = array(
					'post_type'		=> 'page',
					'name'			=> 'blog-s-a'
					);
				$queryTitle = new WP_query ($page_blogs_root);
				if ( $queryTitle->have_posts() ){
					$queryTitle->the_post();
					echo '<div class="sa-titulo-blogs">';
                    echo '<h1 class="col-sm-12">'.get_the_title().'</h1>';
                    the_post_thumbnail( full, array('class'=>'sa-sidebar-titulo img-responsive'));
                    echo '</div>';
				}
                wp_reset_postdata();
				// ######### lista blogs ###########
				$categorias_do_post = get_the_category($post->ID);
				foreach ($categorias_do_post as $categoria) {
					$lista_cats[] = $categoria->term_id;
				}
				if (!$lista_cats){
					$lista_cats = array('cases','sem-categoria');
				}
				$args_last_blogs_cat = array(
					'post_type'			=> 'post',
	                'orderby'           => 'post_date',
	                'order'             => 'DESC',
	                'post_status'       => 'publish',
	                'posts_per_page'    => 4,
	                'category'		    => implode(",",$lista_cats)
					);
				$ultimos_posts = wp_get_recent_posts($args_last_blogs_cat);
				?>
				<ul>
					<?php
					foreach ($ultimos_posts as $item_post) {
					?>
						<li><span>
							<a href="<?php echo get_permalink($item_post['ID']) ;?>">
								<h3><?php echo $item_post['post_title']; ?></h3>
								<p><?php
									if (!empty($item_post['post_exceprt'])){
										echo substr($item_post['post_exceprt'],0,90);
									}else{
										echo substr(strip_tags($item_post['post_content']),0,90);
									}
								?></p>
							</a>
						</span></li>
					<?php
					}
					?>
				</ul>
			</div>


		</div>
	</div>
</div>

<?php get_footer(); ?>