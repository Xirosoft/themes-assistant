<!-- Pricing style 1 start -->
<section class="pricings v2">
    <div class="container">			
        <div class="row">
            <?php foreach ($settings['pricing_plans'] as $pricing_plan) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="price-card <?php if ($pricing_plan['highlight'] == 'yes') { echo esc_attr('highlight');} ?>  <?php echo $settings['pricing_style']." ". esc_attr($settings['animation']); ?>">
                        <div class="price-card-header" style="background-image: url(<?php echo esc_url($pricing_plan['pricing_image']['url']); ?>)">
                            <div class="pricing-info">
                                <?php if($pricing_plan['pricing_title']): ?>
                                    <span class="plan-badge"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pricing_title'] ) ); ?><?php echo  esc_html__($pricing_plan[''], 'themes-assistant')?></span>
                                    <p>
                                        <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['price_month'] ) ); ?>
                                        <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['price_year'] ) ); ?>                                        
                                        <span>
                                            <?php echo esc_html__('/', 'themes-assistant') ?>
                                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pakage_type'] ) ); ?>  
                                        </span>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo  esc_url($pricing_plan['button_url']['url']);?>"  class="btn btn-plan-select"><?php echo  esc_html__($pricing_plan['button_text'], 'themes-assistant')?></a>
                        </div>
                        <div class="price-card-body">
                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pricing_content'] ) ); ?>  
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Pricing style 1 end -->
