<div class="about-img-group">
    <img 
        src="<?php echo esc_url($settings['animation_img']['url']); ?>" 
        alt="
            <?php
                printf(
                    esc_html__( '%s', 'themes-assistant' ),
                    esc_html( $settings['title'] )
                );
            ?>
        "
        width="<?php echo esc_attr($settings['animation_img_dimension']['width']); ?>"
        height="<?php echo esc_attr($settings['animation_img_dimension']['height']); ?>"
        class="<?php echo esc_attr('about-img-bg'); ?>"
    >
    <div class="row">
        <div class="col-7">
        <img 
            src="<?php echo esc_url($settings['image']['url']); ?>" 
            alt="
                <?php
                    printf(
                        esc_html__( '%s', 'themes-assistant' ),
                        esc_html( $settings['title'] )
                    );
                ?>
            "
            width="<?php echo esc_attr($settings['about_image1_dimension']['width']); ?>"
            height="<?php echo esc_attr($settings['about_image1_dimension']['height']); ?>"
            class="<?php echo esc_attr('about-img-1'); ?>"
        >
        </div>
        <div class="col-5">
            <img 
                src="<?php echo esc_url($settings['image2']['url']); ?>" 
                alt="
                    <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( $settings['title'] )
                        );
                    ?>
                "
                width="<?php echo esc_attr($settings['about_image2_dimension']['width']); ?>"
                height="<?php echo esc_attr($settings['about_image2_dimension']['height']); ?>"
                class="<?php echo esc_attr('about-img-2'); ?>"
            >
            <h3>
                <?php
                    printf(
                        esc_html__( '%s', 'themes-assistant' ),
                        esc_html( $settings['img_title'] )
                    );
                ?>
            </h3>
        </div>
    </div>
</div>