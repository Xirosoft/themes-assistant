<div class="col-md-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class(array('post ata-blog-post v5', $content_align, $settings['animation'] )); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-img">
                <div class="img-wrap">
                    <?php the_post_thumbnail('post-thumbnail', array('class' => 'ata-el-thumbnail')); ?>
                </div>
                <div class="date-box">
                    <p class="month">
                        <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( the_time( 'M' ))
                        );
                    ?>
                    </p>
                    <p class="day">
                        <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( the_time( 'd' ))
                        );
                    ?>
                    </p>
                </div>
            </div>
            <?php endif; ?>

            <div class="post-content-area p-3">
                <div class="entry-meta">
                    <span>
                        <i class="ti-user"></i> <?php ucfirst(the_author()); ?> &nbsp;&nbsp;<i class="ti-bookmark"></i>
                        <?php 
                            $categories = get_the_category(); 
                            if ( ! empty( $categories ) ) {
                                echo esc_html( $categories[0]->name );   
                            } 
                        ?>
                    </span>
                </div><!-- .entry-meta -->
                <hr>
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
                    <?php echo esc_html__( ata_excerpt(19), 'themes-assistant'); ?>
                </p>
                <a 
                    href="<?php echo esc_url( get_permalink() );  ?>" 
                    title="
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html( the_title())
                            );
                        ?>
                    " 
                    class="btn">
                    <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html($settings['see_more_text'])
                        );
                    ?>
                    <i class="ti-arrow-right"></i>
                </a>
            </div>
    </article>
</div>