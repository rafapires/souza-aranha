<?php 

/*Template Name: forms */
 
get_header(); ?>
<div id="sa_single" class="container">
	<div id="sa_fullwidth">
		<div class="row">
			<div class="col-sm-12 sa_cadastro">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
				?>
					<h1><?php the_title(); ?>
						<span><?php the_content(); ?></span>
					</h1>
				<?php
					}
				};
				?>
			</div>
		</div>
		<div class="row">
		<div class="col-sm-3">
			<h2>Já sou cadastrado</h2>
			<?php 
			$args = array(
                        'echo'           => true,
                        'redirect'       => site_url( $_SERVER['REQUEST_URI'] ), 
                        'form_id'        => 'loginform',
                        'label_username' => 'Login',
                        'label_password' => 'Senha',
                        'label_remember' => __( 'Remember Me' ),
                        'label_log_in'   => 'Entrar',
                        'id_username'    => 'user_login',
                        'id_password'    => 'user_pass',
                        'id_remember'    => 'rememberme',
                        'id_submit'      => 'btn',
                        'remember'       => false,
                        'value_username' => NULL,
                        'value_remember' => true
                );
            wp_login_form($args);
            ?>
		</div>
		<div class="col-sm-1">
			<h2 class='sa_ou center-block'>ou</h2>
		</div>
		<div class="col-sm-8">
			<h2>Faça seu cadastro</h2>
			<?php
			$custom_fields = get_post_custom_values('frm-view');
			if ($custom_fields){
				echo do_shortcode('[display-frm-data id='.$custom_fields[0].' filter=1]');
			}
			?>
		</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>