<div class="container-fluid image-box  borax-img-box">
    <div class="row align-items-center">
        <div class="col-md-6 order-1 order-md-0">
            <div class="content-box-fluid <?php  echo esc_attr($settings['content_align']) ?>">
                <?php if(!empty($settings['top_title'])){ ?> 
                    <span class="tagline">
                        <?php
                            printf(
                                esc_attr__( '%s', 'themes-assistant' ),
                                esc_attr( $settings['top_title'] )
                            );
                        ?>
                    </span> 
                <?php }

                if(!empty($settings['title'])){ ?> 
                    <h2>
                        <?php
                            printf(
                                esc_attr__( '%s', 'themes-assistant' ),
                                esc_attr( $settings['title'] )
                            );
                        ?>
                        <?php echo esc_html__($settings['title'],'themes-assistant'); ?>
                    </h2> 
                
                <?php }

                if(!empty($settings['content'])){

                    printf(
                        esc_attr__( '%s', 'themes-assistant' ),
                        esc_attr( $settings['content'] )
                    );
                }

                if(!empty($settings['button_text'])){ ?> 
                    <a href="<?php echo esc_url($settings['link']['url']); ?>" class="btn">
                        <?php
                            printf(
                                esc_attr__( '%s', 'themes-assistant' ),
                                esc_attr( $settings['button_txt'] )
                            );
                        ?>
                    </a> 
                <?php } ?>
            </div>
        </div>
        <div class="col-md-6 pr-md-0 service-image-height right-arrow order-0 order-md-1 <?php echo $settings['animation']; ?>">
            <div class="<?php echo $settings['image_shape']; ?>">
                <img 
                    src="<?php echo esc_url($settings['box_image']['url'] ); ?>" 
                    alt="
                        <?php
                            printf(
                                esc_attr__( '%s', 'themes-assistant' ),
                                esc_attr( $settings['title'] )
                            );
                        ?>
                    "
                    width="<?php echo esc_attr($settings['box_image_dimension']['width']); ?>"
                    height="<?php echo esc_attr($settings['box_image_dimension']['height']); ?>"
                >
            </div>
        </div>
    </div>
</div>