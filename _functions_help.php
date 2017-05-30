<?php

//-----------------------------------  // Remove comments //-----------------------------------//

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');

//----------------------------------- // DUPLICATE post + page // -------------------------------//

function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	// get the original post id
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	//and all the original post data then
	$post = get_post( $post_id );
 
	// if you don't want current user to be the new post author,
	// then change next couple of lines to this: $new_post_author = $post->post_author;
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	// if post data exists, create the post duplicate
	if (isset( $post ) && $post != null) {
 
		// new post data array
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		// insert the post by wp_insert_post() function
		$new_post_id = wp_insert_post( $args );
 
		// get all current post terms ad set them to the new post draft
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		//duplicate all post meta just in two SQL queries
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		//finally, redirect to the edit post screen for the new draft
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
 

// Add the duplicate link to action list for post_row_actions 
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplica</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 ); // duplicate post
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2); // duplicate page

//----------------------------------- // Custom Menu // -------------------------------//

//-----------------------------------  // Sidebar //-----------------------------------//

//Some simple code for our widget-enabled sidebar
if ( function_exists('register_sidebar') ){

	register_sidebar(
		array(
			'name' => 'Colonna',
			'id' => 'sidebar-id',
			'description' => 'Quarta colonna nel footer.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);
}

//Code for custom background support
add_custom_background();

//-----------------------------------  // Custom Functions //-----------------------------------//


//-----------------------------------  // Shortcodes //-----------------------------------//


function empty_row_shortcode() {
	return '<div class="reset_float empty_row"></div>';
}
add_shortcode( 'emptyrow', 'empty_row_shortcode' );


//[center]text[/center]
function center_shortcode( $atts, $content = null ) {
	if($content){
		echo "<div class='content_center'>";
			echo do_shortcode($content);
		echo "</div>";
		
	}
}
add_shortcode( 'center', 'center_shortcode' );







//-----------------------------------  // Register Custom Taxonomy //-----------------------------------//

function add_custom_taxonomies_boxgruppo() {
  // Add new "Locations" taxonomy to Posts
  register_taxonomy('gruppo', 'box', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Gruppo Box', 'taxonomy general name' ),
      'singular_name' => _x( 'Gruppo Box', 'taxonomy singular name' ),
      'search_items' =>  __( 'Cerca Gruppo Box' ),
      'all_items' => __( 'Tutti i Gruppi dei Box' ),
      'parent_item' => __( 'Gruppo Box parente' ),
      'parent_item_colon' => __( 'Gruppo Box parente:' ),
      'edit_item' => __( 'Modifica Gruppo Box' ),
      'update_item' => __( 'Aggiorna Gruppo Box' ),
      'add_new_item' => __( 'Agg. nuovo Gruppo Box' ),
      'new_item_name' => __( 'Nuovo nome Gruppo Box' ),
      'menu_name' => __( 'Gruppo Box' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'gruppo', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));
}
add_action( 'init', 'add_custom_taxonomies_boxgruppo', 0 );



//-----------------------------------  // Custom Fields //-----------------------------------//

add_action( 'init', 'create_post_type_box' );
function create_post_type_box() {
	$labels = array(
		'name' => __( 'Box' ),
		'singular_name' => __( 'Box' ),
		'add_new_item' => __('Agg. nuovo Box'),
		'add_new' => __('Agg. nuovo', 'Box'),
		'edit_item' => __('Modifica Box'),
		'new_item' => __('Nuovo Box'),
		'all_items' => __('Tutti i Box'),
		'view_item' => __('Vedi Box'),
		'search_items' => __('Cerca Box'),
		'not_found' =>  __('Nessun Box trovato'),
		'not_found_in_trash' => __('Nessun Box trovato nel cestino'),
		'parent_item_colon' => '',
		'menu_name' => 'Box griglia'
	);
	$rewrite = array(
		'slug'                => 'box',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/media/post_icon_box.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'rewrite' => $rewrite,
		'supports' => array('title'),//,'thumbnail'),
		'taxonomies' => array('gruppo','filtro'),//'category')
	);
	register_post_type( 'box', $args);
}

//-----------------------------------  // User Role //-----------------------------------//

// remove to the admin bar
function remove_annointed_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo'); // wp logo
	$wp_admin_bar->remove_menu('comments'); // comments
	$wp_admin_bar->remove_menu('new-content'); // add new
}
add_action('wp_before_admin_bar_render', 'remove_annointed_admin_bar', 0);

//$result = remove_role( 'admin' );
//$result = remove_role( 'editor' );
//$result = remove_role( 'author' );
//$result = remove_role( 'contributor' );
//$result = remove_role( 'subscriber' );
//$result = add_role( 'coordinatore', 'Coordinatore',array('read' => true));
//$result = add_role( 'redattore', 'Redattore',array('read' => true));

add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
	global $user_ID;
	if (current_user_can('administrator')){
	}
	else if(current_user_can('coordinatore')){
	//	remove_menu_page('index.php'); // Dashboard
	//	remove_menu_page('tools.php'); // Tools
	//	remove_menu_page('edit.php'); // Posts
	//	remove_menu_page('options-general.php'); //Settings
	}
	else if(current_user_can('redattore')){
	//	remove_menu_page('index.php'); // Dashboard
		//remove_menu_page('themes.php'); // Appearance
		//remove_menu_page('plugins.php'); //Plugins
	//	remove_menu_page('tools.php'); // Tools
		//remove_menu_page('users.php'); // Users
	//	remove_menu_page('edit.php'); // Posts
		//remove_menu_page('edit-comments.php');
		//remove_menu_page('options-general.php'); //Settings
		//remove_menu_page('edit.php?post_type=page'); //Pages
	//	remove_menu_page('edit.php?post_type=box'); // Box
	//	remove_menu_page('opzioni'); // ACF opzioni
	}
}

add_action('admin_head','load_editor_style');
function load_editor_style(){
	$templateuri = get_template_directory_uri();
	if(current_user_can('administrator')){
		wp_enqueue_style('editorstyle', $templateuri.'/css/administrator.css');
	}else if(current_user_can('coordinatore')){
		wp_enqueue_style('editorstyle', $templateuri.'/css/coordinatore.css');
	}else if(current_user_can('redattore')){
		wp_enqueue_style('editorstyle', $templateuri.'/css/redattore.css');
	}
}


//---------------------------------------------------------------------------------//

//define( 'ACF_LITE', true );
//include_once('advanced-custom-fields/acf.php');

?>