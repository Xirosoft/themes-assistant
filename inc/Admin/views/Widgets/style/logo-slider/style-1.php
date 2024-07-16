<?php 

if ( $settings['list'] ) {
    echo '<div class="partners-logo owl-carousel"  data-nav="'. esc_attr($settings['nav']) .'" data-control="'. esc_attr($settings['control']) .'" data-autoplay="'. esc_attr($settings['autoplay']) .'" data-loop="'. esc_attr($settings['loop']) .'" data-rtl="'. esc_attr($settings['rtl']) .'">';
    foreach (  $settings['list'] as $item ) {
        echo '<img src="'.esc_url($item['image']['url']).'" alt="'. esc_attr__('Client Logo', 'themes-assistant' ) .'"  width="250" height="60">';
    }
      echo '</div>';

}