<div class="coming-sec v2 <?php echo $settings['select_align']; ?>">
    <div class="heading-area">
        <h2 class="title">
            <?php
                printf(
                    esc_html__( '%s', 'themes-assistant' ),
                    esc_html($settings['title'])
                );
            ?>
        </h2>
        <p class="subtitle">
            <?php
                printf(
                    esc_html__( '%s', 'themes-assistant' ),
                    esc_html($settings['content_txt'])
                );
            ?>
        </p>
    </div>

   <div class="counter-area">
        <div 
            class="counter-items d-flex <?php echo $settings['select_align']; ?>"  
            id="clock" 
            data-date="
                <?php
                    printf(
                        esc_attr__( '%s', 'themes-assistant' ),
                        esc_attr($settings['date_time'])
                    );
                ?> 
            ">
        </div>
   </div>

</div>