<?php 
add_action ( 'init','sa_create_custom_posts' );
add_theme_support( 'post-thumbnails' ); 
register_nav_menu( 'main-menu', 'Menu Principal' );
remove_filter( 'the_content', 'wpautop' );
add_action( 'init', 'sa_taxonomies', 0 );

/* chama jquery do bootstrap */

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

/* cria custom posts do tema */

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

	register_post_type ( 'produtos' ,
		array (
			'labels' => array(
				'name'			=>	'Produtos',
				'singular_name'	=>	'Produto',
				'add_new'		=>	'Adiciona',
				'add_new_item'	=>	'Adiciona novo produto',
				'edit'			=>	'Editar',
				'edit_item'		=>	'Editar produto',
				'new_item'		=>	'Novo produto',
				'view'			=>	'Visualizar',
				'view_item'		=>	'Ver produto',
				'search_items'	=>	'Pesquisar produtos',
				'not_found'		=>	'Nenhum produto encontrado',
				'not_found_in_trash'	=>	'Nenhum produto encontrado na lixeira',
				'parent'		=>	'Produto Pai'
				),
			'public'		=>	true,
			'menu_position' =>	15,
			'supports'		=>	array('title','thumbnail','author','editor','excerpt','revisions','parent'),
			'taxonomies'	=>	array(''),
			'has_archive'	=>	true
			)
		);

	register_post_type ( 'whitepaper' ,
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
				'parent'		=>	'Produto Pai'
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
		<input type="radio" name="sa_status_webinar" value="ativo"  <?php if(get_post_meta( $produto->ID, 'sa_status_webinar', true ) == 'ativo' ) echo 'checked="checked"'; ?> />Ativo
		<input type="radio" name="sa_status_webinar" value="suspenso" <?php if(get_post_meta( $produto->ID, 'sa_status_webinar', true ) == 'suspenso' ) echo 'checked="checked"'; ?> />Suspenso
		<input type="radio" name="sa_status_webinar" value="realizado" <?php if(get_post_meta( $produto->ID, 'sa_status_webinar', true ) == 'realizado' ) echo 'checked="checked"'; ?> />Realizado
	</p>
<?php
}

add_action( 'add_meta_boxes', 'sa_produto_add_meta_box' );
 
function sa_produto_add_meta_box() {
    add_meta_box(
        'sa_produto_meta_box',
        'Atributos do Produto',
        'produto_inner_meta_box',
        'produtos'
    );
}

function produto_inner_meta_box( $produto ) {
?>
	<p>
		<label for="Diferencial">Diferencial:</label>
		<br />
		<textarea cols="100%" rows="4" name="sa_diferencial_produto"><?php echo get_post_meta( $produto->ID, 'sa_diferencial_produto', true ); ?></textarea>
	</p>
	<p>
		<label for="status">Status:</label>
		<br />
		<input type="radio" name="sa_status_produto" value="ativo"  <?php if(get_post_meta( $produto->ID, 'sa_status_produto', true ) == 'ativo' ) echo 'checked="checked"'; ?> />Ativo
		<input type="radio" name="sa_status_produto" value="suspenso" <?php if(get_post_meta( $produto->ID, 'sa_status_produto', true ) == 'suspenso' ) echo 'checked="checked"'; ?> />Suspenso
	</p>
<?php
}


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

		add_action( 'save_post', 'sa_produto_save_post', 10, 2 );
		 
		function sa_produto_save_post( $produto_id, $produto ) {
		 
		   // Verificar se os dados foram enviados, neste caso se a metabox existe, garantindo-nos que estamos a guardar valores da página de filmes.
		   if ( ! $_POST['sa_diferencial_produto'] ) return;
		 
		   // Fazer a saneação dos inputs e guardá-los
		   update_post_meta( $produto_id, 'sa_diferencial_produto', strip_tags( $_POST['sa_diferencial_produto'] ) );
		   update_post_meta( $produto_id, 'sa_status_produto', strip_tags( $_POST['sa_status_produto'] ) );
		 
		   return true;
		 
		}

