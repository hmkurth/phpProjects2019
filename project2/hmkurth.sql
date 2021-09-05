-- Adminer 4.7.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `exercise_log`;
CREATE TABLE `exercise_log` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) DEFAULT NULL,
  `dateOfExercise` date NOT NULL,
  `type` varchar(60) NOT NULL,
  `time_in_minutes` int(3) NOT NULL,
  `heartrate` int(3) NOT NULL,
  `calories` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `exercise_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `exercise_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `exercise_log` (`id`, `user_id`, `dateOfExercise`, `type`, `time_in_minutes`, `heartrate`, `calories`) VALUES
(1,	NULL,	'2020-04-02',	'Zumba',	52,	102,	437),
(2,	2,	'2020-04-02',	'Zumba',	52,	102,	437),
(3,	2,	'2020-04-02',	'Walking',	25,	67,	78),
(4,	2,	'2020-05-01',	'Yoga',	52,	102,	437),
(5,	2,	'2020-04-02',	'Running',	25,	67,	78),
(6,	2,	'2020-04-02',	'Running',	25,	67,	78)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `dateOfExercise` = VALUES(`dateOfExercise`), `type` = VALUES(`type`), `time_in_minutes` = VALUES(`time_in_minutes`), `heartrate` = VALUES(`heartrate`), `calories` = VALUES(`calories`);

DROP TABLE IF EXISTS `exercise_user`;
CREATE TABLE `exercise_user` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(3) DEFAULT 'M',
  `birthdate` date DEFAULT NULL,
  `weight` int(4) DEFAULT '200',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `exercise_user` (`id`, `username`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `weight`) VALUES
(1,	'marion',	'46dcd4dd65b63d106b8cfb4aad906b23716cc613',	'\" \"',	'\" \"',	'M',	'2020-05-01',	200),
(2,	'hkurth',	'75597083827060bd3c1262a6ecf3c4c41e91fb9c',	'Heather',	'Kurth',	'F',	'1981-01-06',	200),
(3,	'suzy Q',	'46dcd4dd65b63d106b8cfb4aad906b23716cc613',	NULL,	NULL,	'M',	NULL,	200),
(4,	'drea',	'1a3e692a445e60ba746fe25e2ec189710a4b4ca4',	'andrea',	'marks',	'F',	'1998-01-25',	200),
(5,	'lou',	'12de88176aaf800ac5839fdff2d0fb45a655c833',	'jim',	'dunce',	'M',	'2001-02-02',	200)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `username` = VALUES(`username`), `password` = VALUES(`password`), `first_name` = VALUES(`first_name`), `last_name` = VALUES(`last_name`), `gender` = VALUES(`gender`), `birthdate` = VALUES(`birthdate`), `weight` = VALUES(`weight`);

INSERT INTO `fullname` (`first_name`, `last_name`) VALUES
('Heather',	'Kurth')
ON DUPLICATE KEY UPDATE `first_name` = VALUES(`first_name`), `last_name` = VALUES(`last_name`);

INSERT INTO `mismatch_user` (`user_id`, `username`, `password`, `join_date`, `first_name`, `last_name`, `gender`, `birthdate`, `city`, `state`, `picture`) VALUES
(1,	'',	'',	'2008-06-03 14:51:46',	'Sidney',	'Kelsow',	'F',	'1984-07-19',	'Tempe',	'AZ',	'sidneypic.jpg'),
(2,	'',	'',	'2008-06-03 14:52:09',	'Nevil',	'Johansson',	'M',	'1973-05-13',	'Reno',	'NV',	'nevilpic.jpg'),
(3,	'',	'',	'2008-06-03 14:53:05',	'Alex',	'Cooper',	'M',	'1974-09-13',	'Boise',	'ID',	'alexpic.jpg'),
(4,	'',	'',	'2008-06-03 14:58:40',	'Susannah',	'Daniels',	'F',	'1977-02-23',	'Pasadena',	'CA',	'susannahpic.jpg'),
(5,	'',	'',	'2008-06-03 15:00:37',	'Ethel',	'Heckel',	'F',	'1943-03-27',	'Wichita',	'KS',	'ethelpic.jpg'),
(6,	'',	'',	'2008-06-03 15:00:48',	'Oscar',	'Klugman',	'M',	'1968-06-04',	'Providence',	'RI',	'oscarpic.jpg'),
(7,	'',	'',	'2008-06-03 15:01:08',	'Belita',	'Chevy',	'F',	'1975-07-08',	'El Paso',	'TX',	'belitapic.jpg'),
(8,	'',	'',	'2008-06-03 15:01:19',	'Jason',	'Filmington',	'M',	'1969-09-24',	'Hollywood',	'CA',	'jasonpic.jpg'),
(9,	'',	'',	'2008-06-03 15:01:51',	'Dierdre',	'Pennington',	'F',	'1970-04-26',	'Cambridge',	'MA',	'dierdrepic.jpg'),
(10,	'',	'',	'2008-06-03 15:02:02',	'Paul',	'Hillsman',	'M',	'1964-12-18',	'Charleston',	'SC',	'paulpic.jpg'),
(11,	'',	'',	'2008-06-03 15:02:13',	'Johan',	'Nettles',	'M',	'1981-11-03',	'Athens',	'GA',	'johanpic.jpg'),
(12,	'jimi',	'2aa36f17507f2c75df2e24aa63c7dabcaf86926e',	'2020-03-04 17:11:23',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(13,	'marion',	'6b3799be4300e44489a08090123f3842e6419da5',	'2020-03-05 20:37:34',	'frannie',	'rool',	'F',	'2004-11-11',	'parkuy',	'WY',	'alexpic.jpg'),
(14,	'girl',	'64875fcccaac069fcb3e0e201e7d5b9166641608',	'2020-03-05 20:48:14',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(15,	'girl2',	'46dcd4dd65b63d106b8cfb4aad906b23716cc613',	'2020-03-05 20:56:41',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(16,	'fib',	'46dcd4dd65b63d106b8cfb4aad906b23716cc613',	'2020-03-05 21:03:13',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(17,	'bobber',	'0fd0bcfb44f83e7d5ac7a8922578276b9af48746',	'2020-03-06 20:02:48',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(18,	'terry',	'd963074197bfa8a7b80412d7d354f89feeecd463',	'2020-03-07 16:01:22',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(19,	'suzy Q',	'16a0fb48706cbd9445856412ef99589b85e5e03c',	'2020-03-07 19:36:35',	'suzy',	'Q',	'F',	'1956-12-31',	'weyauwega',	'mn',	'susannahpic.jpg')
ON DUPLICATE KEY UPDATE `user_id` = VALUES(`user_id`), `username` = VALUES(`username`), `password` = VALUES(`password`), `join_date` = VALUES(`join_date`), `first_name` = VALUES(`first_name`), `last_name` = VALUES(`last_name`), `gender` = VALUES(`gender`), `birthdate` = VALUES(`birthdate`), `city` = VALUES(`city`), `state` = VALUES(`state`), `picture` = VALUES(`picture`);

-- 2020-04-05 23:06:42
