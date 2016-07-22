<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Prodavec_Okon
 */

get_header(); ?>

<div class="container">
			<main class="content">
                <?php if (!is_paged()) {?>
                    <?php echo category_description( $category_id ); ?>
                <?php }?>
				<?
                      $icons = get_option('_taxonomy_font_icons');
                      $first_category_id = reset(get_the_category($post->ID))->term_id;
                      $cur_ico = $icons[$first_category_id];
                      
                      // если иконка есть - выводим, если нет - только заголоввок 
                      if (!empty($cur_ico))
                        echo '<div class="f_left place_h1_img"><span class="term-list-icon ' . $cur_ico . '">' . 
                        '</span></div>' ;
                    ?>
                <?
                // в категориях по умолчанию выводится Nпостов из настроек, 
                // пришлось сделать отдельным запросом (возможно не прав. Меркулов 11.01.2016)
                // artcile_subcategory                
                // kak-zarabotat	
                // kak-sdelat
                // навигация
                $infocat = get_the_category();
                $info = $infocat[0]->cat_ID;
                $array = "cat=$info&posts_per_page=-1";
                $lastposts = get_posts( $array );
                
                // выводим в одном цикле статьи в разные подрубрики категорий:
                // статьи по заработку и статьи в стиле "как сделать":
                $str_post_for_kak_zarabotat ='';
                $str_post_for_kak_sdelat ='';
                $str_post_polezno_znat ='';
              
                // не понял почему. но в рубрике у которой нет статей, почемуто
                // возвращется пусто, вместо ID категории, возможно не ту функцию использовал
                // и get_the_category(); работает для постов
                if ($info!='')
                {
                    foreach( $lastposts as $post )
                    {
                        setup_postdata($post);
                        $customField = get_post_custom_values("artcile_subcategory");
                        
                        if (!is_null($customField[0]) && $customField[0] =='kak-sdelat') {
                            $str_post_for_kak_sdelat = $str_post_for_kak_sdelat .    
                            '<li><a href="' .  get_permalink() . '">' . get_the_title() . '</a></li>';
                        }
                        if (!is_null($customField[0]) && $customField[0] =='polezno-znat') {
                            $str_post_polezno_znat = $str_post_polezno_znat .    
                            '<li><a href="' .  get_permalink() . '">' . get_the_title() . '</a></li>';                    
						}
                        if (!is_null($customField[0]) && $customField[0] =='kak-zarabotat') {
                            $str_post_for_kak_zarabotat = $str_post_for_kak_zarabotat .     
                            '<li><a href="' .  get_permalink() . '">' . get_the_title() . '</a></li>';
                        }
						if (!is_null($customField[0]) && $customField[0] =='skolko-mogno-zarabotat') {
                            $str_post_for_skolko_mogno_zarabotat = $str_post_for_skolko_mogno_zarabotat .     
                            '<li><a href="' .  get_permalink() . '">' . get_the_title() . '</a></li>';
                        }
						if (!is_null($customField[0]) && $customField[0] =='kak-vibrat-temu') {
                            $str_post_for_kak_vibrat_temu = $str_post_for_kak_vibrat_temu .     
                            '<li><a href="' .  get_permalink() . '">' . get_the_title() . '</a></li>';
                        }
						if (!is_null($customField[0]) && $customField[0] =='oformlenie-dizain') {
                            $str_post_for_oformlenie_dizain = $str_post_for_oformlenie_dizain .     
                            '<li><a href="' .  get_permalink() . '">' . get_the_title() . '</a></li>';
                        }
						if (!is_null($customField[0]) && $customField[0] =='raskrutka') {
                            $str_post_for_raskrutka  = $str_post_for_raskrutka.     
                            '<li><a href="' .  get_permalink() . '">' . get_the_title() . '</a></li>';
                        }
						if (!is_null($customField[0]) && $customField[0] =='nakrutka') {
                            $str_post_for_nakrutka   = $str_post_for_nakrutka.     
                            '<li><a href="' .  get_permalink() . '">' . get_the_title() . '</a></li>';
                        }
						if (!is_null($customField[0]) && $customField[0] =='hlam') {
                            $str_post_for_hlam   = $str_post_for_hlam.     
                            '<li><a href="' .  get_permalink() . '">' . get_the_title() . '</a></li>';
                        }
                    }
                    
                    wp_reset_postdata();
                }  
                ?>

<?
  // реклама перед списком статей
  echo do_shortcode("[adsense]"); 
?>

<? if($str_post_for_kak_zarabotat!='') { ?>    
<h2>Как заработать:</h2>
    
        <div class="item_content">
             <ol style="margin-left: 20px; padding-left: 25px;">
                    <? print $str_post_for_kak_zarabotat; ?>                     
             </ol>
        </div>
<? } ?>     
<? if($str_post_for_skolko_mogno_zarabotat!='') { ?>
<h2>Сколько можно заработать:</h2>
        
        <div class="item_content">
             <ol style="margin-left: 20px; padding-left: 25px;">
                    <? print $str_post_for_skolko_mogno_zarabotat; ?>                     
             </ol>
        </div>
<? } ?>
<? if($str_post_for_kak_vibrat_temu!='') { ?>
<h2>Как выбрать идею, тему и название:</h2>
        
        <div class="item_content">
             <ol style="margin-left: 20px; padding-left: 25px;">
                    <? print $str_post_for_kak_vibrat_temu; ?>                     
             </ol>
        </div>
<? } ?> 
<? if($str_post_for_raskrutka!='') { ?>
<h2>Легальные способы раскрутки:</h2>
        
        <div class="item_content">
             <ol style="margin-left: 20px; padding-left: 25px;">
                    <? print $str_post_for_raskrutka; ?>                     
             </ol>
        </div>
<? } ?> 
<? if($str_post_for_nakrutka!='') { ?>
<h2>Серые схемы накрутки лайков, комментариев, подписчиков:</h2>
        
        <div class="item_content">
             <ol style="margin-left: 20px; padding-left: 25px;">
                    <? print $str_post_for_nakrutka; ?>                     
             </ol>
        </div>
<? } ?>
<? if($str_post_polezno_znat!='') { ?>
<h2>Полезно знать:</h2>
        
        <div class="item_content">
             <ol style="margin-left: 20px; padding-left: 25px;">
                    <? print $str_post_polezno_znat; ?>                     
             </ol>
        </div>
<? } ?>       

<? if($str_post_for_kak_sdelat!='') { ?>
<h2>Как сделать:</h2>
        
        <div class="item_content">
             <ol style="margin-left: 20px; padding-left: 25px;">
                    <? print $str_post_for_kak_sdelat; ?>                     
             </ol>
        </div>
<? } ?> 

<? if($str_post_for_oformlenie_dizain!='') { ?>
<h2>Как красиво оформить:</h2>
        
        <div class="item_content">
             <ol style="margin-left: 20px; padding-left: 25px;">
                    <? print $str_post_for_oformlenie_dizain; ?>                     
             </ol>
        </div>
<? } ?>
      
    <?
    /*            
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
	*/ ?>                
			</main>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
