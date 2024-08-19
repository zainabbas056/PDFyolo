<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PDFyolo
 */

	if ( function_exists('get_field') ) {
		$theme_header_logo=					get_field('theme_header_logo','options');
		$theme_header_login_link=		get_field('theme_header_login_link','options');
	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<script data-cfasync="false" async type="text/javascript" src="//agazejagless.com/gcsTwsrPpQZej2A/76837"></script>
	<script data-cfasync="false" async type="text/javascript" src="//benzoylchaitra.com/gbrwjzMzsTDhow/76837"></script>

	<script data-cfasync="false" async type="text/javascript" src="//glochisprp.com/fPHZkupQ2ZCvtq/76826"></script>

<meta name="galaksion-domain-verification" content="086e3350149fdebdd3e471fc2a7c969cd9435ecd7d1389161a117d45a9372799" />


	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- set the page title -->
	<!-- inlcude google nunito sans font cdn link -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<!-- inlcude google poppins font cdn link -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,600&display=swap" rel="stylesheet">
    <title><?php bloginfo( 'name' ); ?></title>


<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open();


	 ?>

	<!-- pageWrapper -->
	<div id="pageWrapper">
		<!-- pageHeader -->
		<header id="pageHeader" class="bg-white shadow-sm fixed-top site-header">
			<div class="container d-flex align-items-center mainNavDiv">
				<button id="pgNaveOpener" class="navbar-toggler pgNaveOpener position-relative d-lg-none" type="button">
					<i class="fa-solid fa-bars menu-icn"></i>
				</button>
				<div class="logo">
					<a href="<?php echo get_site_url() ?>">
						<img src="<?php echo $theme_header_logo['url']?>" class="img-fluid" alt="<?php echo $theme_header_logo['title']?>">
					</a>
				</div>
				<nav id="pageNav" class="navbar navbar-expand-lg navbar-light justify-content-end justify-content-lg-start position-static mx-auto p-0">
					<div class="collapse navbar-collapse pageMainNavCollapse" id="pageMainNavCollapse">
						<div class="d-flex d-lg-none justify-content-end">
							<button class="btn-menu-close bg-transparent border-0 py-1 px-2 site-nav-closer"><i class="fa-solid fa-xmark menu-icn"></i></button>
						</div>
						<!-- mainNavigation -->
						<?php
							PDFyolo_header_menus("navbar-nav mainNavigation","header_main_navigation");
						?>
					</div>
				</nav>
				<div class="site-overlay"></div>
				<div class="header-form-wrap ml-auto ml-lg-0 mw-100">
					<form action="" class="searchForm">
						<div class="input-group">
							<input class="form-control form-control-sm" id="search-header" type="text" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
							<div class="input-group-append">
								<button class="btn btn-light btn-sm" type="submit">
									<i class="fa-solid fa-magnifying-glass search-icn"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</header>
		<main>



			



