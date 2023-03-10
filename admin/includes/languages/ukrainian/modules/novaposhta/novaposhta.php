<?php
// Heading
define('HEADING_TITLE', 'Нова Пошта API ');
define('HEADING_VERIFYING_API_ACCESS', 'Перевірка доступу до API ');
define('HEADING_ADDING_CUSTOM_METHOD', 'Додавання користувальницького способу ');

define('HEADING_OPTIONS_SEAT', 'Параметри кожного місця відправлення ');
define('HEADING_COMPONENTS_LIST', 'Вибір складових ');
define('HEADING_CN', 'Товарно-транспортна накладна ');


//Button
define('BUTTON_SAVE_AND_EXIT', 'Зберегти та вийти ');
define('BUTTON_DOWNLOAD_BASIC_SETTINGS', 'Завантаження базових налаштувань ');
define('BUTTON_IMPORT_SETTINGS', 'Імпорт налаштувань ');
define('BUTTON_EXPORT_SETTINGS', 'Експорт налаштувань ');
define('BUTTON_CANCEL', 'Скасування ');
define('BUTTON_UPDATE', 'Оновити ');
define('BUTTON_ADD', 'Додати ');
define('BUTTON_GENERATE', 'Генерувати ');
define('BUTTON_COPY', 'Копіювати ');
define('BUTTON_RUN', 'Запустить ');

define('BUTTON_CN_LIST', 'Список накладних ');
define('BUTTON_SAVE_CN', 'Зберегти накладну ');
define('BUTTON_CREATE_ONECLICK_CN', 'Створити ТТН ');
define('BUTTON_BACK_TO_ORDERS', 'До замовлень ');
define('BUTTON_WAREHOUSE_DELIVERY', 'Доставка у відділення ');
define('BUTTON_DOORS_DELIVERY', 'Доставка на адресу кур\'єром ');
define('BUTTON_POSHTOMAT_DELIVERY', 'Доставка в почтомат ');
define('BUTTON_OPTIONS_SEAT', 'Параметри кожного місця відправлення ');
define('BUTTON_COMPONENTS_LIST', 'Список складових ');

// Tab
define('TAB_GENERAL', 'Основні ');
define('TAB_TARIFFS', 'Тарифи ');
define('TAB_DATABASE', 'База даних ');
define('TAB_SENDER', 'Відправник ');
define('TAB_RECIPIENT', 'Одержувач ');
define('TAB_DEPARTURE', 'Відправлення ');
define('TAB_PAYMENT', 'Оплата ');
define('TAB_CONSIGNMENT_NOTE', 'ТТН ');
define('TAB_CRON', 'Завдання Cron ');
define('TAB_SUPPORT', 'Підтримка ');

// Column
define('COLUMN_WEIGHT',            'Вага, кг ');
define('COLUMN_WAREHOUSE_SERVICE_COST', 'Обслуговування у відділенні, грн ');
define('COLUMN_DOORS_SERVICE_COST',     'Доплата за адресне обслуговування, грн ');
define('COLUMN_TARIFF_ZONE_CITY', 'У межах міста ');
define('COLUMN_TARIFF_ZONE_REGION', 'У межах області ');
define('COLUMN_TARIFF_ZONE_UKRAINE',  'У межах України ');
define('COLUMN_DOORS_PICKUP', 'Адресний паркан ');
define('COLUMN_DOORS_DELIVERY', 'Адресна доставка ');
define('COLUMN_DELIVERY_PERIOD', 'Термін доставки, днів ');
define('COLUMN_ACTION',          'Дія ');

define('COLUMN_TYPE',            'Тип даних ');
define('COLUMN_DATE', 'Останнє оновлення ');
define('COLUMN_AMOUNT', 'Кількість ');
define('COLUMN_DESCRIPTION',    'Опис ');

define('COLUMN_POSTAL_COMPANY_STATUS',   'Статус поштової компанії ');
define('COLUMN_STORE_STATUS',            'Статус магазина ');
define('COLUMN_IMPLEMENTATION_DELAY',   'Затримка виконання ');
define('COLUMN_NOTIFICATION',         'Сповіщення ');
define('COLUMN_MESSAGE_TEMPLATE',         'Шаблон повідомлення ');

