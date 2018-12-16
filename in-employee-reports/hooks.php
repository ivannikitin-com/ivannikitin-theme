<?php
/** 
 * Плагин отчетов сотрудников
 */
// Возвращает список пользователей текущего отдела, разрешенных для просмотра указанному пользователю
add_filter( 'in-employee-department-users', 'iner_get_allowed_users', 10, 2 ); 
function iner_get_allowed_users( $userList, $userId ) 
{ 
    // Если это начальник отдела. Функция user_can не может читать вторичные роли, поэтому разрешения не используем
    if ( user_can( $userId, 'head_of_department' ) )
    {
        // Прочитаем отделы пользователя
        $userDepartments = array();
        $userInfo = get_userdata( $userId );
        foreach ( $userInfo->roles as $role )
        {
            if ( strpos( $role, 'department_' ) === false )
                continue;
            $userDepartments[] = $role;
        }
        
        if ( count( $userDepartments ) > 0 )
        {
            // Запрашиваем список пользователей
            $usersInDepartments = get_users( array( 'role__in' => $userDepartments ) );
            foreach ( $usersInDepartments as $user )
            {
                // Если пользователя нет в результирующем массиве - добавим
                if ( ! in_array( $user->ID, $userList ) )
                    $userList[] = $user->ID;
            }
        }
    }
    return $userList;
}