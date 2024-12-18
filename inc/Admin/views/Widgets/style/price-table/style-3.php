<section class="pricings v3">
    <div class="container">
        <div class="row">
            <?php foreach ($settings['pricing_plans'] as $pricing_plan) : ?>
                <div class="col-lg-4 col-md-4 col-sm-6 card-deck">
                    <div class="card <?php if ($pricing_plan['highlight'] == 'yes') { echo esc_attr('highlight');} ?> <?php echo esc_attr($settings['pricing_style']).' '.esc_attr($settings['animation']); ?>">
                        <h3 class=""><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pricing_title'] ) ); ?></h3>
                        <div class="table-price card-title">
                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['price_year'] ) ); ?>  
                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['price_month'] ) ); ?>
                            <sup><?php echo esc_html__('/', 'themes-assistant') ?>
                                <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pakage_type'] ) ); ?>
                            </sup>
                        </div>
                        <div class="table-content">
                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( wp_kses_post($pricing_plan['pricing_content']) ) ); ?>
                         </div>
                        <a href="<?php echo  esc_url($pricing_plan['button_url']['url']);?>" class="btn"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['button_text'] ) ); ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>