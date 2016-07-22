<?php
class mainMenuWalker extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth, $args) {
    // назначаем классы li-элементу и выводим его
    $class_names = join( ' ', $item->classes );
    $class_names = ' class="' .esc_attr( $class_names ). '"';
    $output.= '<li id="menu-item-' . $item->ID . '"' .$class_names. '>';

    // назначаем атрибуты a-элементу
    $attributes=  ' rel="' .esc_attr($item->url). '"';
    $attributes.=  ' title="' .esc_attr($item->title). '"';
    $item_output = $args->before;

    // проверяем, на какой странице мы находимся
    $current_url = (is_ssl()?'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $item_url = esc_attr( $item->url );
    $item_output.= "<span class='seolink' ". $attributes .">".$item->title."</span>";

    // заканчиваем вывод элемента
    $item_output.= $args->after;
    $output.= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}
?>

