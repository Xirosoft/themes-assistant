<div class="col-md-4">			
    <article id="post-<?php the_ID(); ?>" <?php post_class(array('post el-blog-post v2', $content_align, $settings['animation'])); ?>>
        <div class="post-img">
            <?php
                if ( has_post_thumbnail() ) :?>
                        <?php the_post_thumbnail('post-thumbnail', array('class' => 'borax-el-thumbnail'));
                        if( get_post_format() == 'gallery' ): ?>
                            <a href="<?php esc_url( the_permalink() );  ?>" class="play-btn">
                                <i class="ti-gallery"></i>
                            </a>
                        <?php
                        elseif( get_post_format() == 'video'): ?>
                            <a href="<?php esc_url( the_permalink() );  ?>" class="play-btn">
                                <i class="ti-control-play"></i>
                            </a>
                        <?php
                        elseif( get_post_format() == 'audio'): ?>
                            <a href="<?php esc_url( the_permalink() );  ?>" class="play-btn">
                                <i class="ti-music-alt"></i>
                            </a>
                        <?php
                    endif;
                endif;
            ?>
            <div class="entry-meta">
                <span>
                    <i class="ti-alarm-clock"></i> 
                    <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( the_time( 'd M, Y' ))
                        );
                    ?>
                        &nbsp;&nbsp;<i class="ti-bookmark"></i>
                    <?php 
                        $categories = get_the_category(); 
                        if ( ! empty( $categories ) ) {
                                echo esc_html( $categories[0]->name );   
                        } 
                    ?>
                </span>
            </div><!-- .entry-meta -->
        </div>

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
    </article>
</div>