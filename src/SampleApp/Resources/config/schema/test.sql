-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- Palvelin: localhost
-- Luontiaika: 07.07.2010 klo 17:21
-- Palvelimen versio: 5.1.47
-- PHP:n versio: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Tietokanta: 'test'
--

-- --------------------------------------------------------

--
-- Rakenne taululle 'accounts'
--

CREATE TABLE accounts (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  number varchar(50) DEFAULT NULL,
  user_id int(11) NOT NULL,
  amount decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (id),
  UNIQUE KEY number (number)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Vedos taulusta 'accounts'
--

INSERT INTO accounts (id, `name`, number, user_id, amount) VALUES
(1, 'Välimäki Risto, savings account', '123456-123', 1, 562.80),
(2, 'Välimäki Risto or Elina, another account', '313313-313', 1, 93.59),
(3, 'Nokia Oyj', '654321-321', 2, 23235327.94),
(4, 'Vaisala Industries', '111111-111', 3, 3423450.30);

-- --------------------------------------------------------

--
-- Rakenne taululle 'saves_accounts'
--

CREATE TABLE saves_accounts (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  number varchar(50) DEFAULT NULL,
  user_id int(11) NOT NULL,
  amount decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (id),
  UNIQUE KEY number (number)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Vedos taulusta 'saves_accounts'
--

INSERT INTO saves_accounts (id, `name`, number, user_id, amount) VALUES
(1, 'tupu, savings account', '555555-555', 1, 562.80),
(2, 'tupu, another account', '666666-666', 1, 93.59),
(3, 'supu', '777777-777', 2, 23235327.94),
(4, 'mr. ñandú', '999999-999', 3, 3423450.30);

-- --------------------------------------------------------

--
-- Rakenne taululle 'mobile_accounts'
--

CREATE TABLE mobile_accounts (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  number varchar(50) DEFAULT NULL,
  user_id int(11) NOT NULL,
  amount decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (id),
  UNIQUE KEY number (number)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Vedos taulusta 'mobile_accounts'
--

INSERT INTO mobile_accounts (id, `name`, number, user_id, amount) VALUES
(1, 'Välimäki Risto', '+34666666666', 1, 11.01),
(2, 'tupu personal phone', '+34690050505', 2, 27.94),
(3, 'supu personal phone', '+34900000000', 3, 30.30),
(4, 'tupu office phone', '+3469999999998', 2, 270.04),
(5, 'supu office phone', '+3469999999999', 3, 350.90);

-- --------------------------------------------------------

--
-- Rakenne taululle 'transfers'
--

CREATE TABLE transfers (
  id int(11) NOT NULL AUTO_INCREMENT,
  source_account_number varchar(50) NOT NULL,
  destination_account_number varchar(50) NOT NULL,
  user_id int(11) NOT NULL,
  amount decimal(15,2) NOT NULL DEFAULT '0.00',
  created datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Vedos taulusta 'transfers'
--

INSERT INTO transfers (id, source_account_number, destination_account_number, user_id, amount, created) VALUES
(12, '123456-123', '313313-313', 1, 10.00, '2010-07-07 12:32:41'),
(14, '123456-123', '313313-313', 1, 10.00, '2010-07-07 12:32:45'),
(15, '313313-313', '123456-123', 1, 50.00, '2010-07-07 12:33:55'),
(17, '123456-123', '123456-123', 1, 34.00, '2010-07-07 12:43:07'),
(19, '123456-123', '123456-123', 1, 123.00, '2010-07-07 12:51:14'),
(21, '123456-123', '654321-321', 1, 12.00, '2010-07-07 12:55:33'),
(23, '123456-123', '313313-313', 1, 44.00, '2010-07-07 13:13:31'),
(25, '123456-123', '313313-313', 1, 2.00, '2010-07-07 13:37:44'),
(26, '123456-123', '313313-313', 1, 12.34, '2010-07-07 13:59:38');