define('COLUMN_CN_IDENTIFIER', 'Ідентифікатор накладної ');
define('COLUMN_CN_NUMBER', '№ накладний ');
define('COLUMN_ORDER_NUMBER', '№ замовлення ');
define('COLUMN_CREATE_DATE', 		   'дата створення ');
define('COLUMN_ACTUAL_SHIPPING_DATE',  'Фактична дата відправлення ');
define('COLUMN_PREFERRED_SHIPPING_DATE', 'Бажана дата доставки ');
define('COLUMN_ESTIMATED_SHIPPING_DATE', 'Передбачувана дата доставки ');
define('COLUMN_RECIPIENT_DATE', 		   'Дата Отримання ');
define('COLUMN_LAST_UPDATED_STATUS_DATE', 'Дата останнього оновлення статусу ');
define('COLUMN_SENDER',           	 'Відправник ');
define('COLUMN_SENDER_ADDRESS',           'Адреса відправника ');
define('COLUMN_RECIPIENT',           'Одержувач ');
define('COLUMN_RECIPIENT_ADDRESS',    'Адреса отримувача ');
define('COLUMN_SEATS_AMOUNT',   'Кількість місць ');
define('COLUMN_DECLARED_COST',           'Оголошена вартість ');
define('COLUMN_SHIPPING_COST',          'Вартість доставки ');
define('COLUMN_BACKWARD_DELIVERY',          'Зворотня доставка ');
define('COLUMN_SERVICE_TYPE',          'Технологія доставки ');
define('COLUMN_ADDITIONAL_INFORMATION', 'додаткова інформація ');
define('COLUMN_PAYER_TYPE',          'Платник доставки ');
define('COLUMN_PAYMENT_METHOD',  'Тип оплати ');
define('COLUMN_DEPARTURE_TYPE',          'Тип відправлення ');
define('COLUMN_PACKING_NUMBER',          'Номер упаковки ');
define('COLUMN_REJECTION_REASON',          'Причина не развоза ');
define('COLUMN_STATUS',           'Статус ');

define('COLUMN_NUMBER',           	 '№ п/п ');
define('COLUMN_VOLUME',           'Об\`єм ');
define('COLUMN_WIDTH',           'Ширина ');
define('COLUMN_LENGTH',          'Довжина ');
define('COLUMN_HEIGHT',           'Висота ');
define('COLUMN_VOLUME_WEIGHT',  'Об\'ємна вага ');
define('COLUMN_PRICE',          'Вартість ');

