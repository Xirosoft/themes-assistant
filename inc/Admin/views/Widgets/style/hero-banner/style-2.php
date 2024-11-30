<section class="banner a py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-1 order-md-0">
                <div class="content-box">
                    <span class="tagline">
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html( $settings['top_title'] )
                            );
                        ?>
                    </span>
                    <h2>
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html( $settings['title'] )
                            );
                        ?>
                    </h2>
                    <p>
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html(wp_kses_post($settings['content']))
                            );
                        ?>
                    </p>
                    <a 
                        href="<?php echo esc_url($settings['link']['url']); ?>" 
                        class="btn" 
                        aria-label="
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html( $settings['button_text'] )
                            );
                        ?>
                        ">
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html( $settings['button_text'] )
                            );
                        ?>
                    </a>
                    <?php if($settings['video_btn_text'] != ''): ?>
                        <a 
                            class="video-btn" 
                            data-fancybox="true" 
                            href="<?php echo esc_url($settings['video_btn_link']['url']); ?>" 
                            aria-label="
                                <?php
                                    printf(
                                        esc_html__( '%s', 'themes-assistant' ),
                                        esc_html( $settings['video_btn_text'] )
                                    );
                                ?>
                            " 
                            aria-hidden="false">
                            <i class="dashicons dashicons-controls-play"></i>
                            <?php
                                printf(
                                    esc_html__( '%s', 'themes-assistant' ),
                                    esc_html( $settings['video_btn_text'] )
                                );
                            ?>
                        </a>
                        <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6 order-0 order-md-1">
                <?php if ( $settings['list'] ): ?>
                    <div class="service-img animation animationActive">
                        <?php if($settings['link']['url']): ?>
                        <a 
                            href="<?php echo $settings['link']['url']; ?>" 
                            aria-label="
                            <?php
                                printf(
                                    esc_html__( '%s', 'themes-assistant' ),
                                    esc_html( $settings['title'] )
                                );
                            ?>
                            ">
                            <?php endif; ?>
                            <?php foreach (  $settings['list'] as $item ): ?>
                                <img 
                                fetchPriority="high" 
                                src="<?php echo esc_url($item['t_image']['url']); ?>" 
                                class="ImgAnimation <?php echo $item['Choose_Animation']; ?>" 
                                width="600" 
                                height="600" 
                                alt="<?php
                                        printf(
                                            esc_html__( '%s', 'themes-assistant' ),
                                            esc_html( $item['title'] )
                                        );
                                    ?>
                                "/>
                            <?php endforeach; ?>
                            <?php if($settings['link']['url']): ?>
                        </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>