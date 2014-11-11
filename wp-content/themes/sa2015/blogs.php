<?php 

/*Template Name: Blogs */
 
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
			$newsArgs = array(  'post_type'     => 'post',
                                'posts_per_page'   => 6,
                                'offset'        => 0,
                                'orderby'       => 'post_date',
                                'order'         => 'DESC',
                                'post_status'   => 'publish'
                );
			$post_carousel = new WP_Query( $newsArgs );
            $sa_imgdefault = 1;
			// The Loop
			while ( $post_carousel->have_posts() ) : $post_carousel->the_post();
            ?>
    
        <div class="item <?php if ($active){echo 'active';}?>">
        
          <?php if ( has_post_thumbnail() ){
            the_post_thumbnail( full, array('class' => 'sa_img_carrousel'));
          }else{
            if ( $sa_imgdefault > 3) {
                $sa_imgdefault = 1;
            }
            ?><img src="<?php bloginfo('template_url'); ?>/img/semimagem0<?php echo $sa_imgdefault++; ?>.jpg" class="sa_img_carrousel" >
            <?php
          }
           //the_post_thumbnail( full, array('class' => 'sa_img_carrousel')) ?>
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
<div id="sa_bloglist" class="row">
    <div class="col-sm-4 sa-col-1">
        <h1 class="sa_title_catblogs">Lead Management</h1>
        <?php
        $newsArgsCol1 = array(
            'post_type'         => 'post',
            'orderby'           => 'post_date',
            'order'             => 'DESC',
            'post_status'       => 'publish',
            'posts_per_page'    => 4,
            'category_name'     => 'lead-management'
            );
            $ultimos_posts_col1 = new WP_Query($newsArgsCol1);
            $sa_css_post_count=0;
            $sa_list_thumb_count=1;
            foreach ($ultimos_posts_col1->posts as $item_post_col1) {
                if ($sa_list_thumb_count>3){
                    $sa_list_thumb_count =1;
                }
                ?>
                <div class="thumbnail clearfix">
                <a href="<?php echo get_permalink($item_post_col1->ID); ?>">
                    <img src="<?php bloginfo('template_url'); ?>/img/semthumb0<?php echo $sa_list_thumb_count++;?>.jpg" class="img-responsive pull-left">
                    <div class="caption">
                        <h2><?php echo $item_post_col1->post_title; ?></h2>
                        <p><?php
                            if (!empty($item_post_col1->post_excerpt)){
                                echo substr($item_post_col1->post_excerpt,0,180);
                            }else{
                                echo substr($item_post_col1->post_content,0,180);
                            }
                            ?>
                        </p>
                            <span class='seta-saibamais pull-right'>
                                Saiba mais
                                <img src="<?php bloginfo('template_url'); ?>/img/seta-link-azul.png">
                            </span>
                    </div>
                </a>
                </div>
                <?php
            }
            wp_reset_query();
        ?>
    </div>
    <div class="col-sm-4 sa-col-2">
        <h1 class="sa_title_catblogs">Fidelização</h1>
        <?php
        $newsArgsCol2 = array(
            'post_type'         => 'post',
            'orderby'           => 'post_date',
            'order'             => 'DESC',
            'post_status'       => 'publish',
            'posts_per_page'    => 4,
            'category_name'     => 'fidelizacao'
            );
            $ultimos_posts_col2 = new WP_Query($newsArgsCol2);
            $sa_css_post_count=0;
            $sa_list_thumb_count=1;
            foreach ($ultimos_posts_col2->posts as $item_post_col2) {
                if ($sa_list_thumb_count>3){
                    $sa_list_thumb_count =1;
                }
                ?>
                <div class="thumbnail clearfix">
                <a href="<?php echo get_permalink($item_post_col2->ID); ?>">
                    <img src="<?php bloginfo('template_url'); ?>/img/semthumb0<?php echo $sa_list_thumb_count++;?>.jpg" class="img-responsive pull-left">
                    <div class="caption">
                        <h2><?php echo $item_post_col2->post_title; ?></h2>
                        <p><?php
                            if (!empty($item_post_col2->post_excerpt)){
                                echo substr($item_post_col2->post_excerpt,0,180);
                            }else{
                                echo substr($item_post_col2->post_content,0,180);
                            }
                            ?>
                        </p>
                            <span class='seta-saibamais pull-right'>
                                Saiba mais
                                <img src="<?php bloginfo('template_url'); ?>/img/seta-link-azul.png">
                            </span>
                    </div>
                </a>
                </div>
                <?php
            }
            wp_reset_query();
        ?>



    </div>
    <div class="col-sm-4 sa-col-3">
        <h1 class="sa_title_catblogs">Cases</h1>
        <?php
        $newsArgsCol3 = array(
            'post_type'         => 'post',
            'orderby'           => 'post_date',
            'order'             => 'DESC',
            'post_status'       => 'publish',
            'posts_per_page'    => 4,
            'category_name'     => 'cases'
            );
            $ultimos_posts_col3 = new WP_Query($newsArgsCol3);
            $sa_css_post_count=0;
            $sa_list_thumb_count=1;
            foreach ($ultimos_posts_col3->posts as $item_post_col3) {
                if ($sa_list_thumb_count>3){
                    $sa_list_thumb_count =1;
                }
                ?>
                <div class="thumbnail clearfix">
                <a href="<?php echo get_permalink($item_post_col3->ID); ?>">
                    <img src="<?php bloginfo('template_url'); ?>/img/semthumb0<?php echo $sa_list_thumb_count++;?>.jpg" class="img-responsive pull-left">
                    <div class="caption">
                        <h2><?php echo $item_post_col3->post_title; ?></h2>
                        <p><?php
                            if (!empty($item_post_col3->post_excerpt)){
                                echo substr($item_post_col3->post_excerpt,0,180);
                            }else{
                                echo substr($item_post_col3->post_content,0,180);
                            }
                            ?>
                        </p>
                            <span class='seta-saibamais pull-right'>
                                Saiba mais
                                <img src="<?php bloginfo('template_url'); ?>/img/seta-link-azul.png">
                            </span>
                    </div>
                </a>
                </div>
                <?php
            }
            wp_reset_query();
        ?>





    </div>
    <?php die(); ?>
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
                
                $whitepaper_title = get_page_by_title('whitepapers');
                ?>
                <div class="thumbnail clearfix sa-whitepaper">
                    <a href="<?php echo get_permalink($whitepaper_title->ID); ?>">
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
                <?php


        ?>  

        </div>
    </div>
    <div class="col-sm-4 sa-col-3">
        <div class="sa-titulo">
             <?php  // ###### cria título da coluna com imagem pela pagina obrigatória Webinars.
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



        ?>
		<a href="#" class="btn btn-block btn-small btn-primary">Lista completa</a>
     
         </ul>
    </div>
    
</div>
</div>
<?php get_footer(); ?>
