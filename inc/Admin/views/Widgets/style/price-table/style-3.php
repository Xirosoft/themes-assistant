<section class="pricing-section v3">
    <div class="container">
        <div class="row">
            <?php foreach ($settings['pricing_plans'] as $pricing_plan) : ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="price-table-wrapper <?php if ($pricing_plan['highlight'] == 'yes') { echo esc_attr('highlight');} ?> '' <?php echo esc_attr($settings['pricing_style']).' '.esc_attr($settings['animation']); ?>">
                        <h3 class="pricing-table-header"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pricing_title'] ) ); ?></h3>
                        <div class="table-price">
                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['price_year'] ) ); ?>  
                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['price_month'] ) ); ?>
                            <sup><?php echo esc_html__('/', 'themes-assistant') ?>
                                <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pakage_type'] ) ); ?>
                            </sup>
                        </div>
                        <?php echo __($pricing_plan['pricing_content'], 'themes-assistant')?>
                        <a href="<?php echo  esc_url($pricing_plan['button_url']['url']);?>" class="btn"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['button_text'] ) ); ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>