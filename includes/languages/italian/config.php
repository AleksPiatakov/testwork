<?php

@setlocale(LC_TIME, 'it_it.UTF-8');
define('OG_LOCALE', 'it_it');
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // DATE_FORMAT_SHORTthis is used for strftime()
//define('DATE_FORMAT_LONG', '%d %B %Y г.'); // this is used for strftime()
//define('DATE_FORMAT_SHORT', '%d/%m/%Y');
define('DATE_FORMAT_SHORT', DEFAULT_DATE_FORMAT);
//define('DATE_FORMAT_LONG', '%d.%m.%Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', DEFAULT_DATE_FORMAT);
define('DATE_FORMAT', DEFAULT_DATE_FORMAT); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
