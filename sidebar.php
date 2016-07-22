<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package life-haker
 */
?>
<aside class="right-sidebar">
	
    <? /*
    <div class="category_header">Навигация по разделам:</div>
	<div class="category_place">
				<div class="category">
					<!--noindex-->
					<?
						$walker = new mainMenuWalker ();
						$args_menu_top = array(
						'menu'    => 'sidebar_menu',
						'container'   => '',
						'walker' => $walker
						);
						wp_nav_menu( $args_menu_top );
					?>
					<!--/noindex-->	
				</div>
	</div>
    */ ?>
  	<!-- Shedule-->
	<? include("shedule-sidebar.php");?>
    
    <?php 
		echo '
				<div class="category_header"><span class="fa fa-btc"></span> Каталог способов заработка:</div>
				<div class="category">
					<div class="category_content cat_main_green">';
        
                    wp_list_categories('hide_empty=1&title_li='); 
    
                echo "</div></div>";
                
                
		echo '
				<div class="category_header"><span class="fa fa-tag"></span> Кому подходят способы:</div>
				<div class="category">
					<div class="category_content">';
        
                    wp_tag_cloud("format=list&largest=10&smallest=10"); 
    
                echo "</div></div>";                
    ?>
	<?php
    /*
		$categories = get_categories($args);
		if($categories){
			echo "
				<div class='category_header'>Каталог способов заработка:</div>
				<div class='category'>
					<div class='category_content'>
						<ul>
			";
			$all_categories="";
			foreach($categories as $category) {
				$i++;
				$all_categories=$all_categories."
				<li><span class='seolink' rel='".get_category_link($category->term_id)."' title='".$category->cat_name."'>".$category->cat_name."</span></li>";
			}
			echo $all_categories;
			echo "
				</ul></div></div>";
		}
      */
	?>
</aside>