<div class="col-md-4 wp-block-in-2019-news_item mb-3 mb-sm-4 mb-md-4">
  <a href="<?php the_permalink(); ?>">
    <?php if ( get_the_post_thumbnail() ) : ?>
      <div class="wp-block-in-2019-news_thumb" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div>
    <?php else : ?>
      <div class="wp-block-in-2019-news_thumb" style="background-image: url(<?php echo bloginfo( 'template_directory' ) . '/src/img/not-found-image.png' ?>);"></div>
    <?php endif; ?>
  </a>
  <div class="card-body">
    <h5 class="wp-block-in-2019-news_title"><?php the_title(); ?></h5>
    <time datetime="<?php the_date(); ?>" class="wp-block-in-2019-news_date"><?php the_time('d.m.Y'); ?></time>
    <p class="wp-block-in-2019-news_description"><?php the_excerpt(); ?></p>
    <a href="<?php the_permalink(); ?>" class="wp-block-in-2019-news_link"><?php esc_html_e( 'Read More', 'in-2019' ) ?></a>
  </div>
</div>