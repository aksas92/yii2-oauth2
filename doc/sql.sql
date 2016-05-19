CREATE TABLE `oauth_clients` (
  `id` varchar(40) NOT NULL,
  `secret` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_secret` (`id`,`secret`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `oauth_client_grants` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(40) NOT NULL,
  `grant_id` varchar(40)  NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `grant_id` (`grant_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `oauth_grants` (
  `id` varchar(40) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;


