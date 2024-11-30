<div class="col-md-4">
    <article id="post-<?php the_ID(); ?>"  class=" post ata-blog-post v3">
        <div class="blog-post-item <?php echo $settings['animation']; ?>">
            <?php the_post_thumbnail('post-thumbnail', array('class' => 'post-feature-thumb')); ?>
            <div class="blog-post-header blog-post-meta">
                    <div class="author-meta">
                        <div class="author-avatar">
                            
                        </div>
                    <div>
                        <span>
                            <?php
                                printf(
                                    esc_html__( 'Posted by %s', 'themes-assistant' ),
                                    esc_html( ucfirst(get_the_author()))
                                );
                            ?>
                        </span>
                        <span>-</span>
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
                    </p>
            </div>
        </div>
    </article>  
</div>
