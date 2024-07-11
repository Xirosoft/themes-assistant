<?php use Elementor\Icons_Manager;  ?> 
<div class="team-item team-item-v2 v4 team">
    <div class="team-image">
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
    </div>
    <div class="team-info text-center">
        <h3><?php echo esc_html($settings['name']); ?></h3>
        <p><?php echo esc_html($settings['position']); ?></p>
        <div class="social-link">
            <?php if (!empty($socials)): ?>
                <?php foreach ($socials as $social):  ?>
                    <a href="<?php echo esc_url($social['url']['url']);?>" aria-hidden="false">
                        <?php if( $social['icon_type'] == 'icon'):?>
                            <span class="icon">
                                <?php Icons_Manager::render_icon( $social['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <?php elseif( $social['icon_type'] == 'iconclass'):?>
                            <span class="icon">
                                <i class="<?php echo esc_attr($social['iconclass']); ?>"></i>
                            </span>
                            <?php elseif( $social['icon_type'] == 'image'):?>
                            <span class="icon">
                                <img src="<?php echo esc_url($social['image']['url']); ?>" alt="<?php echo esc_attr($social['name']); ?>" class="img-icon" width="40" height="40">
                            </span>
                        <?php endif;?>
                    </a>
                <?php endforeach; ?>            
            <?php endif; ?>
        </div>
    </div>
</div>