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
                    <div class="card <?php if ($pricing_plan['highlight'] == 'yes') { echo esc_attr('highlight');} ?>  <?php echo esc_attr($settings['pricing_style']); ?> <?php if($settings['animation']){ echo ' '. esc_attr($settings['animation']); } ?>">
                    <div class="ribbon"><span><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pricing_title'] ) ); ?></span></div>
                    <div class="card-body GetAllPrice" 
                            data-price-year="<?php echo  esc_attr($pricing_plan['price_year'])?>" 
                            data-price-month="<?php echo  esc_attr($pricing_plan['price_month'])?>"
                    >
                        <figure class="card-img">
                        <img src="<?php echo esc_url($pricing_plan['pricing_image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pricing_title'] ) ); ?>" width="400" height="200">
                    </figure>
                        <h1 class="card-title pricing-card-title"  >
                            <span class="price"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['price_month'] ) ); ?></span>

                            <small class="text-muted"><?php echo esc_html__('/', 'themes-assistant') ?> 
                                <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pakage_type'] ) ); ?>                                
                            </small>
                        </h1>
                        <p class="save save_month">
                           <span><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['disscount_caption_month'] ) ); ?></span>
                        </p>
                        <p class="save save_year d-none">
                            <b><?php echo __( '$', 'themes-assistant' ); ?></b><b class="saveValue"></b>
                            <span><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['disscount_caption_year'] ) ); ?></span>
                        </p>
                        <div class="table-content">
                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['pricing_content'] ) ); ?>
                         </div>
                        <a href="<?php echo  esc_url($pricing_plan['button_url']['url']);?>"  class="btn btn-round btn-slide-right">
                            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $pricing_plan['button_text'] ) ); ?>
                        </a>

                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
</div>