<?php use Elementor\Icons_Manager; ?>

<div class="iconBox <?php echo $settings['style']; echo  ' '.$settings['animation'] ?>">
    <div class="bgShape"></div>
    <?php if( $settings['icon_type'] == 'icon'):?>
        <span class="icon-bg">
            <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
    </span>
        <?php elseif( $settings['icon_type'] == 'iconclass'):?>
        <span class="icon-bg">
            <i class="<?php echo esc_html__($settings['iconclass'], 'borax'); ?>"></i>
    </span>
        <?php elseif( $settings['icon_type'] == 'image'):?>
        <span class="icon-bg">
            <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="" class="img-icon" width="350" height="350">
    </span>
        <?php endif;?>
        <div class="icon-heading">
            <?php if( $settings['icon_type'] == 'icon'):?>
            <span class="icon">
                <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </span>
            <?php elseif( $settings['icon_type'] == 'iconclass'):?>
            <span class="icon">
                <i class="<?php echo esc_html__($settings['iconclass'], 'borax'); ?>"></i>
        </span>
            <?php elseif( $settings['icon_type'] == 'image'):?>
            <span class="icon">
                <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr__($settings['title'],'borax'); ?>" class="img-icon" width="40" height="40">
        </span>
            <?php endif;?>
            <a href="<?php echo esc_url($settings['link']['url']); ?>" class="flex-grow-1 flex-shrink-1">
                <h3>
                    <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( $settings['title'] )
                        );
                    ?>
                </h3>
            </a>
    </div>
        <p>
            <?php
                printf(
                    esc_html__( '%s', 'themes-assistant' ),
                    esc_html( $settings['content'] )
                );
            ?>
        </p>
        <?php if($settings['link']['url']): ?>
        <a href="<?php echo esc_url($settings['link']['url']); ?>" class="view_details">
            <?php
                printf(
                    esc_html__( '%s', 'themes-assistant' ),
                    esc_html( $settings['btn_txt'] )
                );
            ?>    
            <i class="ti-arrow-right"></i>
        </a>
        <?php endif; ?>
</div>