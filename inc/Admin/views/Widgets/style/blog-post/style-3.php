<div class="col-md-4 blog-style-1">
        <div class="blog-post-item <?php echo $settings['animation']; ?>">
        <?php the_post_thumbnail('post-thumbnail', array('class' => 'post-feature-thumb')); ?>
        <div class="blog-post-header blog-post-meta">
                <div class="author-meta">
                    <div class="author-avatar">
                        <?php if($avatar = get_avatar(get_the_author_meta('ID')) !== FALSE): ?>
                            <img src="<?php echo $avatar; ?>" alt="">
                        <?php endif; ?>                  
                        <?php echo ucfirst(get_avatar( get_the_author_meta( 'ID' ), 32 )); ?>
                </div>
                <div>
                    <span>
                        <?php
                        printf(
                            esc_html__( 'Posted by %s', 'themes-assistant' ),
                            esc_html( the_author())
                        );
                    ?>
                    </span>
                    <span>
                        <?php
                            printf(
                                esc_html__( '%s', 'themes-assistant' ),
                                esc_html( the_time( 'd M, Y' ))
                            );
                        ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="blog-post-body">
            <div class="blog-post-meta">
                <?php 
                    $categories = get_the_category(); 
                    if ( ! empty( $categories ) ) {
                            echo esc_html( $categories[0]->name );   
                    } 
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
    </div>
</div>
