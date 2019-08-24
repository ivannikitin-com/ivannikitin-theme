<?php
/**
 * Хуки Project Manager
 */
 
/* --------------------------- Темы E-mail --------------------------- */
add_filter( 'cpm_email_project_new_subject', 	'in_cpm_email_project_new_subject', 10, 2 );
function in_cpm_email_project_new_subject( $subject, $project )
{
	return $project . ': Новый проект';
}

add_filter( 'cpm_email_project_update_subject', 'in_cpm_email_project_update_subject', 10, 2 );
function in_cpm_email_project_update_subject( $subject, $project )
{
	return $project . ': Новый участник в проекте';
}

add_filter( 'cpm_email_complete_task_subject', 	'in_cpm_email_complete_task_subject', 10, 3 );
function in_cpm_email_complete_task_subject( $subject, $project, $task )
{
	return 'Re: '. $project . ': ' . $task;
}

add_filter( 'cpm_email_new_message_subject', 	'in_cpm_email_new_message_subject', 10, 3 );
function in_cpm_email_new_message_subject( $subject, $project, $message )
{
	return ( mb_strlen( $message ) > 50 ) ? $project .  ':' . mb_substr( $message, 0, 50 ) . '...' : $project . ':' . mb_substr( $message, 0, 50 );
}

add_filter( 'cpm_email_new_comment_subject', 	'in_cpm_email_comment_subject', 10, 3 );
add_filter( 'cpm_email_update_comment_subject', 'in_cpm_email_comment_subject', 10, 3 );
function in_cpm_email_comment_subject( $subject, $project, $task )
{
	return 'Re: ' . $project . ': ' . $task;
}

add_filter( 'cpm_email_new_task_subject', 	'in_cpm_email_new_task_subject', 10, 4 );
function in_cpm_email_new_task_subject( $subject, $project, $task, $list )
{
	return $project . ': ' . $task;
}


/* --------------------------- Адреса E-mail from и reply to --------------------------- */
add_filter( 'cpm_from_email', 'in_cpm_from_email', 10, 1 );
function in_cpm_from_email( $email_from )
{
	$current_user = wp_get_current_user();
	if ( !($current_user instanceof WP_User) )
		return $email_from;
	
	$user_cpm_email = urlencode( $current_user->user_login ) . '@ivannikitin.com';
	$user_name = $current_user->display_name;
	
	return "From: $user_name <$user_cpm_email>";
}

// add_filter( 'cpm_reply_to', 'in_cpm_reply_to', 10, 2 );
// function in_cpm_reply_to( $to, $comment_post_id )
// {
// 	$current_user = wp_get_current_user();
// 	if ( !($current_user instanceof WP_User) )
// 		return $to;
	
// 	return $current_user->user_email;
// }