// Entry
define('ENTRY_STATUS',      'Статус модуля ');
define('ENTRY_DEBUGGING_MODE',  'Налагоджувальний режим ');
define('ENTRY_SORT_ORDER',  'Порядок сортування ');
define('ENTRY_KEY_API',  'Ключ API ');
define('ENTRY_IMAGE',  'Зображення ');
define('ENTRY_IMAGE_OUTPUT_PLACE',  'Місце виведення зображення ');
define('ENTRY_CURL_CONNECTTIMEOUT',  'cURL тайм-аут підключення ');
define('ENTRY_CURL_TIMEOUT', 'cURL тайм-аут виконання ');
define('ENTRY_METHOD_STATUS',      'Статус ');
define('ENTRY_NAME',      'Назва ');
define('ENTRY_GEO_ZONE',    'Географічна зона ');
define('ENTRY_TAX_CLASS',   'Податковий клас ');
define('ENTRY_MINIMUM_ORDER_AMOUNT',  'Мінімальна сума замовлення ');
define('ENTRY_MAXIMUM_ORDER_AMOUNT',  'Максимальна сума замовлення ');
define('ENTRY_FREE_SHIPPING',  'Безкоштовна доставка від ');
define('ENTRY_FREE_COST_TEXT',      'Текст безкоштовної доставки ');
define('ENTRY_COST',  'Вартість ');
define('ENTRY_API_CALCULATION',  'API розрахунок ');
define('ENTRY_TARIFF_CALCULATION',  'Тарифний розрахунок ');
define('ENTRY_DELIVERY_PERIOD',  'Термін доставки ');
define('ENTRY_WAREHOUSES_FILTER_WEIGHT', 'Фільтр відділень по вазі ');
define('ENTRY_WAREHOUSE_TYPES',  'Тип відділень ');
define('ENTRY_DISCOUNT',  'Знижка ');
define('ENTRY_ADDITIONAL_COMMISSION',  'Додаткова комісія ');
define('ENTRY_ADDITIONAL_COMMISSION_BOTTOM', 'Нижній кордон додаткової комісії ');
define('ENTRY_REGION',               'Область ');
define('ENTRY_CITY',               'Город ');
define('ENTRY_WAREHOUSE',  'Відділ ');
define('ENTRY_REFERENCES', 'Довідники ');
define('ENTRY_SENDER',               'Відправник ');
define('ENTRY_RECIPIENT',              'Одержувач ');
define('ENTRY_CONTACT_PERSON',  'Контактна особа ');
define('ENTRY_PHONE',               'Телефон ');
define('ENTRY_ADDRESS',  'Адреса ');
define('ENTRY_STREET',  'Вулиця ');
define('ENTRY_HOUSE',  'Будинок ');
define('ENTRY_FLAT',  'Квартира ');
define('ENTRY_PREFERRED_DELIVERY_DATE',  'Переважна дата доставки ');
define('ENTRY_PREFERRED_DELIVERY_TIME',  'Переважний час доставки ');
define('ENTRY_AUTODETECTION_DEPARTURE_TYPE', 'Автовизначення типу відправлення ');
define('ENTRY_DEPARTURE_TYPE',        'Тип відправлення ');
define('ENTRY_CALCULATE_VOLUME',  'Облік обсягу ');
define('ENTRY_CALCULATE_VOLUME_TYPE',  'Спосіб розрахунку обсягу ');
define('ENTRY_SEATS_AMOUNT',               'Кількість місць ');
define('ENTRY_DECLARED_COST',             	 'Оголошена вартість ');
define('ENTRY_DECLARED_COST_DEFAULT', 'Оголошена вартість за промовчанням ');
define('ENTRY_DEPARTURE_DESCRIPTION',  'Опис відправлення ');
define('ENTRY_DEPARTURE_ADDITIONAL_INFORMATION', 'Додаткова інформація про відправлення ');
define('ENTRY_USE_PARAMETERS', 'Застосування параметрів ');
define('ENTRY_WEIGHT',  'Вага ');
define('ENTRY_DIMENSIONS',  'Розміри (Ш x Д x В) ');
define('ENTRY_ALLOWANCE', 'Допуск (Ш x Д x В) ');
define('ENTRY_PACK',  'Облік упаковки ');
define('ENTRY_PACK_TYPE',  'Упаковка ');
define('ENTRY_AUTODETECTION_PACK_TYPE', 'Автовизначення типу упаковки ');
define('ENTRY_DELIVERY_PAYER',        'Платник доставки ');
define('ENTRY_THIRD_PERSON',              'Третя особа ');
define('ENTRY_PAYMENT_TYPE',               'Форма оплати ');
define('ENTRY_PAYMENT_COD',  'Метод оплати післяплатою ');
define('ENTRY_BACKWARD_DELIVERY',     'Зворотня доставка ');
define('ENTRY_BACKWARD_DELIVERY_PAYER', 'Платник зворотної доставки ');
define('ENTRY_MONEY_TRANSFER_METHOD',  'Спосіб отримання грошового переказу ');
define('ENTRY_PAYMENT_CARD', 'Платіжна картка ');
define('ENTRY_PAYMENT_CONTROL',  'Контроль оплати ');
define('ENTRY_DISPLAY_ALL_CONSIGNMENTS',     'Відображення всіх накладних облікових записів ');
define('ENTRY_DISPLAYED_INFORMATION',   'Відображувана інформація ');
define('ENTRY_PRINT_FORMAT',            'Формат друку ');
define('ENTRY_NUMBER_OF_COPIES',        'Кількість копій ');
define('ENTRY_TEMPLATE_TYPE',           'Тип шаблону ');
define('ENTRY_PRINT_TYPE',              'Тип друку ');
define('ENTRY_PRINT_START',             'Місце друку ');
define('ENTRY_COMPATIBLE_SHIPPING_METHOD',   'Сумісний спосіб доставки ');
define('ENTRY_CONSIGNMENT_CREATE',      'Створення накладної ');
define('ENTRY_CONSIGNMENT_EDIT',        'Редагування накладної ');
define('ENTRY_CONSIGNMENT_DELETE',      'Видалення накладної ');
define('ENTRY_CONSIGNMENT_ASSIGNMENT_TO_ORDER',  'Присвоєння накладного замовлення ');
define('ENTRY_MENU_TEXT',               'Текст пункту меню ');
define('ENTRY_KEY_CRON',  'Cron ключ ');
define('ENTRY_DEPARTURES_TRACKING',  'Відстеження відправлень ');
define('ENTRY_TRACKING_STATUSES',  'Статуси для відстеження ');
define('ENTRY_ADMIN_NOTIFICATION',  'Для адміністратора ');
define('ENTRY_CUSTOMER_NOTIFICATION',  'Для покупця ');
define('ENTRY_CUSTOMER_NOTIFICATION_DEFAULT',  'Для покупця про зміну статусу ');
define('ENTRY_EMAIL',                   'E-mail ');
define('ENTRY_SMS',                     'SMS ');
define('ENTRY_CODE',                    'Код ');

