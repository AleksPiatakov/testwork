<?php

@setlocale(LC_TIME, 'hu_HU.ISO_8859-1');
define('OG_LOCALE', 'hu_HU');
//define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_SHORT', DEFAULT_DATE_FORMAT);
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
//define('DATE_FORMAT_LONG', '%d %B %Y y.'); // this is used for strftime()
//define('DATE_FORMAT_LONG', '%d.%m.%Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', DEFAULT_DATE_FORMAT);
//define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('DATE_FORMAT', DEFAULT_DATE_FORMAT);
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
