<?php

@setlocale(LC_TIME, 'ua_UA.UTF-8');
define('OG_LOCALE', 'ua_UA');


//define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_SHORT', DEFAULT_DATE_FORMAT);
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
//define('DATE_FORMAT_LONG', '%d %B %Y г.'); // this is used for strftime()
//define('DATE_FORMAT_LONG', '%d.%m.%Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', DEFAULT_DATE_FORMAT);
//define('DATE_FORMAT', 'd.m.Y h:i:s'); // this is used for date()
define('DATE_FORMAT', DEFAULT_DATE_FORMAT);
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
