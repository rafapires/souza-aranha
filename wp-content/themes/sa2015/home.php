<?php 

/*Template Name: Home */
get_header(); ?>
<div class="row-fluid">
    <div id="myCarousel" class="carousel slide col-sm-12">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            <li data-target="#myCarousel" data-slide-to="3" class=""></li>
        </ol>
        <div class="carousel-inner">
            <?php 
			$active = true;
			$newsArgs = array( 'post_type' => 'metodologias');
			$newsLoop = new WP_Query( $newsArgs );
			while ( $newsLoop->have_posts() ) : $newsLoop->the_post();?>
                <div class="item <?php if ($active){echo 'active';}?>">
                    <?php the_post_thumbnail( full, array('class' => 'sa_img_carrousel')) ?>
                    <div class="carousel-caption">
                        <a href="<?php the_permalink(); ?>">
        	                <h4><?php the_title();?></h4>
        	                <?php the_excerpt(); ?>
                            <p class="conheca">Conheça<span class="seta">></span></p>
        	            </a>
                    </div>
                </div>
    			<?php $active =false;?>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>
<div class="container">
    <div id="sa_call_actions" class="row">
        <div class="col-sm-4">
            <div class="sa-col-1">
                <a href="<?php echo get_permalink(); ?>">
                    <h1 class="sa_title_links">SOLUÇÕES S.A.</h1>
                    <?php the_content(); ?>
                    <?php the_post_thumbnail( full, array('class' => 'sa-thumbnail-col-1 img-responsive')) ?>
                    <span class="sa-mais pull-right">+ SAIBA MAIS</span>
                </a>
            </div>
        </div>
        <div class="col-sm-4 sa-col-2">
            <div class="sa-titulo">
                <?php  // ###### cria título da coluna com imagem pela pagina obrigatória Webinars.
                    $page_webinar_root = array(
                        'post_type' => 'page',
                        'name'      => 'webinars'
                        );
                    $query = new WP_Query($page_webinar_root);
                    if ($query->have_posts()){
                        $query->the_post();
                        echo '<h1>'.get_the_title().'</h1>';
                        the_post_thumbnail( full, array('class'=>'sa-thumbnail-col-2 img-responsive'));
                    }
                    wp_reset_postdata();
                // ###### fim título ?>
            </div>
            <div class="row-fluid">
                <?php //######## imprime ultimos dois webinars realizados
                
                $webinars_anteriores = array(
                        'post_type'     => 'webinars',
                        'posts_per_page'=> 3,
                        'order'         => 'DESC',
                        'order_by'      => 'date',
                        'post_status'   => 'publish'
                );
                $ultimos_webinars = wp_get_recent_posts($webinars_anteriores, ARRAY_A);
                $sa_webinar_count = 0;
                foreach (array_reverse($ultimos_webinars) as $ultimos_webinar) {
                    $sa_webinar_count++;
                    ?>
                    <div class="thumbnail clearfix sa-webinar <?php if ($sa_webinar_count==3) { echo 'sa-proximo-webinar';} ?>">
                        <a href="<?php echo get_permalink($ultimos_webinar['ID']); ?>">
                            <div class="row-fluid vertical-align">
                                <div class="col-sm-9">
                                    <div class="caption pull-right">
                                        <h2><?php echo $ultimos_webinar['post_title']; ?></h2>
                                        <p><?php
                                            if (!empty($ultimos_webinar['post_excerpt'])){
                                                echo substr(strip_tags($ultimos_webinar['post_excerpt']),0,90);
                                            }else{
                                                echo substr(strip_tags($ultimos_webinar['post_content']),0,90);
                                            }
                                        ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/seta-dir-circulo-branco.png" class='center-block'>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                wp_reset_postdata();
                // ###### cria título da coluna com imagem pela pagina obrigatória Webinars.
                $whitepaper_title = get_page_by_title('Whitepapers');
                ?>
                <div class="thumbnail clearfix sa-whitepaper">
                    <a href="<?php echo get_post_type_archive_link( 'whitepapers' ); ?>">
                        <div class="row-fluid vertical-align">
                            <div class="col-sm-9">
                                <div class="caption pull-right">
                                    <h2><?php echo $whitepaper_title->post_title; ?></h2>
                                    <p><?php
                                        if (!empty($whitepaper_title->post_excerpt)){
                                            echo substr($whitepaper_title->post_excerpt,0,90);
                                        }else{
                                            echo substr($whitepaper_title->post_content,0,90);
                                        }
                                    ?></p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <img src="<?php bloginfo('template_url'); ?>/img/seta-dir-circulo-branco.png" class='center-block'>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 sa-col-3">
            <div class="sa-titulo">
                 <?php  // ###### cria título da coluna com imagem pela pagina obrigatória blogs.
                    $page_blog_root = array(
                        'post_type' => 'page',
                        'name'      => 'blog-s-a'
                        );
                    $query = new WP_Query($page_blog_root);
                    if ($query->have_posts()){
                        $query->the_post();
                        echo '<h1>'.get_the_title().'</h1>';
                        the_post_thumbnail( full, array('class'=>'sa-thumbnail-col-3 img-responsive'));
                    }
                    wp_reset_postdata();
                // ###### fim título ?>  
            </div>
            <div class="row-fluid sa-list-post">
        		<?php
                $posts_args = array(
                    'numberposts'   => 4,
                    'post_type'     => 'post',
                    'post_status'   => 'publish'
                    );
                $ultimos_posts = wp_get_recent_posts($posts_args);
                $sa_css_post_count=0;
                foreach ($ultimos_posts as $ultimos_post) {
                    if ($sa_css_post_count<3){
                        $sa_css_post_count++;
                    }else{
                        $sa_thumb_class=' post-final';
                    }

                    ?>
                <div class="thumbnail clearfix<?php echo $sa_thumb_class; ?>">
                    <a href="<?php echo get_permalink($ultimos_post['ID']); ?>">
                        <div class="col-sm-2 center-block clearfix">
                                <?php $sa_date = explode(" ", get_the_date('d M',$ultimos_post["ID"])); ?>
                                <h3 class='sa-day center-block'><?php echo $sa_date[0]; ?></h3>
                                <h3 class='sa-month'><?php echo $sa_date[1]; ?></h3>
                        </div>
                        <div class="col-sm-10">
                            <h2 class='sa-title-post'><?php echo $ultimos_post['post_title']; ?></h2>
                            <span class='sa-author'><?php echo the_author_meta('display_name',$ultimos_post['post_author']); ?></span>
                            <p><?php
                                if (!empty($ultimos_post['post_excerpt'])){
                                    echo substr($ultimos_post['post_excerpt'],0,180);
                                }else{
                                    echo substr($ultimos_post['post_content'],0,180);
                                }

                            ?>
                            <span class='seta-list-blog'>
                                <img src="<?php bloginfo('template_url'); ?>/img/seta-list-blog.png">
                            </span></p>

                        </div>
                    </a>
                </div>
                <?php
                }
                $sa_blogs_page = get_page_by_title('blog s.a.');
                ?>
    	       	<a href="<?php echo get_page_link($sa_blogs_page->ID);?>" class="btn btn-block btn-small btn-primary">Lista completa</a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
