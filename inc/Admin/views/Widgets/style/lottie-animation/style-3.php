<?php
$jsonData = !empty($settings['source_json']['url']) ? json_encode($settings['source_json']['url']) : '';
$widget_container = '

<div class="ata-lottie__container '.$style.'" data-settings="'.$jsonData.'" '.$widget_instance->get_render_attribute_string( 'wrapper' ).'>

    <div class="ata-lottie__animation"></div>

    '.$widget_title.'

    '.$widget_caption.'

    <a class="btn ata-lottie__container__link" %1$s>'.$btnText.'</a>

</div>';



echo $widget_container;