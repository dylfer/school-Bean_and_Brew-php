CREATE TABLE `clients` (
  `client_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11),
  `session_id` VARCHAR(36),
  `login_status` BOOLEAN DEFAULT FALSE,
  `pages` TEXT,-- This will store the pages that the user has visited
  `last_request` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `save_data` TEXT,
  `ip_address` VARCHAR(45),
  `user_agent` VARCHAR(255),
  PRIMARY KEY (`client_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;