/* taxonomias */

function sa_taxonomies(){
	register_taxonomy(
		'sa_produtos_taxonomy',
		array ('post','webinars', 'whitepapers'),
		array(
			'label'		=>	'produtos',
			'labels'	=>	array(
				'name'			=>	'Produtos',
				'singular_name'	=>	'Produto',
				'add_new_item'	=>	'Adiciona novo produto',
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
		array ('post','webinars','produtos', 'whitepapers'),
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
		'sa_whitepaper_taxonomy',
		array ('post','webinars','produtos'),
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
			'query_var'			=> true
			)
		);
}



/* habilita submenus no nav do bootstrap */


class twitter_bootstrap_nav_walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth ) {
		$indent = str_repeat( "\t", $depth );
		$output	.= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		if (strcasecmp($item->title, 'divider')) {
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = ($item->current) ? 'active' : '';
			$classes[] = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ($args->has_children && $depth > 0) {
				$class_names .= ' dropdown-submenu';
			} else if($args->has_children && $depth === 0) {
				$class_names .= ' dropdown';
			}

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
			$attributes .= ($args->has_children) ? ' data-toggle="dropdown" data-target="#" class="dropdown-toggle"' : '';

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ($args->has_children && $depth == 0) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		} else {
			$output .= $indent . '<li class="divider">';
		}
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

	if ( !$element ) {
	return;
	}

	$id_field = $this->db_fields['id'];

	if ( is_array( $args[0] ) )
	$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
	else if ( is_object( $args[0] ) )
	$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
	$cb_args = array_merge( array(&$output, $element, $depth), $args);
	call_user_func_array(array(&$this, 'start_el'), $cb_args);

	$id = $element->$id_field;

	if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

	foreach( $children_elements[ $id ] as $child ){

	if ( !isset($newlevel) ) {
	$newlevel = true;

	$cb_args = array_merge( array(&$output, $depth), $args);
	call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
	}
	$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
	}
	unset( $children_elements[ $id ] );
	}

	if ( isset($newlevel) && $newlevel ){

	$cb_args = array_merge( array(&$output, $depth), $args);
	call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
	}
	$cb_args = array_merge( array(&$output, $element, $depth), $args);
	call_user_func_array(array(&$this, 'end_el'), $cb_args);
	}
}


 
	/*add_filter( 'template_include', 'include_template_function', 1 );

	function include_template_function( $template_path ) {
	    if ( get_post_type() == 'produtos' ) {
		if ( is_single() ) {
		    // checks if the file exists in the theme first,
		    // otherwise serve the file from the plugin
		    if ( $theme_file = locate_template( array ( 'produtos.php' ) ) ) {
		        $template_path = $theme_file;
		    } else {
		        $template_path = plugin_dir_path( __FILE__ ) . '/produtos.php';
		    }
		}
	    }
	    return $template_path;
	}*/


/* adiciona parametro nos forms para permitir upload de arquivos */
function update_edit_form() {  
    echo ' enctype="multipart/form-data"';  
} // end update_edit_form  
add_action('post_edit_form_tag', 'update_edit_form'); 

function sa_whitepaper_add_meta_box() {  
  
    // Define the custom attachment for pages  
    add_meta_box(  
        'sa_whitepaper_meta_box',  
        'Atributos do Whitepaper',  
        'whitepaper_inner_meta_box',  
        'whitepaper'
    );  
  
}

// end add_custom_meta_boxes  
add_action('add_meta_boxes', 'sa_whitepaper_add_meta_box');  


function whitepaper_inner_meta_box($whitepaper) {  
  
    wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');  
     ?>
    <p class="description">Coloque o PDF aqui:</p>
    <?php $wer = get_post_meta($whitepaper->ID, 'wp_name_attachment'); ?>
    <input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25" > -->Arquivo atual: <i><?php echo $wer[0]; ?></i> 
      <?php
  
} // end wp_custom_attachment  

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

?>
