<?php use Elementor\Icons_Manager; ?>

<div class="serviceFilter px-3 ">
    <?php if( 'yes' === $settings['show_filter'] ){ ?>
    <div class="ui-group filters">
        <div class="button-group js-radio-button-group filter-menu" data-filter-group="color">
            <?php $cats = explode(",",$settings['category_name']);  
						echo '<button class="button bttn active" type="button" data-filter="">All</button>';
						for ($i=0; $i < count($cats); $i++) { 
						echo '<button class="button bttn" type="button" data-filter=".'.trim($cats[$i]).'">'.ucwords($cats[$i]).'</button>';
						}
					?>
        </div>
    </div>
    <?php } ?>

<div class="sp-wrapper service-filter v2">
    <?php if ( $settings['service_pricing_list'] ): 
        foreach (  $settings['service_pricing_list'] as $item ): ?>
            <div class="pricing-list-item <?php echo esc_attr($item['category_name_container']) ?>">
                <?php  if ( $item['link']['url'] ):  ?>
                    <a href="<?php echo esc_url($item['link']['url']); ?>">
                <?php endif; ?>
                <div class="d-flex">
                    <?php if( $item['icon_type'] == 'icon'):?>
                    <span class="icon">
                        <?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                    <?php elseif( $item['icon_type'] == 'iconclass'):?>
                    <span class="icon">
                        <i class="<?php echo esc_html__($item['iconclass'], 'themes-assistant'); ?>"></i>
                    </span>
                    <?php elseif( $item['icon_type'] == 'image'):?>
                    <span class="icon">
                        <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_html__($item['service_title'], 'themes-assistant'); ?>" class="img-icon" width="40" height="40">
                    </span>
                    <?php endif;?>
                    
                    <div class="flex-grow-1 flex-shrink-1 content">
                        <h2><?php echo esc_html__($item['service_title'], 'themes-assistant'); ?></h2>
                        <p><?php echo esc_html__($item['service_subtitle'], 'themes-assistant'); ?></p>
                    </div>
                    <div class="price">
                        <?php if ( $item['discount_rice'] ): ?>
                            <del><?php echo esc_html__($item['discount_rice'], 'themes-assistant'); ?></del>
                        <?php endif;?>

                        <?php if ( $item['price_labels'] == 'new' ): ?>
                            <span class="new"><?php echo esc_html__($item['price_labels'], 'themes-assistant'); ?></span>
                        <?php elseif ( $item['price_labels'] == 'best' ):  ?>
                            <span class="best"><?php echo esc_html__($item['price_labels'], 'themes-assistant'); ?></span>
                        <?php elseif ( $item['price_labels'] == 'popular' ):  ?>
                            <span class="upc"><?php echo esc_html__($item['price_labels'], 'themes-assistant'); ?></span>
                        <?php endif;?>

                        <p><?php echo esc_html__($item['service_price'], 'themes-assistant'); ?></p>								
                    </div>
                </div>	
        <?php  if ( $item['link']['url'] ):  ?>
        </a>
            <?php endif; ?>	
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>