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
                        <?php
                        if ( has_post_thumbnail() ){
                            the_post_thumbnail( array(1400,400), array('class' => 'sa_img_carrousel'));
                        }else{
                            if ( $sa_imgdefault > 3) {
                                $sa_imgdefault = 1;
                            }
                        ?>
                        <img src="<?php bloginfo('template_url'); ?>/img/semimagem0<?php echo $sa_imgdefault++; ?>.jpg" class="sa_img_carrousel" >
                        <?php
                        }
                        ?>
                        <div class="carousel-caption">
                            <a href="<?php the_permalink(); ?>">
            	                <h4><?php the_title();?></h4>
            	                <?php the_excerpt(); ?>
                                <p class="conheca">Conheça<span class="seta">></span></p>
            	            </a>
                        </div>
                    </div>
                    <?php
                    $active =false;
                endwhile;
                wp_reset_query();
                ?>
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
                $cat1_link = get_category_link( get_cat_ID('lead-management') );
                $sa_css_post_count=0;
                $sa_list_thumb_count=1;
                foreach ($ultimos_posts_col1->posts as $item_post_col1) {
                    if ($sa_list_thumb_count>3){
                        $sa_list_thumb_count =1;
                    }
                    ?>
                    <div class="thumbnail clearfix">
                        <a href="<?php echo get_permalink($item_post_col1->ID); ?>">
                            <?php
                            $sa_post_thumb = get_the_post_thumbnail($item_post_col1->ID, array(100,100),array('class' => 'img-responsive pull-left'));
                            if ($sa_post_thumb){
                                echo $sa_post_thumb;
                            }else{
                                ?>
                                <img src="<?php bloginfo('template_url'); ?>/img/semthumb0<?php echo $sa_list_thumb_count++; ?>.jpg" class="img-responsive pull-left">
                            <?php
                            }
                            ?>
                            <div class="caption">
                                <h2><?php echo $item_post_col1->post_title; ?></h2>
                                <p><?php
                                    if (!empty($item_post_col1->post_excerpt)){
                                        echo substr(strip_tags($item_post_col1->post_excerpt),0,180);
                                    }else{
                                        echo substr(strip_tags($item_post_col1->post_content),0,180);
                                    }
                                    ?>
                                </p>
                            </div>
                            <span class='seta-saibamais pull-right'>
                                Saiba mais
                                <img src="<?php bloginfo('template_url'); ?>/img/seta-link-azul.png">
                            </span>
                        </a>
                    </div>
                    <?php
                }
                wp_reset_query();
            ?>
        <a href="<?php echo esc_url($cat1_link) ;?>" class="btn btn-block btn-small btn-primary">Lista completa</a>
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
                $cat2_link = get_category_link( get_cat_ID('fidelizacao') );
                $sa_css_post_count=0;
                $sa_list_thumb_count=1;
                foreach ($ultimos_posts_col2->posts as $item_post_col2) {
                    if ($sa_list_thumb_count>3){
                        $sa_list_thumb_count =1;
                    }
                    ?>
                    <div class="thumbnail clearfix">
                    <a href="<?php echo get_permalink($item_post_col2->ID); ?>">
                        <?php
                            $sa_post_thumb = get_the_post_thumbnail($item_post_col2->ID, array(100,100),array('class' => 'img-responsive pull-left'));
                            if ($sa_post_thumb){
                                echo $sa_post_thumb;
                            }else{
                                ?>
                                <img src="<?php bloginfo('template_url'); ?>/img/semthumb0<?php echo $sa_list_thumb_count++; ?>.jpg" class="img-responsive pull-left">
                            <?php
                            }
                            ?>                        <div class="caption">
                            <h2><?php echo $item_post_col2->post_title; ?></h2>
                            <p><?php
                                if (!empty($item_post_col2->post_excerpt)){
                                    echo substr(strip_tags($item_post_col2->post_excerpt),0,180);
                                }else{
                                    echo substr(strip_tags($item_post_col2->post_content),0,180);
                                }
                                ?>
                            </p>
                        </div>
                        <span class='seta-saibamais pull-right'>
                            Saiba mais
                            <img src="<?php bloginfo('template_url'); ?>/img/seta-link-azul.png">
                        </span>
                    </a>
                    </div>
                    <?php
                }
                wp_reset_query();
            ?>
        <a href="<?php echo esc_url($cat2_link) ;?>" class="btn btn-block btn-small btn-primary">Lista completa</a>


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
                $cat3_link = get_category_link( get_cat_ID('cases') );
                $sa_css_post_count=0;
                $sa_list_thumb_count=1;
                foreach ($ultimos_posts_col3->posts as $item_post_col3) {
                    if ($sa_list_thumb_count>3){
                        $sa_list_thumb_count =1;
                    }
                    ?>
                    <div class="thumbnail clearfix">
                    <a href="<?php echo get_permalink($item_post_col3->ID); ?>">
                            <?php
                            $sa_post_thumb = get_the_post_thumbnail($item_post_col3->ID, array(100,100),array('class' => 'img-responsive pull-left'));
                            if ($sa_post_thumb){
                                echo $sa_post_thumb;
                            }else{
                                ?>
                                <img src="<?php bloginfo('template_url'); ?>/img/semthumb0<?php echo $sa_list_thumb_count++; ?>.jpg" class="img-responsive pull-left">
                            <?php
                            }
                            ?>                        <div class="caption">
                            <h2><?php echo $item_post_col3->post_title; ?></h2>
                            <p><?php
                                if (!empty($item_post_col3->post_excerpt)){
                                    echo substr(strip_tags($item_post_col3->post_excerpt),0,180);
                                }else{
                                    echo substr(strip_tags($item_post_col3->post_content),0,180);
                                }
                                ?>
                            </p>
                        </div>
                        <span class='seta-saibamais pull-right'>
                            Saiba mais
                            <img src="<?php bloginfo('template_url'); ?>/img/seta-link-azul.png">
                        </span>
                    </a>
                    </div>
                    <?php
                }
                wp_reset_query();
            ?>
        <a href="<?php echo esc_url($cat3_link) ;?>" class="btn btn-block btn-small btn-primary">Lista completa</a>




        </div>
        
    </div>
</div>
<?php get_footer(); ?>