<?php
$jsonData = !empty($settings['source_json']['url']) ? json_encode($settings['source_json']['url']) : '';

$widget_container = '
    <div class="ata-lottie__container" data-settings="' . $jsonData . '" ' . $widget_instance->get_render_attribute_string('wrapper') . '>
        <div class="ata-lottie__animation"></div>
    </div>';

if (!empty($settings['custom_link']['url']) && 'custom' === $settings['link_to']) {
    $widget_instance->add_link_attributes('url', $settings['custom_link']);
    $widget_container = sprintf('<a class="ata-lottie__container__link" %1$s>%2$s</a>', $widget_instance->get_render_attribute_string('url'), $widget_container);
}

echo $widget_container;
?>
