<?php

function inteam_start_container_team() {
    echo '<div class="container-fluid">';
        echo '<div class="row">';
}

add_action( 'inteam_before_main_content', 'inteam_start_container_team', 1 );

function inteam_end_container_team() {
    echo '</div>';
        echo '</div>';
}

add_action( 'inteam_after_main_content', 'inteam_end_container_team', 1 );