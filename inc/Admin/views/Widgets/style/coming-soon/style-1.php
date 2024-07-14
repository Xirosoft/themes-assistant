
<section class="coming-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="sec-heading">
                    <h2 class="sec-title">
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html($settings['title'])
                            );
                        ?>
                    </h2>
                    <p class="sec-subtitle">
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html($settings['content_txt'])
                            );
                        ?>    
                    </p>
                </div>
                <div 
                    class="text-center" 
                    id="clock" 
                    data-date="
                        <?php
                            printf(
                                esc_attr__( '%s', 'themes-assistant' ),
                                esc_attr($settings['date_time'])
                            );
                        ?>   
                "></div>
                <div class="bill-form v2 text-center">
                    <h3>
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html($settings['see_more_text'])
                            );
                        ?>
                        <?php echo esc_html__('Stay connected', 'themes-assistant'); ?>
                    </h3>
                    <?php echo do_shortcode($settings['mailchip']); ?>
                </div>
            </div>
        </div>
    </div>
</section>