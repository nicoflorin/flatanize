<?php
//Konstanten
//Website Name
define('TITLE', 'flatanize');
define('WEBMASTER', 'webmaster@flatanize.com');

//Frequenz
define('ONCE', 'once');
define('DAILY', 'daily');
define('WEEKLY', 'weekly');
define('MONTHLY', 'every month');

//Wochentage
define('MONDAY', 'Monday');
define('TUESDAY', 'Tuesday');
define('WEDNESDAY', 'Wednesday');
define('THURSDAY', 'Thursday');
define('FRIDAY', 'Friday');
define('SATURDAY', 'Saturday');
define('SUNDAY', 'Sunday');
define('CURR', 'CHF');

//Protokoll (http/https)
define('PROTOCOL', isset($_SERVER['HTTPS']) ? 'https' : 'http');

//Paths Konstanten
define('URL', PROTOCOL . '://' . $_SERVER['HTTP_HOST']);
// ROOT in public/index.php definiert. ROOT => flatanize
