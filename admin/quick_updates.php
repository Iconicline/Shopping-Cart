<?php
/*
*---------------------------------------------------------
*
*	CartET - Open Source Shopping Cart Software
*	http://www.cartet.org
*
*---------------------------------------------------------
*/

require('includes/top.php');

if ($_GET['sorting'])
{
	switch ($_GET['sorting'])
	{
		case 'id':
			$prodsort = 'p.products_id ASC';
		break;
		case 'id-desc':
			$prodsort = 'p.products_id DESC';
		break;
		case 'name':
			$prodsort = 'pd.products_name ASC';
		break;
		case 'name-desc':
			$prodsort = 'pd.products_name DESC';
		break;
		case 'price':
			$prodsort = 'p.products_price ASC';
		break;
		case 'price-desc':
			$prodsort = 'p.products_price DESC';
		break;
		case 'stock':
			$prodsort = 'p.products_quantity ASC';
		break;
		case 'stock-desc':
			$prodsort = 'p.products_quantity DESC';
		break;
		default:
			$prodsort = 'pd.products_name ASC';
		break;
	}
}
else
{
	$prodsort = 'p.products_sort, pd.products_name ASC';
}

$manufacturer = '';
if (isset($_GET['manufacturer']) && !empty($_GET['manufacturer']))
{
	$manufacturer = "AND p.manufacturers_id = ".(int)$_GET['manufacturer']."";
}

$cat = '';
if (isset($_GET['cPath']) && !empty($_GET['cPath']))
{
	$cat = "AND p2c.categories_id = ".(int)$_GET['cPath']."";
}

$i = 0;
$group_query = os_db_query("SELECT customers_status_image, customers_status_id, customers_status_name FROM ".TABLE_CUSTOMERS_STATUS." WHERE language_id = '".(int)$_SESSION['languages_id']."' AND customers_status_id != '0'");
while ($group_values = os_db_fetch_array($group_query))
{
	// load data into array
	$i ++;
	$group_data[$i] = array
	(
		'STATUS_NAME' => $group_values['customers_status_name'],
		'STATUS_IMAGE' => $group_values['customers_status_image'],
		'STATUS_ID' => $group_values['customers_status_id']
	);
}

$products_shippingtime = $cartet->product->getShippingStatus();

$aManufacturers = array();
$getManufacturersQuery = os_db_query("select m.manufacturers_id, m.manufacturers_name from ".TABLE_MANUFACTURERS." m order by m.manufacturers_name ASC");
if (os_db_num_rows($getManufacturersQuery) > 0)
{
	while($getManufacturers = os_db_fetch_array($getManufacturersQuery))
	{
		$aManufacturers[$getManufacturers['manufacturers_id']] = $getManufacturers['manufacturers_name'];
	}
}

$row_bypage_array = array(array('id' => '', 'text' => TEXT_MAXI_ROW_BY_PAGE));
for ($i = 50; $i <= 500 ; $i=$i+50)
{
	$row_bypage_array[] = array('id' => $i, 'text' => $i);
}

$row_by_page = $_REQUEST['row_by_page'];
($row_by_page) ? define('MAX_DISPLAY_ROW_BY_PAGE' , $row_by_page ) : $row_by_page = MAX_DISPLAY_ADMIN_PAGE; define('MAX_DISPLAY_ROW_BY_PAGE' , MAX_DISPLAY_ADMIN_PAGE );

