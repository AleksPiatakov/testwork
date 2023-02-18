<?php

@setlocale(LC_TIME, 'es_ES');
define('OG_LOCALE', 'es_ES');
//define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%d.%m.%Y'); // this is used for strftime()
//define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('DATE_FORMAT_SHORT', DEFAULT_DATE_FORMAT);
define('DATE_FORMAT_LONG', DEFAULT_DATE_FORMAT);
define('DATE_FORMAT', DEFAULT_DATE_FORMAT);
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
