CREATE TABLE `baking_bookings` (
  `booking_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11),
  `name` VARCHAR(50) NOT NULL,
  `booking_date` DATE NOT NULL,
  `booking_time` TIME NOT NULL,
  `baking_location` VARCHAR(100) NOT NULL,
  `items` TEXT NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `booking_status` ENUM('pending', 'confirmed', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` DATETIME,
  `notes` TEXT,
  PRIMARY KEY (`booking_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;