<section class="xop-section">

    <div class="xop-wrapper">

        <div class="xop-container">

            <?php foreach (  $settings['list'] as $item ) { 
                
                if($item['portfolio_image']['id']){
                    $thumbnail_image = wp_get_attachment_image_src($item['portfolio_image']['id'], 'thumbnail');
                    $full_image 	 = wp_get_attachment_image_src($item['portfolio_image']['id'], 'full');
                    $thumbnail_url	= $thumbnail_image[0];
                    $full_url 		= $full_image[0];
                }else{
                    $thumbnail_url 	= $item['portfolio_image']['url'];
                    $full_url 		= $item['portfolio_image']['url'];
                }?>

            <a data-fancybox="gallery" class="project port_popup" area-label="<?php echo esc_html__($item['portfolio_title'], 'themes-assistant') ?>" href="<?php echo esc_url($item['portfolio_image']['url']); ?>" aria-hidden="false">

                <figure>

                    <img 
                        src="<?php if($thumbnail_url) echo esc_url($thumbnail_url); ?>" 
                        alt="<?php echo esc_html__($item['portfolio_title'], 'themes-assistant') ?>" class="mCS_img_loaded"
                        width="<?php echo esc_attr($item['portfolio_image_dimension']['width']); ?>"
                        height="<?php echo esc_attr($item['portfolio_image_dimension']['height']); ?>"
                    >

                    <figcaption>

                        <div>

                            <h3 class="pTitle"><?php echo esc_html__($item['portfolio_title'], 'themes-assistant') ?></h3>

                            <p class="pCat cta"><?php echo esc_html__($item['portfolio_category'], 'themes-assistant') ?></p>

                        </div>

                    </figcaption>

                </figure>

            </a>

            <?php } ?>

        </div>

    </div>

</section>