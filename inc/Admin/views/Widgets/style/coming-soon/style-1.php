
<section class="coming-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="sec-heading">
                    <h2 class="sec-title"><?php echo $settings['title'] ?></h2>
                    <p class="sec-subtitle"><?php echo $settings['content_txt'] ?></p>
                </div>
                <div class="text-center" id="clock" data-date="<?php echo $this->get_settings( 'date_time' ); ?>"></div>
                <div class="bill-form v2 text-center">
                    <h3><?php echo esc_html__('Stay connected', 'themes-assistant'); ?></h3>
                    <?php echo do_shortcode($settings['mailchip']); ?>
                </div>
            </div>
        </div>
    </div>
</section>