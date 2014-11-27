<?php 
//remove_filter( 'the_content', 'wpautop' );
add_theme_support( 'post-thumbnails' );
add_image_size( 'metodologia_list', 300 , 300 , true);
//set_post_thumbnail_size( 150, 150, true ); 
add_filter('show_admin_bar', '__return_false');

register_nav_menus( array (
		'main-menu' => 'Menu Principal',
		'foot-menu'	=> 'Footer Menu',
		'blog-menu' => 'Blog Menu'
		) );


function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

/* cria custom posts do tema */
add_action ( 'init','sa_create_custom_posts' );

	function sa_create_custom_posts()
	{
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

		register_post_type ( 'metodologias' ,
			array (
				'labels' => array(
					'name'			=>	'Metodologias',
					'singular_name'	=>	'Metodologia',
					'add_new'		=>	'Adiciona',
					'add_new_item'	=>	'Adiciona nova metodologia',
					'edit'			=>	'Editar',
					'edit_item'		=>	'Editar metodologia',
					'new_item'		=>	'Nova metodologia',
					'view'			=>	'Visualizar',
					'view_item'		=>	'Ver metodologia',
					'search_items'	=>	'Pesquisar metodologias',
					'not_found'		=>	'Nenhuma metodologia encontrada',
					'not_found_in_trash'	=>	'Nenhuma metodologia encontrada na lixeira',
					'parent'		=>	'Metodologia Pai'
					),
				'public'		=>	true,
				'menu_position' =>	15,
				'supports'		=>	array('title','thumbnail','author','editor','excerpt','revisions','parent'),
				'taxonomies'	=>	array(''),
				'has_archive'	=>	true
				)
			);

		register_post_type ( 'whitepapers' ,
			array (
				'labels' => array(
					'name'			=>	'Whitepapers',
					'singular_name'	=>	'Whitepaper',
					'add_new'		=>	'Adiciona',
					'add_new_item'	=>	'Adiciona novo whitepaper',
					'edit'			=>	'Editar',
					'edit_item'		=>	'Editar whitepaper',
					'new_item'		=>	'Novo whitepaper',
					'view'			=>	'Visualizar',
					'view_item'		=>	'Ver whitepaper',
					'search_items'	=>	'Pesquisar whitepapers',
					'not_found'		=>	'Nenhum whitepaper encontrado',
					'not_found_in_trash'	=>	'Nenhum whitepaper encontrado na lixeira',
					'parent'		=>	'whitepaper Pai'
					),
				'public'		=>	true,
				'menu_position' =>	15,
				'supports'		=>	array('title','thumbnail','author','editor','excerpt','revisions','parent'),
				'taxonomies'	=>	array(''),
				'has_archive'	=>	true
				)
			);
	}


