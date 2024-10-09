CREATE TABLE `users`
  (
     `id`         INT(11) NOT NULL auto_increment,
     `username`   VARCHAR(50) NOT NULL,
     `email`      VARCHAR(100) NOT NULL,
     `password`   VARCHAR(255) NOT NULL,
     `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
     `token_secret`      VARCHAR(255) NOT NULL,
     PRIMARY KEY (`id`),
     UNIQUE KEY `username` (`username`),
     UNIQUE KEY `email` (`email`)
  )
engine=innodb
DEFAULT charset=utf8; 