<div class="call-action-section">
    <div class="call-inner">
        <div class="container">
            <div class="row <?php if($settings['select_style'] == 'align-left'){ echo 'align-items-center'; }  ?>">
                <?php if($settings['select_style'] == 'align-center'): ?>
                <div class="col-md-12">
                    <div class="call-content text-center">
                        <h2><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['title'] ) ); ?></h2>
                        <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['text'] ) ); ?></p>
                        <a href="<?php echo esc_url($settings['link']['url']); ?>" class="btn"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['btn'] ) ); ?></a>
                    </div>
                </div>
                <?php elseif($settings['select_style'] == 'align-left'): ?>
                    <div class="col-md-8">
                            <div class="call-content text-left">
                                <h2 class="text-left"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['title'] ) ); ?></h2>
                            <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['text'] ) ); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="call-content text-right">
                                <a href="<?php echo esc_url($settings['link']['url']); ?>"
                                class="btn"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['btn'] ) ); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>  