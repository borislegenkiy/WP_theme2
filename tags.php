<?php
/*
Template Name: Tag
*/
get_header(); ?>

<div class="container">
			<main class="content">
                
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p id="breadcrumbs">','</p>');
				} ?>
                
                <?php if (!is_paged()) {?>
                    <?php echo category_description( $category_id ); ?>
                <?php }?>
				
				<?php echo do_shortcode('[adsense]4333461144[/adsense]'); ?>


<h2>Свежие статьи в рубрике:</h2>
                
				<?php while ( have_posts() ) : the_post(); ?>
					<?
					$image_url2 = wp_get_attachment_image_src($image_id,'medium');
					$image_url2 = $image_url2[0];
					if( get_the_post_thumbnail() ) {
						$image_url=get_the_post_thumbnail($image_id,array(240,240));
					} else {
						$image_url="<img src='/wp-content/themes/life-haker/img/logo_for_post.png'>";
					}
					?>
					
					<div class="item_content">
						<table>
							<tr>
								<td class="item_content_td1"><a href="<?php the_permalink();?>"><?php echo $image_url;?></a></td>
								<td class="item_content_td2">
									<div class="item_content_header">
										<a href="<?php the_permalink();?>"><?php  the_title(); ?></a>
									</div>
									
									<div class="text_item"> 	
										<?php the_excerpt(); ?>
									</div>
									
									<div class="text_item"> 	
										<div class="read_more_button f_right">
											<a href="<?php the_permalink();?>">Читать все..</a>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
				<?php endwhile; ?>
				
				<div class="digits">
		            <?php wp_pagenavi(); ?>
				</div>
			</main>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
