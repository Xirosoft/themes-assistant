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
                        <i class="<?php echo esc_attr($item['iconclass']); ?>"></i>
                    </span>
                    <?php elseif( $item['icon_type'] == 'image'):?>
                    <span class="icon">
                        <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['service_title'] ) ); ?>" class="img-icon" width="40" height="40">
                    </span>
                    <?php endif;?>
                    
                    <div class="flex-grow-1 flex-shrink-1 content">
                        <h2><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['service_title'] ) ); ?></h2>
                        <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['service_subtitle'] ) ); ?></p>
                    </div>
                    <div class="price">
                        <?php if ( $item['discount_rice'] ): ?>
                            <del><?php echo esc_html__($item['discount_rice'], 'themes-assistant'); ?></del>
                        <?php endif;?>

                        <?php if ( $item['price_labels'] == 'new' ): ?>
                            <span class="new"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['price_labels'] ) ); ?></span>
                        <?php elseif ( $item['price_labels'] == 'best' ):  ?>
                            <span class="best"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['price_labels'] ) ); ?></span>
                        <?php elseif ( $item['price_labels'] == 'popular' ):  ?>
                            <span class="upc"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['price_labels'] ) ); ?></span>
                        <?php endif;?>

                        <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['service_price'] ) ); ?></p>								
                    </div>
                </div>	
        <?php  if ( $item['link']['url'] ):  ?>
        </a>
            <?php endif; ?>	
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>