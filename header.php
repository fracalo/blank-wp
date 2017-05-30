<?php
	session_start();

	// GET LINGUA
	$lg = get_language();

	// POST VARS
	// $options_fields = get_fields('options');
	// $post_fields = get_fields();
?>

 <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?> <![endif]-->
<!--[if IE 7]>         <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?> <![endif]-->
<!--[if IE 8]>         <html class="lt-ie9" <?php language_attributes(); ?> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- <meta http-equiv="last-modified" content="2017-02-28@11:00:00 GMT" /> -->

<link rel="home" href="<?php bloginfo( 'url' ); ?>">
<base href=".">
<!-- <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" /> -->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">

<!-- -------------------
ICONS - START
-------------------- -->

<link rel="shortcut icon" href="<?php// echo ($post_fields['icon_favicon'])?$post_fields['icon_favicon']:$options_fields['icon_favicon']; ?>" />
<link rel="icon" href="<?php// echo ($post_fields['icon_favicon'])?$post_fields['icon_favicon']:$options_fields['icon_favicon']; ?>" type="image/x-icon">
<meta name="msapplication-TileImage" content="<?php// echo ($post_fields['icon_msapplication-TileImage'])?$post_fields['icon_msapplication-TileImage']:$options_fields['icon_msapplication-TileImage']; ?>">
<link rel="icon" sizes="16x16 32x32 64x64" href="<?php// echo ($post_fields['icon_favicon'])?$post_fields['icon_favicon']:$options_fields['icon_favicon']; ?>">
<link rel="icon" type="image/png" sizes="196x196" href="<?php// echo ($post_fields['icon_196x196'])?$post_fields['icon_196x196']:$options_fields['icon_196x196']; ?>">
<link rel="icon" type="image/png" sizes="160x160" href="<?php// echo ($post_fields['icon_160x160'])?$post_fields['icon_160x160']:$options_fields['icon_160x160']; ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?php// echo ($post_fields['icon_96x96'])?$post_fields['icon_96x96']:$options_fields['icon_96x96']; ?>">
<link rel="icon" type="image/png" sizes="64x64" href="<?php// echo ($post_fields['icon_64x64'])?$post_fields['icon_64x64']:$options_fields['icon_64x64']; ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php// echo ($post_fields['icon_32x32'])?$post_fields['icon_32x32']:$options_fields['icon_32x32']; ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php// echo ($post_fields['icon_16x16'])?$post_fields['icon_16x16']:$options_fields['icon_16x16']; ?>">
<link rel="apple-touch-icon" sizes="57x57" href="<?php// echo ($post_fields['icon_57x57'])?$post_fields['icon_57x57']:$options_fields['icon_57x57']; ?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?php// echo ($post_fields['icon_114x114'])?$post_fields['icon_114x114']:$options_fields['icon_114x114']; ?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?php// echo ($post_fields['icon_72x72'])?$post_fields['icon_72x72']:$options_fields['icon_72x72']; ?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?php// echo ($post_fields['icon_144x144'])?$post_fields['icon_144x144']:$options_fields['icon_144x144']; ?>">
<link rel="apple-touch-icon" sizes="60x60" href="<?php// echo ($post_fields['icon_60x60'])?$post_fields['icon_60x60']:$options_fields['icon_60x60']; ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?php// echo ($post_fields['icon_120x120'])?$post_fields['icon_120x120']:$options_fields['icon_120x120']; ?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?php// echo ($post_fields['icon_76x76'])?$post_fields['icon_76x76']:$options_fields['icon_76x76']; ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php// echo ($post_fields['icon_152x152'])?$post_fields['icon_152x152']:$options_fields['icon_152x152']; ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php// echo ($post_fields['icon_180x180'])?$post_fields['icon_180x180']:$options_fields['icon_196x196']; ?>">

<!-- -------------------
ICONS - END
-------------------- -->


<!-- -------------------
SEO - START
-------------------- -->

<title><?php// echo ($post_fields['seo_title'])?$post_fields['seo_title']:$options_fields['seo_title']; ?></title>

<meta name="description" content="<?php// echo ($post_fields['seo_description'])?$post_fields['seo_description']:$options_fields['seo_description']; ?>">

<meta name="keywords" content="<?php// echo ($post_fields['seo_keywords'])?$post_fields['seo_keywords']:$options_fields['seo_keywords']; ?>">

