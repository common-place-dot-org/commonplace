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
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory')?>/favicon.ico" />
<title><?php wp_title('›', true, 'right'); ?>Common-place: The Journal of early American Life</title>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/plain" rel="author" href="<?php echo esc_url( home_url( '/' ) ); ?>/humans.txt" />
<?php wp_head(); ?>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body <?php body_class(); ?>>
	<nav id="skiplinks" class="sr-only">
		<a href="#site-navigation">Skip to Navigation</a>
		<a href="#search">Skip to Search</a>
		<a href="#content">Skip to Content</a>
	</nav>
	<div id="page" class="container">
		<a class="skip-link sr-only" href="#content"><?php _e( 'Skip to content', 'gazette' ); ?></a>
		<header id="masthead" role="banner">
			<div class="row hidden-xs">
				<div class="col-sm-4">
					<?php 
						if (wp_get_nav_menu_object('Header Left')){
							$defaults = array(
								'menu'			=> 'Header Left',
								'container'       => false,
								'items_wrap'      => '<ul id="%1$s" class="%2$s nav nav-pills">%3$s</ul>',
								'depth'			=> 1,
								'fallback_cb'		=> false
							);
							wp_nav_menu( $defaults );
						}
					?>
				</div>				
				<div class="col-sm-4">
					<h1 class="site-title">
						<a href="<?php home_url(); ?>" rel="home">
							<img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?> : <?php bloginfo( 'description' ); ?>" class="img-responsive"/>
						</a>
					</h1>
				</div>
				<div class="col-sm-4">
					<div id="search">
						<?php echo get_bsearch_form(); ?>
					</div>
				</div>
			</div>
			
			<nav id="site-navigation" class="navbar navbar-default" role="navigation">
				<div class="container-fluid"> 
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#columns-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
						<a class="navbar-brand visible-xs-block" href="<?php home_url();?>"><img src="<?php bloginfo('stylesheet_directory')?>/img/logo-mobile.png" alt="Common-place" width="190"/></a>
					</div>
					<div class="collapse navbar-collapse" id="columns-nav">
						<?php
							$defaults = array(
								'theme_location'  => 'primary',
								'container'       => false,
								'menu_class'      => 'nav navbar-nav',
								'depth' => '1'
							);
							wp_nav_menu( $defaults );

							?>
							<hr class="visible-sm-block visible-xs-block"/>
							<ul class="nav navbar-nav navbar-right visible-xs-block">
								<li><a href="<?php bloginfo('wpurl')?>/archive">Search</a></li>
								<li><a href="<?php bloginfo('wpurl')?>/subscribe">Subscribe</a></li>
							</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
			</nav>
			<!-- #site-navigation -->
		</header>
		<!-- #masthead -->
		<div id="content" class="site-content">
