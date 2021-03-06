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

if (isset($_GET['order_hash']) && !empty($_GET['order_hash']) && USE_ORDERS_HASH == 'true')
{
	$oh = os_db_prepare_input(os_db_input($_GET['order_hash']));
	$check_order_by_hash_query = os_db_query("SELECT orders_id FROM ".TABLE_ORDERS." WHERE order_hash = '".$oh."'");
	if (os_db_num_rows($check_order_by_hash_query) == 1)
	{
		$check_order_by_hash = os_db_fetch_array($check_order_by_hash_query);
		$order_id = $check_order_by_hash['orders_id'];
	}
	else
		os_redirect(os_href_link(FILENAME_LOGIN, '', 'SSL'));
}
else
{
	//security checks
	if (!isset($_SESSION['customer_id']))
	{
		os_redirect(os_href_link(FILENAME_LOGIN, '', 'SSL'));
	}

	if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id'])))
	{
		os_redirect(os_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
	}

	$customer_info_query = os_db_query("select customers_id from ".TABLE_ORDERS." where orders_id = '".(int)$_GET['order_id']."'");
	$customer_info = os_db_fetch_array($customer_info_query);
	if ($customer_info['customers_id'] != $_SESSION['customer_id'])
	{
		os_redirect(os_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
	}

	$order_id = $_GET['order_id'];
}

$breadcrumb->add(NAVBAR_TITLE_1_ACCOUNT_HISTORY_INFO, os_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2_ACCOUNT_HISTORY_INFO, os_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
$breadcrumb->add(sprintf(NAVBAR_TITLE_3_ACCOUNT_HISTORY_INFO, (int)$order_id), os_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id='.(int)$order_id, 'SSL'));

require (_CLASS.'order.php');
$order = new order((int)$order_id);

require (_INCLUDES.'header.php');

// Delivery Info
if ($order->delivery != false)
{
	$osTemplate->assign('DELIVERY_LABEL', os_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'));
	if ($order->info['shipping_method'])
	{
		$osTemplate->assign('SHIPPING_METHOD', $order->info['shipping_method']);
	}
}

$order_total = $order->getTotalData((int)$order_id);

$osTemplate->assign('order_data', $order->getOrderData((int)$order_id));
$osTemplate->assign('order_total', $order_total['data']);

// Payment Method
if ($order->info['payment_method'] != '' && $order->info['payment_method'] != 'no_payment') 
{
	include (_MODULES.'payment/'.$order->info['payment_method'].'/'.$_SESSION['language'].'.php');
	$osTemplate->assign('PAYMENT_METHOD', constant(MODULE_PAYMENT_.strtoupper($order->info['payment_method'])._TEXT_TITLE));
}

// Order History
$statuses_query = os_db_query("select os.orders_status_name, osh.date_added, osh.comments from ".TABLE_ORDERS_STATUS." os, ".TABLE_ORDERS_STATUS_HISTORY." osh where osh.orders_id = '".(int) $order_id."' and osh.orders_status_id = os.orders_status_id and os.language_id = '".(int) $_SESSION['languages_id']."' order by osh.date_added");

$aHistory = array();
while ($statuses = os_db_fetch_array($statuses_query))
{
	$aHistory[] = $statuses;
}
$osTemplate->assign('aHistory', $aHistory);

// Download-Products
if (DOWNLOAD_ENABLED == 'true')
	include (_MODULES.'downloads.php');

// фильтр кнопок печати
$array = array();
$array['params'] = array('order_id' => $order_id, 'payment_method' => $order->info['payment_method']);
$array = apply_filter('print_menu', $array);
if (is_array($array['link']) && !empty($array['link']))
{
	$osTemplate->assign('filterPrint', $array['link']);
}
// фильтр кнопок печати

$osTemplate->assign('ORDER_NUMBER', (int)$order_id);
$osTemplate->assign('ORDER_DATE', os_date_long($order->info['date_purchased']));
$osTemplate->assign('ORDER_STATUS', $order->info['orders_status']);
$osTemplate->assign('BILLING_LABEL', os_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'));
$osTemplate->assign('PRODUCTS_EDIT', os_href_link(FILENAME_SHOPPING_CART, '', 'SSL'));
$osTemplate->assign('SHIPPING_ADDRESS_EDIT', os_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'));
$osTemplate->assign('BILLING_ADDRESS_EDIT', os_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL'));

if ($order->info['order_hash'] && USE_ORDERS_HASH == 'true')
{
	$osTemplate->assign('ORDER_HASH', os_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_hash='.$order->info['order_hash'], 'SSL'));
}

$from_history = preg_match("/page=/i", os_get_all_get_params()); // referer from account_history yes/no
$back_to = $from_history ? FILENAME_ACCOUNT_HISTORY : FILENAME_ACCOUNT; // if from account_history => return to account_history

$_array = array('img' => 'button_back.gif',
	'href' => os_href_link($back_to, os_get_all_get_params(array ('order_id')), 'SSL'),
	'alt' => IMAGE_BUTTON_BACK,
	'code' => ''
);

$_array = apply_filter('button_back', $_array);

if (empty($_array['code']))
{
	$_array['code'] = buttonSubmit($_array['img'], $_array['href'], $_array['alt']);
}

$osTemplate->assign('BUTTON_BACK', $_array['code']);

$osTemplate->assign('order', $order);

// Оплата
$payment_method = $order->info['payment_method'];

require (_CLASS.'payment.php');
$payment_modules = new payment($payment_method);

// Если метод оплаты требует перехода на сайт сервиса, то посылаем на form_action_url,
// в противном случае форма отправляет на окончательное формирование заказа
if (isset($$payment_method->form_action_url) && !$$payment_method->tmpOrders)
{
	// Заполенные поля методов оплаты(если есть)
	if (is_array($payment_modules->modules))
	{
		if ($confirmation = $payment_modules->confirmation())
		{
			$payment_info = $confirmation['title'];
			for ($i = 0, $n = sizeof($confirmation['fields']); $i < $n; $i++)
			{
				$payment_info .= '<table>
			<tr><td>'.$confirmation['fields'][$i]['title'] . '</td>
			<td>'.stripslashes($confirmation['fields'][$i]['field']).'</td>
			</tr></table>';
			}
			$osTemplate->assign('PAYMENT_INFORMATION', $payment_info);
		}
	}

	$form_action_url = $$payment_method->form_action_url;
	$osTemplate->assign('PAID', true);

	if (isset($$payment_method->form_action_method) && !empty($$payment_method->form_action_method))
		$form_action_method = $$payment_method->form_action_method;
	else
		$form_action_method = 'post';

	$osTemplate->assign('CHECKOUT_FORM', os_draw_form('checkout_confirmation', $form_action_url, $form_action_method));
	$osTemplate->assign('CHECKOUT_FORM_END', '</form>');

	// метод класса оплаты process_button
	$payment_button = '';
	if (is_array($payment_modules->modules))
	{
		$payment_button .= $payment_modules->process_button();
	}
	$osTemplate->assign('MODULE_BUTTONS', $payment_button);
	$osTemplate->assign('CHECKOUT_BUTTON', buttonSubmit('button_confirm_order.gif', null, TEXT_BUTTON_PAY_NOW));
}
else
	$osTemplate->assign('PAID', false);



$osTemplate->assign('language', $_SESSION['language']);
$osTemplate->caching = 0;
$main_content = $osTemplate->fetch(CURRENT_TEMPLATE.'/module/account_history_info.html');
$osTemplate->assign('language', $_SESSION['language']);
$osTemplate->assign('main_content', $main_content);
$osTemplate->caching = 0;
$osTemplate->loadFilter('output', 'trimhitespace');
$template = (file_exists(_THEMES_C.FILENAME_ACCOUNT_HISTORY_INFO.'.html') ? CURRENT_TEMPLATE.'/'.FILENAME_ACCOUNT_HISTORY_INFO.'.html' : CURRENT_TEMPLATE.'/index.html');
$osTemplate->display($template);
include ('includes/bottom.php');