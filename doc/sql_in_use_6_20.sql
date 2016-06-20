/*
Navicat MySQL Data Transfer

Source Server         : 虚拟机vmware_mysql
Source Server Version : 50621
Source Host           : 192.168.163.128:3306
Source Database       : bmsys_oauth2

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-06-20 17:21:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pre_oauth_access_token_scopes
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_access_token_scopes`;
CREATE TABLE `pre_oauth_access_token_scopes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `access_token_id` varchar(255) NOT NULL,
  `scope_id` varchar(40) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `access_token_id` (`access_token_id`),
  KEY `scope_id` (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_access_tokens`;
CREATE TABLE `pre_oauth_access_tokens` (
  `id` varchar(255) NOT NULL,
  `expire_time` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `client_id` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_auth_code_scopes
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_auth_code_scopes`;
CREATE TABLE `pre_oauth_auth_code_scopes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auth_code_id` varchar(255) NOT NULL,
  `scope_id` varchar(40) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_code_id` (`auth_code_id`),
  KEY `scope_id` (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_auth_codes`;
CREATE TABLE `pre_oauth_auth_codes` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `client_id` varchar(40) NOT NULL,
  `expire_time` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_client_grants
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_client_grants`;
CREATE TABLE `pre_oauth_client_grants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(40) NOT NULL,
  `grant_id` varchar(40) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `grant_id` (`grant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_client_profile
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_client_profile`;
CREATE TABLE `pre_oauth_client_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(40) NOT NULL,
  `redirect_uri` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_id` (`client_id`,`redirect_uri`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_client_scopes
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_client_scopes`;
CREATE TABLE `pre_oauth_client_scopes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(40) NOT NULL,
  `scope_id` varchar(40) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `scope_id` (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_clients`;
CREATE TABLE `pre_oauth_clients` (
  `id` varchar(40) NOT NULL,
  `secret` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `oauth_clients_id_secret_unique` (`id`,`secret`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_grant_scopes
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_grant_scopes`;
CREATE TABLE `pre_oauth_grant_scopes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grant_id` varchar(40) NOT NULL,
  `scope_id` varchar(40) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grant_id` (`grant_id`),
  KEY `scope_id` (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_grants
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_grants`;
CREATE TABLE `pre_oauth_grants` (
  `id` varchar(40) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_refresh_tokens`;
CREATE TABLE `pre_oauth_refresh_tokens` (
  `id` varchar(255) NOT NULL,
  `access_token_id` varchar(255) NOT NULL,
  `expire_time` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`access_token_id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_scopes
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_scopes`;
CREATE TABLE `pre_oauth_scopes` (
  `id` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_user_clients
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_user_clients`;
CREATE TABLE `pre_oauth_user_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `client_id` varchar(40) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_client_id` (`user_id`,`client_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_user_grants
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_user_grants`;
CREATE TABLE `pre_oauth_user_grants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `grant_id` varchar(40) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_grant_id` (`user_id`,`grant_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_oauth_user_scopes
-- ----------------------------
DROP TABLE IF EXISTS `pre_oauth_user_scopes`;
CREATE TABLE `pre_oauth_user_scopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `scope_id` varchar(40) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_scope_id` (`user_id`,`scope_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_users
-- ----------------------------
DROP TABLE IF EXISTS `pre_users`;
CREATE TABLE `pre_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