/* cria meta boxes dos custom posts */

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
			<label for="Data">Data:</label>
			<input type="date" name="sa_data_webinar" value="<?php echo get_post_meta($webinar->ID, 'sa_data_webinar'); ?>">

			<label for="Hora">Hora:</label>
			<input type="time" name="sa_hora_webinar" value="<?php echo get_post_meta($webinar->ID, 'sa_hora_webinar'); ?>">
		</p>
			<p>
			<label for="URL" >URL:</label>
			<input type="url" size="120"name="sa_url_webinar" value="<?php echo get_post_meta($webinar->ID, 'sa_url_webinar'); ?>">
		</p>
		<p>
			<label for="status">Status:</label>
			<br />
			<input type="radio" name="sa_status_webinar" value="ativo"  <?php if(get_post_meta( $webinar->ID, 'sa_status_webinar', true ) == 'ativo' ) echo 'checked="checked"'; ?> />Ativo
			<input type="radio" name="sa_status_webinar" value="suspenso" <?php if(get_post_meta( $webinar->ID, 'sa_status_webinar', true ) == 'suspenso' ) echo 'checked="checked"'; ?> />Suspenso
			<input type="radio" name="sa_status_webinar" value="realizado" <?php if(get_post_meta( $webinar->ID, 'sa_status_webinar', true ) == 'realizado' ) echo 'checked="checked"'; ?> />Realizado
		</p>
	<?php
	}

	add_action( 'add_meta_boxes', 'sa_metodologia_add_meta_box' );
	 
	function sa_metodologia_add_meta_box() {
	    add_meta_box(
	        'sa_metodologia_meta_box',
	        'Atributos do metodologia',
	        'metodologia_inner_meta_box',
	        'metodologias'
	    );
	}

	function metodologia_inner_meta_box( $metodologia ) {
	?>
		<p>
			<label for="Diferencial">Diferencial:</label>
			<br />
			<textarea cols="100%" rows="4" name="sa_diferencial_metodologia"><?php echo get_post_meta( $metodologia->ID, 'sa_diferencial_metodologia', true ); ?></textarea>
		</p>
		<p>
			<label for="status">Status:</label>
			<br />
			<input type="radio" name="sa_status_metodologia" value="ativo"  <?php if(get_post_meta( $metodologia->ID, 'sa_status_metodologia', true ) == 'ativo' ) echo 'checked="checked"'; ?> />Ativo
			<input type="radio" name="sa_status_metodologia" value="suspenso" <?php if(get_post_meta( $metodologia->ID, 'sa_status_metodologia', true ) == 'suspenso' ) echo 'checked="checked"'; ?> />Suspenso
		</p>
	<?php
	}

	function sa_whitepaper_add_meta_box() {  
	  
	    // Define the custom attachment for pages  
	    add_meta_box(  
	        'sa_whitepaper_meta_box',  
	        'Atributos do Whitepaper',  
	        'whitepaper_inner_meta_box',  
	        'whitepapers'
	    );  
	  
	}

	add_action('add_meta_boxes', 'sa_whitepaper_add_meta_box');  


	function whitepaper_inner_meta_box($whitepaper) {  
	  
	    wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');  
	     ?>
	    <p class="description">Coloque o PDF aqui:</p>
	    <?php $wer = get_post_meta($whitepaper->ID, 'wp_name_attachment'); ?>
	    <input type="file" id="wp_custom_attachment" name="wp_custom_attachment"  size="25" > ########## Arquivo atual: <em><i><?php echo $wer[0]; ?></i></em> 
	      <?php
	  
	} 

	function save_whitepaper_meta_data($id) {  
	  
	    /* --- security verification --- */  
	    if(!wp_verify_nonce($_POST['wp_custom_attachment_nonce'], plugin_basename(__FILE__))) {  
	      return $id;  
	    } // end if  
	        
	    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {  
	      return $id;  
	    } // end if  
	        
	    if('page' == $_POST['post_type']) {  
	      if(!current_user_can('edit_page', $id)) {  
	        return $id;  
	      } // end if  
	    } else {  
	        if(!current_user_can('edit_page', $id)) {  
	            return $id;  
	        } // end if  
	    } // end if  
	    /* - end security verification - */  
	      
	    // Make sure the file array isn't empty  
	    if(!empty($_FILES['wp_custom_attachment']['name'])) { 
	         
	        // Setup the array of supported file types. In this case, it's just PDF.  
	        $supported_types = array('application/pdf');  
	          
	        // Get the file type of the upload  
	        $arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));  
	        $uploaded_type = $arr_file_type['type'];  
	          
	        // Check if the type is supported. If not, throw an error.  
	        if(in_array($uploaded_type, $supported_types)) {  
	  
	            // Use the WordPress API to upload the file  
	            $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));  
	      
	            if(isset($upload['error']) && $upload['error'] != 0) {  
	                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
	            } else {  
	             //   add_post_meta($id, 'wp_custom_attachment', $upload);  
	                update_post_meta($id, 'wp_custom_attachment', $upload);
	                update_post_meta($id, 'wp_name_attachment', $_FILES['wp_custom_attachment']['name']);      
	            } // end if/else  
	  
	        } else {  
	            wp_die("O arquivo não é um PDF.   <a href='javascript:history.go(-2)'>Voltar</a>");  
	        } // end if/else  
	          
	    } // end if  
	      
	} // end save_whitepaper_meta_data  
	add_action('save_post', 'save_whitepaper_meta_data');  

/* salva parametros dos metabox dos custom posts */

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

	add_action( 'save_post', 'sa_metodologia_save_post', 10, 2 );
	 
	function sa_metodologia_save_post( $metodologia_id, $metodologia ) {
	 
	   // Verificar se os dados foram enviados, neste caso se a metabox existe, garantindo-nos que estamos a guardar valores da página de filmes.
	   if ( ! $_POST['sa_diferencial_metodologia'] ) return;
	 
	   // Fazer a saneação dos inputs e guardá-los
	   update_post_meta( $metodologia_id, 'sa_diferencial_metodologia', strip_tags( $_POST['sa_diferencial_metodologia'] ) );
	   update_post_meta( $metodologia_id, 'sa_status_metodologia', strip_tags( $_POST['sa_status_metodologia'] ) );
	 
	   return true;
	 
	}

