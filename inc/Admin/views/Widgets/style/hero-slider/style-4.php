<section class="banner v2 v4">	
    <div class="align-items-center">
        <?php if ($settings['list']):  ?>
            <div class="hero-slide owl-carousel" 
            data-nav="<?php echo esc_attr($settings['nav']); ?>" 
            data-control="<?php echo esc_attr($settings['control']); ?>" 
            data-autoplay="<?php echo esc_attr($settings['autoplay']); ?>"
            data-loop="<?php echo esc_attr($settings['loop']); ?>"
            data-rtl="<?php echo esc_attr($settings['rtl']); ?>"
            data-slider-id="20"
            >
                <?php foreach (  $settings['list'] as $item ) { ?>
                    <div class="item">
                        <img 
                            src="<?php echo esc_url($item['image']['url']); ?>" 
                            alt="
                            <?php
                                printf(
                                    esc_html__( '%s', 'themes-assistant' ),
                                    esc_html( $item['title'] )
                                );
                            ?>
                            " 
                            width="1920" 
                            height="750"
                            >
                        <div class="ImageOverlay"></div>
                        <div class="container">
                            <div class="row">											
                                <div class="col-lg-4 offset-lg-4 text-right slide-box s2">
                                    <div class="content-box text-center">
                                        <span class="tagline">
                                        <?php
                                            printf(
                                                esc_html__( '%s', 'themes-assistant' ),
                                                esc_html( $item['top_title'] )
                                            );
                                        ?>
                                        </span>
                                        <h2>
                                            <?php
                                                printf(
                                                    esc_html__( '%s', 'themes-assistant' ),
                                                    esc_html( $item['title'] )
                                                );
                                            ?>
                                        </h2>
                                        <p>
                                            <?php
                                                printf(
                                                    esc_html__( '%s', 'themes-assistant' ),
                                                    esc_html( $item['content_txt'] )
                                                );
                                            ?>
                                        </p>
                                        <?php if($item['button_text']):  ?>
                                            <a href="<?php echo esc_url($item['link']['url']); ?>" class="btn ">
                                                <?php
                                                    printf(
                                                        esc_html__( '%s', 'themes-assistant' ),
                                                        esc_html( $item['button_text'] )
                                                    );
                                                ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php if($item['button_text2']):  ?>
                                            <a href="<?php echo esc_url($item['link2']['url']); ?>" class="btn ">
                                                <?php
                                                    printf(
                                                        esc_html__( '%s', 'themes-assistant' ),
                                                        esc_html( $item['button_text2'] )
                                                    );
                                                ?>
                                            </a>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
            <div class="container slider-v4-thumb-area">
                <div id="carousel-custom-dots" class="owl-thumbs slider-v4-thumb"  data-slider-id="20">
                    <?php foreach (  $settings['list'] as $item ): ?>    
                        <div class="owl-thumb-item">
                            <img 
                                src="<?php echo esc_url($item['image']['url']); ?>" 
                                class="slider-v3" 
                                alt="
                                    <?php
                                        printf(
                                            esc_html__( '%s', 'themes-assistant' ),
                                            esc_html( $item['title'] )
                                        );
                                    ?>
                                ">
                            </div>
                    <?php endforeach; ?>                         
            </div>
        </div>
        <?php endif; ?>
    </div>
</section> 