// массовое изменение цен
if (isset($_GET['action']) && $_GET['action'] == 'multiup')
{
	$price = $_POST['price'];
	$value = trim($price, '%');

	if ($_POST['customer_groups'] == 1)
	{
		$i = 0;
		$group_query = os_db_query("SELECT customers_status_id FROM ".TABLE_CUSTOMERS_STATUS." WHERE language_id = '".(int) $_SESSION['languages_id']."' AND customers_status_id != '0'");
		while ($group_values = os_db_fetch_array($group_query))
		{
			$i++;
			$group_data[$i] = array('STATUS_ID' => $group_values['customers_status_id']);
		}
	}

	if (is_numeric($value))
	{
		$isPersent = substr($price, -1) == '%';
		if ($_POST['cPath'] > 0)
		{
			$where_manufacturer = '';
			if ($_POST['manufacturer'] > 0)
			{
				$where_manufacturer = "p.manufacturers_id = '".(int)$_POST['manufacturer']."' AND ";
			}
			$sql = 'UPDATE '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_TO_CATEGORIES.' p2c SET products_price = products_price + '.($isPersent ? 'products_price * ('.$value.'/100)' : $value).' WHERE '.$where_manufacturer.' p.products_id = p2c.products_id AND p2c.categories_id = \''.(int)$_POST['cPath'].'\'';

			if ($_POST['customer_groups'] == 1)
			{
				for ($col = 0, $n = sizeof($group_data); $col < $n +1; $col ++)
				{
					if (@$group_data[$col]['STATUS_ID'] != '')
					{
						os_db_query("UPDATE ".TABLE_PERSONAL_OFFERS.$group_data[$col]['STATUS_ID']." po, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c SET po.personal_offer = po.personal_offer + ".($isPersent ? 'po.personal_offer * ('.$value.'/100)' : $value)." WHERE po.products_id = p2c.products_id AND p2c.categories_id = '".(int)$_POST['cPath']."'");
					}
				}
			}
		}
		else
		{
			$where_manufacturer = '';
			if ($_POST['manufacturer'] > 0)
			{
				$where_manufacturer = " WHERE manufacturers_id = '".(int)$_POST['manufacturer']."'";
			}
			$sql = 'UPDATE '.TABLE_PRODUCTS.' SET products_price = products_price + '.($isPersent ? 'products_price * ('.$value.'/100)' : $value).$where_manufacturer;

			if ($_POST['customer_groups'] == 1)
			{
				for ($col = 0, $n = sizeof($group_data); $col < $n +1; $col ++)
				{
					if (@$group_data[$col]['STATUS_ID'] != '')
					{
						os_db_query("UPDATE ".TABLE_PERSONAL_OFFERS.$group_data[$col]['STATUS_ID']." SET personal_offer = personal_offer + ".($isPersent ? 'personal_offer * ('.$value.'/100)' : $value)."");
					}
				}
			}
		}
		os_db_query($sql);
	}
	os_redirect(FILENAME_QUICK_UPDATES);
}

$breadcrumb->add(HEADING_TITLE, FILENAME_QUICK_UPDATES);

