CREATE TABLE `bakery` (
  `bakery_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11),
  `name` VARCHAR(50) NOT NULL,
  `type`: ENUM('booking', 'order') NOT NULL,

  `booking_date` DATE,
  `booking_time` TIME,
  `baking_location` VARCHAR(100) ,
  `booking_status` ENUM('pending', 'confirmed', 'completed', 'cancelled')  DEFAULT 'pending',

  `items` TEXT,
  `price` DECIMAL(10, 2),
  
  `notes` TEXT,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;