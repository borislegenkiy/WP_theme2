<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package life-haker
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="/wp-content/themes/life-haker/img/favicon.ico" type="image/ico">

<!-- JQuery -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<!-- Main JS Script -->
<script type="text/javascript" src="/wp-content/themes/life-haker/js/span.js"></script>

<!-- Google Analytics counter -->
<script type="text/javascript" src="/wp-content/themes/life-haker/js/google-analytics.js"></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" src="/wp-content/themes/life-haker/js/yandex-metrika.js"></script>

<!-- JS Scripts For VK & FaceBook Comments-->
<!--
<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
<script type="text/javascript">
  VK.init({apiId: 5201458, onlyWidgets: true});
</script>
<script type="text/javascript" src="/wp-content/themes/life-haker/js/facebook.js"></script>
-->

<?php wp_head(); ?>
<?php require_once("walker_menu.php"); ?>
<?php require_once("contents.php"); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
	<header class="header">
		<div class="header_line1">
			<div class="logo_header f_left"><span class="seolink" rel="http://lifeha.ru/" title="Лайфха"><img src="/wp-content/themes/life-haker/img/logo.png" alt="Лайфха - лого" title="Лайфха - лого"></span></div>
			<div class="main_menu  f_left">
				<!--noindex-->	
				<?
					$walker = new mainMenuWalker ();
					$args_menu_top = array(
					'menu'    => 'top_menu',
					'container'   => '',
					'walker' => $walker
					);
					wp_nav_menu( $args_menu_top );
				?>
				<!--/noindex-->
			</div>
			<div class="info_place f_left">
				<div class="phone_place">
					<div class="phone_img f_left"><img alt="Лайфха - тел" title="Лайфха - тел" src="/wp-content/themes/life-haker/img/phone.png"></div>
					<div class="phone_text f_left">8 (962) 350-10-92</div>
				</div>
				<div class="email_place">
					<div class="email_img f_left"><img alt="Лайфха - почта" title="Лайфха - почта" src="/wp-content/themes/life-haker/img/message.png"></div>
					<div class="email_text f_left"><a href="mailto:vip@lifeha.ru">vip@lifeha.ru</a></div>
				</div>
				<div class="work_place">
					<div class="work_text f_left">пн.-пт. 09.00 - 18.00</div>
				</div>
			</div>
		</div>
	</header>

	<div class="middle">