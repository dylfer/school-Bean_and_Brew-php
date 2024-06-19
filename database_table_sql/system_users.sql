CREATE TABLE `system_users` (
  `account_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `access` ENUM('staff', 'manager', 'admin') NOT NULL,
  `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` DATETIME,
  `status` ENUM('active', 'suspended', 'deleted') NOT NULL DEFAULT 'active',
  `status_change` `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `computers_access` TEXT,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;