define('ENTRY_REDBOX_BARCODE',        'Штрих-код redBOX ');
define('ENTRY_WIDTH',               'Ширина ');
define('ENTRY_LENGTH',               'Довжина ');
define('ENTRY_HEIGHT',               'Висота ');
define('ENTRY_VOLUME_WEIGHT',               'Об\'ємна вага (Об\'єм x 250) ');
define('ENTRY_VOLUME_GENERAL',              'Загальний обсяг відправлення ');
define('ENTRY_BACKWARD_DELIVERY_TOTAL', 'Сума зворотної доставки ');
define('ENTRY_DEPARTURE_DATE', 		 'Дата відправки ');
define('ENTRY_SALES_ORDER_NUMBER',  'Внутрішній номер замовлення клієнта ');
define('ENTRY_PACKING_NUMBER', 'Номер упаковки ');
define('ENTRY_RISE_ON_FLOOR', 		 'Підйом на поверх ');
define('ENTRY_ELEVATOR', 				    'Ліфт ');
define('ENTRY_CN_NUMBER',  				    'Накладна ');
define('ENTRY_CN_TYPE',  				    'Тип накладної ');
define('ENTRY_ORDER_NUMBER',  		 'Номер замовлення ');

// HELP
define('HELP_STATUS',  'Увімкнути/вимкнути модуль ');
define('HELP_DEBUGGING_MODE',  'Увімкнути/вимкнути налагоджувальний режим ');
define('HELP_SORT_ORDER',  'Порядок сортування модуля ');
define('HELP_KEY_API',  'Вставте значення ключа API, який Ви можете знайти на сайті компанії "Нова Пошта" (novaposhta.ua) в особистому кабінеті. Перейдіть до розділу Установки 🠆 Безпека 🠆 Мої ключі API ');
define('HELP_IMAGE',  'Зображення методу доставки ');
define('HELP_IMAGE_OUTPUT_PLACE',  'Вкажіть варіант виведення зображення методу доставки у кошику ');
define('HELP_CURL_CONNECTTIMEOUT',  	 'Кількість секунд очікування під час спроби з\'єднання. Щоб прибрати обмеження, залиште поле порожнім ');
define('HELP_CURL_TIMEOUT', 'Максимально дозволена кількість секунд для виконання функцій cURL. Щоб прибрати обмеження, залиште поле порожнім. cURL тайм-аут виконання має бути більше ніж cURL тайм-аут підключення ');
define('HELP_METHOD_STATUS',      'Увімкнути/вимкнути спосіб доставки ');
define('HELP_NAME',      'Ця назва відображатиметься покупцю під час оформлення замовлення ');
define('HELP_GEO_ZONE',  'Виберіть географічну зону, для якої буде доступний цей спосіб доставки ');
define('HELP_TAX_CLASS',  'Виберіть податковий клас ');
define('HELP_MINIMUM_ORDER_AMOUNT',  'Менше зазначеної суми спосіб доставки буде недоступним ');
define('HELP_MAXIMUM_ORDER_AMOUNT',  'Більше зазначеної суми спосіб доставки буде недоступним ');
define('HELP_FREE_SHIPPING',  'Вкажіть мінімальну суму замовлення для безкоштовної доставки ');
define('HELP_FREE_COST_TEXT',      'Цей текст буде відображатися у разі безкоштовної доставки ');
define('HELP_COST',  'Розраховувати вартість доставки? ');
define('HELP_API_CALCULATION',  'Розрахунок вартості через API поштової компанії - дає найточніші та найактуальніші дані про вартість доставки. ');
define('HELP_TARIFF_CALCULATION',  'Якщо розрахунок через API поштової компанії вимкнено, то використовуватиметься лише тарифний розрахунок. Якщо розрахунок через API включений - використовуватиметься тарифний розрахунок вартості доставки тільки у разі недоступності API ');
define('HELP_DELIVERY_PERIOD', 	 'Розраховувати термін доставки? ');
define('HELP_WAREHOUSES_FILTER_WEIGHT', 'Якщо увімкнути фільтр, то для клієнта список доступних відділень формуватиметься відповідно до загальної ваги товарів у кошику та максимально допустимої ваги для відділень ');
define('HELP_WAREHOUSE_TYPES', 	 'Вибраний тип відділень буде доступним для клієнтів під час оформлення замовлення. Якщо не вибрано жодного типу, то будуть доступні всі відділення ');
define('HELP_DISCOUNT',  'Вкажіть знижку на доставку. Якщо у Вас немає знижки, залиште поле порожнім ');
define('HELP_ADDITIONAL_COMMISSION',  'Вкажіть розмір додаткової комісії, яка розраховується як відсоток від оголошеної вартості відправлення ');
define('HELP_ADDITIONAL_COMMISSION_BOTTOM', 'Вкажіть мінімальну оголошену вартість відправлення, починаючи з якої розраховуватиметься додаткова комісія ');
define('HELP_UPDATE_REGIONS',  'Буде виконано оновлення списку областей поштової компанії. Дія не вплине на стандартні області ');
define('HELP_UPDATE_CITIES',  'Буде виконано оновлення міст, до яких можлива доставка поштовою компанією. ');
define('HELP_UPDATE_WAREHOUSES', 'Буде виконано оновлення відділень поштової компанії ');
define('HELP_UPDATE_REFERENCES', 'Буде виконано оновлення довідкової та іншої інформації поштової компанії, необхідної для роботи доповнення. ');
define('HELP_SENDER',  'Виберіть відправника ');
define('HELP_SENDER_CONTACT_PERSON',  'Виберіть контактну особу ');
define('HELP_SENDER_REGION',               'Вкажіть область відправника ');
define('HELP_SENDER_CITY',               'Вкажіть область відправникаВиберіть місто, з якого буде здійснюватись відправлення замовлення ');
define('HELP_SENDER_ADDRESS',  'Виберіть адресу з якої буде надсилатися замовлення ');
define('HELP_RECIPIENT',  'Виберіть стандартного одержувача або вкажіть макроси для пошуку назви. Приклад: Приватна особа ');
define('HELP_RECIPIENT_CONTACT_PERSON',  'Вкажіть макрос для П.І.Б контактної особи. Приклад: {shipping_lastname} {shipping_firstname} ');
define('HELP_RECIPIENT_CONTACT_PERSON_PHONE', 'Вкажіть макрос для телефонного номера контактної особи. Приклад: {telephone} ');
define('HELP_RECIPIENT_REGION',        'Вкажіть макрос для області одержувача. Приклад: {shipping_zone} ');
define('HELP_RECIPIENT_CITY',               'Вкажіть макрос для одержувача міста. Приклад: {shipping_city} ');
define('HELP_RECIPIENT_WAREHOUSE',  'Вкажіть макрос відділення одержувача. Приклад: {shipping_address_1} ');
define('HELP_RECIPIENT_ADDRESS',  'Вкажіть макрос для адреси одержувача. Використовується для введення адреси доставки в одне поле з поділом через кому (вулиця, будинок, квартира). Приклад: {shipping_address_1} ');
define('HELP_RECIPIENT_STREET',  'Вкажіть макрос для одержувача вулиці. Приклад: {shipping_street} ');
define('HELP_RECIPIENT_HOUSE',  'Вкажіть макрос для одержувача будинку. Приклад: {shipping_house} ');
define('HELP_RECIPIENT_FLAT',  'Вкажіть макрос для квартири отримувача. Приклад: {shipping_flat} ');
define('HELP_PREFERRED_DELIVERY_DATE',  'Вкажіть макрос для кращої дати доставки. Приклад: {shipping_date} ');
define('HELP_PREFERRED_DELIVERY_TIME',  'Вкажіть макрос для кращого часу доставки. Приклад: {shipping_time} ');
define('HELP_AUTODETECTION_DEPARTURE_TYPE', 'Визначати тип відправлення автоматично? ');
define('HELP_DEPARTURE_TYPE',  'Вкажіть тип відправлення ');
define('HELP_CALCULATE_VOLUME',  'Враховувати об\'ємну вагу при розрахунку попередньої вартості доставки та при створенні ТТН? ');
define('HELP_CALCULATE_VOLUME_TYPE',  'Вкажіть спосіб розрахунку обсягу ');
define('HELP_SEATS_AMOUNT',               'Вкажіть кількість місць за замовчуванням. Якщо залишити поле порожнім, то кількість місць буде відповідати кількості товарів на замовлення ');
define('HELP_DECLARED_COST',             	 'Вкажіть складові для оголошеної вартості відправлення ');
define('HELP_DECLARED_COST_DEFAULT', 'Значення буде використано якщо оголошена вартість не задана або оплата на замовлення не післяплатою ');
define('HELP_DEPARTURE_DESCRIPTION',  'Використовується як опис товару за умовчанням під час створення «ЕН», зручно якщо у магазині багато товарів, які мають однаковий опис ');
define('HELP_DEPARTURE_ADDITIONAL_INFORMATION',  'Використовується як шаблон поля додаткової інформації про відправлення під час створення ТТН. Можливе застосування макросів. При використанні макросів товару розділяйте текст на два блоки символом «|» (макроси товару використовуйте у другому блоці) ');
define('HELP_USE_PARAMETERS', 'Вкажіть спосіб застосування параметрів за умовчанням (вага та габарити) ');
define('HELP_WEIGHT',  'Вкажіть фактичну вагу за промовчанням ');
define('HELP_DIMENSIONS',  'Вкажіть габаритні розміри за промовчанням ');
define('HELP_ALLOWANCE', 'Дані розміри сумуватимуться з розмірами відправлення. Можна вказувати негативні значення ');
define('HELP_PACK',  'Враховувати упаковку у вартості доставки? ');
define('HELP_PACK_TYPE',  'Вкажіть тип упаковки за промовчанням ');
define('HELP_AUTODETECTION_PACK_TYPE',  'Включити автоматичний вибір упаковки з вибраних типів? Якщо автовизначення не включено, то буде використано перший тип вибраної упаковки ');
define('HELP_DELIVERY_PAYER',               'Вкажіть платника доставки за замовчуванням ');
define('HELP_THIRD_PERSON',               'Вкажіть третю особу за замовчуванням ');
define('HELP_PAYMENT_TYPE',               'Вкажіть форму оплати за промовчанням ');
define('HELP_PAYMENT_COD',  'Вкажіть спосіб оплати який відповідає післяплаті ');
define('HELP_BACKWARD_DELIVERY',    'Вкажіть тип зворотної доставки за промовчанням ');
define('HELP_BACKWARD_DELIVERY_PAYER', 'Вкажіть платника зворотної доставки за замовчуванням ');
define('HELP_MONEY_TRANSFER_METHOD',  'Вкажіть спосіб отримання грошового переказу ');
define('HELP_DEFAULT_PAYMENT_CARD',  'Виберіть платіжну картку за промовчанням, на яку буде зараховано грошовий переказ. Карту можна додати до особистого кабінету поштової компанії ');
define('HELP_PAYMENT_CONTROL',             	 'Вкажіть складові для контролю оплати. Якщо будуть відзначені позиції, то контроль оплати замінятиме грошовий переказ. ');
define('HELP_DISPLAY_ALL_CONSIGNMENTS',  'Відображати всі накладні облікового запису поштової компанії? Якщо вибрати «Ні», відображатимуться лише ті накладні, які закріплені за замовленнями даного інтернет-магазину ');
define('HELP_DISPLAYED_INFORMATION',    'Виберіть інформацію для відображення ');
define('HELP_PRINT_FORMAT',             'Вкажіть формат друку ');
define('HELP_NUMBER_OF_COPIES',         'Вкажіть кількість копій ');
define('HELP_TEMPLATE_TYPE',            'Вкажіть тип шаблону ');
define('HELP_PRINT_TYPE',               'Вкажіть тип друку ');
define('HELP_PRINT_START',              'Вкажіть місце, з якого буде починатися друк ');
define('HELP_COMPATIBLE_SHIPPING_METHOD',    'Виберіть спосіб доставки замовлення, для якого буде доступна робота з накладною ');
define('HELP_CONSIGNMENT_CREATE',       'Включити можливість створення накладної під час перегляду замовлення? ');
define('HELP_CONSIGNMENT_EDIT',         'Включити можливість редагування накладної під час перегляду замовлення? ');
define('HELP_CONSIGNMENT_DELETE',       'Включити можливість видалення накладної під час перегляду замовлення? ');
define('HELP_CONSIGNMENT_ASSIGNMENT_TO_ORDER',   'Включити можливість присвоєння накладної під час перегляду замовлення? ');
define('HELP_KEY_CRON',  'Задайте або згенеруйте ключ ');
define('HELP_TRACKING_STATUSES',  'Виберіть статуси замовлень, для яких відстежуватиметься ');

