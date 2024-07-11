<div class="service-item borax-img-box">
    <div class="service-image">
        <div class="<?php if ( 'yes' === $settings['image_shadow'] ) {echo 'ImgShadow'; }  ?>">
            <div class="<?php echo $settings['image_shape']; ?>">
                <img 
                    src="<?php echo esc_url($settings['box_image']['url'] ); ?>" 
                    alt="
                        <?php
                            printf(
                                esc_attr__( '%s', 'themes-assistant' ),
                                esc_attr( $settings['top_title'] )
                            );
                        ?>
                    "
                    width="<?php echo esc_attr($settings['box_image_dimension']['width']); ?>"
                    height="<?php echo esc_attr($settings['box_image_dimension']['height']); ?>"
                >
            </div>
        </div>
    </div>
    <div class="service-info text-center">
        <h2>
            <a href="<?php echo esc_url($settings['link']['url']); ?>">
                <?php
                    printf(
                        esc_attr__( '%s', 'themes-assistant' ),
                        esc_attr( $settings['top_title'] )
                    );
                ?>
            </a>
        </h2>
        <p>
            <?php
                printf(
                    esc_attr__( '%s', 'themes-assistant' ),
                    esc_attr( $settings['content'] )
                );
            ?>
        </p>
        <div class="icon">
            <a href="<?php echo esc_url($settings['link']['url']); ?>"><i class="ti-arrow-right"></i></a>
        </div>
    </div>
</div> 