/* taxonomias */
add_action( 'init', 'sa_taxonomies', 0 );

	function sa_taxonomies(){
		register_taxonomy(
			'sa_metodologias_taxonomy',
			array ('post','webinars', 'whitepapers'),
			array(
				'label'		=>	'metodologias',
				'labels'	=>	array(
					'name'			=>	'Metodologias',
					'singular_name'	=>	'Metodologia',
					'add_new_item'	=>	'Adiciona nova metodologia',
					'new_item_name'	=>	'Titulo',
					),
				'hierarchical'		=> true,
				'show_ui'			=> true,
				'show_admin_column'	=> true,
				'query_var'			=> true
				)
			);

		register_taxonomy(
			'sa_clientes_taxonomy',
			array ('post','webinars','metodologias', 'whitepapers'),
			array(
				'label'		=>	'clientes',
				'labels'	=>	array(
					'name'			=>	'Clientes',
					'singular_name'	=>	'Cliente',
					'add_new_item'	=>	'Adiciona novo cliente',
					'new_item_name'	=>	'Nome',
					),
				'hierarchical'		=> true,
				'show_ui'			=> true,
				'show_admin_column'	=> true,
				'query_var'			=> true
				)
			);

		register_taxonomy(
			'sa_whitepapers_taxonomy',
			array ('post','webinars','metodologias'),
			array(
				'label'		=>	'whitepapers',
				'labels'	=>	array(
					'name'			=>	'Whitepapers',
					'singular_name'	=>	'Whitepaper',
					'add_new_item'	=>	'Adiciona novo whitepaper',
					'new_item_name'	=>	'Nome',
					),
				'hierarchical'		=> true,
				'show_ui'			=> true,
				'show_admin_column'	=> true,
				'query_var'			=> true,
				'show_in_nav_menus' => false
				)
		);
	}

/* retira do menu adm as taxonomias */

add_action('admin_menu','yoursite_admin_menu');
function yoursite_admin_menu() {
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=sa_whitepapers_taxonomy' ); //remove taxonomy 'whitepaper' from sub menu of post
    remove_submenu_page( 'edit.php?post_type=webinars', 'edit-tags.php?taxonomy=sa_whitepapers_taxonomy&amp;post_type=webinars' ); // remove taxonomy 'whitepaper' from submenu of webinars
    remove_submenu_page( 'edit.php?post_type=metodologias', 'edit-tags.php?taxonomy=sa_whitepapers_taxonomy&amp;post_type=metodologias' ); // remove taxonomy 'whitepaper' from submenu of metodologias
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=sa_metodologias_taxonomy' ); //remove taxonomy 'metodologias' from sub menu of post
    remove_submenu_page( 'edit.php?post_type=webinars', 'edit-tags.php?taxonomy=sa_metodologias_taxonomy&amp;post_type=webinars' ); // remove taxonomy 'metodologias' from submenu of webinars
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=sa_clientes_taxonomy' ); //remove taxonomy 'clientes' from sub menu of post
    remove_submenu_page( 'edit.php?post_type=webinars', 'edit-tags.php?taxonomy=sa_clientes_taxonomy&amp;post_type=webinars' ); // remove taxonomy 'clientes' from submenu of webinars
    remove_submenu_page( 'edit.php?post_type=metodologias', 'edit-tags.php?taxonomy=sa_clientes_taxonomy&amp;post_type=metodologias' ); // remove taxonomy 'clientes' from submenu of metodologias
}

/* cria taxonomia com mesmo nome do custom post automáticamente */

add_action (save_post, save_taxonomy_as_same_title_of_post,5,1);
add_action (edit_post, save_taxonomy_as_same_title_of_post,5,1);
function save_taxonomy_as_same_title_of_post ($id){
	$nome_custom_post=get_post_type(get_the_ID());
	if ($nome_custom_post=='whitepapers') {
		$taxonomy_name='sa_whitepapers_taxonomy';
	}
	if ($nome_custom_post=='metodologias') {
		$taxonomy_name='sa_metodologias_taxonomy';
	}
	if ($nome_custom_post=='clientes') {
		$taxonomy_name='sa_clientes_taxonomy';
	}
	$nome_termo=get_the_title($id);
	wp_insert_term($nome_termo,$taxonomy_name);
}

/* deleta taxonomia com o mesmo nome do custom post deletado */
add_action (delete_post, delete_taxonomy_as_same_title_of_post);
function delete_taxonomy_as_same_title_of_post ($id){
	$name_term = get_the_title(get_the_ID($id));
	$nome_custom_post=get_post_type(get_the_ID());
	if ($nome_custom_post=='whitepapers') {
		$taxonomy_name='sa_whitepapers_taxonomy';
	}
	if ($nome_custom_post=='metodologias') {
		$taxonomy_name='sa_metodologias_taxonomy';
	}
	if ($nome_custom_post=='clientes') {
		$taxonomy_name='sa_clientes_taxonomy';
	}
	$id_term = get_term_by('name',$name_term,$taxonomy_name)->term_id;
	wp_delete_term($id_term,$taxonomy_name);
}

/* adiciona parametro nos forms para permitir upload de arquivos */
	function update_edit_form() {  
	    echo ' enctype="multipart/form-data"';  
	} 
	add_action('post_edit_form_tag', 'update_edit_form'); 

?>