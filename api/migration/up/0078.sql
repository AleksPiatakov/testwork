UPDATE `email_content` SET
    `subject` = 'Order Process #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '1';

UPDATE `email_content` SET
    `subject` = 'Order Process #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '2';

UPDATE `email_content` SET
    `subject` = 'Ваш заказ #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '3';

UPDATE `email_content` SET
    `subject` = 'Ваше замовлення #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '5';

UPDATE `email_content` SET
    `subject` = 'Διαδικασία παραγγελίας #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '8';

UPDATE `email_content` SET
    `subject` = 'Ihre Bestellung #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '9';

UPDATE `email_content` SET
    `subject` = 'Orden en proceso #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '11';

UPDATE `email_content` SET
    `subject` = 'Twoje zamówienie #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '12';

UPDATE `email_content` SET
    `subject` = 'Bestelproces #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '15';

UPDATE `email_content` SET
    `subject` = 'Processus de commande #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '16';

UPDATE `email_content` SET
    `subject` = 'Order Process #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '17';

UPDATE `email_content` SET
    `subject` = 'Ваш заказ #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '18';

UPDATE `email_content` SET
    `subject` = 'Order Process #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` = '19';

UPDATE `email_content` SET
    `subject` = 'Order Process #{ORDER_NUMBER}'
WHERE `email_name` LIKE '%create_order%' and `language_id` IN ('20', '21', '22', '23', '24', '25');
