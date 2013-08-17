<?php 
add_action ( 'init','sa_create_custom_posts' );
add_theme_support( 'post-thumbnails' ); 

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

function sa_create_custom_posts()
{
	register_post_type ( 'parceiros' ,
		array (
			'labels' => array(
				'name'			=>	'Parceiros',
				'singular_name'	=>	'Parceiro',
				'add_new'		=>	'Adiciona',
				'add_new_item'	=>	'Adiciona novo parceiro',
				'edit'			=>	'Editar',
				'edit_item'		=>	'Editar parceiro',
				'new_item'		=>	'Novo parceiro',
				'view'			=>	'Visualizar',
				'view_item'		=>	'Ver parceiro',
				'search_items'	=>	'Pesquisar parceiros',
				'not_found'		=>	'Nenhum parceiro encontrado',
				'not_found_in_trash'	=>	'Nenhum parceiro encontrado na lixeira',
				'parent'		=>	'Parceiro Pai'
				),
			'public'		=>	true,
			'menu_position' =>	15,
			'supports'		=>	array('title','thumbnail','author','excerpt','revisions','custom-fields'),
			'taxonomies'	=>	array(''),
			'has_archive'	=>	true
			)
		);

	register_post_type ( 'clientes' ,
		array (
			'labels' => array(
				'name'			=>	'Clientes',
				'singular_name'	=>	'Cliente',
				'add_new'		=>	'Adiciona',
				'add_new_item'	=>	'Adiciona novo cliente',
				'edit'			=>	'Editar',
				'edit_item'		=>	'Editar cliente',
				'new_item'		=>	'Novo cliente',
				'view'			=>	'Visualizar',
				'view_item'		=>	'Ver cliente',
				'search_items'	=>	'Pesquisar clientes',
				'not_found'		=>	'Nenhum cliente encontrado',
				'not_found_in_trash'	=>	'Nenhum cliente encontrado na lixeira',
				'parent'		=>	'Cliente Pai'
				),
			'public'		=>	true,
			'menu_position' =>	15,
			'supports'		=>	array('title','thumbnail','author','excerpt','revisions','custom-fields'),
			'taxonomies'	=>	array(''),
			'has_archive'	=>	true
			)
		);


	register_post_type ( 'webinars' ,
		array (
			'labels' => array(
				'name'			=>	'Webinars',
				'singular_name'	=>	'Webniar',
				'add_new'		=>	'Adiciona',
				'add_new_item'	=>	'Adiciona novo webinar',
				'edit'			=>	'Editar',
				'edit_item'		=>	'Editar webinar',
				'new_item'		=>	'Novo webinar',
				'view'			=>	'Visualizar',
				'view_item'		=>	'Ver webinar',
				'search_items'	=>	'Pesquisar webinars',
				'not_found'		=>	'Nenhum webinar encontrado',
				'not_found_in_trash'	=>	'Nenhum webinar encontrado na lixeira',
				'parent'		=>	'Webniar Pai'
				),
			'public'		=>	true,
			'menu_position' =>	15,
			'supports'		=>	array('title','thumbnail','author','editor','excerpt','revisions'),
			'taxonomies'	=>	array(''),
			'has_archive'	=>	true
			)
		);
}

add_action( 'add_meta_boxes', 'sa_webinar_add_meta_box' );
 
function sa_webinar_add_meta_box() {
    add_meta_box(
        'sa_webinar_meta_box',
        'Atributos do Webinar',
        'webinar_inner_meta_box',
        'webinars'
    );
}

function webinar_inner_meta_box( $webinar ) {
?>
<p>
<label for="data">Data:</label>
<br />
<input type="date" name="sa_data_webinar" value="<?php echo get_post_meta( $webinar->ID, 'sa_data_webinar', true ); ?>" />
</p>
<p>
<label for="hora">Hora:</label>
<br />
<input type="time" name="sa_hora_webinar" value="<?php echo get_post_meta( $webinar->ID, 'sa_hora_webinar', true ); ?>" />
</p>
<p>
<label for="url">URL:</label>
<br />
<input type="text" name="sa_url_webinar" value="<?php echo get_post_meta( $webinar->ID, 'sa_url_webinar', true ); ?>" />
</p>
<p>
<label for="status">Status:</label>
<br />
<input type="radio" name="sa_status_webinar" value="agendado"  <?php if(get_post_meta( $webinar->ID, 'sa_status_webinar', true ) == 'agendado' ) echo 'checked="checked"'; ?> />Agendado
<input type="radio" name="sa_status_webinar" value="realizado" <?php if(get_post_meta( $webinar->ID, 'sa_status_webinar', true ) == 'realizado' ) echo 'checked="checked"'; ?> />Realizado
</p>
<?php
}

add_action( 'save_post', 'sa_webinar_save_post', 10, 2 );
 
function sa_webinar_save_post( $webinar_id, $webinar ) {
 
   // Verificar se os dados foram enviados, neste caso se a metabox existe, garantindo-nos que estamos a guardar valores da página de filmes.
   if ( ! $_POST['sa_data_webinar'] ) return;
 
   // Fazer a saneação dos inputs e guardá-los
   update_post_meta( $webinar_id, 'sa_data_webinar', strip_tags( $_POST['sa_data_webinar'] ) );
   update_post_meta( $webinar_id, 'sa_hora_webinar', strip_tags( $_POST['sa_hora_webinar'] ) );
   update_post_meta( $webinar_id, 'sa_url_webinar', strip_tags( $_POST['sa_url_webinar'] ) );
   update_post_meta( $webinar_id, 'sa_status_webinar', strip_tags( $_POST['sa_status_webinar'] ) );
 
   return true;
 
}


?>




