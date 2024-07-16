<div class="faq">
    <div class="accordion version-1" id="accordionExample">
        <?php
            if ( $settings['list'] ) {
                $i = 0;
                foreach (  $settings['list'] as $item ) {
                    $i++;
                    if($i === 1) { ?> 
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <button class="a-btn btn-link" type="button" data-toggle="collapse" data-target="#ata-faq<?php echo esc_attr($i); ?>"
                                aria-expanded="true" aria-controls="collapseOne">
                                <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['title'] ) ); ?>
                            </button> 
                        </div>
                        <div id="ata-faq<?php echo $i ?>" class="ata-collapse  ata-show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <?php echo wp_kses_post($item['text']); ?>
                            </div>
                        </div>
                    </div> <?php
                                }else{?>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <button class="a-btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#ata<?php echo esc_attr($i); ?>" aria-expanded="false" aria-controls="collapseOne">
                                <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['title'] ) ); ?>
                            </button>
                        </div>
                        <div id="ata<?php echo $i ?>" class="ata-collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
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