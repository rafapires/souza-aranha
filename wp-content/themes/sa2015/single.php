<?php get_header();  ?>

<div id="sa_single" class="container">
	<div id="sa_colunado" class="row">
		<div class="col-sm-8">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
			?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php comments_template('', true);?>
			<?php
				}
			};
			?>
		</div>
		<div class="col-sm-4">
			<div id="sa_clientes" class="row">
				<?php
				// ######### monta título ###########
				$page_clientes_root = array(
					'post_type'		=> 'page',
					'name'			=> 'clientes'
					);
				$queryTitle = new WP_query ($page_clientes_root);
				if ( $queryTitle->have_posts() ){
					$queryTitle->the_post();
                    echo '<h1 class="col-sm-12">'.get_the_title().'</h1>';
                    the_post_thumbnail( full, array('class'=>'sa-sidebar-titulo img-responsive'));
				}
                wp_reset_postdata();
				// ######### lista clientes ###########
				$lista_clientes_do_post = get_the_terms($post->ID,'sa_clientes_taxonomy');
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
							<?php echo get_the_post_thumbnail($cliente->ID,array(80,80),array('class' => 'img-responsive')); ?>
							<h2><?php echo get_the_title($cliente->ID); ?></h2>
						</div>
						<?php
					}
                wp_reset_postdata();
				}
				?>
			</div>

			<div id="sa_whitepaper" class="row">
				<?php
				// ######### monta título ###########
				$page_whitepaper_root = array(
					'post_type'		=> 'page',
					'name'			=> 'whitepapers'
					);
				$queryTitle = new WP_query ($page_whitepaper_root);
				if ( $queryTitle->have_posts() ){
					$queryTitle->the_post();
                    echo '<h1 class="col-sm-12">'.get_the_title().'</h1>';
				}
                wp_reset_postdata();
				// ######### lista whitepapers ###########
				$lista_whitepapers_do_post = get_the_terms($post->ID,'sa_whitepaper_taxonomy');
				foreach ($lista_whitepapers_do_post as $item_whitepaper_do_post) {
					$argsWhitepapers = array(
						'post_type'		=> 'whitepaper',
						'post_status'	=> 'publish',
						'name'			=> $item_whitepaper_do_post->slug,
						);
					$whitepapers_posts = get_posts($argsWhitepapers);
					foreach ($whitepapers_posts as $whitepaper) {
						?>
						<div class="thumbnail clearfix col-sm-4 sa-whitepaper">
							<a href="<?php echo get_permalink($whitepaper->ID); ?>">
								<h2><?php echo get_the_title($whitepaper->ID); ?></h2>
								<p><?php
									if (!empty($whitepaper->post_exceprt)){
										echo substr($whitepaper->post_exceprt,0,90);
									}else{
										echo substr(strip_tags($whitepaper->post_content),0,90);
									}
								?></p>
							</a>
						</div>
						<?php
					}
                wp_reset_postdata();
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
                    echo '<h1 class="col-sm-12">'.get_the_title().'</h1>';
                    the_post_thumbnail( full, array('class'=>'sa-sidebar-titulo img-responsive'));
				}
                wp_reset_postdata();
				// ######### lista blogs ###########
				$categorias_do_post = get_the_category($post->ID);
				foreach ($categorias_do_post as $categoria) {
					$lista_cats[] = $categoria->term_id;
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
						<li>
							<h3><?php echo $item_post['post_title']; ?></h3>
							<p><?php
								if (!empty($item_post['post_exceprt'])){
									echo substr($item_post['post_exceprt'],0,90);
								}else{
									echo substr(strip_tags($item_post['post_content']),0,90);
								}
							?></p>
						</li>
					<?php
					}
					?>
				</ul>
			</div>


		</div>
	</div>
</div>


<?php get_footer(); ?>