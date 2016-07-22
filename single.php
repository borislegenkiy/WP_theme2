<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package life-haker
 */
get_header(); ?>
		<div class="container">
			<main class="content">
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<div class="data">
						<?php if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb('<p id="breadcrumbs">','</p>');
						} ?>
					</div>
					<!--<div class="data"><?php the_date();?></div>-->
                    
                    <?
                      $icons = get_option('_taxonomy_font_icons');
                      $first_category_id = reset(get_the_category($post->ID))->term_id;
                      $cur_ico = $icons[$first_category_id];
                      
                      // если иконка есть - выводим, если нет - только заголоввок 
                      if (!empty($cur_ico))
                        echo '<div class="f_left place_h1_img"><span class="term-list-icon ' . $cur_ico . '">' . 
                        '</span></div><div class="f_left place_h1_text"><h1>'. get_the_title() . '</h1></div>' ;
                      else 
                        echo '<h1>'. get_the_title() . '</h1>';
                    ?>
     
					<?php if ( is_active_sidebar( 'underpost-1' ) ) : ?>
						<?php dynamic_sidebar( 'underpost-1' ); ?>
					<?php endif; ?>
					
					<?php if( has_tag() ) {?>
						<div class="name_tags">Кому подходит этот спосок заработка:</div>
					<?php } ?>
					<div class="tags"> <?php the_tags( '', '', '<br />' ); ?> </div>
					<?php
					## Вывод содержания вверху, автоматом для всех постов
					add_filter('the_content', 'contents_on_post_top' );
					function contents_on_post_top( $content ){
						if( ! is_singular() ) return $content;

						//$args['margin'] = 50;
						//$args['to_menu'] = false;
						//$args['title'] = false;
						$tags = array('h2','h3');
						$contents = Kama_Contents::init( $args )->make_contents( $content, $tags );
						return $contents . $content;
					}
					?>

					<? the_content(''); ?>
					
					<?php if ( is_active_sidebar( 'upperpost-1' ) ) : ?>
						<?php dynamic_sidebar( 'upperpost-1' ); ?>
					<?php endif; ?>
					<div class="place_social">
						<div class="name_social_links f_left">ПОДЕЛИТЬСЯ ЗАПИСЬЮ</div>
						<div class="place_social_icons f_left">
							<?php echo do_shortcode('[smm_buttons]');?>
						</div>
					</div>
					<hr>
				<?php endwhile; ?>
				<?php endif; ?>
				
				<div class="recommended">
						<?php if(function_exists('related_posts')){ 
						   if( has_tag() ) {
								related_posts();
						   } else {
							$categories = get_the_category($post->ID);
							if ($categories) {
								$category_ids = array();
								foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
								$args=array (
								  'category__in' => $category_ids,
								  'post__not_in' => array($post->ID),
								  'showposts'=>5,
								  'orderby'=>rand,
								  'caller_get_posts'=>1);
								$my_query = new wp_query($args);
								//echo $my_query['0'];
								echo "
									<div class='recommended_article f_left'>
										<div class='recommended_article_header'>
											<div class='recommended_article_header_img f_left'><img src='/wp-content/themes/life-haker/img/notes.png'></div>
											<div class='recommended_article_header_text f_left'>РЕКОМЕНДУЕМЫЕ СТАТЬИ</div>
										</div>
										<div class='recommended_article_blk'>
											<ul class='recommended_article_links'>
									";
								if( $my_query->have_posts() ) {
									while ($my_query->have_posts()) {
										$my_query->the_post();
										?>
										<li><span class="seolink" rel="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></span></li>
										<?php
										$count++;
									}
									echo "</ul>
										</div>
									</div>";
								}
								wp_reset_query();
							}
						   }
						}?>
				</div>
			<!--
			<div class="social_comments_place">
				<div class='recommended_article_header'>
					<div class='recommended_article_header_img f_left'><img src='/wp-content/themes/life-haker/img/notes.png'></div>
					<div class='recommended_article_header_text f_left'>КОММЕНТАРИИ</div>
				</div>
				<div class="social_comments">
					<div class="social_vk f_left">
						<div id="vk_comments"></div>
						<script type="text/javascript">
						VK.Widgets.Comments("vk_comments", {limit: 10, width: "330", attach: "*"});
						</script>
					</div>
					<div class="social_facebook f_left">
						<div id="fb-root"></div>
						<div class="fb-comments" data-href="<?php echo get_permalink();?>" data-width="330" data-numposts="5"></div>
					</div>
				</div>
			</div>-->
			</main>
		</div>
<?php
get_sidebar();
get_footer();
?>