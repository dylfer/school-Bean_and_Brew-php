CREATE TABLE `clients` (
  `session_id` VARCHAR(36) NOT NULL,
  `previous_session_id` VARCHAR(36) DEFAULT NULL,
  `previous_client_id` VARCHAR(36) DEFAULT NULL,
  `client_id` VARCHAR(36) NOT NULL , -- user/ device, caried over when session expires
  `user_id` INT(11),
  `login_status` BOOLEAN DEFAULT FALSE,
  `token` VARCHAR(255) DEFAULT NULL,
  `pages` TEXT,-- This will store the pages that the user has visited
  `last_request` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- / last updated 
  `save_data` TEXT,
  `ip_address` VARCHAR(45),
  `malicious_level` INT(11) DEFAULT 0, 
  `ban_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- / time when the user is banned
  `user_agent` VARCHAR(255),
  PRIMARY KEY (`session_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;