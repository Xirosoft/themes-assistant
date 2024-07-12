<section class="pricing-section v3">
    <div class="container">
        <div class="row">
        <?php
            foreach ($settings['pricing_plans'] as $pricing_plan) :
            ?>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="price-table-wrapper <?php if ($pricing_plan['highlight'] == 'yes') { echo esc_attr('highlight');} ?> '' <?php echo $settings['pricing_style'].' '.$settings['animation'] ?>">
                    <h3 class="pricing-table-header"><?php echo  esc_html__($pricing_plan['pricing_title'], 'themes-assistant')?></h3>
                    <div class="table-price"><?php echo  esc_html__($pricing_plan['price_tag'], 'themes-assistant')?><?php echo  esc_html__($pricing_plan['price_month'], 'themes-assistant')?><sup><?php echo esc_html__('/', 'themes-assistant') ?><?php echo  esc_html__($pricing_plan['pakage_type'], 'themes-assistant')?></sup></div>
                    <?php echo __($pricing_plan['pricing_content'], 'themes-assistant')?>
                    <a href="<?php echo  esc_url($pricing_plan['button_url']['url']);?>" class="btn"><?php echo  esc_html__($pricing_plan['button_text'], 'themes-assistant')?></a>
                </div>
            </div>
        
            <?php
            endforeach;
            ?>
            
        </div>
    </div>
</section>