// TEXT
define('TEXT_SELECT',     '--- Виберіть ---');
define('TEXT_SHIPPING',     'Доставка ');
define('TEXT_SETTINGS',     				    'Налаштування для магазину: ');
define('TEXT_SUCCESS_SETTINGS',      'Налаштування успішно збережено ');
define('TEXT_SUCCESS_DOWNLOAD_BASIC_SETTINGS',   'Базові налаштування успішно завантажені ');
define('TEXT_SUCCESS_IMPORT_SETTINGS',  'Налаштування успішно імпортовано ');
define('TEXT_CONTACTS', 'Контакти ');
define('TEXT_INSTRUCTION', 				    'Інструкція ');
define('TEXT_DOCUMENTATION_API', 'Документація API ');
define('TEXT_GLOBAL', 'Загальні ');
define('TEXT_WAREHOUSE', 'Доставка у відділення ');
define('TEXT_DOORS', 'Доставка кур\'єром ');
define('TEXT_POSHTOMAT', 'Доставка до пошти ');
define('TEXT_VERIFYING_API_ACCESS',     'Перевірка доступу до API ');
define('TEXT_REGIONS_UPDATING', 'Оновлення областей ');
define('TEXT_CITIES_UPDATING', 'Оновлення міст ');
define('TEXT_WAREHOUSES_UPDATING', 'Оновлення відділень ');
define('TEXT_REFERENCES_UPDATING', 'Оновлення довідкової інформації ');
define('TEXT_SAVING_SETTINGS', 'Збереження налаштувань ');
define('TEXT_IMAGE_OUTPUT_PLACE_TITLE',  'Заголовок варіантів доставки ');
define('TEXT_IMAGE_OUTPUT_PLACE_IMG_KEY',  'Елемент із ключем «img» масиву способу доставки ');
define('TEXT_PARCEL_TARIFFS',  		   'Тарифи для посилок ');
define('TEXT_UPDATE_SUCCESS',  'Дані успішно оновлено ');
define('TEXT_SUM_ALL_PRODUCTS_VOLUME',  'Сума обсягів усіх товарів ');
define('TEXT_LARGEST_PRODUCT_VOLUME',  'Об\'єм найбільшого товару ');
define('TEXT_DEFAULT_DEPARTURE_OPTIONS',  'Параметри відправлення за замовчуванням ');
define('TEXT_PRODUCTS_WITHOUT_PARAMETERS',  'Застосувати до товарів без параметрів ');
define('TEXT_ALL_PRODUCTS',  'Застосувати до кожного товару ');
define('TEXT_WHOLE_ORDER',  'Застосувати до всього замовлення ');
define('TEXT_PACK',  'Упаковка ');
define('TEXT_ON_WAREHOUSE',             'У відділенні ');
define('TEXT_TO_PAYMENT_CARD',          'На карту ');
define('TEXT_CONSIGNMENT_NOTE_LIST', 'Список накладних ');
define('TEXT_PRINT_SETTINGS', 			    'Налаштування друку ');
define('TEXT_INTEGRATION_WITH_ORDERS', 'Інтеграція із замовленнями ');
define('TEXT_BASE_UPDATE', 'Оновлення бази даних ');
define('TEXT_DEPARTURES_TRACKING', 'Відстеження відправлень ');
define('TEXT_SETTINGS_DEPARTURES_STATUSES', 	 'Налаштування статусів відправлення ');
define('TEXT_MESSAGE_TEMPLATE_MACROS', 	 'Макрос для шаблону повідомлення ');
define('TEXT_ORDER', 'Замовлення ');
define('TEXT_ORDERS', 'Усі замовлення ');
define('TEXT_FORM_CREATE', 'Створення накладної ');
define('TEXT_FORM_EDIT', 'Редагування накладної ');
define('TEXT_SENDER', 'Відправник ');
define('TEXT_RECIPIENT', 'Одержувач ');
define('TEXT_DEPARTURE_OPTIONS', 'Параметри відправлення ');
define('TEXT_PAYMENT', 'Оплата ');
define('TEXT_ADDITIONALLY', 'Додатково ');
define('TEXT_DECLARED_COST', 'Оголошена вартість: ');
define('TEXT_NO_BACKWARD_DELIVERY', 'Немає зворотної доставки ');
define('TEXT_DURING_DAY', 'На протязі дня ');
define('TEXT_CN_SUCCESS_SAVE', 'Накладна успішно збережена ');
define('TEXT_CN_SUCCESS_ASSIGNMENT', 'Накладна успішно присвоєна замовлення ');
define('TEXT_SUCCESS_DELETE', 		 'Вилучення пройшло успішно ');
define('TEXT_OR', 'або ');
define('TEXT_GRN', 'грн ');
define('TEXT_CM', 'см ');
define('TEXT_KG', 'кг ');
define('TEXT_PCT', '% ');
define('TEXT_CUBIC_METER', 'м&sup3; ');
define('TEXT_PC', 'шт ');
define('TEXT_HOUR', 'годин ');
define('TEXT_DAY', 'днів ');
define('TEXT_MONTH', 'місяців ');
define('TEXT_YEAR', 'років ');
define('TEXT_CONFIRM', 'Ви впевнені? ');
define('TEXT_MACROS',                   'Макроси ');
define('TEXT_EDIT', 					 'Редагувати ');
define('TEXT_DELETE', 'Вилучити ');
define('TEXT_ASSIGNMENT_ORDER', 'Присвоїти замовлення ');
define('TEXT_CUSTOMIZED_PRINTING', 'Налаштований друк ');
define('TEXT_DOWNLOAD_PDF', 			 'Завантажити у форматі PDF ');
define('TEXT_PRINT_HTML', 'Друк HTML ');
define('TEXT_CN', 'Накладна ');
define('TEXT_MARK', 					 'Маркування ');
define('TEXT_MARK_ZEBRA', 'Маркування «Зебра» ');
define('TEXT_MARK_ZEBRA_100_100', 'Маркування "Зебра" 100x100 ');
define('TEXT_CN_A4', 'ЭН А4 ');
define('TEXT_CN_A5', 'ЭН А5 ');
define('TEXT_HTML', 						    'HTML ');
define('TEXT_PDF', 						    'PDF ');
define('TEXT_HORIZONTALLY', 'Горизонтально ');
define('TEXT_VERTICALLY', 'Вертикально ');
define('TEXT_REDELIVERY_MONEY',         'Зі зворотною доставкою ');
define('TEXT_UNASSEMBLED_CARGO',        'Не забрані ');
define('TEXT_NO_RESULTS','Немає даних!');
define('BUTTON_FILTER','Фільтр');

