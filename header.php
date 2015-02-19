<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package gazette
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<link type="text/plain" rel="author" href="<?php echo esc_url( home_url( '/' ) ); ?>/humans.txt" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="container">
		<a class="skip-link sr-only" href="#content"><?php _e( 'Skip to content', 'gazette' ); ?></a>
		<div class=
		<header id="masthead" class="page-header" role="banner">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?><br/>
						<small class="site-description">
							<?php bloginfo( 'description' ); ?>
						</small>
					</a></h1>
				</div>
				<div class="col-sm-4">
					<a href="#">Subscribe</a>
					<?php get_search_form( true ); ?>
				</div>
			</div>
			<nav id="site-navigation" class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php 
							$defaults = array(
								'theme_location'  => 'primary',
								'container'       => false,
								'menu_class'      => 'nav navbar-nav',
								'depth' => '1'
							);	
							wp_nav_menu( $defaults );
							
							?>
					</div>
					<!-- /.navbar-collapse --> 
				</div>
				<!-- .container-fluid --> 
			</nav>
			<!-- #site-navigation --> 
		</header>
		<!-- #masthead -->
		<div id="content" class="site-content">