$main->head();
$main->top_menu();
?>
<div class="second-page-nav">

	<form class="form-inline" method="post" action="quick_updates.php?action=multiup">
		<label class="checkbox"><?php echo TEXT_MARGE_INFO; ?></label>
		<input type="text" class="input-medium" name="price">
		<?php echo os_draw_pull_down_menu('cPath', os_get_category_tree(), $current_category_id, ''); ?>
		<select name="manufacturer">
			<option value="0"><?php echo TEXT_ALL_MANUFACTURERS; ?></option>
			<?php
			if (is_array($aManufacturers))
			{
				foreach($aManufacturers AS $mId => $mName)
				{
					echo '<option value="'.$mId.'" '.(($mId == $_GET['manufacturer']) ? 'selected' : '').'>'.$mName.'</option>';
				}
			}
			?>
		</select>
		<label class="checkbox"><input type="checkbox" name="customer_groups" value="1"/> <?php echo TEXT_MARGE_CUSTOMER_GROUPS; ?></label>
		<button type="submit" class="btn">OK</button>
		<label class="checkbox"><?php echo TEXT_SPEC_PRICE_INFO1; ?></label>
	</form>

	<hr>

	<div class="row-fluid">
		<div class="span3">
			<?php echo os_draw_form('search', FILENAME_QUICK_UPDATES, '', 'get'); ?>
				<input type="hidden" name="cPath" value="<?php echo $_GET['cPath']; ?>">
				<input type="hidden" name="row_by_page" value="<?php echo $_GET['row_by_page']; ?>">
				<input type="hidden" name="manufacturer" value="<?php echo $_GET['manufacturer']; ?>">
				<input type="hidden" name="sorting" value="<?php echo $_GET['sorting']; ?>">
				<fieldset>
					<?php echo os_draw_input_field('search', '', 'placeholder="'.HEADING_TITLE_SEARCH.'…"'); ?>
				</fieldset>
			</form>
		</div>
		<div class="span3">
			<?php echo os_draw_form('manufacturers', FILENAME_QUICK_UPDATES, '', 'get'); ?>
				<input type="hidden" name="cPath" value="<?php echo $_GET['cPath']; ?>">
				<input type="hidden" name="row_by_page" value="<?php echo $_GET['row_by_page']; ?>">
				<input type="hidden" name="sorting" value="<?php echo $_GET['sorting']; ?>">
				<fieldset>
					<select name="manufacturer" onChange="this.form.submit();">
						<option value="0"><?php echo TEXT_ALL_MANUFACTURERS; ?></option>
						<?php
						if (is_array($aManufacturers))
						{
							foreach($aManufacturers AS $mId => $mName)
							{
								echo '<option value="'.$mId.'" '.(($mId == $_GET['manufacturer']) ? 'selected' : '').'>'.$mName.'</option>';
							}
						}
						?>
					</select>
				</fieldset>
			</form>
		</div>
		<div class="span3">
			<?php echo os_draw_form('cPath', FILENAME_QUICK_UPDATES, '', 'get'); ?>
				<input type="hidden" name="manufacturer" value="<?php echo $_GET['manufacturer']; ?>">
				<input type="hidden" name="row_by_page" value="<?php echo $_GET['row_by_page']; ?>">
				<input type="hidden" name="sorting" value="<?php echo $_GET['sorting']; ?>">
				<fieldset>
					<?php echo os_draw_pull_down_menu('cPath', os_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"'); ?>
				</fieldset>
			</form>
		</div>
		<div class="span3">
			<div class="pull-right">
				<?php echo os_draw_form('row_by_page', FILENAME_QUICK_UPDATES, '', 'get'); ?>
					<input type="hidden" name="manufacturer" value="<?php echo $_GET['manufacturer']; ?>">
					<input type="hidden" name="cPath" value="<?php echo $_GET['cPath']; ?>">
					<input type="hidden" name="sorting" value="<?php echo $_GET['sorting']; ?>">
					<fieldset>
					<?php echo  os_draw_pull_down_menu('row_by_page', $row_bypage_array, $row_by_page, 'onChange="this.form.submit();"'); ?>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

<form id="quick_updates" action="" method="post">

	<table class="table table-condensed table-big-list">
		<thead>
			<tr>
				<th><?php echo '#'.os_sorting(FILENAME_QUICK_UPDATES, 'id'); ?></th>
				<th><span class="line"></span><?php echo TABLE_HEADING_PRODUCTS.os_sorting(FILENAME_QUICK_UPDATES, 'name'); ?></th>
				<th><span class="line"></span><?php echo TABLE_HEADING_SORT; ?></th>
				<?php if (STOCK_CHECK == 'true') { ?>
				<th><span class="line"></span><?php echo TABLE_HEADING_QUANTITY.os_sorting(FILENAME_QUICK_UPDATES, 'stock'); ?></th>
				<?php } ?>
				<th><span class="line"></span><?php echo TABLE_HEADING_PRICE.os_sorting(FILENAME_QUICK_UPDATES, 'price'); ?></th>
				<?php
				if (is_array($group_data) && !empty($group_data))
				{
					foreach ($group_data AS $gdId => $gdValue)
					{
						?><th><span class="line"></span><?php echo $gdValue['STATUS_NAME']; ?></th><?php
					}
				}
				?>
				<th><span class="line"></span><?php echo TABLE_HEADING_SHIPPING; ?></th>
				<th><span class="line"></span><?php echo TABLE_HEADING_MANUFACTURERS; ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		if ($_GET['search'])
			$products_query = os_db_query("SELECT * FROM ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c WHERE p.products_id = pd.products_id AND pd.language_id = '".$_SESSION['languages_id']."' AND p.products_id = p2c.products_id AND (pd.products_name like '%".os_db_prepare_input($_GET['search'])."%' OR p.products_model = '".os_db_prepare_input($_GET['search'])."') ".$manufacturer." ".$cat." ORDER BY ".$prodsort);
		else
			$products_query = os_db_query("SELECT * FROM ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c WHERE p.products_id = pd.products_id AND pd.language_id = '".(int)$_SESSION['languages_id']."' AND p.products_id = p2c.products_id ".$manufacturer." ".$cat." ORDER BY ".$prodsort);

		$numr = os_db_num_rows($products_query);
		$products_count = 0;

		if (!isset($_GET['page'])){$page=0;} else { $page = $_GET['page']; };

		$max_count = MAX_DISPLAY_ROW_BY_PAGE;

		if ( (isset($product_id)) and ($numr>0) )
		{
			$pnum=1;

			while ($row=os_db_fetch_array($products_query, true))
			{
				if ($row["products_id"]==$product_id)
				{
					$pnum=($pnum/$max_count);
					if (strpos($pnum,".")>0)
					{
						$pnum=substr($pnum,0,strpos($pnum,"."));
					}
					else
					{
						if ($pnum<>0)
						{
							$pnum=$pnum-1;
						}
					}
					$page = $pnum*$max_count;
					echo $page;
					break;
				}
				$pnum++;
			}
		}

		$page = $page == 0 ? 1 : $page;
		$page = ($page-1)*MAX_DISPLAY_ROW_BY_PAGE;

		if ($_GET['search'])
			$products_query = os_db_query("SELECT * FROM ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c WHERE p.products_id = pd.products_id AND pd.language_id = '".$_SESSION['languages_id']."' AND p.products_id = p2c.products_id AND (pd.products_name like '%".os_db_prepare_input($_GET['search'])."%' OR p.products_model = '".os_db_prepare_input($_GET['search'])."') ".$manufacturer." ".$cat." ORDER BY ".$prodsort." limit ".$page.",".$max_count);
		else
			$products_query = os_db_query("SELECT * FROM ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c WHERE p.products_id = pd.products_id AND pd.language_id = '".(int)$_SESSION['languages_id']."' AND p.products_id = p2c.products_id ".$manufacturer." ".$cat." ORDER BY ".$prodsort." limit ".$page.",".$max_count);

		$aProducts = array();
		$aTaxIds = array();
		while ($products = os_db_fetch_array($products_query))
		{
			$aTaxIds[$products['products_tax_class_id']] = $products['products_tax_class_id'];
			$aProducts[] = $products;
		}

		$getTaxRate = $cartet->price->getTaxRate(array('tax_class_id' => $aTaxIds));

		foreach($aProducts AS $products)
		{
			$products_count++;
			$rows++;

			if (@$_GET['search'])
				$cPath=$products['categories_id'];
			?>
			<tr class="products_tr">
				<td><?php echo $products['products_id']; ?></td>
				<td><?php echo $products['products_name']; ?></td>
				<td><input class="width40px" type="text" name="<?php echo $products['products_id']; ?>[products_sort]" value="<?php echo $products['products_sort']; ?>" /></td>
				<?php if (STOCK_CHECK == 'true') { ?>
					<td><input class="width100px" type="text" name="<?php echo $products['products_id']; ?>[products_quantity]" value="<?php echo $products['products_quantity']; ?>" /></td>
				<?php } ?>
				<td class="tcenter">
					<?php
					if (PRICE_IS_BRUTTO == 'true')
						$products_price = os_round($products['products_price'] * ((100 + $getTaxRate[$products['products_tax_class_id']]['taxId']) / 100), PRICE_PRECISION);
					else
						$products_price = $products['products_price'];
					?>
					<input class="width100px" type="text" name="<?php echo $products['products_id']; ?>[products_price]" value="<?php echo $products_price; ?>" />
					
				</td>
				<?php
				if (is_array($group_data) && !empty($group_data))
				{
					$products_price = '';
					foreach ($group_data AS $gdId => $gdValue)
					{
						if ($gdValue['STATUS_NAME'] != '')
						{
							if (PRICE_IS_BRUTTO == 'true')
								$products_price = os_round(get_group_price($gdValue['STATUS_ID'], $products['products_id']) * ((100 + $getTaxRate[$products['products_tax_class_id']]['taxId']) / 100), PRICE_PRECISION);
							else
								$products_price = os_round(get_group_price($gdValue['STATUS_ID'], $products['products_id']), PRICE_PRECISION);
							?>
							<td class="tcenter">
								<input type="text" name="<?php echo $products['products_id']; ?>[products_price_<?php echo $gdValue['STATUS_ID']; ?>]" value="<?php echo $products_price; ?>" class="width100px">
								</td>
							<?php
						}
					}
				}
				?>
				<td>
					<select class="width100px" name="<?php echo $products['products_id']; ?>[products_shippingtime]">
						<?php
						if (is_array($products_shippingtime))
						{
							foreach($products_shippingtime AS $id => $text)
							{
								$selected = ($products['products_shippingtime'] == $id) ? 'selected' : '';
								echo '<option value="'.$id.'" '.$selected.'>'.$text.'</option>';
							}
						}
						?>
					</select>
				</td>
				<td>
					<select name="<?php echo $products['products_id']; ?>[manufacturers_id]">
						<option value=""></option>
						<?php
						if (is_array($aManufacturers))
						{
							foreach($aManufacturers AS $mId => $mName)
							{
								echo '<option value="'.$mId.'" '.(($mId == $products['manufacturers_id']) ? 'selected' : '').'>'.$mName.'</option>';
							}
						}
						?>
					</select>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

	<div class="pagination pagination-mini pagination-right">
		<ul>
		<?php
		if ($numr > $max_count)
		{
			$_param = array(
				'file_name' => FILENAME_QUICK_UPDATES,
				'page_name' => 'page',
				'param' => array('cPath' => $cPath)
			);

			if (!empty($_GET['search']))
			{
				$_param['param']['search'] = $_GET['search'];
			}

			if (!empty($_GET['manufacturer']))
			{
				$_param['param']['manufacturer'] = $_GET['manufacturer'];
			}

			if (!empty($_GET['row_by_page']))
			{
				$_param['param']['row_by_page'] = $_GET['row_by_page'];
			}

			if (!empty($_GET['sorting']))
			{
				$_param['param']['sorting'] = $_GET['sorting'];
			}
			echo osc_pages_menu($numr, $max_count, $_GET['page'], $_param);
		}
		?>
		</ul>
	</div>

	<hr>

	<div class="tcenter footer-btn">
		<input class="btn btn-success ajax-save-form" data-form-action="products_saveQuickUpdates" type="submit" value="<?php echo BUTTON_SAVE; ?>" />
	</div>
</form>

<?php $main->bottom(); ?>