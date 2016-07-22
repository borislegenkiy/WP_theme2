<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package life-haker
 */
get_header(); ?>

<div class="container">
	<main class="content">
			<div>
				<h1>Ошибка 404.</h1>
			</div>
			<div style="padding: 15px;">
				<h2>К сожалению страница была перемещена или удалена.</h2>
			</div>
			<div style="padding: 15px;">
				<h4>Посмотрите наши материалы:</h4>
			</div>
			<div class="page-content">
				<?php get_template_part('sitemap');?>
			</div>
			<div class="pagenavy_block">
				<?php wp_pagenavi();?>
			</div>
	</main>
</div>

<?php
get_sidebar();
get_footer();
?>