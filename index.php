<?php
/*
*---------------------------------------------------------
*
*	CartET - Open Source Shopping Cart Software
*	http://www.cartet.org
*
*---------------------------------------------------------
*/

include ('includes/top.php');

if (isset($_GET['page']) && !isset($_GET['cat']) && !isset($_GET['manufacturers_id']) && !empty($_GET['page']) or (isset($_GET['main_page']) && !empty($_GET['main_page'])) )
{
	if (isset($os_action['page'][$_GET['page']]) && function_exists($_GET['page']))
	{
		$_plug_name = $os_action_plug[$_GET['page']];
		$p->name = $_plug_name;
		$p->group = $p->info[$p->name]['group'];
		$p->set_dir();
		$_page = $_GET['page'];
		$_page = os_db_prepare_input($_page);
		$_page();
	}
	elseif (isset($os_action['main_page'][$_GET['main_page']]))
	{
		if (function_exists($_GET['main_page']))
		{
			require (dir_path('includes').'header.php');
			$_main_page = $_GET['main_page'];
			$_main_page = os_db_prepare_input($_main_page);

			$_plug_name = $os_action_plug[$_GET['main_page']];
			$p->name =  $_plug_name;
			$p->group = $p->info[$p->name]['group'];
			$p->set_dir();

			ob_start();
			$_main_page();
			$m_content = ob_get_contents();
			ob_end_clean();

			$osTemplate->assign('CONTENT_BODY', $m_content);

			$_array = array(
				'img' => 'button_back.gif',
				'href' => 'javascript:history.back(1)',
				'alt' => IMAGE_BUTTON_BACK,
				'code' => ''
			);

			$osTemplate->assign('language', $_SESSION['language']);
			$main_content = $osTemplate->fetch(CURRENT_TEMPLATE.'/module/content.html');

			$osTemplate->assign('language', $_SESSION['language']);
			$osTemplate->assign('main_content', $main_content);

			$osTemplate->loadFilter('output', 'trimhitespace');
			$template = (file_exists(_THEMES_C.FILENAME_CONTENT.'_'.$_GET['coID'].'.html') ? CURRENT_TEMPLATE.'/'.FILENAME_CONTENT.'_'.$_GET['coID'].'.html' : CURRENT_TEMPLATE.'/index.html');

			$osTemplate->display($template);
		}
	}
	else
	{
		os_redirect('index.php');
	}
}
elseif (isset($_GET['modules_page']) && isset($_GET['modules_type']) && isset($_GET['modules_name']))
{
	if (!empty($_GET['modules_page']) && !empty($_GET['modules_type'])&& !empty($_GET['modules_name']) && ($_GET['modules_type']=='payment' or $_GET['modules_type']=='order_total' or $_GET['modules_type']=='shipping'))
	{
		$module_file = _MODULES.os_check_file_name($_GET['modules_type']).'/'.os_check_file_name($_GET['modules_name']).'/'.os_check_file_name($_GET['modules_page']).'.php';
		if (is_file($module_file))
		{
			include($module_file);
		}
	}
}
else
{
	$category_depth = 'top';
	if (isset ($cPath) && os_not_null($cPath))
	{
		$categories_products_query = osDBquery("select count(p.products_id) as total from ".TABLE_PRODUCTS_TO_CATEGORIES." as ptc, ".TABLE_PRODUCTS." as p where ptc.categories_id = '".$current_category_id."' and ptc.products_id=p.products_id and p.products_status='1'");
		$cateqories_products = os_db_fetch_array($categories_products_query, true);
		if ($cateqories_products['total'] > 0)
		{
			$category_depth = 'products';
		}
		else
		{
			$category_parent_query = osDBquery("select count(*) as total from ".TABLE_CATEGORIES." where parent_id = '".$current_category_id."'");
			$category_parent = os_db_fetch_array($category_parent_query, true);
			if ($category_parent['total'] > 0)
				$category_depth = 'nested';
			else
				$category_depth = 'products';
		}
	}

	require (_INCLUDES.'header.php');
	include (_MODULES.'default.php');
	$osTemplate->assign('language', $_SESSION['language']);
	$osTemplate->loadFilter('output', 'trimhitespace');

	$osTemplate->caching = 0;
	$template = (file_exists(_THEMES_C.FILENAME_DEFAULT.'_'.@$cID.'.html') ? CURRENT_TEMPLATE.'/'.FILENAME_DEFAULT.'_'.@$cID.'.html' : CURRENT_TEMPLATE.'/index.html');
	$osTemplate->display($template);
}

if (!isset($_GET['page']) && !isset($_GET['modules_page']))
{
	include ('includes/bottom.php');
}