// ERROR
define('ERROR_PERMISSION', 'Помилка: у Вас немає права змінювати налаштування! ');
define('ERROR_SETTINGS_SAVING',     'Помилка збереження налаштувань! ');
define('ERROR_DOWNLOAD_BASIC_SETTINGS', 'Помилка завантаження базових налаштувань! ');
define('ERROR_IMPORT_SETTINGS',         'Помилка імпорту налаштувань! ');
define('ERROR_KEY_API', 'Помилка ключа API! ');
define('ERROR_REFERENCES', 'У Вас не оновлено довідників. Будь ласка, зайдіть у налаштування Нової Пошти та оновіть усі бази.');
define('ERROR_UPDATE', 'Помилка оновлення даних! ');
define('ERROR_FIELD',  					    'Помилка під час заповнення поля! ');

define('ERROR_GET_ORDER', 'Замовлення не знайдено у базі ');
define('ERROR_GET_CN', 'Помилка завантаження накладної ');
define('ERROR_CN_SAVE',  'Не вдалося зберегти накладну ');
define('ERROR_CN_ASSIGNMENT',  'Не вдалося присвоїти накладне замовлення ');
define('ERROR_DELETE',  'Вилучення не вдалося ');
define('ERROR_SENDER',  'Відправника не знайдено. Будь ласка, виберіть зі списку ');
define('ERROR_SENDER_CONTACT_PERSON',  'Контактну особу для цього відправника не знайдено. Будь ласка, виберіть зі списку ');
define('ERROR_CITY',  'Місто не знайдено. Будь ласка, виберіть зі списку ');
define('ERROR_ADDRESS', 	 			   'Адреса не знайдено. Будь ласка, виберіть зі списку ');
define('ERROR_WAREHOUSE', 'Відділення не знайдено. Будь ласка, виберіть зі списку ');
define('ERROR_THIRD_PERSON',  'Третя особа не знайдено у базі. Будь ласка, виберіть зі списку ');
define('ERROR_FULL_NAME_CORRECT',  			 'Перевірте правильність написання прізвища, імені та по батькові. Приклад: Шевченко Тарас Григорович ');
define('ERROR_CHARACTERS',  'Заборонені символи ');
define('ERROR_PHONE',  'Неправильний формат телефонного номера. Приклад: 380501234567 ');
define('ERROR_WIDTH', 	              'Ширина має бути цілим числом не більше 35 см ');
define('ERROR_LENGTH',   	            'Довжина має бути цілим числом не більше 61 см ');
define('ERROR_HEIGHT',       	         'Висота має бути цілим числом не більше 37 см ');
define('ERROR_WEIGHT',  				 'Вага має бути дробовим або цілим числом більше 0. Коректні приклади: 7, 1.002 ');
define('ERROR_VOLUME',  				 'Обсяг має бути дробовим або цілим числом більше 0. Коректні приклади: 7, 1.002 ');
define('ERROR_SEATS_AMOUNT',  'Кількість місць має бути цілим числом більше 0 ');
define('ERROR_SUM',                     'Сума має бути дробовим або цілим числом більше 0. Коректні приклади: 700, 100.5');
define('ERROR_DEPARTURE_DESCRIPTION', 	 'Опис відправлення має складатися не менше ніж із 3-х символів і мати сенс ');
define('ERROR_DATE', 'Неправильний формат дати. Коректний приклад: 24.07.2014 ');
define('ERROR_DATE_PAST', 'Дата не може бути в минулому ');
define('ERROR_DEPARTURE_ADDITIONAL_INFORMATION', 'Додаткова інформація про відправлення не може перевищувати 100 символів ');