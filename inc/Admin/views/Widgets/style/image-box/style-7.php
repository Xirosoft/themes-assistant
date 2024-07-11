<?php if ( $settings['list'] ): ?>
    <div class="service-img animation animationActive borax-img-box">
        <?php if($settings['link']['url']): ?>
            <a href="<?php echo $settings['link']['url']; ?>">
            <?php endif; ?>
                <?php foreach (  $settings['list'] as $item ): ?>
                <img 
                    src="<?php echo esc_url($item['t_image']['url']); ?>"
                    class="ImgAnimation <?php echo $item['Choose_Animation']; ?>" 
                    width="600" height="600" 
                />
            <?php endforeach; ?>
                <?php if($settings['link']['url']): ?>
            </a>
        <?php endif; ?>
    </div>
<?php endif;