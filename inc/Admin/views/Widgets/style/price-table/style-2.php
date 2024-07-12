<!-- Pricing style 1 start -->
<section class="pricings v2">
			<div class="container">			
				<div class="row">
                <?php
                    foreach ($settings['pricing_plans'] as $pricing_plan) :
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="price-card <?php if ($pricing_plan['highlight'] == 'yes') { echo esc_attr('highlight');} ?>  <?php echo $settings['pricing_style']." ".$settings['animation'] ?>">
                            <div class="price-card-header" style="background-image: url(<?php echo esc_url($pricing_plan['pricing_image']['url']); ?>)">
                                <div class="pricing-info">
                                    <?php if($pricing_plan['pricing_title']): ?>
                                        <span class="plan-badge"><?php echo  esc_html__($pricing_plan['pricing_title'], 'themes-assistant')?></span>
                                        <p>
                                            <?php echo esc_html__($pricing_plan['price_month'], 'themes-assistant')?>
                                            <?php echo esc_html__($pricing_plan['price_year'], 'themes-assistant')?>
                                            <span>
                                                <?php echo esc_html__('/', 'themes-assistant') ?>
                                                <?php echo esc_html__($pricing_plan['pakage_type'], 'themes-assistant')?>
                                            </span>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php echo  esc_url($pricing_plan['button_url']['url']);?>"  class="btn btn-plan-select"><?php echo  esc_html__($pricing_plan['button_text'], 'themes-assistant')?></a>
                            </div>
                            <div class="price-card-body">
                                <?php echo __($pricing_plan['pricing_content'], 'themes-assistant')?>
                            </div>
                        </div>
                    </div>
                    <?php
                    endforeach;
                    ?>
					
					
				</div>
			</div>
		</section>
		<!-- Pricing style 1 end -->
