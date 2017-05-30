<?php

//Add support for WordPress 3.0's custom menus
add_action( 'init', 'register_my_menu' );

//Register area for custom menu
function register_my_menu() {
    register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
}


 // Enable post thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size(520, 250, true);

// Image size for single posts
add_image_size( 'slide-post', 1200, 800);

//Some simple code for our widget-enabled sidebar
if ( function_exists('register_sidebar') )
    register_sidebar();

//Code for custom background support
add_custom_background();

//Remove jquery migrate
add_action( 'wp_default_scripts', function( $scripts ) {
    if ( ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, array( 'jquery-migrate' ) );
    }
} );

//-----------------------------------  // Custom functions //-----------------------------------//

function string_limit_words($string, $word_limit){
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

function get_language(){
	$result = null;
	$cookie_name = "NIPPO_LNG";
	$cookie_value = null;
	$set_lang = null;
	if(!isset($_COOKIE[$cookie_name])) {
		$set_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	}
	if($_GET['lg']){
		$set_lang = $_GET['lg'];
	}
	if($set_lang){
		switch ($set_lang){
		    case "en":
		        $cookie_value = 'eng';
		        break;
		    default:
		        $cookie_value = 'ita';
		        break;
		}
	}
	if($cookie_value){
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	}
	$result = ($cookie_value)?$cookie_value:$_COOKIE['NIPPO_LNG'];
	return $result;
}

//-----------------------------------  // Single Category //-----------------------------------//

//Gets post cat slug and looks for single-[cat slug].php and applies it
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
		return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);


//-----------------------------------  // Shortcodes //-----------------------------------//


//-----------------------------------  // Register Widget Areas //-----------------------------------//


//-----------------------------------  // Custom Fields //-----------------------------------//

if( function_exists('acf_add_options_page') ) {
	$page = acf_add_options_page(array(
		'page_title' 	=> 'Opzioni',
		'menu_title' 	=> 'Opzioni',
		'menu_slug' 	=> 'opzioni',
		'parent_slug'	=> '',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false
	));
// gestione sponsor contatti etc.
    /*$page2 = acf_add_options_page(array(
        'page_title' 	=> 'Configurazioni',
        'menu_title' 	=> 'Configurazioni',
        'menu_slug' 	=> 'configurazioni',
        'parent_slug'	=> '',
        'capability' 	=> 'edit_posts',
        'redirect' 	=> false
    ));*/
}

//-----------------------------------  // Register Custom post type //-----------------------------------//


//add_action( 'init', 'create_post_type_membro' );
//add_action( 'init', 'create_post_type_gara' );
//add_action( 'init', 'create_post_type_sponsor' );


function create_post_type_membro() {
    $labels = array(
        'name' => __( 'Membri' ),
        'singular_name' => __( 'Membro' ),
        'add_new_item' => __('Agg. nuovo Membro'),
        'add_new' => __('Agg. nuovo', 'Membro'),
        'edit_item' => __('Modifica Membro'),
        'new_item' => __('Nuovo Membro'),
        'all_items' => __('Tutti i Membro'),
        'view_item' => __('Vedi Membro'),
        'search_items' => __('Cerca Membro'),
        'not_found' =>  __('nessun membro trovato'),
        'not_found_in_trash' => __('nessun membro trovato nel cestino'),
        'parent_item_colon' => '',
        'menu_name' => 'Squadra'
    );
    $rewrite = array(
        'slug'                => 'membro',
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
        'menu_icon' =>'dashicons-groups',//  get_stylesheet_directory_uri() . '/media/post_icon_box.png',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'rewrite' => $rewrite,
        'supports' => array('title'),//,'thumbnail'),
        'taxonomies' => array('tipologia'),//'category')
    );
    register_post_type( 'membro', $args);
}
function create_post_type_sponsor() {
    $labels = array(
        'name' => __( 'Sponsor' ),
        'singular_name' => __( 'Sponsor' ),
        'add_new_item' => __('Agg. nuovo Sponsor'),
        'add_new' => __('Agg. nuovo', 'Sponsor'),
        'edit_item' => __('Modifica Sponsor'),
        'new_item' => __('Nuovo Sponsor'),
        'all_items' => __('Tutti i Sponsor'),
        'view_item' => __('Vedi Sponsor'),
        'search_items' => __('Cerca Sponsor'),
        'not_found' =>  __('nessun soonsor trovato'),
        'not_found_in_trash' => __('nessun sponsor trovato nel cestino'),
        'parent_item_colon' => '',
        'menu_name' => 'Sponsor'
    );
    $rewrite = array(
        'slug'                => 'sponsor',
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
        'menu_icon' =>'dashicons-groups',//  get_stylesheet_directory_uri() . '/media/post_icon_box.png',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'rewrite' => $rewrite,
        'supports' => array('title'),//,'thumbnail'),
        'taxonomies' => array(),//'gruppo')
    );
    register_post_type( 'sponsor', $args);
}