/* --------------------------- Инфорация о клиенте и координаторе в проекте --------------------------- */
//add_action( 'cpm_project_after_description', 'in_cpm_project_after_description', 10, 1 );
function in_cpm_project_after_description( $project )
{
	//echo '<pre>', var_export($project, true), '</pre>';
	//echo '<pre>', var_export($project->users, true), '</pre>';
	// $project->ID - ID проекта
	// $project->users Список пользователей

	/*	Находим клиента
	array (
	  'id' => 238,
	  'email' => 'ax1980@bk.ru',
	  'name' => 'Алексей',
	  'role' => 'client',
	)*/
	$client = array();
	foreach ( $project->users as $id => $user )
	{
		if ( $user['role'] == 'client' )
		{
			// Проверяем его роль с CRM
			$userData = get_userdata( $user['id'] );
			if ( in_array( 'customer', $userData->roles ) )
			{
				$client = $user;
				break;
			}
		}
	}
	
	// Получаем данные о клиенте из CRM
	if ( ! empty( $client ) && function_exists( 'wc_crm_get_customer' ) )
	{
		echo '<div id="customerInfo">';
		$customerInfo = wc_crm_get_customer( $client['id'], 'user_id' );
		if ( ! empty( $customerInfo ) ) 
		{
			// Получаем объект клиента
			$customer = new WC_CRM_Customer( $customerInfo->c_id );

			// Координатор
			$coordinator = get_userdata( $customer->customer_agent );		
			echo '<div id="coordinatorInfo">Координатор (старые данные): ', $coordinator->display_name, '</div>' . PHP_EOL;
			
			// Выводим данные о клиенте ТОЛЬКО СОТРУДНИКАМ!
			if ( current_user_can( 'employee' ) || current_user_can( 'administrator' ) )
			{
				$company = get_user_meta( $client['id'], 'billing_company', true );
				if ( ! empty( $company  ) )
					$company  = ', ' . $company;
			
				// Для тех, кто может выставлять счета выводим ссылку на CRM
				if ( current_user_can( 'manage_shop_order_terms' ) )
				{
					echo '<div id="clientInfo">Клиент: <a href="/wp-admin/admin.php?page=wc_crm&c_id=' , $customerInfo->c_id, '" target="_blank" title="Открыть карточку клиента в новом окне">', 
						$client['name'], $company, '</a></div>' . PHP_EOL;
				}
				else
				{
					echo '<div id="clientInfo">Клиент: ', $client['name'], $company, '</div>' . PHP_EOL;
				}
			}
		}
		else
		{
			// Пользователь не найден в CRM
			echo '<div class="error">Данные о пользователе #' . $client['id'] . ' в CRM не найдены!</div>' . PHP_EOL;
		}
		echo '</div><!--/customerInfo -->';	
	}	
}

/** ==========================================================================================
 * Хук на вывод TITLE названия проекта в заголовке страницы и в TITLE
 * https://wpexplorer-themes.com/total/docs/page-title-filter/
 * https://yoast.com/wordpress/plugins/seo/api/
 */
add_filter( 'wpex_title', 'in_cpm_project_title' );		// TOTAL hook
add_filter( 'wpseo_title', 'in_cpm_project_title' );	// Yoast SEO hook
function in_cpm_project_title( $title ) 
{
	// Если это страница проекта...
	if ( isset( $_GET['project_id'] ) && ! is_admin() )
	{
		// Текущий пользователь
		$current_user = wp_get_current_user();
		
		// Пользователь авторизован?
		if ( $current_user->ID != 0 )
		{
			// Если CPM включена...
			if ( class_exists( 'CPM_Project' ) )
			{
				$cpm =  CPM_Project::getInstance();
				$project    = $cpm->get( $_GET['project_id'] );
				$title = 'Проект ' . $project->post_title;
				
				switch ( $_GET['tab'] )
				{
					case 'message':
						$title .= ': Обсуждения';
						break;
						
					case 'task':
						$title .= ': Задачи';
						break;
						
					case 'milestone':
						$title .= ': Вехи';
						break;
						
					case 'files':
						$title .= ': Файлы';
						break;
						
					case 'settings':
						$title .= ': Настройки';
						break;
						
					case 'kanboard':
						$title .= ': Канбан';
						break;				
				}
				
			}
		}
		else
		{
			$title = 'Вход в CPM (система управления проектами)';
		}
	}		

    return $title; 
}

/**
 * Добавим проект в хлебные крошки на фронтэнде
 */
