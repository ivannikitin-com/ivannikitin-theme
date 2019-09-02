<article class="col-12 col-sm-4 team_item text-center">
    <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail( 
            null, 
            array( 
                'class' => 'rounded-circle img-thumbnail border-0' 
            ) 
            ); ?>
        <div class="team_name"><?php the_title(); ?></div>
        <!-- <div class="team_func">Директор компании</div> -->
    </a>
</article>