<meta name="apple-mobile-web-app-title" content="<?php// echo ($post_fields['seo_apple-mobile-web-app-title'])?$post_fields['seo_apple-mobile-web-app-title']:$options_fields['seo_apple-mobile-web-app-title']; ?>">
<meta name="application-name" content="<?php// echo ($post_fields['seo_application-name'])?$post_fields['seo_application-name']:$options_fields['seo_application-name']; ?>">

<meta property="og:url" content="<?php// echo ($post_fields['seo_og:url'])?$post_fields['seo_og:url']:$options_fields['seo_og:url']; ?>">
<meta property="og:type" content="<?php// echo ($post_fields['seo_og:type'])?$post_fields['seo_og:type']:$options_fields['seo_og:type']; ?>">
<meta property="og:title" content="<?php// echo ($post_fields['seo_og:title'])?$post_fields['seo_og:title']:$options_fields['seo_og:title']; ?>">
<meta property="og:description" content="<?php// echo ($post_fields['seo_og:description'])?$post_fields['seo_og:description']:$options_fields['seo_og:description']; ?>">
<meta property="og:image" content="<?php// echo ($post_fields['seo_og:image'])?$post_fields['seo_og:image']:$options_fields['seo_og:image']; ?>">

<meta name="twitter:site" content="<?php// echo ($post_fields['seo_twitter:site'])?$post_fields['seo_twitter:site']:$options_fields['seo_twitter:site']; ?>">
<meta property="twitter:title" content="<?php// echo ($post_fields['seo_twitter:title'])?$post_fields['seo_twitter:title']:$options_fields['seo_twitter:title']; ?>">
<meta property="twitter:description" content="<?php// echo ($post_fields['seo_twitter:description'])?$post_fields['seo_twitter:description']:$options_fields['seo_twitter:description']; ?>">
<meta property="twitter:image" content="<?php// echo ($post_fields['seo_twitter:image'])?$post_fields['seo_twitter:image']:$options_fields['seo_twitter:image']; ?>">

<!-- -------------------
SEO - END
-------------------- -->



<!-- -------------------
CSS - START
-------------------- -->

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/include/bootstrap.min.css" >
<!--<link rel="stylesheet" type="text/css" href="<?php// bloginfo('template_url'); ?>/css/font-awesome-4.7.0/css/font-awesome.min.css" >
<link rel="stylesheet" type="text/css" href="<?php// bloginfo('template_url'); ?>/css/flexslider.css" >

<custom fonts
<link href="https://fonts.googleapis.com/css?family=Oswald|Montserrat" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="all" href="<?php// bloginfo( 'stylesheet_url' ); ?>?v=1.0" />
<link rel="stylesheet" type="text/css" media="all" href="<?php// bloginfo( 'template_url' ); ?>/css/custom-style.css?v=1.0" />-->

<!-- -------------------
CSS - END
-------------------- -->

<?php wp_head(); ?>
</head>
<body>

	<!-- -------------------
	SEO TRAKING - START
	------------------- -->

	<?php// echo ($post_fields['seo_googleanalytics'])?$post_fields['seo_googleanalytics']:$options_fields['seo_googleanalytics']; ?>

	<!-- -------------------
	SEO TRAKING - END
	------------------- -->

	<header id="header">
    <div class="container-fluid top-menu">
			<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
				<!--
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Link</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link disabled" href="#">Disabled</a>
			      </li>
			    </ul>
			    <form class="form-inline my-2 my-lg-0">
			      <input class="form-control mr-sm-2" type="text" placeholder="Search">
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			    </form>
				-->

					<?php
					$nav = wp_nav_menu(array(
						'menu'            => '', // id menu
						//'theme_location' => 'primary',
						//'depth'             => 2,
						'container'       => 'ul',
						'container_class' => 'nav-collapse',
						'container_id'    => 'navbarSupportedContent',
						'menu_class'=> 'navbar-nav mr-auto', // ul class
						'echo' => false,
						//'before'          => '',
					    //'after'           => '',
					    //'link_before'     => '',
					    //'link_after'      => '',
					    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
					));
					//var_dump($nav);
					$nav  = preg_replace('/class="menu-item/', '/class="nav-item menu-item' , $nav);
					$nav = preg_replace('/<a /', '<a class="nav-link" ', $nav);
					echo $nav;
					?>
				</div>
			</nav>
		</div>
	 		<!--/.container-fluid -->
	</header>
