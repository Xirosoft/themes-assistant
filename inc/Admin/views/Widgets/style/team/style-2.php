
<div class="single-memb team">
    <div class="<?php if ( 'yes' === $settings['image_shadow'] ) {echo 'ImgShadow'; }  ?>">
        <div class="<?php echo esc_attr($settings['image_shape']); ?>">
            <img 
                src="<?php echo esc_url($settings['image']['url']); ?>" 
                alt="<?php echo esc_attr($settings['name']); ?>"
                width="<?php echo esc_attr($settings['team_image_dimension']['width']); ?>"
                height="<?php echo esc_attr($settings['team_image_dimension']['height']); ?>"
            >
        </div>
    </div>

    <div class="memb-details">
        <h3> <?php echo esc_html($settings['name']); ?></h3>
        <?php if(!empty($settings['position'])) {  ?> 
            <p><strong><?php echo esc_html($settings['position']); ?></p> </strong><?php
        } ?>
        <div class="memb-social">
            <?php if(!empty($settings['facebook'])){ ?> 
                <a href="<?php echo esc_url($settings['facebook']['url']); ?>" aria-hidden="false" title="<?php echo esc_attr('Facebook'); ?>"><?php echo esc_html('Facebook'); ?>  </a> 
            <?php  } ?>
            <?php if(!empty($settings['twitter'])){ ?> 
                <a href="<?php echo esc_url($settings['twitter']['url']); ?>" aria-hidden="false" title="<?php echo esc_attr('Twitter'); ?>"> <?php echo esc_html('Twitter'); ?> </a> 
            <?php } ?>
            <?php if(!empty($settings['linkedin'])){ ?> 
                <a href="<?php echo esc_url($settings['linkedin']['url']); ?>" aria-hidden="false" title="Lin<?php echo esc_attr('Linkedin'); ?>"> <?php echo esc_html('Linkedin'); ?> </a> 
            <?php  } ?>
        </div>
    </div>
</div>