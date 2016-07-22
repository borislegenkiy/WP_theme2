<?php
/*
Template Name: Sitemap Page
*/
get_header(); ?>
	
<div class="wrapper">
	<div class="middle">
		<div class="container">
			<main class="content">
				<header class="page-header">
					<h1 ><?php _e( 'Карта сайта', 'lifeha1' ); ?></h1>
				</header>

				<div class="page-content">
					<?php get_template_part('sitemap'); ?>
				</div>
				<div class="pagenavy_block">
		                    <?php wp_pagenavi(); ?>
				</div>
	
			</main><!-- .content -->
		</div><!-- .container-->

		<aside class="right-sidebar">
			
				<? include("rightsidebar.php");?>
		
		</aside><!-- .right-sidebar -->
		<div class="clear"></div>
	</div>
</div>
<?php get_footer(); ?>