function create_post_type_gara() {
    $labels = array(
        'name' => __( 'Gare' ),
        'singular_name' => __( 'Gara' ),
        'add_new_item' => __('Agg. nuova Gara'),
        'add_new' => __('Agg. nuova', 'Gara'),
        'edit_item' => __('Modifica Gara'),
        'new_item' => __('Nuova Gara'),
        'all_items' => __('Tutte le Gare'),
        'view_item' => __('Vedi Gara'),
        'search_items' => __('Cerca Gara'),
        'not_found' =>  __('Nessuna Gara trovato'),
        'not_found_in_trash' => __('Nessuna Gara trovato nel cestino'),
        'parent_item_colon' => '',
        'menu_name' => 'Gare',
    );
    $rewrite = array(
        'slug'                => 'gare',
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
        'menu_icon' => 'dashicons-awards',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'rewrite' => $rewrite,
        'supports' => array('title'),//,'thumbnail'),
        //'taxonomies' => array('tipologia'),//'category')
        'menu_position' => 7,
    );
    register_post_type( 'gara', $args);
}




//-----------------------------------  // Register Custom Taxonomy //-----------------------------------//

function add_custom_taxonomies_tipologia_membri() {
    // Add new "Locations" taxonomy to Posts
    register_taxonomy('tipologia', 'membro', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x( 'Tipoligia Membro', 'taxonomy general name' ),
            'singular_name' => _x( 'Tipologia Membro', 'taxonomy singular name' ),
            'search_items' =>  __( 'Cerca Tipoligia Membro' ),
            'all_items' => __( 'Tutti i Gruppi dei Membro' ),
            'parent_item' => __( 'Tipoligia Membro parente' ),
            'parent_item_colon' => __( 'Tipoligia Membro parente:' ),
            'edit_item' => __( 'Modifica Tipoligia Membro' ),
            'update_item' => __( 'Aggiorna Tipoligia Membro' ),
            'add_new_item' => __( 'Agg. nuovo Tipoligia Membro' ),
            'new_item_name' => __( 'Nuovo nome Tipoligia Membro' ),
            'menu_name' => __( 'Tipoligia Membro' ),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'tipologia', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),
    ));
}
//add_action( 'init', 'add_custom_taxonomies_tipologia_membri', 0 );


/*
function add_custom_taxonomies_gruppo_sponsor() {
    // Add new "Locations" taxonomy to Posts
    register_taxonomy('gruppo', 'sponsor', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x( 'Gruppo Sponsor', 'taxonomy general name' ),
            'singular_name' => _x( 'Gruppo Sponsor', 'taxonomy singular name' ),
            'search_items' =>  __( 'Cerca Gruppo Sponsor' ),
            'all_items' => __( 'Tutti i Gruppi degli Sponsor' ),
            'parent_item' => __( 'Gruppo Sponsor parente' ),
            'parent_item_colon' => __( 'Gruppo Sponsor parente:' ),
            'edit_item' => __( 'Modifica Gruppo Sponsor' ),
            'update_item' => __( 'Aggiorna Gruppo Sponsor' ),
            'add_new_item' => __( 'Agg. nuovo Gruppo Sponsor' ),
            'new_item_name' => __( 'Nuovo nome Gruppo Sponsor' ),
            'menu_name' => __( 'Gruppo Sponsor' ),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'gruppo', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),
    ));
}
add_action( 'init', 'add_custom_taxonomies_gruppo_sponsor', 0 );
*/

//---------------------------------------------------------------------------------//

//define( 'ACF_LITE', true );
//include_once('advanced-custom-fields/acf.php');
?>
