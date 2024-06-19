CREATE TABLE `coffee_orders` (
  `order_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11),
  `order_collection_date` DATE NOT NULL,
  `order_collection_time` TIME NOT NULL,
  `coffee_shop_location` VARCHAR(100) NOT NULL,
  `items` TEXT NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `order_status` ENUM('pending', 'preparing', 'ready', 'collected') NOT NULL DEFAULT 'pending',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` DATETIME,
  `notes` TEXT,
  PRIMARY KEY (`order_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;