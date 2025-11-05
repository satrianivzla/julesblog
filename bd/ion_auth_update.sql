-- Ion Auth Schema Update
-- Adds the forgotten_password_selector and remember_selector fields to the users table.

ALTER TABLE `users`
  ADD `forgotten_password_selector` varchar(40) DEFAULT NULL AFTER `forgotten_password_code`,
  ADD `remember_selector` varchar(40) DEFAULT NULL AFTER `remember_code`;
