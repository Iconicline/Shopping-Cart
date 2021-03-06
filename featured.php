<?php
/*
*---------------------------------------------------------
*
*	CartET - Open Source Shopping Cart Software
*	http://www.cartet.org
*
*---------------------------------------------------------
*
*	Based on: osCommerce, nextcommerce, xt:Commerce
*	Released under the GNU General Public License
*
*---------------------------------------------------------
*/

include ('includes/top.php');
//$osTemplate = new osTemplate;

$breadcrumb->add(NAVBAR_TITLE_FEATURED, os_href_link(FILENAME_FEATURED));

require (dir_path('includes').'header.php');

$featured_query_raw = $cartet->product->getList(array(
	'products_status' => 1,
	'category_status' => 1,
	'group' => 'p.products_id',
	'where' => array('f.products_id = p.products_id', 'f.status = 1'),
	'order' => 'f.featured_date_added DESC',
));

$featured_split = new splitPageResults($featured_query_raw, $_GET['page'], MAX_DISPLAY_FEATURED_PRODUCTS);

$module_content = '';
$row = 0;
$featured_query = os_db_query($featured_split->sql_query);
while ($featured = os_db_fetch_array($featured_query)) {
	$module_content[] = $product->buildDataArray($featured);
}

if (($featured_split->number_of_rows > 0)) {
	$osTemplate->assign('PAGINATION', $featured_split->display_links(MAX_DISPLAY_PAGE_LINKS, os_get_all_get_params(array ('page', 'info', 'x', 'y'))));

}

$osTemplate->assign('language', $_SESSION['language']);
$osTemplate->assign('module_content', $module_content);
$osTemplate->caching = 0;
$main_content = $osTemplate->fetch(CURRENT_TEMPLATE.'/module/featured.html');

$osTemplate->assign('language', $_SESSION['language']);
$osTemplate->assign('main_content', $main_content);
$osTemplate->caching = 0;
 $osTemplate->loadFilter('output', 'trimhitespace');
$template = (file_exists(_THEMES_C.FILENAME_FEATURED.'.html') ? CURRENT_TEMPLATE.'/'.FILENAME_FEATURED.'.html' : CURRENT_TEMPLATE.'/index.html');
$osTemplate->display($template);

include ('includes/bottom.php');