<?php
$widget_container = '
<div class="e-lottie__container '.$style.'" data-settings="'.$jsonData.'"  '.$this->get_render_attribute_string( 'wrapper' ).'>
    <div class="e-lottie__animation"></div>
    '.$widget_title.'
    '.$widget_caption.'
</div>';

if ( ! empty( $settings['custom_link']['url'] ) && 'custom' === $settings['link_to'] ) {
    $this->add_link_attributes( 'url', $settings['custom_link'] );
    $widget_container = sprintf( '<a class="e-lottie__container__link" %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $widget_container );
}
echo $widget_container;