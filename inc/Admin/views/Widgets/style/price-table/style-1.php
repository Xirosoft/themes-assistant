<div class="pricings v1">
        <?php if ($settings['month_year_control'] == 'yes') { ?>
        <div class="button-area monthYear">
            <div class="btn-box">
                <button class="monthbtn active" type="button" ><?php echo __( 'Monthly', 'themes-assistant' ) ?></button>
                <button class="yearbtn" type="button" ><?php echo __( 'Yearly', 'themes-assistant' ) ?></button>
        </div>
    </div>
        <?php } ?>
    <div class="card-deck mb-3 text-center">
            <?php
        foreach ($settings['pricing_plans'] as $pricing_plan) : ?>
                    <div class="card <?php if ($pricing_plan['highlight'] == 'yes') { echo esc_attr('highlight');} ?>  <?php echo $settings['pricing_style']; ?> <?php if($settings['animation']){ echo ' '.$settings['animation']; } ?>">
                    <div class="ribbon"><span><?php echo  esc_html__($pricing_plan['pricing_title'], 'themes-assistant')?></span></div>
                    <div class="card-body GetAllPrice" 
                            data-price-year="<?php echo  esc_html__($pricing_plan['price_year'], 'themes-assistant')?>" 
                            data-price-month="<?php echo  esc_html__($pricing_plan['price_month'], 'themes-assistant')?>"
                    >
                        <figure class="card-img">
                        <img src="<?php echo esc_url($pricing_plan['pricing_image']['url']); ?>" alt="<?php echo  esc_html__($pricing_plan['pricing_title'], 'themes-assistant')?>" width="400" height="200">
                    </figure>
                        <h1 class="card-title pricing-card-title"  >
                            <span class="price"><?php echo  esc_html__($pricing_plan['price_month'], 'themes-assistant')?></span>

                            <small class="text-muted"><?php echo esc_html__('/', 'themes-assistant') ?> 
                                <?php echo  esc_html__($pricing_plan['pakage_type'], 'themes-assistant')?>
                            </small>
                        </h1>
                        <p class="save save_month">
                           <span><?php echo esc_html__($pricing_plan['disscount_caption_month'], 'themes-assistant')?></span>
                        </p>
                        <p class="save save_year d-none">
                            <b><?php echo __( '$', 'themes-assistant' ); ?></b><b class="saveValue"></b>
                            <span><?php echo esc_html__($pricing_plan['disscount_caption_year'], 'themes-assistant')?></span>
                        </p>
                        <div class="table-content">
                            <?php echo __($pricing_plan['pricing_content'], 'themes-assistant')?>
                    </div>
                        <a href="<?php echo  esc_url($pricing_plan['button_url']['url']);?>"  class="btn btn-round btn-slide-right"><?php echo  esc_html__($pricing_plan['button_text'], 'themes-assistant')?></a>

                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
</div>