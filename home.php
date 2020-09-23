<?php get_header(); ?>
<div class="sky-unit"></div>
<div id="main-content" class="blog-container">
    <?php
    $query_blogposts = new WP_Query( 'category_name=blog_post' );
    if($query_blogposts->have_posts()):
        while($query_blogposts->have_posts()):
            $query_blogposts->the_post();
            ?>
            <div class="blog-post">
                <a href="<?php the_permalink();?>" class="post-title"><?php the_title();?></a>
                <h3 class="post-date">&mdash; <?php echo get_the_date();?></h3>
                <p class="post-content">
                    <?php the_excerpt();?>
                </p>
            </div>
            
            <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?> 
</div>


<?php get_footer();?>