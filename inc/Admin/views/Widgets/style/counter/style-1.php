<div class="single-fun <?php echo esc_attr($settings['counter_style']); ?>">
    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php  printf( esc_attr__( '%s', 'themes-assistant' ), esc_html( $settings['text'])); ?>" width="50" height="50">
    <div class="count-box">
        <span class="stat-count" data-count="<?php echo esc_attr($settings['number']) ?>">0</span> 
        <h3 class="text"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['text'] ) ); ?></h3>
    </div>
</div> 