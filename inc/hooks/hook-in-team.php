<?php

function inteam_start_container_team() {
    echo '<div class="container">';
        echo '<div class="row">';
}

add_action( 'inteam_before_main_content', 'inteam_start_container_team', 1 );

function inteam_header_team() {
    echo '<div class="col-md-12">';
        echo '<header class="page-header text-center">';
            echo the_archive_title( '<h1 class="page-title">', '</h1>' );
            echo the_archive_description( '<div class="archive-description">', '</div>' );
        echo '</header>';
    echo '</div>';
}

add_action( 'inteam_before_main_content', 'inteam_header_team', 5 );

function inteam_end_container_team() {
    echo '</div>';
        echo '</div>';
}

add_action( 'inteam_after_main_content', 'inteam_end_container_team', 1 );