<div class="col-md-4 blog-style-2">
    <div class="blog-post-item <?php echo $settings['animation']; ?>">
        <div class="blog-feature-thumb">
            <?php the_post_thumbnail('post-thumbnail', array('class' => 'post-feature-thumb')); ?>
        </div>

        <div class="blog-post-body">
            <div class="blog-post-meta">
                <i class="ti-user"></i> <?php the_author(); ?> &nbsp;
                <i class="ti-alarm-clock"></i> 
                <?php
                    printf(
                        esc_html__( '%s', 'themes-assistant' ),
                        esc_html( the_time( 'd M, Y' ))
                    );
                ?>
            </div>
            <h3>
                <a 
                    href="<?php echo esc_url( get_permalink() );  ?>"
                    area-label="
                    <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( the_title())
                        );
                    ?>
                    "
                    >
                    <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( the_title())
                        );
                    ?>
                </a>
            </h3>

            <p>
                <?php
                    printf(
                        esc_html__( '%s', 'themes-assistant' ),
                        esc_html( ata_excerpt(19) )
                    );
                ?>
            </p>
        </div>
    </div>
</div>





            