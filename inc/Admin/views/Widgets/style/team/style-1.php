<?php
use Elementor\Icons_Manager; 
?>
<div class="team v2">
    <div class="single-memb">
        <div class="">
            <div class="">
                <img 
                    src="<?php echo esc_url($settings['image']['url']); ?>" 
                    alt="<?php echo esc_attr__($settings['name'], 'themes-assistant'); ?>"
                    width="<?php echo esc_attr($settings['team_image_dimension']['width']); ?>"
                    height="<?php echo esc_attr($settings['team_image_dimension']['height']); ?>"
                >
            </div>
        </div>
        <div class="memb-details">
            <h3><?php echo esc_html__($settings['name'], 'themes-assistant'); ?></h3>
            <span><?php echo esc_html__($settings['position'], 'themes-assistant'); ?></span>
            <div class="memb-social">
                <?php if (!empty($socials)): ?>
                <ul class="socials-list list-inline">
                    <?php foreach ($socials as $social): ?>
                        <a href="<?php echo esc_url($social['url']['url']);?>" aria-hidden="false" title="social Link">
                            <?php if( $social['icon_type'] == 'icon'):?>
                                <span class="icon">
                                    <?php Icons_Manager::render_icon( $social['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                                <?php elseif( $social['icon_type'] == 'iconclass'):?>
                                <span class="icon">
                                    <i class="<?php echo esc_html__($social['iconclass'], 'themes-assistant'); ?>"></i>
                            </span>
                                <?php elseif( $social['icon_type'] == 'image'):?>
                                <span class="icon">
                                    <img src="<?php echo esc_url($social['image']['url']); ?>" alt="<?php echo esc_attr__($social['name'],'themes-assistant'); ?>" class="img-icon" width="40" height="40">
                            </span>
                            <?php endif;?>
                        </a>
                
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
