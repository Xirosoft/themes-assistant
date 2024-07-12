<?php

$widget_container = '

<div class="e-lottie__container '.$style.'" data-settings="'.$jsonData.'" '.$this->get_render_attribute_string( 'wrapper' ).'>

    <div class="e-lottie__animation"></div>

    '.$widget_title.'

    '.$widget_caption.'

    <a class="btn e-lottie__container__link" %1$s>'.$btnText.'</a>

</div>';



echo $widget_container;