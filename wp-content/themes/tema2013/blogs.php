<?php 

/*Template Name: Blogs */
 
get_header(); ?>

<div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner">
        <?php /* Get all Sticky Posts */
			$sticky = get_option( 'sticky_posts' );
			/* Sort Sticky Posts, newest at the top */
			rsort( $sticky );
			/* Get top 5 Sticky Posts */
			$sticky = array_slice( $sticky, 0, 5 );
			/* Query Sticky Posts */
			$active = true;
			query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) ); 
			// The Loop
			$sa_count_img_default = 0;
			while ( have_posts() ) : the_post();
		?>
		        <div class="item <?php if ($active){echo 'active';}?>">
			        <?php // verifica se há imagem destacada no post, caso contrário carrega imagem default
        				if (has_post_thumbnail()){
        					echo get_the_post_thumbnail();
			        	}else{
							if ($sa_count_img_default==3) {
								$sa_count_img_default=1;
							}else{
								$sa_count_img_default++;
							}
			        		?>
			        		<img src="<?php bloginfo('template_url'); ?>/img/destaque-default-0<?php echo $sa_count_img_default; ?>.jpg">
			        		<?php
			        	}
			        ?>
		            <div class="carousel-caption">
		                <h4><?php the_title();?></h4>
		                <?php the_excerpt(); ?>
		            </div>
		        </div>
				<?php $active =false;?>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
</div>

<div id="sa_blogs">
	<div class="row-fluid">
		<div class="span4">
			<!-- CATEGORIA LEAD-MANAGENT -->
			<h2 class="sa_title_links">Lead Managemment</h2>		
			<ul>
				<?php
					$args = array(
							'post_type'		=>	'post',
							'category_name'	=>	'lead-managemment',
							'post_per_page'	=>	3,
							'order'			=>	'ASC'
					);
				query_posts( $args );// The Query
				// The Loop
				while ( have_posts() ) : the_post();
				?>
				<li>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
					<p><?php the_excerpt(); ?></p>
				</li>
				<?php endwhile; ?>
			</ul>
			<a href="?cat=7" class="btn btn-large btn-block btn-primary">Lista completa</a>
		</div>
			
		<div class="span4">
			<!-- CATEGORIA Fidelização -->
			<h2 class="sa_title_links">Programa de Fidelidade</h2>
			<ul>
				<?php
					$args = array(
							'post_type'		=>	'post',
							'category_name'	=>	'programa-de-fidelidade',
							'post_per_page'	=>	3,
							'order'			=>	'ASC'
					);
				query_posts( $args ); // The Query
				// The Loop
				while ( have_posts() ) : the_post();
				?>
				<li>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
					<p><?php the_excerpt(); ?></p>
				</li>
				<?php endwhile; ?>
			</ul>
			<a href="?cat=14" class="btn btn-large btn-block btn-primary">Lista completa</a>
		</div>

		<div class="span4">
			<!-- CATEGORIA Cases -->
			<h2 class="sa_title_links">Cases</h2>	
			<ul>
				<?php
					$args = array(
							'post_type'		=>	'post',
							'category_name'	=>	'cases',
							'post_per_page'	=>	3,
							'order'			=>	'ASC'
					);
					query_posts( $args );	// The Query
					// The Loop
					while ( have_posts() ) : the_post();
				?>
				<li>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
					<p><?php the_excerpt(); ?></p>
				</li>
				<?php endwhile; ?>
			</ul>
			<a href="?cat=15" class="btn btn-large btn-block btn-primary">Lista completa</a>
		</div>
	</div>
	

<?php wp_reset_query(); ?>
<?php get_footer(); ?>