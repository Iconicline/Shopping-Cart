<?php
$_config = dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))))).'/includes/top.php';
include($_config);

//�������� ���������� �����
define('DIR_ROOT',		_CATALOG);
//���������� � ������������� (������������ ��������)
define('DIR_IMAGES',	'images');
//���������� � ������� (������������ ��������)
define('DIR_FILES',		'images');
//������ � ������ �������� �� ������� ����� ����� �������� ����������� � ������� ������ �� ������ ������
define('WIDTH_TO_LINK', 500);
define('HEIGHT_TO_LINK', 500);
//�������� ������� ����� ��������� ������ (��� �������� ���� lightbox)
define('CLASS_LINK', 'lightview');
define('REL_LINK', 'lightbox');

date_default_timezone_set('Europe/Moscow');
?>
