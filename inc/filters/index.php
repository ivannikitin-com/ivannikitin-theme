<?php

function in2019_custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'in2019_custom_excerpt_length', 999 );