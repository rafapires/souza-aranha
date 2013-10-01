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
			while ( have_posts() ) : the_post(); ?>
    
        <div class="item <?php if ($active){echo 'active';}?>">
        
          <?php echo get_the_post_thumbnail() ?>
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
<!-- CATEGORIA LEAD-MANAGENT -->

	<div class="row-fluid">
			
		<div class="span4">
		<h2 class="sa_title_links">Lead Managemment</h2>		
		<ul>
		
		<?php
		$args = array(
				'post_type'=> 'post',
				'cat'    => 7,
				'post_per_page'=>3,
				'order'    => 'ASC'
		);

			// The Query
			query_posts( $args );
			
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

			</ul>
		</div>
			
		<div class="span4">
	
	
<!-- CATEGORIA Fidelização -->
		<h2 class="sa_title_links">Fidelização</h2>
		<ul>
		
		<?php
		$args = array(
				'post_type'=> 'post',
				'cat'    => 14,
				'post_per_page'=>3,
				'order'    => 'ASC'
		);

			// The Query
			query_posts( $args );
			
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
			
			</ul>
		</div>
			
		<div class="span4">
			
			<!-- CATEGORIA Cases -->
			<h2 class="sa_title_links">Cases</h2>	
		<ul>
		
		<?php
		$args = array(
				'post_type'=> 'post',
				'cat'    => 15,
				'post_per_page'=>3,
				'order'    => 'ASC'
		);

			// The Query
			query_posts( $args );
			
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