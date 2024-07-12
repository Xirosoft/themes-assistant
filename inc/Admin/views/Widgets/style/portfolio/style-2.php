<?php use Elementor\Icons_Manager; ?>
<div class="portfolioITems px-3 ">
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
		<?php if ($settings['list']):  ?>
		<div class="portGrid row">
			<?php foreach (  $settings['list'] as $item ) { 
					if($item['portfolio_image']['id']){
						$thumbnail_image = wp_get_attachment_image_src($item['portfolio_image']['id'], 'borax-thumbnail');
						$full_image 	 = wp_get_attachment_image_src($item['portfolio_image']['id'], 'full');
						$thumbnail_url	 = $thumbnail_image[0];
						$full_url 		 = $full_image[0];
					}else{
						$thumbnail_url 	= $item['portfolio_image']['url'];
						$full_url 		= $item['portfolio_image']['url'];
					}

					var_dump($thumbnail_image);
				?>
				<div class="protItem col-md-4 col-12 <?php echo esc_attr($item['portfolio_category']) ?>">
					<img 
						src="<?php if($thumbnail_url) echo esc_url($thumbnail_url); ?>" 
						alt="<?php echo esc_html__($item['portfolio_title'], 'themes-assistant') ?>" class="mCS_img_loaded"
						width="<?php echo esc_attr($item['portfolio_image_dimension']['width']); ?>"
						height="<?php echo esc_attr($item['portfolio_image_dimension']['height']); ?>"
					>
					<div class="demoBox">
					<?php
						$target = $item['preview_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $item['preview_link']['nofollow'] ? ' rel="nofollow"' : '';?>
						<a data-fancybox="gallery" class="port_popup" area-label="<?php echo esc_html__($item['portfolio_title'], 'themes-assistant') ?>" href="<?php if($full_url) echo esc_url($full_url); ?>" <?php echo  $target . $nofollow; ?> aria-hidden="false"> 
							<?php if( $settings['icon_type'] == 'icon'):?>
							<span class="icon">
								<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
							<?php elseif( $settings['icon_type'] == 'iconclass'):?>
								<span class="icon">
									<i class="<?php echo esc_html__($settings['iconclass'], 'themes-assistant'); ?>"></i>
								</span>
							<?php elseif( $settings['icon_type'] == 'image'):?> 
							<span class="icon">
								<img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_html__($item['portfolio_title'], 'themes-assistant') ?>" class="img-icon" style="pointer-event: none"  width="68" height="68">
							</span>
							<?php endif;?>    
						</a>
						<h3 class="pTitle"><?php echo esc_html__($item['portfolio_title'], 'themes-assistant') ?></h3>
						<p class="pCat"><?php echo esc_html__($item['portfolio_category'], 'themes-assistant') ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php endif; ?>
	</div>


