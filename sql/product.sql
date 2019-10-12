SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `tradename` varchar(255) DEFAULT NULL,
  `productname` varchar(255) NOT NULL,
  `productnumber` varchar(45) DEFAULT NULL,
  KEY `vsoenumber` (`productnumber`),
  KEY `productname` (`productname`),
  KEY `tradename` (`tradename`),
  FULLTEXT KEY `vsoe_fulltext` (`productnumber`,`productname`,`tradename`),
  FULLTEXT KEY `vsoe_fulltextvsoenumber` (`productnumber`),
  FULLTEXT KEY `vsoe_fulltextproductname` (`productname`),
  FULLTEXT KEY `vsoe_fulltexttradename` (`tradename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;