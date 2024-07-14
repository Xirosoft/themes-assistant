<section class="banner v3">
    <div class="video-item">
        <video autoplay poster="<?php echo esc_attr($settings['poster']['url']); ?>" id="bgvid" loop>
            <source src="<?php echo esc_url($settings['video']['url']); ?>" type="video/mp4">
        </video>
        <div id="polina">
            <button type="button" id="video-btn"></button>
        </div>
    </div>
    <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-1 order-md-0">
                    <div class="content-box">
                        <span class="tagline"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['top_title'] ) ); ?></span>
                        <h2><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['title'] ) ); ?></h2>
                        <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['content'] ) ); ?>
                        <a href="<?php echo esc_url($settings['link']['url']); ?>" class="btn btn-default">
                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['button_text'] ) ); ?>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 order-0 order-md-1">
                    <figure class="ban-img">
                        <?php echo '<img src="' . esc_url($settings['image']['url']) . '" width="600" height="350">'; ?>
                </figure>
            </div>
        </div>
    </div>
</section>