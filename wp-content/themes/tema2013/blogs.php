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
        <div class="item active">
            <img src="http://dummyimage.com/1020x300/eee/fff.png" alt="">
            <div class="carousel-caption">
                <h4>First Thumbnail label</h4>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
        </div>
        <div class="item">
            <img src="http://dummyimage.com/1020x300/eee/fff.png" alt="">
            <div class="carousel-caption">
                <h4>Second Thumbnail label</h4>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
        </div>
        <div class="item">
            <img src="http://dummyimage.com/1020x300/eee/fff.png" alt="">
            <div class="carousel-caption">
                <h4>Third Thumbnail label</h4>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
</div>

<div id="sa_blogs">
<!-- CATEGORIA LEAD-MANAGENT -->
	<div class="row-fluid">
		<div class="span4">
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
			
			
			
	
<!-- CATEGORIA Fidelização -->	
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
			

			<!-- CATEGORIA Cases -->	
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
	
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>