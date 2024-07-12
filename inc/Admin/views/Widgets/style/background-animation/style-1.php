<?php 

    $i = 1;

    foreach ( $settings['gallery'] as $image ) {

        echo '<img src="' . $image['url'] . '" class="ael el'.$i++ .'" width="50" height="60"  /> ';

    }

?>