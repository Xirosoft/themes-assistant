<div class="faq">
    <div class="accordion v2" id="AtaAccordion">
        <?php
            if ( $settings['list'] ) {
                $i = 0;
                foreach (  $settings['list'] as $item ) {
                    $i++;
                    if($i === 1) { ?> 
                    <div class="card active">
                        <div class="card-header" id="heading-<?php echo $i ?>">
                            <button class="a-btn btn-link ata-collapsed" type="button" data-toggle="collapse" data-target="#ata-faq<?php echo esc_attr($i); ?>"
                                aria-expanded="true" aria-controls="collapse-<?php echo $i ?>">
                                <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['title'] ) ); ?>
                            </button> 
                        </div>
                        <div id="ata-faq<?php echo $i ?>" class="ata-collapse  ata-show" aria-labelledby="heading-<?php echo $i ?>"
                            data-parent="#AtaAccordion">
                            <div class="card-body">
                                <?php echo wp_kses_post($item['text']); ?>
                            </div>
                        </div>
                    </div> 
                    <?php }else{?>
                    <div class="card">
                        <div class="card-header" id="heading-<?php echo $i ?>">
                            <button class="a-btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#ata-faq<?php echo esc_attr($i); ?>" 
                                aria-expanded="false" aria-controls="collapse-<?php echo $i ?>">
                                <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['title'] ) ); ?>
                            </button>
                        </div>
                        <div id="ata-faq<?php echo $i ?>" class="ata-collapse " aria-labelledby="heading-<?php echo $i ?>" data-parent="#AtaAccordion">
                            <div class="card-body">
                                <?php echo wp_kses_post($item['text']); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
            }
            ?>
    </div>
</div>