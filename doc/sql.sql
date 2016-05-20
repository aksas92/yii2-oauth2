CREATE TABLE `oauth_clients` (
  `id` varchar(40) NOT NULL,
  `secret` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_secret` (`id`,`secret`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `oauth_client_profile` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(40) NOT NULL,
  `redirect_uri` varchar(255) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_id` (`client_id`,`redirect_uri`)
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

CREATE TABLE `oauth_scopes` (
  `id` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `oauth_client_scopes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(40) NOT NULL,
  `scope_id` varchar(40) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `scope_id` (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `oauth_grant_scopes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `grant_id` varchar(40) NOT NULL,
  `scope_id` varchar(40) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grant_id` (`grant_id`),
  KEY `scope_id` (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(255) NOT NULL,
  `expire_time` int NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `client_id` varchar(40) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `oauth_access_token_scopes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `access_token_id` varchar(255) NOT NULL,
  `scope_id` varchar(40) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `access_token_id` (`access_token_id`),
  KEY `scope_id` (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(255) NOT NULL,
  `access_token_id` varchar(255) NOT NULL,
  `expire_time` int(11) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`access_token_id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `oauth_user_scopes` (
  `id`  int NOT NULL AUTO_INCREMENT ,
  `user_id`  varchar(255) NOT NULL ,
  `scope_id`  varchar(40) NOT NULL ,
  `created_at`  int NOT NULL ,
  `updated_at`  int NOT NULL ,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_scope_id` (`user_id`,`scope_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `oauth_auth_codes` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `client_id` varchar(40) NOT NULL,
  `expire_time` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `oauth_auth_code_scopes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `auth_code_id` varchar(255) NOT NULL,
  `scope_id` varchar(40) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_code_id` (`auth_code_id`),
  KEY `scope_id` (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
