<?php
/**
 * Добавляем в классы BODY текущие роли пользователей
 * Это нужно для скрывания части контента для незарегисрированных пользователей и разных ролей пользователей
 * Сделано по образу и подобию плагина eyes-only-user-access-shortcode
 */
add_filter('body_class','in2019_body_classes');
function in2019_body_classes( $classes )
{
    // Префикс CSS классов
    $prefix = 'in2019-';
    
    // Текущий пользователь
	$current_user = wp_get_current_user();
	$sseo_username = str_replace ( ' ', '', strtolower ( $current_user->user_login ) );
    
    // Роли текущего пользователя
    global $wp_roles; 
    $all_roles = $wp_roles->roles; 
    $editable_roles = apply_filters( 'editable_roles', $all_roles ); 
    
    // Добавляем классы
    if ( is_user_logged_in() ) 
    {
        // Логин пользователя
        $classes[] = $prefix . $sseo_username;
        
        // Роли пользователя
        foreach($editable_roles as $role=>$theroles) 
        {
            if (current_user_can( $role ) ) 
            {
				$classes[] = $prefix.$role;
			}
		}
	}
    
    // Готово!
    return $classes;
}