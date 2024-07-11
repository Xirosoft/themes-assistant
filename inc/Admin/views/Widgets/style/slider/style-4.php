<section class="banner v2 v4">	
    <div class="align-items-center">
        <?php if ($settings['list']):  ?>
            <div class="hero-slide owl-carousel" 
            data-nav="<?php echo esc_attr($settings['nav']); ?>" 
            data-control="<?php echo esc_attr($settings['control']); ?>" 
            data-autoplay="<?php echo esc_attr($settings['autoplay']); ?>"
            data-loop="<?php echo esc_attr($settings['loop']); ?>"
            data-rtl="<?php echo esc_attr($settings['rtl']); ?>"
            data-slider-id="20"
            >
                <?php foreach (  $settings['list'] as $item ) { ?>
                    <div class="item">
                        <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr__($item['title'],'themes-assistant') ?>" width="1920" height="750">
                        <div class="ImageOverlay"></div>
                        <div class="container">
                            <div class="row">											
                                <div class="col-lg-4 offset-lg-4 text-right slide-box s2">
                                    <div class="content-box text-center">
                                        <span class="tagline"><?php echo esc_html__($item['top_title'], 'themes-assistant') ?></span>
                                        <h2><?php echo esc_html__($item['title'], 'themes-assistant' )?></h2>
                                        <p><?php echo esc_html__($item['content_txt'], 'themes-assistant') ?></p>
                                        <?php if($item['button_text']):  ?>
                                            <a href="<?php echo esc_url($item['link']['url']); ?>" class="btn "><?php echo esc_html__($item['button_text'], 'themes-assistant'); ?></a>
                                        <?php endif; ?>
                                        <?php if($item['button_text2']):  ?>
                                            <a href="<?php echo esc_url($item['link2']['url']); ?>" class="btn "><?php echo esc_html__($item['button_text2'], 'themes-assistant'); ?></a>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
            <div class="container slider-v4-thumb-area">
                <div id="carousel-custom-dots" class="owl-thumbs slider-v4-thumb"  data-slider-id="20">
                    <?php foreach (  $settings['list'] as $item ): ?>    
                        <div class="owl-thumb-item"><img src="<?php echo esc_url($item['image']['url']); ?>" class="slider-v3" alt="<?php echo esc_attr__($item['title'],'themes-assistant') ?>"></div>
                    <?php endforeach; ?>                         
            </div>
        </div>
        <?php endif; ?>
    </div>
</section> 