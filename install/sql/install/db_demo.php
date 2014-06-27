<?php
/*
*---------------------------------------------------------
*
*	CartET - Open Source Shopping Cart Software
*	http://www.cartet.org
*
*---------------------------------------------------------
*/

os_db_query("INSERT INTO `".DB_PREFIX."categories` VALUES
(1, NULL, 0, 1, 'default', 0, 0, 0, 0, 'default', 1, 'p.products_price', 'ASC', NOW(), NULL, 0, 0, 'smartphones.html', 1,0,'1'),
(2, NULL, 0, 1, 'default', 0, 0, 0, 0, 'default', 2, 'p.products_price', 'ASC', NOW(), NULL, 0, 0, 'phones.html', 1,0,'1'),
(3, NULL, 0, 1, 'default', 0, 0, 0, 0, 'default', 3, 'p.products_price', 'ASC', NOW(), NULL, 0, 0, 'accessories.html', 1,0,'1'),
(4, NULL, 0, 1, 'default', 0, 0, 0, 0, 'default', 4, 'p.products_price', 'ASC', NOW(), NULL, 0, 0, 'navigation.html', 1,0,'1'),
(5, NULL, 0, 1, 'default', 0, 0, 0, 0, 'default', 5, 'p.products_price', 'ASC', NOW(), NULL, 0, 0, 'videoregistrator.html', 1,0,'1'),
(6, NULL, 0, 1, 'default', 0, 0, 0, 0, 'default', 6, 'p.products_price', 'ASC', NOW(), NULL, 0, 0, 'tabletpc.html', 1,0,'1'),
(7, NULL, 0, 1, 'default', 0, 0, 0, 0, 'default', 7, 'p.products_price', 'ASC', NOW(), NULL, 0, 0, 'notebooks.html', 1,0,'1'),
(8, NULL, 0, 1, 'default', 0, 0, 0, 0, 'default', 8, 'p.products_price', 'ASC', NOW(), NULL, 0, 0, 'camera.html', 1,0,'1'),
(9, NULL, 0, 1, 'default', 0, 0, 0, 0, 'default', 9, 'p.products_price', 'ASC', NOW(), NULL, 0, 0, 'pocketbook.html', 1,0,'1');
");

os_db_query("INSERT INTO `".DB_PREFIX."categories_description` VALUES
(1, 1, 'Смартфоны', '', '', '', '', ''),
(2, 1, 'Мобильные телефоны', '', '', '', '', ''),
(3, 1, 'Аксессуары', '', '', '', '', ''),
(4, 1, 'Навигаторы', '', '', '', '', ''),
(5, 1, 'Видеорегистраторы', '', '', '', '', ''),
(6, 1, 'Планшетные компьютеры', '', '', '', '', ''),
(7, 1, 'Ноутбуки', '', '', '', '', ''),
(8, 1, 'Фотоаппараты', '', '', '', '', ''),
(9, 1, 'Электронные книги', '', '', '', '', '');
");

os_db_query("INSERT INTO `".DB_PREFIX."products_to_categories` VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 3),
(7, 3),
(8, 4),
(9, 4),
(10, 5),
(11, 6),
(12, 6),
(13, 7),
(14, 8),
(15, 9);
");

os_db_query("INSERT INTO `".DB_PREFIX."products` VALUES
(1, '', 50, 1, '', 0, 0, 0, 0, 0, '1_0.jpg', '22990.0000', '100.0000', NOW(), NULL, NULL, '0.14', 1, 0, 'default', 'default', 1, 0, 0, 0, 0, '0.0000', 1, 0, 1, 0, 0, 1, 'sonyericsson-xperia-s-lt26i-black.html', 1, 0, 1, 0, 1, ''),
(2, '', 10, 1, '', 0, 0, 0, 0, 0, '2_0.jpg', '23290.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 2, 0, 0, 0, 0, '0.0000', 1, 0, 1, 0, 0, 1, 'nokia-lumia-900-black.html', 1, 0, 1, 0, 1, ''),
(3, '', 10, 1, '', 0, 0, 0, 0, 0, '3_0.jpg', '26990.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 3, 0, 0, 0, 0, '0.0000', 1, 0, 1, 0, 0, 1, 'htc-one-x-grey.html', 1, 0, 1, 0, 1, ''),
(4, '', 50, 1, '', 0, 0, 0, 0, 0, '4_0.jpg', '5590.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 2, 0, 0, 0, 0, '0.0000', 0, 0, 1, 0, 0, 1, 'nokia-c5.html', 1, 0, 1, 0, 1, ''),
(5, '', 20, 1, '', 0, 0, 0, 0, 0, '5_0.jpg', '16990.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 4, 0, 0, 0, 0, '0.0000', 1, 0, 1, 0, 0, 1, 'samsung-i9001-metallic-black.html', 1, 0, 1, 0, 1, ''),
(6, '', 50, 1, '', 0, 0, 0, 0, 0, '6_0.jpg', '490.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 2, 0, 0, 0, 0, '0.0000', 1, 0, 1, 0, 0, 1, 'nokia-bh-212-headset.html', 1, 0, 1, 0, 1, ''),
(7, '', 10, 1, '', 0, 0, 0, 0, 0, '7_0.jpg', '490.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 0, 0, 0, 0, 0, '0.0000', 0, 0, 1, 0, 0, 1, 'jabra-sp200.html', 1, 0, 1, 0, 1, ''),
(8, '', 10, 1, '', 0, 0, 0, 0, 0, '8_0.jpg', '2490.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 0, 0, 0, 0, 0, '0.0000', 0, 0, 1, 0, 0, 1, 'prology-imap-417mi.html', 1, 0, 1, 0, 1, ''),
(9, '', 10, 1, '', 0, 0, 0, 0, 0, '9_0.jpg', '2990.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 0, 0, 0, 0, 0, '0.0000', 0, 0, 1, 0, 0, 1, 'lexand-str-5350.html', 1, 0, 1, 0, 1, ''),
(10, '', 20, 1, '', 0, 0, 0, 0, 0, '10_0.jpg', '6990.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 0, 0, 0, 0, 0, '0.0000', 1, 0, 1, 0, 0, 1, 'advocam-hd-2.html', 1, 0, 1, 0, 1, ''),
(11, '', 50, 1, '', 0, 0, 0, 0, 0, '11_0.jpg', '20490.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 5, 0, 0, 0, 0, '0.0000', 1, 0, 1, 0, 0, 1, 'apple-ipad-3-wi-fi-16gb-white.html', 1, 0, 1, 0, 1, ''),
(12, '', 10, 1, '', 0, 0, 0, 0, 0, '12_0.jpg', '19990.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 5, 0, 0, 0, 0, '0.0000', 1, 0, 1, 0, 0, 1, 'apple-ipad2-16gb-wifi-3g-black.html', 1, 0, 1, 0, 1, ''),
(13, '', 10, 1, '', 0, 0, 0, 0, 0, '13_0.jpg', '21000.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 4, 0, 0, 0, 0, '0.0000', 0, 0, 1, 0, 0, 1, 'samsung-np300e4a-a03-i3-2330m.html', 1, 0, 1, 0, 1, ''),
(14, '', 10, 1, '', 0, 0, 0, 0, 0, '14_0.jpg', '6990.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 6, 0, 0, 0, 0, '0.0000', 0, 0, 1, 0, 0, 1, 'panasonic-lumix-dmc-fp7.html', 1, 0, 1, 0, 1, ''),
(15, '', 50, 1, '', 0, 0, 0, 0, 0, '15_0.jpg', '9990.0000', '100.0000', NOW(), NULL, NULL, '0.00', 1, 0, 'default', 'default', 0, 0, 0, 0, 0, '0.0000', 0, 0, 1, 0, 0, 1, 'pocketbook-a10.html', 1, 0, 1, 0, 1, '');
");

os_db_query("INSERT INTO `".DB_PREFIX."products_description` VALUES
(1, 1, 'Sony Xperia S LT26i black', '', '', '', '', '', '', '', 13),
(2, 1, 'Nokia Lumia 900 black', '', '', '', '', '', '', '', 2),
(3, 1, 'HTC One X Grey', 'Смартфон с поддержкой технологии NFC', '', '', '', '', '', '', 1),
(4, 1, 'Nokia C5-03 MTS White Alum Grey', 'Nokia C5-03 МТС – стильный сенсорный смартфон от Nokia, наделенный полным набором необходимых в наше время функций. Вы можете самостоятельно настроить оформление рабочего стола, вывести на него все необходимые Вам функции и применять разнообразные темы оформления. Благодаря камере с разрешением 5 мегапикселей Вы можете оперативно сделать качественные снимки и видео, моментально опубликовывая их в социальные сети. Наличие бесплатной GPS-навигации с пошаговой голосовой инструкцией позволит всегда найти оптимальный путь. А благодаря скоростному 3G и Wi-Fi соединению Вы сможете быстро и комфортно общаться в социальных сетях, а также легко смотреть видео на популярном сервисе YouTube.', '', '', '', '', '', '', 0),
(5, 1, 'Samsung I9001 Metallic Black', '', '', '', '', '', '', '', 0),
(6, 1, 'Беспроводная гарнитура Nokia BH-212', '<p><strong>Особенности</strong></p>\r\n<ul>\r\n<li>Простое беспроводное общение в дороге</li>\r\n<li>до 11 часов разговора и 500 часов в режиме ожидания</li>\r\n<li>зеленый светодиодный индикатор статуса</li>\r\n<li>удобное крепление благодаря мягкому крючку</li>\r\n</ul>', '', '', '', '', '', '', 1),
(7, 1, 'Спикерфон Jabra SP200', 'Беспроводная гарнитура для телефонов с функцией Bluetooth.', '', '', '', '', '', '', 0),
(8, 1, 'Prology iMap-417Mi', 'Портативный навигатор с сенсорным экраном (4,3'''') 109мм, с предустановленным ПО \"Навител Навигатор\" с картами 2D/3D и внутренней памятью на 4Гб.', '', '', '', '', '', '', 1),
(9, 1, 'Lexand STR-5350', '', '', '', '', '', '', '', 0),
(10, 1, 'AdvoCam HD-2', '', '', '', '', '', '', '', 0),
(11, 1, 'Apple iPad 16ГБ Wi-Fi белый', 'Благодаря уникальному дисплею Retina, 5-мегапиксельной камере iSight и технологиям сверхбыстрой беспроводной связи новый iPad стал ещё увлекательнее. Просматривайте веб-сайты, проверяйте почту, листайте фотографии, смотрите фильмы, играйте, читайте книги и журналы — вы найдёте занятие на любой вкус. С iPad намного проще, быстрее и интереснее выполнять повседневные задачи. А благодаря 200 000 приложений в App Store ваши возможности практически безграничны.', '', '', '', '', '', '', 2),
(12, 1, 'Apple iPad2 16Gb Wi-Fi + 3G Black', '', '', '', '', '', '', '', 1),
(13, 1, 'Samsung NP300E4A-A03 i3 2330M', '', '', '', '', '', '', '', 0),
(14, 1, 'Panasonic Lumix DMC-FP7', '', '', '', '', '', '', '', 0),
(15, 1, 'PocketBook A10', '<p>Pocket Book А10 - гибрид электронной книги и планшета. У него цветной мультитач-экран, операционная система Android 2.3, есть Wi-Fi, Bluetooth, просмотр видео - в общем все, что душа пожелает.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Планшет Pocket Book А10</strong></p>\r\n<p>Чем является это устройство - электронной книгой или бюджетным планшетом Android - вопрос философский. Покетбук заточен под чтение книг, но читать книги вас никто не заставляет. Играйте в Angry Birds, общайтесь с друзьями в соцсетях - все возможности современного планшета под рукой с процессором TI OMAP 3621 мощностью в 1 GHz.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Бесплатные приложения</strong></p>\r\n<p>С Pocket Book А10 вы получаете бесплатный пакет важных и удобных приложений. Это браузер, файловый менеджер, словарь Abbyy Lingvo. Office Suite позволит работать с файлами Word. Поддерживаются все форматы электронных книг, а цветной экран позволяет читать и комиксы.</p>', '', '', '', '', '', '', 2);
");

os_db_query("INSERT INTO `".DB_PREFIX."products_extra_fields` VALUES
(1, 'Смартфон', 0, 1, 0),
(2, 'Операционная система', 0, 1, 0),
(3, 'Процессор', 0, 1, 0),
(4, 'Частота процессора', 0, 1, 0),
(5, 'Диапазоны GSM', 0, 1, 0),
(6, 'Поддержка 3G (UMTS)', 0, 1, 0),
(7, 'MP3 на звонок', 0, 1, 0),
(8, 'MMS', 0, 1, 0),
(9, 'Сенсорный экран', 0, 1, 0),
(10, 'Multitouch', 0, 1, 0),
(11, 'Тип экрана', 0, 1, 0),
(12, 'Поддержка Wi-Fi', 0, 1, 0),
(13, 'Bluetooth', 0, 1, 0),
(14, 'Интерфейс USB', 0, 1, 0),
(15, 'Цветной экран', 0, 1, 0),
(16, 'Диагональ экрана', 0, 1, 0),
(17, 'Разрешение экрана', 0, 1, 0),
(18, 'Ширина', 0, 1, 0),
(19, 'Высота', 0, 1, 0),
(20, 'Толщина', 0, 1, 0),
(21, 'Голосовая навигация', 0, 1, 0);
");

os_db_query("INSERT INTO `".DB_PREFIX."products_to_products_extra_fields` VALUES
(1, 1, 'Да'),
(1, 13, 'Да'),
(1, 12, 'Да'),
(1, 11, 'Цветной'),
(1, 10, 'Да'),
(1, 9, 'Да'),
(1, 8, 'Да'),
(1, 7, 'Да'),
(1, 6, 'Да'),
(1, 5, '850, 900, 1800, 1900'),
(1, 4, '1.5 ГГц'),
(1, 3, 'Qualcomm MSM 8260'),
(1, 2, 'Android 2.3'),
(1, 14, 'USB micro'),
(2, 1, 'Да'),
(2, 13, 'Да'),
(2, 12, 'Да'),
(2, 11, 'Цветной'),
(2, 10, 'Да'),
(2, 9, 'Да'),
(2, 8, 'Да'),
(2, 7, 'Да'),
(2, 6, 'Да'),
(2, 5, '850, 900, 1800, 1900'),
(2, 4, '1.4 ГГц'),
(2, 3, 'Qualcomm APQ8055'),
(2, 2, 'MS Windows Phone 7.5 Mango'),
(2, 14, 'USB micro'),
(3, 1, 'Да'),
(3, 13, 'Да'),
(3, 12, 'Да'),
(3, 11, 'Цветной'),
(3, 10, 'Да'),
(3, 9, 'Да'),
(3, 8, 'Да'),
(3, 7, 'Да'),
(3, 6, 'Да'),
(3, 5, '900, 1800, 1900'),
(3, 4, '1.5 ГГц'),
(3, 3, 'NVIDIA Tegra 3'),
(3, 2, 'Android 4.0'),
(3, 14, 'USB micro'),
(4, 1, 'Да'),
(4, 13, 'Да'),
(4, 12, 'Да'),
(4, 11, 'TFT'),
(4, 9, 'Да'),
(4, 8, 'Да'),
(4, 2, 'Symbian OS 9.4'),
(4, 14, 'USB micro'),
(5, 1, 'Да'),
(5, 13, 'Да'),
(5, 12, 'Да'),
(5, 11, 'OLED'),
(5, 9, 'Да'),
(5, 7, 'Да'),
(8, 15, 'Да'),
(8, 16, '4.3\"'),
(8, 17, '480 x 272 пикселей'),
(8, 18, '118 мм'),
(8, 19, '79 мм'),
(8, 20, '12 мм'),
(8, 2, 'MS Windows Embedded CE6.0'),
(8, 3, 'MStar'),
(8, 4, '0.5 ГГц'),
(8, 9, 'Да'),
(8, 21, 'Да'),
(9, 15, 'Да'),
(9, 16, '5.0\"'),
(9, 17, '480 x 272 пикс пикселей'),
(9, 18, '134.5 мм'),
(9, 19, '85 мм'),
(9, 20, '10 мм'),
(9, 2, 'MS Windows Embedded CE6.0'),
(9, 3, 'ARM11'),
(9, 4, '0.6 ГГц'),
(9, 9, 'Да'),
(9, 21, 'Да'),
(10, 16, '1.5\"'),
(10, 18, '50 мм'),
(10, 19, '85 мм'),
(10, 20, '23 мм'),
(11, 13, 'Да'),
(11, 14, 'USB 2.0'),
(11, 15, 'Да'),
(11, 16, '9.7\"'),
(11, 18, '186 мм'),
(11, 19, '241 мм'),
(11, 20, '9 мм'),
(11, 10, 'Да'),
(11, 2, 'iOS 5'),
(11, 3, 'Apple A5x'),
(11, 4, '1 ГГц'),
(11, 9, 'Да'),
(12, 13, 'Да'),
(12, 14, 'USB 2.0'),
(12, 15, 'Да'),
(12, 16, '9.7\"'),
(12, 18, '186 мм'),
(12, 19, '241 мм'),
(12, 20, '9 мм'),
(12, 12, 'IEEE 802.11b, IEEE 802.11g, IEEE 802.11n'),
(12, 10, 'Да'),
(12, 2, 'iOS 4'),
(12, 3, 'Apple A5'),
(12, 4, '1 ГГц'),
(12, 9, 'Да'),
(13, 13, 'Да'),
(13, 14, 'USB 2.0x3'),
(13, 16, '14\"'),
(13, 17, '1366 x 768 пикс'),
(13, 18, '332 мм'),
(13, 19, '231 мм'),
(13, 20, '33 мм'),
(13, 12, 'Да'),
(13, 3, 'Core i3'),
(13, 4, '2.2 ГГц'),
(14, 18, '101 мм'),
(14, 19, '59 мм'),
(14, 20, '18 мм'),
(15, 13, 'Да'),
(15, 15, 'Да'),
(15, 16, '10\"'),
(15, 17, '768 x 1024 пикс'),
(15, 18, '244 мм'),
(15, 19, '207 мм'),
(15, 20, '15 мм'),
(15, 12, 'Да'),
(15, 9, 'Да');
");

os_db_query("INSERT INTO `".DB_PREFIX."products_images` VALUES
(1, 1, 1, '1_1.jpg', ''),
(2, 2, 1, '2_1.jpg', ''),
(3, 2, 2, '2_2.jpg', ''),
(4, 3, 1, '3_1.jpg', ''),
(5, 3, 2, '3_2.jpg', ''),
(6, 4, 1, '4_1.jpg', ''),
(7, 5, 1, '5_1.jpg', ''),
(8, 6, 1, '6_1.jpg', ''),
(9, 7, 1, '7_1.jpg', ''),
(10, 10, 1, '10_1.jpg', ''),
(11, 11, 1, '11_1.jpg', ''),
(12, 14, 1, '14_1.jpg', '');
");

os_db_query("INSERT INTO `".DB_PREFIX."manufacturers` VALUES
(1, 'Sony', NULL, '2012-07-17 14:16:31', NULL, ''),
(2, 'Nokia', NULL, '2012-07-17 14:16:44', NULL, ''),
(3, 'HTC', NULL, '2012-07-17 14:16:53', NULL, ''),
(4, 'Samsung', NULL, '2012-07-17 14:17:02', NULL, ''),
(5, 'Apple', NULL, '2012-07-17 14:17:44', NULL, ''),
(6, 'Panasonic', NULL, '2012-07-17 14:17:59', NULL, '');
");

os_db_query("INSERT INTO `".DB_PREFIX."manufacturers_info` VALUES
(1, 1, 'Sony', '', '', '', '', 0, NULL),
(2, 1, 'Nokia', '', '', '', '', 0, NULL),
(3, 1, 'HTC', '', '', '', '', 0, NULL),
(4, 1, 'Samsung', '', '', '', '', 0, NULL),
(5, 1, 'Apple', '', '', '', '', 0, NULL),
(6, 1, 'Panasonic', '', '', '', '', 0, NULL);
");

os_db_query("INSERT INTO ".DB_PREFIX."topics VALUES (1, NULL, 0, 0, '2010-01-01 01:01:01', NULL, '');");
os_db_query("INSERT INTO ".DB_PREFIX."topics_description VALUES (1, 1, 'Ноутбуки', '', '');");

os_db_query("INSERT INTO `".DB_PREFIX."articles` VALUES
(1, '2010-01-01 01:01:01', NULL, NULL, 1, '', 0),
(2, '2010-01-01 01:01:01', NULL, NULL, 1, '', 0),
(3, '2010-01-01 01:01:01', NULL, NULL, 1, '', 0),
(4, '2010-01-01 01:01:01', NULL, NULL, 1, '', 0),
(5, '2010-01-01 01:01:01', NULL, NULL, 1, '', 0);");

os_db_query("INSERT INTO `".DB_PREFIX."articles_to_topics` VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1);");

os_db_query("INSERT INTO `".DB_PREFIX."latest_news` VALUES
(1, 'Fujitsu представила новые конвертируемые ПК на базе Centrino 2: LifeBook T5010 и LifeBook T1010', '<p>Подразделение компании Fujitsu в Азиатскои и Тихоокеанском регионах представило две новые модели конвертируемых ноутбуков LifeBook T5010 и LifeBook T1010. Оба устройства оснащены 13.3-дюймовыми широкоформатными экранами с разрешением WXGA (1280&times;800), закрепленными на поворотном механизме, вращающимся в обе стороны.</p>\r\n<p>&nbsp;</p>\r\n<p>Эти модели были спроектированы специально для работы в условиях жесткой эксплуатации. LifeBook T5010 и LifeBook T1010 оснащены LED-индикатором, отображающим статус системы даже при закрытом экране, а также специальным сенсором прокрутки, обеспечивающим контроль над изображением при повернутом экране. Также ноутбуки оснащены двусторонними динамиками, воспроизводящими звук, даже когда ноутбук находится в закрытом состоянии.</p>\r\n<p>&nbsp;</p>\r\n<p>LifeBook T5010 и T1010 созданы на базе новой платформы Intel Centrino 2 и оснащены процессорами Core 2 Duo (Penryn), ОС Windows Vista и памятью DDR3 (1066MГц). <br /><br />LifeBook T5010 оснащен активным дигитайзером, позволяющим точнее распознавать написанный от руки текст. Ноутбук также имеет модульный отсек, который при необходимости позволяет снизить вес устройства или продлить время автономной работы, если в него вставлена дополнительная батарея. <br /><br />LifeBook T1010 оснащен пассивным дигитайзером, поддерживающим ввод информации при помощи стилуса.</p>', '2010-01-01 06:51:47', 1, 1, ''),
(2, 'MSI, возможно, будет производить нетбуки для LG', 'В октябре корейская компания LG Electronics планирует представить новые нетбуки на базе процессоров Atom. Поскольку практически все ноутбуки до этого времени производились Micro-Star International (MSI), заказ на производство новых моделей, вероятнее всего, получит этот производитель. \r\n\r\nПервый нетбук от LG под названием X110 будет оснащен 8.9-дюймовым монитором, 2ГБ памяти и жестким диском емкостью 120ГБ. Новый нетбук будет работать под управлением ОС Windows XP. Компания пока не приняла решения, появятся ли версии, оснащенные Linux. Цена на устройства составит US$625-790.', '2010-01-01 06:53:48', 1, 1, ''),
(3, 'Sony планирует выпустить нетбук, оказалась новостью для самой Sony', 'В ответ на слухи о том, что компания Sony планирует выпустить собственный нетбук, ее представитель Стен Глазго (Stan Glasgow) заявил, что производитель «не собирается конкурировать с Asus.» \r\n\r\nИнформация, опубликованная в китайском издании Economic Daily News еще больше запутывает дело. По ее данным, компания Foxconn займется поставками некоторых компонентов для грядущих моделей нетбуков для Sony. В той же заметке также говорится о том, что и другие японские производители ПК, включая Fujitsu (которая, к слову, не поддерживает идею выпуска собственных нетбуков), также планируют войти в данный сектор рынка в четвертом квартале этого года. \r\n\r\nГде правда, а где досужие домыслы — покажет время. Мы не раз являлись свидетелями того, как компании, сперва отрицавшие свою заинтересованность в том или ином проекте, в конце концов присоединялись к нему в последнюю минуту.', '2010-01-01 06:54:12', 1, 1, ''),
(4, 'ASUS Eee PC 1000HD оказался большим разочарованием', 'Вероятно, по мнению ASUS, лучший способ заявить о бренде Eee PC на перенасыщенном рынке нетбуков — это выпустить менее мощные и интересные модификации уже существующих моделей. Иначе объяснить поступление в продажу Eee PC 1000HD вряд ли возможно. \r\n\r\nМодель 1000HD (сравните с 1000H ) практически ничем не отличается от Eee 904 на базе Pentium M, но при этом она оснащена 10-дюймовым экраном. Огромное семейство Eee, пополнившееся очередным клоном, состоит из моделей, организованных крайне нелогично: Eee 901 гораздо быстрее модели 904, которая имеет корпус как у серии 1000, но процессор как у моделей 900 и 1000HD. В отличие от них, 901, 1000 и 1000H созданы на базе Atom. Похоже, несмотря на многообещающий слоган «Easy to learn, Easy to work, Easy to play» (легко учиться, легко работать, легко играть), разобраться во всем этом многообразии не так-то легко.', '2010-01-01 06:54:26', 1, 1, ''),
(5, 'Новый лаптоп Bentley от Ego за $19,943: для стильных и нетребовательных пользователей', 'Быстрые роскошные большие автомобиле всегда были в моде. Многие компании выпускают ноутбуки с логотипами известных марок автомобилей, дизайн которых также заимствует о них некоторые элементы. Компания Ego выпустила серию новых ультрастильных роскошных ноутбуков, отделанных кожей, на которых красуется логотип Bentley. К сожалению, эти ноутбуки скорее напоминают красивую игрушку и с точки зрения характеристик не представляют особого интереса. По крайней мере, можно с уверенностью сказать, что ноутбук не стоит своих $19,943. В продажу модель поступит этим летом.', '2010-01-01 06:55:24', 1, 1, '');
");

os_db_query("INSERT INTO `".DB_PREFIX."articles_description` VALUES
(1, 1, 'Новый лаптоп Bentley от Ego за $19,943: для стильных и нетребовательных пользователей', 'Быстрые роскошные большие автомобиле всегда были в моде. Многие компании выпускают ноутбуки с логотипами известных марок автомобилей, дизайн которых также заимствует о них некоторые элементы. Компания Ego выпустила серию новых ультрастильных роскошных ноутбуков, отделанных кожей, на которых красуется логотип Bentley. К сожалению, эти ноутбуки скорее напоминают красивую игрушку и с точки зрения характеристик не представляют особого интереса. По крайней мере, можно с уверенностью сказать, что ноутбук не стоит своих $19,943. В продажу модель поступит этим летом.', '', 0, '', '', ''),
(2, 1, 'ASUS Eee PC 1000HD оказался большим разочарованием', 'Вероятно, по мнению ASUS, лучший способ заявить о бренде Eee PC на перенасыщенном рынке нетбуков — это выпустить менее мощные и интересные модификации уже существующих моделей. Иначе объяснить поступление в продажу Eee PC 1000HD вряд ли возможно. \r\n\r\nМодель 1000HD (сравните с 1000H ) практически ничем не отличается от Eee 904 на базе Pentium M, но при этом она оснащена 10-дюймовым экраном. Огромное семейство Eee, пополнившееся очередным клоном, состоит из моделей, организованных крайне нелогично: Eee 901 гораздо быстрее модели 904, которая имеет корпус как у серии 1000, но процессор как у моделей 900 и 1000HD. В отличие от них, 901, 1000 и 1000H созданы на базе Atom. Похоже, несмотря на многообещающий слоган «Easy to learn, Easy to work, Easy to play» (легко учиться, легко работать, легко играть), разобраться во всем этом многообразии не так-то легко.', '', 0, '', '', ''),
(3, 1, 'Sony планирует выпустить нетбук, оказалась новостью для самой Sony', 'Вероятно, по мнению ASUS, лучший способ заявить о бренде Eee PC на перенасыщенном рынке нетбуков — это выпустить менее мощные и интересные модификации уже существующих моделей. Иначе объяснить поступление в продажу Eee PC 1000HD вряд ли возможно. \r\n\r\nМодель 1000HD (сравните с 1000H ) практически ничем не отличается от Eee 904 на базе Pentium M, но при этом она оснащена 10-дюймовым экраном. Огромное семейство Eee, пополнившееся очередным клоном, состоит из моделей, организованных крайне нелогично: Eee 901 гораздо быстрее модели 904, которая имеет корпус как у серии 1000, но процессор как у моделей 900 и 1000HD. В отличие от них, 901, 1000 и 1000H созданы на базе Atom. Похоже, несмотря на многообещающий слоган «Easy to learn, Easy to work, Easy to play» (легко учиться, легко работать, легко играть), разобраться во всем этом многообразии не так-то легко.', '', 0, '', '', ''),
(4, 1, 'MSI, возможно, будет производить нетбуки для LG', 'В октябре корейская компания LG Electronics планирует представить новые нетбуки на базе процессоров Atom. Поскольку практически все ноутбуки до этого времени производились Micro-Star International (MSI), заказ на производство новых моделей, вероятнее всего, получит этот производитель. \r\n\r\nПервый нетбук от LG под названием X110 будет оснащен 8.9-дюймовым монитором, 2ГБ памяти и жестким диском емкостью 120ГБ. Новый нетбук будет работать под управлением ОС Windows XP. Компания пока не приняла решения, появятся ли версии, оснащенные Linux. Цена на устройства составит US$625-790.', '', 0, '', '', ''),
(5, 1, 'Fujitsu представила новые конвертируемые ПК на базе Centrino 2: LifeBook T5010 и LifeBook T1010', '<p>Подразделение компании Fujitsu в Азиатскои и Тихоокеанском регионах представило две новые модели конвертируемых ноутбуков LifeBook T5010 и LifeBook T1010. Оба устройства оснащены 13.3-дюймовыми широкоформатными экранами с разрешением WXGA (1280&times;800), закрепленными на поворотном механизме, вращающимся в обе стороны.</p>\r\n<p>&nbsp;</p>\r\n<p>Эти модели были спроектированы специально для работы в условиях жесткой эксплуатации. LifeBook T5010 и LifeBook T1010 оснащены LED-индикатором, отображающим статус системы даже при закрытом экране, а также специальным сенсором прокрутки, обеспечивающим контроль над изображением при повернутом экране. Также ноутбуки оснащены двусторонними динамиками, воспроизводящими звук, даже когда ноутбук находится в закрытом состоянии.</p>\r\n<p>&nbsp;</p>\r\n<p>LifeBook T5010 и T1010 созданы на базе новой платформы Intel Centrino 2 и оснащены процессорами Core 2 Duo (Penryn), ОС Windows Vista и памятью DDR3 (1066MГц). <br /><br />LifeBook T5010 оснащен активным дигитайзером, позволяющим точнее распознавать написанный от руки текст. Ноутбук также имеет модульный отсек, который при необходимости позволяет снизить вес устройства или продлить время автономной работы, если в него вставлена дополнительная батарея. <br /><br />LifeBook T1010 оснащен пассивным дигитайзером, поддерживающим ввод информации при помощи стилуса.</p>', '', 0, '', '', '');
");

?>