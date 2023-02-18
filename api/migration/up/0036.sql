UPDATE  customers SET customers_dob = '1970-01-01 00:00:00' WHERE customers_dob = '0000-00-00 00:00:00';
ALTER TABLE customers
    ADD COLUMN customers_trylog_date datetime DEFAULT CURRENT_TIMESTAMP AFTER telegram_chat_id,
    ADD COLUMN customers_try_count int(11) NOT NULL DEFAULT '0' AFTER customers_trylog_date;