add_filter( 'wpseo_breadcrumb_links', 'in_cpm_project_breadcrumb' );	// Yoast SEO hook
function in_cpm_project_breadcrumb( $crumbs ) 
{
	// Если это страница проекта...
	if ( isset( $_GET['project_id'] ) && ! is_admin() )
	{
		// Текущий пользователь
		$current_user = wp_get_current_user();
		
		// Пользователь авторизован?
		if ( $current_user->ID != 0 )
		{
			// Если CPM включена...
			if ( class_exists( 'CPM_Project' ) )
			{
				$cpm =  CPM_Project::getInstance();
				$project    = $cpm->get( $_GET['project_id'] );
				$crumbs[] = array(
					'text'       => $project->post_title,
					'url'		 => cpm_url_project_overview( $project->ID ),
					'allow_html' => false,
				);
				
				switch ( $_GET['tab'] )
				{
					case 'message':
						$crumbs[] = array(
							'text'       => 'Обсуждения',
							'allow_html' => false,
						);
						break;
						
					case 'task':
						$crumbs[] = array(
							'text'       => 'Задачи',
							'allow_html' => false,
						);
						break;
						
					case 'milestone':
						$crumbs[] = array(
							'text'       => 'Вехи',
							'allow_html' => false,
						);
						break;
						
					case 'files':
						$crumbs[] = array(
							'text'       => 'Файлы',
							'allow_html' => false,
						);
						break;
						
					case 'settings':
						$crumbs[] = array(
							'text'       => 'Настройки',
							'allow_html' => false,
						);
						break;
						
					case 'kanboard':
						$crumbs[] = array(
							'text'       => 'Канбан',
							'allow_html' => false,
						);
						break;				
				}				
				
			}
		}
	}		

    return $crumbs; 
}

/**
 *  Фильитр возвращает список активных проектов для отчетов
 */
add_filter( 'iner_projects', 'in_cpm_project_list', 10, 2 );
function in_cpm_project_list( $projectList, $userId )
{
	if ( class_exists( 'CPM_Project' ) )
	{
		$project_obj = CPM_Project::getInstance();
		$projects	 = $project_obj->get_projects( -1, array( 'title', 'ASC') );
		foreach ( $projects as $project )
		{
			if ( (! empty($project->users) && array_key_exists ( $userId, $project->users )) || current_user_can('administrator') )
				if ( is_object( $project ) )
					$projectList[] = $project->post_title;
		}
			
	}
	return $projectList;
}

/**
 * ------------------------------------------------------------------------------------
 * Канбан
 */
add_filter( 'cpm_kanban_tasklabel_section_name', 'in_cpm_kanban_tasklabel_section_name', 10, 6 );
function in_cpm_kanban_tasklabel_section_name( $name, $project_id, $list_id, $task_id, $single, $sectionId )
{
	// Не выводим Backlog
	if ( in_array( $name, array( 'Backlog', 'План' ) ) )
		return false;
	
	// Меняем название секций для метки
	switch ( $name )
	{
		case 'Сделать':
			return 'Запланировано';
	
		default:
			return $name;
	}
}

add_filter( 'cpm_kanban_tasklabel_label', 'in_cpm_kanban_tasklabel_label', 10, 7 );
function in_cpm_kanban_tasklabel_label( $html, $project_id, $list_id, $task_id, $single, $sectionId, $sectionName )
{
	// Меняем цвет метки
	switch ( $sectionName )
	{
		case 'В работе':
			return str_replace( 'cpm-kanban-task-label', 'cpm-kanban-task-label cpm-bg-green', $html );
	
		default:
			return $html;
	}
}

/**
 * ------------------------------------------------------------------------------------
 * Тема Total, добавим две доп.ссылки в верхнее меню
 */

add_filter( 'wpex_top_bar_content', 'in_wpex_top_bar_content' );
function in_wpex_top_bar_content( $content )
{
	$currentUser = wp_get_current_user();
	if ( ! empty( $currentUser->roles ) && ! empty( array_intersect( array('administrator', 'head', 'employee', 'customer', 'agent' ), $currentUser->roles ) ) )
	{
			$content .= 
				'<span class="fa fa-tasks" style="color:#2072a8;margin-left:20px;margin-right:5px;"></span> <a href="/my-account/projects/">Мои проекты</a>' . 
				'<span class="fa fa-list-alt" style="color:#2072a8;margin-left:20px;margin-right:5px;"></span> <a href="/my-account/tasks/">Мои задачи</a>';
	}
	
	return $content;
}
