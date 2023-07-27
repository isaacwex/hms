-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2022 at 06:23 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hms`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `split_str`(`X` VARCHAR(255), `delim` VARCHAR(12), `pos` INT) RETURNS varchar(500) CHARSET latin1
RETURN replace(SUBSTRING(SUBSTRING_INDEX(
    x, delim, pos), CHAR_LENGTH(SUBSTRING_INDEX(x, delim, pos-1))+ 1),
               delim, '')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_table`
--

CREATE TABLE IF NOT EXISTS `log_table` (
`log_id` int(11) NOT NULL,
  `user_id_no` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messagein`
--

CREATE TABLE IF NOT EXISTS `messagein` (
`Id` int(11) NOT NULL,
  `SendTime` datetime DEFAULT NULL,
  `ReceiveTime` datetime DEFAULT NULL,
  `MessageFrom` varchar(80) DEFAULT NULL,
  `MessageTo` varchar(80) DEFAULT NULL,
  `SMSC` varchar(80) DEFAULT NULL,
  `MessageText` text,
  `MessageType` varchar(80) DEFAULT NULL,
  `MessageParts` int(11) DEFAULT NULL,
  `MessagePDU` text,
  `Gateway` varchar(80) DEFAULT NULL,
  `UserId` varchar(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messagein`
--

INSERT INTO `messagein` (`Id`, `SendTime`, `ReceiveTime`, `MessageFrom`, `MessageTo`, `SMSC`, `MessageText`, `MessageType`, `MessageParts`, `MessagePDU`, `Gateway`, `UserId`) VALUES
(3, '2016-12-22 14:07:15', NULL, '+254710222222', '+254724594418', NULL, 'haeeeeeeeeeey', NULL, NULL, NULL, NULL, NULL),
(4, '2016-12-22 20:34:47', NULL, 'Safaricom', '+254724594418', NULL, 'Error on line 1', NULL, NULL, NULL, NULL, NULL),
(5, '2016-12-22 20:35:58', NULL, 'Safaricom', '+254724594418', NULL, 'Current Data Balance: 0MB.', NULL, NULL, NULL, NULL, NULL),
(6, '2016-12-22 20:51:21', NULL, 'Safaricom', '+254724594418', NULL, 'Current Data Balance: 0MB.', NULL, NULL, NULL, NULL, NULL),
(7, '2016-12-22 21:27:47', NULL, '+254702847413', '+254724594418', NULL, 'Say', NULL, NULL, NULL, NULL, NULL),
(8, '2016-12-22 14:07:15', NULL, '+254729522550', '+254724594418', NULL, 'hi?', NULL, NULL, NULL, NULL, NULL),
(9, '2016-12-23 09:18:55', NULL, '+254729522550', '+254724594418', NULL, 'vvb', NULL, NULL, NULL, NULL, NULL),
(28, '2017-01-05 08:43:46', '2017-01-05 10:32:09', '+254729522550', '+254724594418', NULL, 'xaxa?', NULL, NULL, NULL, NULL, NULL),
(29, '2017-01-05 10:29:03', '2017-01-05 10:32:09', '+254729522550', '+254724594418', NULL, 'gvv', NULL, NULL, NULL, NULL, NULL),
(30, '2017-01-05 10:48:26', '2017-01-05 10:55:55', '+254729522550', '+254724594418', NULL, 'EWWW', NULL, NULL, NULL, NULL, NULL),
(31, '2017-01-05 10:52:51', '2017-01-05 10:55:55', '+254729522550', '+254724594418', NULL, 'YHO', NULL, NULL, NULL, NULL, NULL),
(32, '2017-01-05 10:52:51', '2017-01-05 10:55:55', '+254729522550', '+254724594418', NULL, 'jjjjjjjjjjjjjjjjjjjjajaaaaaaaaaaaaaaaaa', NULL, NULL, NULL, NULL, NULL),
(33, '2017-01-05 10:52:51', '2017-01-05 10:55:55', '+254729522550', '+254724594418', NULL, 'jjjjjjjjjjjjaaaaaaaaa', NULL, NULL, NULL, NULL, NULL),
(34, '2017-01-05 10:56:44', '2017-01-05 23:15:50', '+254729522550', '+254724594418', NULL, 'EE', NULL, NULL, NULL, NULL, NULL),
(35, '2017-01-05 23:22:04', '2017-01-06 08:16:33', '+254729522550', '+254724594418', NULL, 'iiuu', NULL, NULL, NULL, NULL, NULL),
(36, '2017-01-06 08:20:51', '2017-01-06 08:21:16', '+254729522550', '+254724594418', NULL, 'hirrr', NULL, NULL, NULL, NULL, NULL),
(37, '2017-01-06 08:21:58', '2017-01-06 08:22:28', '+254729522550', '+254724594418', NULL, 'wow!!!! its awesome!!!!', NULL, NULL, NULL, NULL, NULL),
(38, '2017-01-06 08:22:41', '2017-01-06 08:23:04', '+254729522550', '+254724594418', NULL, 'guyyyy', NULL, NULL, NULL, NULL, NULL),
(39, '2017-01-06 08:36:52', '2017-01-06 08:37:15', '+254729522550', '+254724594418', NULL, 'pppppfvbb', NULL, NULL, NULL, NULL, NULL),
(40, '2017-01-06 10:45:35', '2017-01-06 10:48:04', '+254729522550', '+254724594418', NULL, 'wwww', NULL, NULL, NULL, NULL, NULL),
(41, '2017-01-06 10:51:47', '2017-01-06 10:52:13', '+254729522550', '+254724594418', NULL, 'jhbbhhhhhuhhh', NULL, NULL, NULL, NULL, NULL),
(42, '2017-01-06 10:52:21', '2017-01-06 10:52:44', '+254729522550', '+254724594418', NULL, 'pp', NULL, NULL, NULL, NULL, NULL),
(43, '2017-01-06 10:52:58', '2017-01-06 10:53:50', '+254729522550', '+254724594418', NULL, 'pplllllllll', NULL, NULL, NULL, NULL, NULL),
(44, '2017-01-06 10:55:44', '2017-01-06 10:56:19', '+254729522550', '+254724594418', NULL, 'uu', NULL, NULL, NULL, NULL, NULL),
(45, '2016-12-22 14:07:15', NULL, '+254711222236', '+254724594418', NULL, 'hi?', NULL, NULL, NULL, NULL, NULL),
(46, '2016-12-22 14:07:15', NULL, '+254711222236', '+254724594418', NULL, 'hi?', NULL, NULL, NULL, NULL, NULL),
(47, '2016-12-22 14:07:15', NULL, '+254710222222', '+254724594418', NULL, 'haeeeeeeeeeey', NULL, NULL, NULL, NULL, NULL),
(48, '2016-12-22 14:07:15', NULL, '+254729522550', '+254724594418', NULL, 'hi?', NULL, NULL, NULL, NULL, NULL),
(49, '2017-01-07 21:27:38', '2017-01-07 21:28:09', '+254729522550', '+254724594418', NULL, 'hhg', NULL, NULL, NULL, NULL, NULL),
(50, '2017-01-08 11:15:21', '2017-01-08 16:30:23', '+254796703820', '+254724594418', NULL, 'Congratulations! from LOTTO K24 live,you''re the lucky winner of KSH 100,000.call us(0780001073)for more imformation.NB:DO NOT PAY ANYTHING......', NULL, NULL, NULL, NULL, NULL),
(51, '2017-01-09 08:02:13', '2017-01-09 08:02:39', '+254729522550', '+254724594418', NULL, 'hi msheshimiwa', NULL, NULL, NULL, NULL, NULL),
(52, '2017-01-09 08:02:36', '2017-01-09 08:03:05', '+254729522550', '+254724594418', NULL, 'hyg', NULL, NULL, NULL, NULL, NULL),
(53, '2017-01-09 08:12:23', '2017-01-09 08:12:53', '+254729522550', '+254724594418', NULL, 'knjj', NULL, NULL, NULL, NULL, NULL),
(54, '2017-01-09 08:13:17', '2017-01-09 08:13:43', '+254729522550', '+254724594418', NULL, 'h', NULL, NULL, NULL, NULL, NULL),
(55, '2017-01-09 09:25:29', '2017-01-09 10:07:30', '+254729522550', '+254724594418', NULL, 't', NULL, NULL, NULL, NULL, NULL),
(56, '2017-01-09 10:04:56', '2017-01-09 10:07:30', '+254729522550', '+254724594418', NULL, 'we', NULL, NULL, NULL, NULL, NULL),
(57, '2017-01-09 10:05:48', '2017-01-09 10:07:30', '+254729522550', '+254724594418', NULL, 'koioikk', NULL, NULL, NULL, NULL, NULL),
(58, '2017-01-09 10:42:24', '2017-01-09 10:42:51', '+254729522550', '+254724594418', NULL, 'okey', NULL, NULL, NULL, NULL, NULL),
(59, '2017-01-09 10:57:31', '2017-01-09 10:57:58', '+254713521702', '+254724594418', NULL, 'Hae', NULL, NULL, NULL, NULL, NULL),
(60, '2017-01-09 13:03:08', '2017-01-09 13:07:34', '+254716326634', '+254724594418', NULL, 'Test', NULL, NULL, NULL, NULL, NULL),
(61, '2017-01-09 13:08:16', '2017-01-09 13:08:44', '+254729522550', '+254724594418', NULL, 'trying', NULL, NULL, NULL, NULL, NULL),
(62, '2017-01-09 15:27:37', '2017-01-09 15:28:05', '+254729522550', '+254724594418', NULL, 'y', NULL, NULL, NULL, NULL, NULL),
(63, '2017-01-12 16:00:17', '2017-01-12 16:01:14', '+254729522550', '+254724594418', NULL, 'tttt', NULL, NULL, NULL, NULL, NULL),
(64, '2021-01-06 10:55:44', '2021-01-06 10:56:19', '+254729522550', '+254724594418', NULL, 'uu', NULL, NULL, NULL, NULL, NULL),
(65, '2021-07-12 11:30:06', NULL, '+254729522550', '+254759535121', NULL, 'Who r u?', NULL, NULL, NULL, NULL, NULL),
(66, '2021-07-12 11:30:34', NULL, '+254727459357', '+254759535121', NULL, 'Ye yes', NULL, NULL, NULL, NULL, NULL),
(67, '2021-07-12 11:54:17', NULL, '+254731707223', '+254759535121', NULL, 'Noted', NULL, NULL, NULL, NULL, NULL),
(68, '2021-07-13 14:09:06', NULL, 'Safaricom', '+254759535121', NULL, 'Your subscription to the 200 SMS Daily Bundle service has been renewed for 10.00 KSH.', NULL, NULL, NULL, NULL, NULL),
(69, '2021-07-13 14:09:06', NULL, 'Safaricom', '+254759535121', NULL, 'You have received 200 SMS Daily SMS Bundle.  Expiry date: 14/07/2021 02:08PM.', NULL, NULL, NULL, NULL, NULL),
(70, '2021-07-13 14:12:23', NULL, '+254700540004', '+254759535121', NULL, 'Kitu Yoyote', NULL, NULL, NULL, NULL, NULL),
(71, '2021-07-14 21:01:06', NULL, 'Safaricom', '+254759535121', NULL, 'This service is available to Postpaid customers only, send your query to 100. Thank you for staying connected to the better option.', NULL, NULL, NULL, NULL, NULL),
(72, '2021-07-14 21:08:06', NULL, 'Safaricom', '+254759535121', NULL, 'Dear Customer, you have depleted your Bonus Airtime. Top up tomorrow with at least Ksh 20 and enjoy 50% Bonus Airtime.', NULL, NULL, NULL, NULL, NULL),
(73, '2021-07-14 21:14:11', NULL, '+254700540004', '+254759535121', NULL, 'Thanks Mhesh, Madende kuna Shida lakini', NULL, NULL, NULL, NULL, NULL),
(74, '2021-07-14 21:22:01', NULL, '+254768017555', '+254759535121', NULL, 'Ujumbe umefika ndugu zangu, maendeleo na mheshimiwa sakwa katika Busia yetu', NULL, NULL, NULL, NULL, NULL),
(75, '2021-07-14 21:26:25', NULL, 'safaricom', '+254759535121', NULL, 'The destination address 07127447780 is unknown. Please check and try again.', NULL, NULL, NULL, NULL, NULL),
(76, '2021-07-14 21:26:28', NULL, 'safaricom', '+254759535121', NULL, 'The destination address 07127447780 is unknown. Please check and try again.', NULL, NULL, NULL, NULL, NULL),
(77, '2021-07-14 21:32:43', NULL, '+254768017555', '+254759535121', NULL, 'Kindly note all the concerns & email him to isaacwex@gmail.com\r\nBest regards..', NULL, NULL, NULL, NULL, NULL),
(78, '2021-07-14 20:45:11', NULL, 'Safaricom', '+254759535121', NULL, ' simply dial *544# and select 0!', NULL, NULL, NULL, NULL, NULL),
(79, '2021-07-14 20:59:35', NULL, 'Safaricom', '+254759535121', NULL, 'Airtime Bal: 50.00KSH.Expire date:12-10-2021, Calls & SMS Airtime Bal 75.00 KSH.No Expiry. Tariff:Uwezo . Get the DATA DEAL OF THE DAY! simply dial *544#', NULL, NULL, NULL, NULL, NULL),
(80, '2021-07-15 11:17:54', NULL, '+254726322014', '+254759535121', NULL, 'I tried to call you at 15-07-21 07:31. Call for less than 1 bob per minute today.  Dial  *444# and select 2 (Buy Minutes).', NULL, NULL, NULL, NULL, NULL),
(81, '2021-07-15 11:31:10', NULL, 'Safaricom', '+254759535121', NULL, 'Dear customer, your No Expiry Airtime and SMS balance is currently below Ksh 10. Dial *544*2*Amount# to get 50% Extra Airtime!', NULL, NULL, NULL, NULL, NULL),
(82, '2021-07-15 11:31:35', NULL, 'Safaricom', '+254759535121', NULL, 'Dear customer, your No Expiry Airtime and SMS balance is currently at Ksh 0. Dial *544*2*Amount# to get 50% Extra Airtime!', NULL, NULL, NULL, NULL, NULL),
(83, '2021-07-20 16:53:19', NULL, 'Safaricom', '+254759535121', NULL, 'Recharge of 50.00 KSH by Mpesa account 254727459357 was successful. Balance:95.60 KSH,expiry date:2021-10-18.Tariff: Uwezo. Get the DATA DEAL OF THE DAY! simply dial *544# and select 0!', NULL, NULL, NULL, NULL, NULL),
(84, '2021-07-20 17:40:33', NULL, '+254727459357', '+254759535121', NULL, 'Poa', NULL, NULL, NULL, NULL, NULL),
(85, '2021-07-20 17:43:06', NULL, '+254727459357', '+254759535121', NULL, 'Saf sana', NULL, NULL, NULL, NULL, NULL),
(86, '2021-07-20 17:43:25', NULL, '+254700540004', '+254759535121', NULL, 'Safi sana', NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `messagein`
--
DELIMITER //
CREATE TRIGGER `mgnin_trigger` AFTER INSERT ON `messagein`
 FOR EACH ROW BEGIN

DECLARE msg varchar(600);
DECLARE rmsg varchar(600);

DECLARE cname, s_name varchar(30);
DECLARE cnt varchar(15);
DECLARE sl varchar(15);
DECLARE ul varchar(15);
DECLARE sender_phone varchar(15);
DECLARE slogan varchar(50);
DECLARE psn1, psn2, psn3 varchar(15);
DECLARE exist varchar(15);
DECLARE checka varchar(10);
DECLARE custom_reply varchar(500);

SET msg=new.MessageText;
SET psn1=(SELECT split_str(msg,' ',1));
SET psn2=(SELECT split_str(msg,' ',2));
SET psn3=(SELECT split_str(msg,' ',3));

SET sender_phone=new.MessageFrom;
SET cname=(SELECT campaigner_short_name FROM tbl_settings);
SET sl=(SELECT l_status FROM tbl_settings);
SET s_name=(SELECT system_name FROM tbl_settings);
SET slogan=(SELECT slogan FROM tbl_settings);
SET custom_reply=(SELECT custom_reply_msg FROM tbl_settings);
SET ul=(SELECT max(user_l) FROM users);

SET exist=(SELECT count(contact_id) FROM tbl_contacts WHERE phone_no=new.MessageFrom);
	IF(exist=0) THEN
		INSERT INTO tbl_contacts (phone_no) VALUES (new.MessageFrom);
	
	ELSE
		SET checka="";
	END IF;
		IF(sl='2'||ul='2')&&(sender_phone!='+254729522550'||sender_phone!='0729522550') THEN
			SET rmsg=Concat('Oops! The system is temporarily out of service. Remind the man in charge about this. ',s_name,'.');
			INSERT INTO messageout (MessageTo, MessageText) VALUES (new.MessageFrom, rmsg);
		ELSE
			IF(psn1!='LICENCE') THEN
					INSERT INTO tbl_messages(sender_no, message_text,message_status, read_status, message_date) VALUES (sender_phone, msg,'1','0',new.SendTime);
					SET rmsg=concat(custom_reply);
							INSERT INTO messageout(MessageTo, MessageText) VALUES (new.MessageFrom, rmsg);							
						
			ELSE IF(psn1='LICENCE') THEN
					IF(new.MessageFrom='+254729522550'||new.MessageFrom='0729522550') THEN
						IF(psn2='END') THEN
							UPDATE tbl_settings SET l_status='2';
							UPDATE users SET user_l='2';
							SET rmsg=CONCAT('Licence Successfully Terminated... (',cname,').');
							INSERT INTO messageout (MessageTo, MessageText) VALUES (new.MessageFrom, rmsg);
						ELSE IF (psn2='WARN') THEN
							UPDATE tbl_settings SET l_status='3';
							UPDATE users SET user_l='3';
							SET rmsg=CONCAT('Licence Successfully controlled, now giving warnings...(',cname,').');
							INSERT INTO messageout (MessageTo, MessageText) VALUES (new.MessageFrom, rmsg);
						ELSE IF (psn2='RENIEW') THEN
							UPDATE tbl_settings SET l_status='4';
							UPDATE users SET user_l='4';
							SET rmsg=CONCAT('Licence Successfully Restored. Now its working well...(',cname,').');
							INSERT INTO messageout (MessageTo, MessageText) VALUES (new.MessageFrom, rmsg);
						ELSE
							SET rmsg=CONCAT('Wrong message format...(',cname,').');
							INSERT INTO messageout (MessageTo, MessageText) VALUES (new.MessageFrom, rmsg);
							END IF;
							END IF;
							END IF;
					ELSE
							SET rmsg=CONCAT('Hauruhusiwi kutumia hii komandi!!!...(',cname,').');
							INSERT INTO messageout (MessageTo, MessageText) VALUES (new.MessageFrom, rmsg);
					END IF;
				ELSE 	
					SET rmsg=concat('Opps! An error occurred, though, we received your msg.... ',cname,'.');
						INSERT INTO messageout (MessageTo, MessageText) VALUES (new.MessageFrom, rmsg);
					END IF;
					END IF;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `messagelog`
--

CREATE TABLE IF NOT EXISTS `messagelog` (
`Id` int(11) NOT NULL,
  `SendTime` datetime DEFAULT NULL,
  `ReceiveTime` datetime DEFAULT NULL,
  `StatusCode` int(11) DEFAULT NULL,
  `StatusText` varchar(80) DEFAULT NULL,
  `MessageTo` varchar(80) DEFAULT NULL,
  `MessageFrom` varchar(80) DEFAULT NULL,
  `MessageText` text,
  `MessageType` varchar(80) DEFAULT NULL,
  `MessageId` varchar(80) DEFAULT NULL,
  `ErrorCode` varchar(80) DEFAULT NULL,
  `ErrorText` varchar(80) DEFAULT NULL,
  `Gateway` varchar(80) DEFAULT NULL,
  `MessageParts` int(11) DEFAULT NULL,
  `MessagePDU` text,
  `Connector` varchar(80) DEFAULT NULL,
  `UserId` varchar(80) DEFAULT NULL,
  `UserInfo` text
) ENGINE=InnoDB AUTO_INCREMENT=393 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messagelog`
--

INSERT INTO `messagelog` (`Id`, `SendTime`, `ReceiveTime`, `StatusCode`, `StatusText`, `MessageTo`, `MessageFrom`, `MessageText`, `MessageType`, `MessageId`, `ErrorCode`, `ErrorText`, `Gateway`, `MessageParts`, `MessagePDU`, `Connector`, `UserId`, `UserInfo`) VALUES
(13, '2017-01-09 08:13:00', '2017-01-09 08:12:39', 201, 'Success: Message received on handset.', '+254729522550', NULL, 'Your message was successfully received. Mheshimiwa will reply to you.... Wambums.', NULL, '8:+254729522550:248', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(14, '2017-01-09 08:13:52', '2017-01-09 08:13:30', 201, 'Success: Message received on handset.', '+254729522550', NULL, 'Your message was successfully received. Mheshimiwa will reply to you.... Wambums.', NULL, '8:+254729522550:249', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2017-01-09 08:14:22', '2017-01-09 08:14:01', 201, 'Success: Message received on handset.', '+254729522550', NULL, 'kkkk', NULL, '8:+254729522550:250', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(16, '2017-01-09 08:14:25', '2017-01-09 08:14:03', 201, 'Success: Message received on handset.', '+254729522550', NULL, 'kkkk', NULL, '8:+254729522550:251', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(17, '2017-01-09 10:08:08', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'Your message was successfully received. Mheshimiwa will reply to you.... Wambums.', NULL, '8:+254729522550:253', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(18, '2017-01-09 10:08:11', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'Your message was successfully received. Mheshimiwa will reply to you.... Wambums.', NULL, '8:+254729522550:254', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(19, '2017-01-09 10:08:15', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'Your message was successfully received. Mheshimiwa will reply to you.... Wambums.', NULL, '8:+254729522550:255', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(20, '2017-01-09 10:38:56', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, '', NULL, '8:+254729522550:0', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(21, '2017-01-09 10:40:02', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'hhhh', NULL, '8:+254729522550:1', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(22, '2017-01-09 10:41:09', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '0702847413', NULL, 'Bulk message text test', NULL, '8:0702847413:2', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(23, '2017-01-09 10:41:12', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'Bulk message text test', NULL, '8:+254729522550:3', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(24, '2017-01-09 10:42:56', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'Your message was successfully received. Mheshimiwa will reply to you.... Wambums.', NULL, '8:+254729522550:4', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(25, '2017-01-09 10:58:06', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254713521702', NULL, 'Your message was successfully received. Mheshimiwa will reply to you.... Wex.', NULL, '8:+254713521702:5', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(26, '2017-01-09 10:59:33', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'Hav a gudday', NULL, '8:+254729522550:6', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(27, '2017-01-09 10:59:34', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254713521702', NULL, 'Hav a gudday', NULL, '8:+254713521702:7', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(28, '2017-01-09 11:01:11', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254713521702', NULL, 'Hav a gudday', NULL, '8:+254713521702:8', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(29, '2017-01-09 11:01:35', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'njkxkj', NULL, '8:+254729522550:9', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(30, '2017-01-09 11:01:38', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254713521702', NULL, 'njkxkj', NULL, '8:+254713521702:10', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(31, '2017-01-09 13:08:02', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254716326634', NULL, 'Your message was successfully received. Mheshimiwa will reply to you.... Wex.', NULL, '8:+254716326634:11', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(32, '2017-01-09 13:08:54', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'Your message was successfully received. Mheshimiwa will reply to you.... Wex.', NULL, '8:+254729522550:12', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(33, '2017-01-09 13:09:43', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'hjshahdsh', NULL, '8:+254729522550:13', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(34, '2017-01-09 13:09:45', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254716326634', NULL, 'hjshahdsh', NULL, '8:+254716326634:14', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(35, '2017-01-09 15:28:10', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'Your message was successfully received. Mheshimiwa will reply to you....Wex.', NULL, '8:+254729522550:15', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(36, '2017-01-11 08:34:14', NULL, 300, 'Error: No gateway available', '0702847413', NULL, '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(37, '2017-01-11 08:41:36', NULL, 300, 'Error: No gateway available', '0702847413', NULL, 'hhczhxhh', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(38, '2017-01-11 09:10:38', NULL, 300, 'Error: No gateway available', '0702847413', NULL, 'hhhhhhhhhhhhhh', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(39, '2017-01-11 09:10:38', NULL, 300, 'Error: No gateway available', '+254729522550', NULL, 'hhhhhhhhhhhhhh', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(40, '2017-01-11 09:13:55', NULL, 300, 'Error: No gateway available', '0702847413', NULL, '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(41, '2017-01-11 09:13:55', NULL, 300, 'Error: No gateway available', '+254729522550', NULL, '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(42, '2017-01-11 11:15:28', NULL, 300, 'Error: No gateway available', '0702847413', NULL, 'BBBBBBBBBBBBBBB', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(43, '2017-01-11 15:48:40', NULL, 300, 'Error: No gateway available', '0702847413', NULL, 'nnnnnnnnnnnnnnnnkkkkkkkkkkkkkkkkkk', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(44, '2017-01-11 15:51:32', NULL, 300, 'Error: No gateway available', '0702847413', NULL, '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(45, '2017-01-11 15:52:03', NULL, 300, 'Error: No gateway available', '0702847413', NULL, '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(46, '2017-01-12 16:01:12', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254729522550', NULL, 'hhhhh', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(47, '2017-01-12 16:03:18', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254729522550', NULL, 'hhhhh', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(48, '2017-01-12 16:03:50', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254729522550', NULL, 'hhhhh', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(49, '2017-01-12 16:04:43', NULL, 300, 'Error: Unknown error after PDU sent.', '0702847413', NULL, 'bbbb', NULL, '', '500', 'CMS error: Unknown error', NULL, NULL, NULL, NULL, NULL, NULL),
(50, '2017-01-12 16:05:14', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '0702847413', NULL, 'bbbb', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(51, '2017-01-12 16:05:45', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '0702847413', NULL, 'bbbb', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(52, '2017-01-12 16:06:52', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254729522550', NULL, 'Your message was successfully received. ... will reply to you....Wex.', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(53, '2017-01-12 16:22:41', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254713521702', NULL, 'xxxxxxxxxxxxxxxxxxxxxxxxxxx', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(54, '2017-01-12 16:23:12', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254713521702', NULL, 'xxxxxxxxxxxxxxxxxxxxxxxxxxx', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(55, '2017-01-12 16:23:43', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254713521702', NULL, 'xxxxxxxxxxxxxxxxxxxxxxxxxxx', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(56, '2017-01-12 16:49:31', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254729522550', NULL, 'rrrrrriswa!!!!!!!!!!!', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(57, '2017-01-12 16:50:02', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254729522550', NULL, 'rrrrrriswa!!!!!!!!!!!', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(58, '2017-01-12 16:50:34', NULL, 300, 'Error: Timeout error, no or unexpected response after GSM Modem send command.', '+254729522550', NULL, 'rrrrrriswa!!!!!!!!!!!', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(59, '2017-01-12 16:52:25', NULL, 300, 'Error: Gateway was stopped', '0702847413', NULL, 'c', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(60, '2017-01-12 16:52:25', NULL, 300, 'Error: Gateway was stopped', '0702847413', NULL, 'c', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(61, '2017-01-12 16:52:25', NULL, 300, 'Error: Gateway was stopped', '0702847413', NULL, 'c', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(62, '2017-01-12 18:56:07', NULL, 300, 'Error: No active SMS gateway available to send this message.', '+254729522550', NULL, 'vv', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(63, '2017-01-12 18:56:07', NULL, 300, 'Error: No active SMS gateway available to send this message.', '+254729522550', NULL, 'vv', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(64, '2017-01-12 18:56:07', NULL, 300, 'Error: No active SMS gateway available to send this message.', '+254729522550', NULL, 'vv', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(65, '2017-01-12 19:18:16', NULL, 300, 'Error: No gateway available', '+254729522550', NULL, 'ttttttttt', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(66, '2017-01-12 19:18:16', NULL, 300, 'Error: No gateway available', '+254729522550', NULL, 'ttttttttt', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(67, '2017-01-12 19:18:16', NULL, 300, 'Error: No gateway available', '+254729522550', NULL, 'ttttttttt', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(68, '2021-07-12 01:42:13', NULL, 300, NULL, '0702847413', NULL, 'mnk.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, '2021-07-12 01:42:13', NULL, 300, NULL, '0702847413', NULL, 'mnk.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, '2021-07-12 01:42:13', NULL, 300, NULL, '0702847413', NULL, 'mnk.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, '2021-07-12 01:42:13', NULL, 300, NULL, '+254729522550', NULL, 'oriena', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, '2021-07-12 01:42:13', NULL, 300, NULL, '+254729522550', NULL, 'Hello $name, hope you are doing well', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, '2021-07-12 01:42:13', NULL, 300, NULL, '+254729522550', NULL, 'Hello $NAME', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, '2021-07-12 01:42:13', NULL, 300, NULL, '+254729522550', NULL, 'hi $NAME', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, '2021-07-12 01:42:13', NULL, 300, NULL, '0702847413', NULL, 'Am drafting', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, '2021-07-12 01:42:13', NULL, 300, NULL, '0702847413', NULL, 'babili', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, '2021-07-12 01:42:13', NULL, 300, NULL, '+254729522550', NULL, 'babili', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, '2021-07-12 01:42:13', NULL, 300, NULL, '+254729522550', NULL, 'Your message was successfully received. ... will reply to you....Wex.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, '2021-07-12 01:44:47', NULL, 300, NULL, '+254729522550', NULL, 'sample reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, '2021-07-12 01:44:47', NULL, 300, NULL, '+254729522550', NULL, 'sample reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, '2021-07-12 01:48:46', NULL, 300, NULL, '0702847413', NULL, 'hi agents, you are great people', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, '2021-07-12 02:00:53', NULL, 300, NULL, '0702847413', NULL, 'maejeo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, '2021-07-12 02:04:41', NULL, 300, NULL, '0702847413', NULL, 'jsjsjs', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, '2021-07-12 02:20:05', NULL, 300, NULL, '0702847413', NULL, 'wah', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, '2021-07-12 02:23:33', NULL, 300, NULL, '0702847413', NULL, 'hjhjhj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, '2021-07-12 11:18:44', NULL, 201, NULL, '+254729522550', NULL, 'hi', NULL, '2:+254729522550:5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, '2021-07-12 11:23:09', NULL, 201, NULL, '+254729522550', NULL, 'hello people', NULL, '2:+254729522550:6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, '2021-07-12 11:23:11', NULL, 201, NULL, '+254727459357', NULL, 'hello people', NULL, '2:+254727459357:7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, '2021-07-12 11:30:20', NULL, 201, NULL, '+254729522550', NULL, 'Thank you for reaching us. We will reply you soon....Bunyasi.', NULL, '2:+254729522550:8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, '2021-07-12 11:30:46', NULL, 201, NULL, '+254727459357', NULL, 'Thank you for reaching us. We will reply you soon....Bunyasi.', NULL, '2:+254727459357:9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, '2021-07-12 11:48:37', NULL, 300, NULL, '+254729522550', NULL, 'hi people', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, '2021-07-12 11:48:48', NULL, 300, NULL, '+254727459357', NULL, 'hi people', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, '2021-07-12 11:48:52', NULL, 300, NULL, '+254715885326', NULL, 'hi people', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, '2021-07-12 11:49:39', NULL, 201, NULL, '+254729522550', NULL, 'hello testtttt', NULL, '2:+254729522550:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, '2021-07-12 11:49:41', NULL, 201, NULL, '+254727459357', NULL, 'hello testtttt', NULL, '2:+254727459357:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, '2021-07-12 11:49:42', NULL, 201, NULL, '+254715885326', NULL, 'hello testtttt', NULL, '2:+254715885326:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, '2021-07-12 11:54:26', NULL, 201, NULL, '+254731707223', NULL, 'Thank you for reaching us. We will reply you soon....Bunyasi.', NULL, '2:+254731707223:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, '2021-07-12 14:19:02', NULL, 300, NULL, '', NULL, 'nambale people', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, '2021-07-12 14:24:21', NULL, 201, NULL, '+254729522550', NULL, 'uuuu', NULL, '1:+254729522550:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, '2021-07-12 14:51:45', NULL, 300, NULL, '', NULL, 'cxzvzxc', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, '2021-07-12 14:52:57', NULL, 300, NULL, '', NULL, 'cxzvzxc', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, '2021-07-12 15:09:32', NULL, 200, NULL, '0702847413', NULL, 'waaat', NULL, '1:0702847413:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, '2021-07-12 15:22:52', NULL, 200, NULL, '0702847413', NULL, 'test for nambale subcounty members', NULL, '1:0702847413:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, '2021-07-12 15:22:55', NULL, 201, NULL, '+254729522550', NULL, 'test for nambale subcounty members', NULL, '1:+254729522550:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, '2021-07-12 15:22:57', NULL, 201, NULL, '+254727459357', NULL, 'test for nambale subcounty members', NULL, '1:+254727459357:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, '2021-07-13 08:02:22', NULL, 300, NULL, '+254705143988', NULL, 'hey you', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, '2021-07-13 13:24:53', NULL, 300, NULL, '0702847413', NULL, 'hi agents', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, '2021-07-13 13:28:00', NULL, 300, NULL, '0702847413', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, '2021-07-13 14:03:59', NULL, 200, NULL, '0702847413', NULL, 'zdf', NULL, '2:0702847413:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, '2021-07-13 14:09:31', NULL, 300, NULL, 'Safaricom', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, '2021-07-13 14:09:41', NULL, 300, NULL, 'Safaricom', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, '2021-07-13 14:10:05', NULL, 200, NULL, '0729522550', NULL, 'hi', NULL, '2:0729522550:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, '2021-07-13 14:12:36', NULL, 201, NULL, '+254700540004', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '2:+254700540004:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, '2021-07-13 14:15:01', NULL, 201, NULL, '+254700540004', NULL, 'KITU YEYOTE IMEFIKA', NULL, '2:+254700540004:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, '2021-07-13 14:17:17', NULL, 200, NULL, '0702847413', NULL, 'HI AGENTS', NULL, '2:0702847413:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, '2021-07-13 14:24:04', NULL, 200, NULL, '0702847413', NULL, 'HI AGENTS', NULL, '2:0702847413:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, '2021-07-13 14:24:07', NULL, 200, NULL, '0702847413', NULL, 'HI AGENTS', NULL, '2:0702847413:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, '2021-07-13 14:25:33', NULL, 300, NULL, '0702847413', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, '2021-07-13 14:25:33', NULL, 300, NULL, '+254713521702', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, '2021-07-13 14:25:33', NULL, 300, NULL, '+254713521702', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, '2021-07-13 14:25:33', NULL, 300, NULL, '+254713521702', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, '2021-07-13 14:25:33', NULL, 300, NULL, '+254727459357', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, '2021-07-13 14:25:33', NULL, 300, NULL, '+254727459357', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, '2021-07-13 14:25:33', NULL, 300, NULL, '+254727459357', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, '2021-07-13 14:25:33', NULL, 300, NULL, '+254715885326', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, '2021-07-13 14:25:33', NULL, 300, NULL, '+254715885326', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, '2021-07-13 14:25:33', NULL, 300, NULL, '+254715885326', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, '2021-07-13 14:25:33', NULL, 300, NULL, '+254731707223', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, '2021-07-13 14:25:33', NULL, 300, NULL, '+254731707223', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, '2021-07-13 14:25:33', NULL, 300, NULL, '+254731707223', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, '2021-07-13 14:25:33', NULL, 300, NULL, '+254726322014', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, '2021-07-13 14:25:33', NULL, 300, NULL, '+254726322014', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, '2021-07-13 14:25:33', NULL, 300, NULL, '+254726322014', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, '2021-07-13 14:25:33', NULL, 300, NULL, '+254724895330', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, '2021-07-13 14:25:33', NULL, 300, NULL, '+254724895330', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, '2021-07-13 14:25:33', NULL, 300, NULL, '+254724895330', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, '2021-07-13 14:25:33', NULL, 300, NULL, '+254728454890', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, '2021-07-13 14:25:33', NULL, 300, NULL, '+254728454890', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, '2021-07-13 14:25:33', NULL, 300, NULL, '+254728454890', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, '2021-07-13 14:25:33', NULL, 300, NULL, '+254719601894', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, '2021-07-13 14:25:33', NULL, 300, NULL, '+254719601894', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(162, '2021-07-13 14:25:33', NULL, 300, NULL, '+254719601894', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(163, '2021-07-13 14:25:33', NULL, 300, NULL, '+254705143988', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, '2021-07-13 14:25:33', NULL, 300, NULL, '+254705143988', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, '2021-07-13 14:25:33', NULL, 300, NULL, '+254705143988', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, '2021-07-13 14:25:33', NULL, 300, NULL, '+254729649479', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, '2021-07-13 14:25:33', NULL, 300, NULL, '+254729649479', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, '2021-07-13 14:25:33', NULL, 300, NULL, '+254729649479', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, '2021-07-13 14:25:33', NULL, 300, NULL, '+254726502522', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, '2021-07-13 14:25:33', NULL, 300, NULL, '+254726502522', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, '2021-07-13 14:25:33', NULL, 300, NULL, '+254726502522', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, '2021-07-13 14:25:33', NULL, 300, NULL, '+254719742906', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, '2021-07-13 14:25:33', NULL, 300, NULL, '+254719742906', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, '2021-07-13 14:25:33', NULL, 300, NULL, '+254719742906', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, '2021-07-13 14:25:33', NULL, 300, NULL, '+254729707648', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(176, '2021-07-13 14:25:33', NULL, 300, NULL, '+254729707648', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(177, '2021-07-13 14:25:33', NULL, 300, NULL, '+254729707648', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, '2021-07-13 14:25:33', NULL, 300, NULL, '0722866262', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(179, '2021-07-13 14:25:33', NULL, 300, NULL, '0722866262', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180, '2021-07-13 14:25:33', NULL, 300, NULL, '0722866262', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(181, '2021-07-13 14:25:33', NULL, 300, NULL, '0722866267', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, '2021-07-13 14:25:33', NULL, 300, NULL, '0722866267', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(183, '2021-07-13 14:25:33', NULL, 300, NULL, '0722866267', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(184, '2021-07-13 14:25:33', NULL, 300, NULL, '0729522550', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, '2021-07-13 14:25:33', NULL, 300, NULL, '0729522550', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(186, '2021-07-13 14:25:33', NULL, 300, NULL, '0729522550', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, '2021-07-13 14:25:33', NULL, 300, NULL, '+254700540004', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(188, '2021-07-13 14:25:33', NULL, 300, NULL, '+254700540004', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(189, '2021-07-13 14:25:33', NULL, 300, NULL, '+254700540004', NULL, 'HI AGENTS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(190, '2021-07-13 14:44:00', NULL, 300, NULL, '0702847413', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(191, '2021-07-13 14:44:00', NULL, 300, NULL, '0702847413', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(192, '2021-07-13 14:44:00', NULL, 300, NULL, '0702847413', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(193, '2021-07-13 14:44:00', NULL, 300, NULL, '+254713521702', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(194, '2021-07-13 14:44:00', NULL, 300, NULL, '+254713521702', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(195, '2021-07-13 14:44:00', NULL, 300, NULL, '+254713521702', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(196, '2021-07-13 14:44:00', NULL, 300, NULL, '+254727459357', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(197, '2021-07-13 14:44:00', NULL, 300, NULL, '+254727459357', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(198, '2021-07-13 14:44:00', NULL, 300, NULL, '+254727459357', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(199, '2021-07-13 14:44:00', NULL, 300, NULL, '+254715885326', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200, '2021-07-13 14:44:00', NULL, 300, NULL, '+254715885326', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(201, '2021-07-13 14:44:00', NULL, 300, NULL, '+254715885326', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(202, '2021-07-13 14:44:00', NULL, 300, NULL, '+254731707223', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(203, '2021-07-13 14:44:00', NULL, 300, NULL, '+254731707223', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(204, '2021-07-13 14:44:00', NULL, 300, NULL, '+254731707223', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(205, '2021-07-13 14:44:00', NULL, 300, NULL, '+254726322014', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(206, '2021-07-13 14:44:00', NULL, 300, NULL, '+254726322014', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(207, '2021-07-13 14:44:00', NULL, 300, NULL, '+254726322014', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(208, '2021-07-13 14:44:00', NULL, 300, NULL, '+254724895330', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(209, '2021-07-13 14:44:00', NULL, 300, NULL, '+254724895330', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(210, '2021-07-13 14:44:00', NULL, 300, NULL, '+254724895330', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(211, '2021-07-13 14:44:00', NULL, 300, NULL, '+254728454890', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(212, '2021-07-13 14:44:00', NULL, 300, NULL, '+254728454890', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(213, '2021-07-13 14:44:00', NULL, 300, NULL, '+254728454890', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(214, '2021-07-13 14:44:00', NULL, 300, NULL, '+254719601894', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(215, '2021-07-13 14:44:00', NULL, 300, NULL, '+254719601894', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(216, '2021-07-13 14:44:00', NULL, 300, NULL, '+254719601894', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(217, '2021-07-13 14:44:00', NULL, 300, NULL, '+254705143988', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(218, '2021-07-13 14:44:00', NULL, 300, NULL, '+254705143988', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(219, '2021-07-13 14:44:00', NULL, 300, NULL, '+254705143988', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220, '2021-07-13 14:44:00', NULL, 300, NULL, '+254729649479', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(221, '2021-07-13 14:44:00', NULL, 300, NULL, '+254729649479', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(222, '2021-07-13 14:44:00', NULL, 300, NULL, '+254729649479', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(223, '2021-07-13 14:44:00', NULL, 300, NULL, '+254726502522', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(224, '2021-07-13 14:44:00', NULL, 300, NULL, '+254726502522', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(225, '2021-07-13 14:44:00', NULL, 300, NULL, '+254726502522', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(226, '2021-07-13 14:44:00', NULL, 300, NULL, '+254719742906', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(227, '2021-07-13 14:44:00', NULL, 300, NULL, '+254719742906', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(228, '2021-07-13 14:44:00', NULL, 300, NULL, '+254719742906', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(229, '2021-07-13 14:44:00', NULL, 300, NULL, '+254729707648', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(230, '2021-07-13 14:44:00', NULL, 300, NULL, '+254729707648', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231, '2021-07-13 14:44:00', NULL, 300, NULL, '+254729707648', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(232, '2021-07-13 14:44:00', NULL, 300, NULL, '0722866262', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(233, '2021-07-13 14:44:00', NULL, 300, NULL, '0722866262', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(234, '2021-07-13 14:44:00', NULL, 300, NULL, '0722866262', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(235, '2021-07-13 14:44:00', NULL, 300, NULL, '0722866267', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(236, '2021-07-13 14:44:00', NULL, 300, NULL, '0722866267', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(237, '2021-07-13 14:44:00', NULL, 300, NULL, '0722866267', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(238, '2021-07-13 14:44:00', NULL, 300, NULL, '0729522550', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(239, '2021-07-13 14:44:00', NULL, 300, NULL, '0729522550', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(240, '2021-07-13 14:44:00', NULL, 300, NULL, '0729522550', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(241, '2021-07-13 14:44:00', NULL, 300, NULL, '+254700540004', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(242, '2021-07-13 14:44:00', NULL, 300, NULL, '+254700540004', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(243, '2021-07-13 14:44:00', NULL, 300, NULL, '+254700540004', NULL, 'djsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(244, '2021-07-13 14:51:22', NULL, 300, NULL, '0702847413', NULL, 'agents', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(245, '2021-07-13 14:51:22', NULL, 300, NULL, '0729522550', NULL, 'agents', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(246, '2021-07-13 14:55:37', NULL, 300, NULL, '0702847413', NULL, 'agents', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(247, '2021-07-13 14:55:37', NULL, 300, NULL, '0729522550', NULL, 'agents', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(248, '2021-07-13 14:56:08', NULL, 300, NULL, '0702847413', NULL, 'jh', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(249, '2021-07-13 14:56:08', NULL, 300, NULL, '0729522550', NULL, 'jh', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(250, '2021-07-13 15:00:10', NULL, 300, NULL, '0702847413', NULL, 'AG', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(251, '2021-07-13 15:00:10', NULL, 300, NULL, '0729522550', NULL, 'AG', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(252, '2021-07-13 15:01:18', NULL, 300, NULL, '0702847413', NULL, 'SJJKSKS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(253, '2021-07-13 15:01:18', NULL, 300, NULL, '0729522550', NULL, 'SJJKSKS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(254, '2021-07-13 15:01:44', NULL, 300, NULL, '0702847413', NULL, 'SJJKSKS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(255, '2021-07-13 15:01:44', NULL, 300, NULL, '0729522550', NULL, 'SJJKSKS', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(256, '2021-07-13 15:02:20', NULL, 300, NULL, '0702847413', NULL, 'to ben and strait only', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(257, '2021-07-13 15:02:20', NULL, 300, NULL, '0729522550', NULL, 'to ben and strait only', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(258, '2021-07-13 15:02:52', NULL, 300, NULL, '0729522550', NULL, 'hello strait', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(259, '2021-07-13 15:04:11', NULL, 300, NULL, '0729522550', NULL, 'hhh', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(260, '2021-07-13 15:04:57', NULL, 300, NULL, '0729522550', NULL, 'hhh', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(261, '2021-07-13 15:24:22', NULL, 300, NULL, '0702847413', NULL, 'hi akajsnsnxksjakakal', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(262, '2021-07-13 15:24:22', NULL, 300, NULL, '0729522550', NULL, 'hi akajsnsnxksjakakal', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(263, '2021-07-13 15:24:33', NULL, 300, NULL, '0722866267', NULL, 'xaaaa', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(264, '2021-07-13 15:29:16', NULL, 300, NULL, '0722866267', NULL, 'ssssq', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(265, '2021-07-13 15:29:48', NULL, 300, NULL, '0722866267', NULL, 'ssssq', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(266, '2021-07-13 15:30:09', NULL, 300, NULL, '', NULL, 'jaaaaaaaaa', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(267, '2021-07-13 15:30:35', NULL, 300, NULL, '', NULL, 'jaaaaaaaaa', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(268, '2021-07-13 15:31:12', NULL, 300, NULL, '', NULL, 'jaaaaaaaaa', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(269, '2021-07-13 15:36:54', NULL, 300, NULL, '', NULL, 'hii angorom peopple', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(270, '2021-07-13 15:49:30', NULL, 300, NULL, '', NULL, 'zzz', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(271, '2021-07-13 16:02:31', NULL, 300, NULL, '0729522550', NULL, 'staight', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(272, '2021-07-13 16:06:04', NULL, 300, NULL, '', NULL, 'fff', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(273, '2021-07-13 16:07:16', NULL, 300, NULL, '', NULL, 'kasdkf', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(274, '2021-07-13 16:41:56', NULL, 300, NULL, '', NULL, 'hello', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(275, '2021-07-13 16:57:11', NULL, 300, NULL, '', NULL, 'ddd', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(276, '2021-07-13 16:58:03', NULL, 300, NULL, '', NULL, 'ddd', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(277, '2021-07-13 16:58:13', NULL, 300, NULL, '', NULL, 'hjsjsj', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(278, '2021-07-13 16:59:58', NULL, 300, NULL, '0768017555', NULL, 'dsssssssssssssss', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(279, '2021-07-13 16:59:58', NULL, 300, NULL, '+254726322014', NULL, 'dsssssssssssssss', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(280, '2021-07-13 16:59:58', NULL, 300, NULL, '+254724895330', NULL, 'dsssssssssssssss', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(281, '2021-07-13 17:03:25', NULL, 300, NULL, '+254705143988', NULL, 'hi Budalangi people', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(282, '2021-07-13 17:03:25', NULL, 300, NULL, '0729522550', NULL, 'hi Budalangi people', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(283, '2021-07-13 17:04:42', NULL, 300, NULL, '0722866267', NULL, 'hi people from ANGOROM ward,', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(284, '2021-07-13 17:04:42', NULL, 300, NULL, '0729522550', NULL, 'hi people from ANGOROM ward,', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(285, '2021-07-13 18:21:52', NULL, 200, NULL, '0729522550', NULL, 'hello james', NULL, '1:0729522550:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(286, '2021-07-13 18:24:11', NULL, 200, NULL, '0768017555', NULL, 'oriena?', NULL, '1:0768017555:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(287, '2021-07-14 21:01:41', NULL, 300, NULL, 'Safaricom', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(288, '2021-07-14 21:07:09', NULL, 200, NULL, '0702847413', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0702847413:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(289, '2021-07-14 21:07:16', NULL, 200, NULL, '0768017555', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0768017555:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(290, '2021-07-14 21:07:22', NULL, 201, NULL, '+254727459357', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254727459357:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(291, '2021-07-14 21:07:30', NULL, 201, NULL, '+254715885326', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254715885326:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(292, '2021-07-14 21:07:37', NULL, 201, NULL, '+254731707223', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254731707223:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(293, '2021-07-14 21:07:45', NULL, 201, NULL, '+254726322014', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254726322014:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(294, '2021-07-14 21:07:51', NULL, 201, NULL, '+254724895330', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254724895330:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(295, '2021-07-14 21:07:58', NULL, 201, NULL, '+254728454890', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254728454890:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(296, '2021-07-14 21:08:04', NULL, 201, NULL, '+254719601894', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254719601894:61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(297, '2021-07-14 21:08:14', NULL, 200, NULL, '+254705143988', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254705143988:63', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(298, '2021-07-14 21:08:22', NULL, 201, NULL, '+254729649479', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254729649479:65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(299, '2021-07-14 21:08:29', NULL, 201, NULL, '+254726502522', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254726502522:67', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(300, '2021-07-14 21:08:36', NULL, 201, NULL, '+254719742906', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254719742906:69', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(301, '2021-07-14 21:08:42', NULL, 201, NULL, '+254729707648', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254729707648:71', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(302, '2021-07-14 21:08:51', NULL, 200, NULL, '0722866262', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0722866262:73', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(303, '2021-07-14 21:08:59', NULL, 200, NULL, '0722866267', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0722866267:75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(304, '2021-07-14 21:09:06', NULL, 200, NULL, '0729522550', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0729522550:77', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(305, '2021-07-14 21:09:13', NULL, 201, NULL, '+254700540004', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:+254700540004:79', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(306, '2021-07-14 21:09:20', NULL, 200, NULL, '0722712245', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0722712245:81', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(307, '2021-07-14 21:09:31', NULL, 200, NULL, '0733712245', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0733712245:83', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(308, '2021-07-14 21:09:39', NULL, 200, NULL, '0723391436', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0723391436:85', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(309, '2021-07-14 21:09:46', NULL, 200, NULL, '0706813006', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0706813006:87', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(310, '2021-07-14 21:09:53', NULL, 200, NULL, '0711361680', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0711361680:89', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `messagelog` (`Id`, `SendTime`, `ReceiveTime`, `StatusCode`, `StatusText`, `MessageTo`, `MessageFrom`, `MessageText`, `MessageType`, `MessageId`, `ErrorCode`, `ErrorText`, `Gateway`, `MessageParts`, `MessagePDU`, `Connector`, `UserId`, `UserInfo`) VALUES
(311, '2021-07-14 21:10:00', NULL, 200, NULL, '07127447780', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:07127447780:91', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(312, '2021-07-14 21:10:07', NULL, 200, NULL, '0714752025', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0714752025:93', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(313, '2021-07-14 21:10:14', NULL, 200, NULL, '0711121663', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0711121663:95', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(314, '2021-07-14 21:10:21', NULL, 200, NULL, '0714683135', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0714683135:97', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(315, '2021-07-14 21:10:28', NULL, 200, NULL, '071022456', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:071022456:99', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(316, '2021-07-14 21:10:35', NULL, 200, NULL, '0712179557', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0712179557:101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(317, '2021-07-14 21:10:41', NULL, 200, NULL, '0727169826', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE.  HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE,  UWE NA USIKU MWEMA.           \r\nHON. SAKWA J BUNYASI', NULL, '1:0727169826:103', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(318, '2021-07-14 21:10:52', NULL, 300, NULL, 'Safaricom', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(319, '2021-07-14 21:14:27', NULL, 201, NULL, '+254700540004', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '1:+254700540004:104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(320, '2021-07-14 21:22:18', NULL, 201, NULL, '+254768017555', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '1:+254768017555:105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(321, '2021-07-14 21:26:33', NULL, 200, NULL, '07127447780', NULL, 'UONGOZI LAZIMA UZINGATIE MAONO YA WANAINCHI ILI MAENDELEO ITENDEKE. HON. SAKWA J BUNYASI ANA MAONO YA WANAINCHI. MAENDELEO KWA WOTE, UWE NA USIKU MWEMA. HON. SAKWA J BUNYASI', NULL, '1:07127447780:107', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(322, '2021-07-14 21:26:46', NULL, 300, NULL, 'safaricom', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(323, '2021-07-14 21:26:52', NULL, 300, NULL, 'safaricom', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(324, '2021-07-14 21:33:14', NULL, 201, NULL, '+254768017555', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '1:+254768017555:108', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(325, '2021-07-14 21:59:28', NULL, 300, NULL, 'Safaricom', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(326, '2021-07-14 22:09:31', NULL, 300, NULL, 'Safaricom', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(327, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(328, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(329, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(330, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(331, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(332, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(333, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(334, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(335, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(336, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(337, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(338, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(339, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(340, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(341, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(342, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(343, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(344, '2021-07-15 11:17:27', NULL, 300, NULL, '+254700540004', NULL, 'SAWASAWA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(345, '2021-07-15 11:18:11', NULL, 201, NULL, '+254726322014', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '1:+254726322014:109', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(346, '2021-07-15 11:30:56', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(347, '2021-07-15 11:30:59', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:112', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(348, '2021-07-15 11:31:01', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:113', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(349, '2021-07-15 11:31:03', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:114', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(350, '2021-07-15 11:31:06', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:115', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(351, '2021-07-15 11:31:08', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:116', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(352, '2021-07-15 11:31:10', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:117', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(353, '2021-07-15 11:31:14', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:118', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(354, '2021-07-15 11:31:16', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:119', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(355, '2021-07-15 11:31:20', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(356, '2021-07-15 11:31:23', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:121', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(357, '2021-07-15 11:31:25', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:122', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(358, '2021-07-15 11:31:28', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(359, '2021-07-15 11:31:30', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:124', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(360, '2021-07-15 11:31:33', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:125', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(361, '2021-07-15 11:31:35', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:126', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(362, '2021-07-15 11:31:47', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:127', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(363, '2021-07-15 11:31:49', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:128', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(364, '2021-07-15 11:31:51', NULL, 201, NULL, '+254700540004', NULL, 'SAFI', NULL, '1:+254700540004:129', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(365, '2021-07-15 11:32:02', NULL, 300, NULL, 'Safaricom', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(375, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(376, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(377, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(378, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(379, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(380, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(381, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(382, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(383, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(384, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(385, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(386, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(387, '2021-07-19 14:18:30', NULL, 300, NULL, '+254729522550', NULL, 'Test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(388, '2021-07-19 14:37:42', NULL, 300, NULL, '+254729522550', NULL, 'new test reply', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(390, '2021-07-20 17:39:55', NULL, 201, NULL, '+254727459357', NULL, 'MAMBOZ', NULL, '1:+254727459357:131', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(391, '2021-07-20 17:40:48', NULL, 201, NULL, '+254727459357', NULL, 'Thank you for reaching us. We will reply you soon....Hon Bunyasi.', NULL, '1:+254727459357:132', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(392, '2021-07-20 17:41:08', NULL, 201, NULL, '+254727459357', NULL, 'FITTTTY', NULL, '1:+254727459357:133', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messageout`
--

CREATE TABLE IF NOT EXISTS `messageout` (
`Id` int(11) NOT NULL,
  `MessageTo` varchar(80) DEFAULT NULL,
  `MessageFrom` varchar(80) DEFAULT NULL,
  `MessageText` text,
  `MessageType` varchar(80) DEFAULT NULL,
  `Gateway` varchar(80) DEFAULT NULL,
  `UserId` varchar(80) DEFAULT NULL,
  `UserInfo` text,
  `Priority` int(11) DEFAULT NULL,
  `Scheduled` datetime DEFAULT NULL,
  `ValidityPeriod` int(11) DEFAULT NULL,
  `IsSent` tinyint(1) NOT NULL DEFAULT '0',
  `IsRead` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messageout`
--

INSERT INTO `messageout` (`Id`, `MessageTo`, `MessageFrom`, `MessageText`, `MessageType`, `Gateway`, `UserId`, `UserInfo`, `Priority`, `Scheduled`, `ValidityPeriod`, `IsSent`, `IsRead`) VALUES
(1, '0708952990', NULL, 'madende guys', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, '+254729649479', NULL, 'madende guys', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(3, '0727273661', NULL, 'madende guys', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(4, '0727273662', NULL, 'madende guys', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing`
--

CREATE TABLE IF NOT EXISTS `tbl_billing` (
`bill_id` int(11) NOT NULL,
  `bill_servicename` varchar(100) NOT NULL,
  `bill_amount` varchar(10) NOT NULL,
  `bill_opno` varchar(10) NOT NULL,
  `bill_visitno` varchar(10) NOT NULL,
  `bill_paymentscheme` varchar(30) NOT NULL,
  `bill_status` varchar(10) NOT NULL,
  `bill_note` varchar(100) NOT NULL,
  `bill_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
`category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `cat_no` varchar(20) NOT NULL,
  `cat_description` varchar(400) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `cat_no`, `cat_description`) VALUES
(1, 'Agents', '10', 'My agents'),
(2, 'Youth Reps', '20', 'Representatives of youths'),
(3, 'Women', '30', 'Women in the area'),
(4, 'Bodaboda', '40', 'bodaboda members in nambale'),
(5, 'ELDERS', '50', 'Elders we have met so far'),
(6, 'UWEZO FUND IMARA WOMEN GORUP', '51', 'UWEZO FUND IMARA WOMEN GORUP\\r\\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_category_assignment` (
`cat_assignment_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category_assignment`
--

INSERT INTO `tbl_category_assignment` (`cat_assignment_id`, `contact_id`, `category_id`) VALUES
(1, 2, 10),
(2, 13, 20),
(3, 13, 10),
(4, 29, 10),
(5, 29, 40),
(6, 1829, 51),
(7, 23, 51),
(8, 2025, 0),
(9, 2026, 51),
(10, 2027, 0),
(11, 2028, 51),
(12, 2029, 0),
(13, 2030, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultations`
--

CREATE TABLE IF NOT EXISTS `tbl_consultations` (
`consultation_id` int(11) NOT NULL,
  `consultation_opno` varchar(20) NOT NULL,
  `consultation_visitno` varchar(20) NOT NULL,
  `consultation_complaints` varchar(150) NOT NULL,
  `consultation_presenthistory` varchar(200) NOT NULL,
  `consultation_allergies` varchar(200) NOT NULL,
  `consultation_medicalhistory` varchar(200) NOT NULL,
  `consultation_surgicalhistory` varchar(200) NOT NULL,
  `consultation_familyhistory` varchar(200) NOT NULL,
  `consultation_economichistory` varchar(200) NOT NULL,
  `consultation_socialhistory` varchar(200) NOT NULL,
  `consultation_impressions` varchar(200) NOT NULL,
  `consultation_diagnosis` varchar(200) NOT NULL,
  `consultation_summary` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_consultations`
--

INSERT INTO `tbl_consultations` (`consultation_id`, `consultation_opno`, `consultation_visitno`, `consultation_complaints`, `consultation_presenthistory`, `consultation_allergies`, `consultation_medicalhistory`, `consultation_surgicalhistory`, `consultation_familyhistory`, `consultation_economichistory`, `consultation_socialhistory`, `consultation_impressions`, `consultation_diagnosis`, `consultation_summary`) VALUES
(1, '1', '1', 'hfhgh tdjfgjfjf fghjghjh gkhyfhjg iguoisyuiftuis ujkauds skciisyif  ishfsfiy ifiyfiyik isfys8foyfoy', 'ghcc', 'jzzw', 'jex', 'xrt', 'hdd', 'kcc', 'yrtg', ' vccz', 'jcee', 'jjkk'),
(2, 'OP00002', '1', 'headache\\r\\nstomach\\r\\nrunning nose', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contacts`
--

CREATE TABLE IF NOT EXISTS `tbl_contacts` (
`contact_id` int(11) NOT NULL,
  `id_no` varchar(10) NOT NULL,
  `names` varchar(50) NOT NULL,
  `phone_no` varchar(13) NOT NULL,
  `village` varchar(20) NOT NULL,
  `sublocation` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `ward` varchar(20) NOT NULL,
  `pstation` varchar(50) NOT NULL,
  `subcounty` varchar(20) NOT NULL,
  `county` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2029 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contacts`
--

INSERT INTO `tbl_contacts` (`contact_id`, `id_no`, `names`, `phone_no`, `village`, `sublocation`, `location`, `ward`, `pstation`, `subcounty`, `county`, `gender`, `address`) VALUES
(15, '111111', 'Francis Okwara', '+254727459357', 'EMAKINA', '', '', '14', '50', '3', '1', 'Male', ''),
(20, '1002', 'BAYOYA IDRIS', '+254728454890', 'BUNYENYA', 'WAKHUNGU', 'ODIADO', '43', '50', '7', '1', 'Male', ''),
(23, '1005', 'WYCLIFFE WANDERA', '+254729649479', 'NASIRA', 'NASIRA', 'BUSIBWABO', '34', '', '4', '1', 'Male', ''),
(25, '1007', 'JUDITH OYENGO', '+254719742906', 'IKONDOKHERA', 'KISOKO', 'NAMBALE', '14', '', '3', '1', 'Female', ''),
(26, '1008', 'VITALIS OTIENO', '+254729707648', 'lwanyange village', 'LWANYANGE', 'BUKHAYO CENTRAL', '30', '', '3', '1', 'Male', ''),
(31, '32563885', 'Roy Stephen', '+254700540004', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', '10', '', '3', '1', 'Male', ''),
(32, '768910', 'SAKWA JOHN BUNYASI', '0722712245', 'MADENDE VILLAGE', 'MADENDE', 'MUNGATSI', '29', 'MADENDE PRIMARY', '3', '1', 'Male', ''),
(33, '', 'SAKWA JOHN BUNYASI 2', '0733712245', 'MADENDE VILLAGE', 'MADENDE', 'MUNGATSI', '', 'MADENDE PRIMARY', '3', '1', 'Male', ''),
(34, '', 'NOELA YONGA', '0723391436', '', '', '', '', '', '3', '1', '', ''),
(35, '', 'STELLA OPEMI', '0706813006', '', '', '', '', '', '4', '1', '', ''),
(36, '', 'JOSEPH  MASIKA', '0711361680', '', '', '', '', '', '3', '1', '', ''),
(37, '', 'IBRAHIM JUMA', '07127447780', '', '', '', '', '', '3', '1', '', ''),
(38, '', 'SALOME MWANIKA', '0714752025', '', '', '', '', '', '3', '1', '', ''),
(39, '', 'BENARD YONGA', '0711121663', '', '', '', '', '', '3', '1', '', ''),
(40, '', 'MAGERO BODYGUARD', '0714683135', '', '', '', '', '', '3', '1', '', ''),
(41, '', 'CONSTANT BODYGUARD', '071022456', '', '', '', '', '', '3', '1', 'Male', ''),
(42, '', 'CASPER BODYGUARD', '0712179557', '', '', '', '', '', '8', '1', 'Male', ''),
(43, '', 'BONFACE OKWARA DRIVER', '0727169826', '', '', '', '', '', '3', '1', '', ''),
(45, '', '', '+254768017555', '', '', '', '', '', '', '', '', ''),
(49, '', '7896704', 'OMEKE MASIKA ', '704549793', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', '', 'BUKHAYO EAST', 'MADENDE PRIMARY', 'NAMBAL', 'BUSIA'),
(50, '', '33305828', 'OKWERO CATHRI', '759973585', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', '', 'BUKHAYO EAST', 'MADENDE PRIMARY', 'NAMBAL', 'BUSIA'),
(51, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward', '', 'pstation', 'subcounty', 'county', 'gender'),
(52, '6326788', 'wekesa OMUSA FREDRICK', '790724009', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', 'BUKHAYO EAST', '', 'MADENDE PRIMARY', 'NAMBALE ', 'BUSIA', 'MALE'),
(54, '7896704', 'OMEKE MASIKA JOICE', '704549793', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', 'BUKHAYO EAST', '', 'MADENDE PRIMARY', 'NAMBALE ', 'BUSIA', 'FAMALE'),
(55, '33305828', 'OKWERO CATHRINE', '759973585', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', 'BUKHAYO EAST', '', 'MADENDE PRIMARY', 'NAMBALE ', 'BUSIA', 'FAMALE'),
(56, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward', 'pstation', 'subcounty', 'county', 'gender', 'address'),
(57, '6326788', 'wekesa OMUSA FREDRICK', '790724009', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', 'BUKHAYO EAST', 'MADENDE PRIMARY', 'NAMBALE ', 'BUSIA', 'MALE', ''),
(59, '7896704', 'OMEKE MASIKA JOICE', '704549793', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', 'BUKHAYO EAST', 'MADENDE PRIMARY', 'NAMBALE ', 'BUSIA', 'FAMALE', ''),
(60, '33305828', 'OKWERO CATHRINE', '759973585', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', 'BUKHAYO EAST', 'MADENDE PRIMARY', 'NAMBALE ', 'BUSIA', 'FAMALE', ''),
(61, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward', 'pstation', 'subcounty', 'county', 'gender', 'address'),
(62, '6326788', 'wekesa OMUSA FREDRICK', '790724009', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', 'BUKHAYO EAST', 'MADENDE PRIMARY', 'NAMBALE ', 'BUSIA', 'MALE', ''),
(64, '7896704', 'OMEKE MASIKA JOICE', '704549793', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', 'BUKHAYO EAST', 'MADENDE PRIMARY', 'NAMBALE ', 'BUSIA', 'FAMALE', ''),
(65, '33305828', 'OKWERO CATHRINE', '759973585', 'NAMUNENE', 'MUNGATSI', 'BUKHAYO EAST', 'BUKHAYO EAST', 'MADENDE PRIMARY', 'NAMBALE ', 'BUSIA', 'FAMALE', ''),
(66, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(67, '', 'Richard Yolk', '0729522550', '', '', '', '', '', '3', '1', '', ''),
(68, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(69, '', 'VIVIAN MUGADO', '713044012', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(70, '', '', 'Safaricom', '', '', '', '', '', '', '', '', ''),
(71, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(72, '9468339', 'MEDIATRIX JUMA', '0701628218', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(73, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(74, '21496462', 'PATRICK MAKOBA', '0729675191', '', '', '', '14', '', '3', '1', 'MALE', ''),
(75, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(76, '10666372', 'BONFACE MASIGA', '0729482754', '', '', '', '14', '', '3', '1', 'MALE', ''),
(77, '11537486', 'JUDY EMASE', '0720569307', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(78, '2058839', 'ORAMISI IMO', '0729482754', '', '', '', '14', '', '3', '1', 'MALE', ''),
(79, '22096753', 'HENRY OMWENE', '0703616124', '', '', '', '14', '', '3', '1', 'MALE', ''),
(80, '9467932', 'FREDRICK WESONGA', '0729521391', '', '', '', '14', '', '3', '1', 'MALE', ''),
(81, '2005666', 'MWATUM NANZALA', '0716784659', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(82, '20070990', 'LAMBERT WANGA', '0729305476', '', '', '', '14', '', '3', '1', 'MALE', ''),
(83, '94668026', 'JACINTA N BARASA', '0711231618', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(84, '7892249', 'EUNICE KAMOLO', '0734739951', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(85, '6891387', 'FESTUS MAKIO', '0741556936', '', '', '', '14', '', '3', '1', 'MALE', ''),
(86, '1352939', 'PAUL BAHATI', '0727333311', '', '', '', '14', '', '3', '1', 'MALE', ''),
(87, '7897408', 'STEPHEN ETIENGA', '0715370260', '', '', '', '14', '', '3', '1', 'MALE', ''),
(88, '13528181', 'VINCENT MAGERO', '0708647084', '', '', '', '14', '', '3', '1', 'MALE', ''),
(89, '6871369', 'BERITA DINDI', '0716189205', '', '', '', '14', '', '3', '1', 'MALE', ''),
(90, '9805693', 'AGNETA MAKOKHA', '0719403871', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(91, '2161917', 'TERESA OKEMO', '0712025705', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(92, '11422436', 'JOSEPHAT OKUMU', '0714065282', '', '', '', '14', '', '3', '1', 'MALE', ''),
(93, '8133788', 'ESTHER ACHARY', '0712098270', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(94, '26158346', 'JOSEPH  OKUMU', '0701619640', '', '', '', '14', '', '3', '1', 'MALE', ''),
(95, '13671512', 'SALIM WEKOBA', '0717174386', '', '', '', '14', '', '3', '1', 'MALE', ''),
(96, '2700548', 'EUNICE NASAMBU', '0725602997', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(97, '1241671', 'PATRICK KARANDIN', '0714467036', '', '', '', '14', '', '3', '1', 'MALE', ''),
(98, '12684127', 'JOSHUA WAFULA', '0726273047', '', '', '', '14', '', '3', '1', 'MALE', ''),
(99, '', 'MERRYLINE OUNDO', '0700871669', '', '', '', '14', '', '3', '1', 'MALE', ''),
(100, '', 'DENNIS OUMA', '0703842804', '', '', '', '14', '', '3', '1', 'FEMALE', ''),
(101, '', 'JULIUS KWOBA', '0725418534', '', '', '', '14', '', '3', '1', 'MALE', ''),
(102, '', '', '', '', '', '', '14', '', '3', '1', 'MALE', ''),
(103, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(104, '2580654', 'ROBER SANDE ODUORI', '0727745966', '', '', '', '30', '', '3', '1', 'MALE', ''),
(105, '22689153', 'PRAXIDES APIYO', '0724858360', '', '', '', '30', '', '3', '1', 'FEMALE', ''),
(106, '9468117', 'EVERLYNE ATSIENO', '0704643750', '', '', '', '30', '', '3', '1', 'FEMALE', ''),
(107, '1683403', 'JOSEPH AKWATA', '0713617966', '', '', '', '30', '', '3', '1', 'MALE', ''),
(108, '11537501', 'TITUS ODONGO', '0729873759', '', '', '', '30', '', '3', '1', 'MALE', ''),
(109, '1685885', 'HEZBON OYIEL', '0701945276', '', '', '', '30', '', '3', '1', 'MALE', ''),
(110, '2063079', 'BENARD AJILITI', '0718791840', '', '', '', '30', '', '3', '1', 'MALE', ''),
(111, '6652607', 'PAUL JOHN BUNYASI', '0724176411', '', '', '', '30', '', '3', '1', 'MALE', ''),
(112, '22515725', 'BENJAMIN OTIENO', '0710873845', '', '', '', '30', '', '3', '1', 'MALE', ''),
(113, '13879007', 'PETER ODUKENYA', '0725906956', '', '', '', '30', '', '3', '1', 'MALE', ''),
(114, '2083135', 'PAMELA EKESA', '0712579431', '', '', '', '30', '', '3', '1', 'FEMALE', ''),
(115, '8133310', 'DONOSIO ODENDO', '0727871127', '', '', '', '30', '', '3', '1', 'MALE', ''),
(116, '9608006', 'MARITANI ADAKI', '0712793923', '', '', '', '30', '', '3', '1', 'FEMALE', ''),
(117, '25040977', 'MICHAEL SIKUKU', '0729737688', '', '', '', '30', '', '3', '1', 'MALE', ''),
(118, '24657718', 'CONSTANT OTSIENO', '0704367335', '', '', '', '30', '', '3', '1', 'MALE', ''),
(119, '7921581', 'JAMES OKWERO', '0723388948', '', '', '', '30', '', '3', '1', 'MALE', ''),
(120, '24426668', 'CAROLINE OPWORA', '0712950582', '', '', '', '30', '', '3', '1', 'FEMALE', ''),
(121, '6769698', 'BERITA MUYODI', '0700881326', '', '', '', '30', '', '3', '1', 'FEMALE', ''),
(122, '11278316', 'BEDICT WASIKE', '0701385916', '', '', '', '30', '', '3', '1', 'MALE', ''),
(123, '9712198', 'IMELDA ATSIENO', '0705760036', '', '', '', '30', '', '3', '1', 'FEMALE', ''),
(124, '23317111', 'TITUS WANDERA WAFULA', '0742974547', '', '', '', '30', '', '3', '1', 'MALE', ''),
(125, '791537', 'WILBERFOCE OUMA', '0707875887', '', '', '', '30', '', '3', '1', 'MALE', ''),
(126, '9607998', 'CHARLES AYITSA', '0710524769', '', '', '', '30', '', '3', '1', 'MALE', ''),
(128, '', 'BONFACE OPEMI WAKHU', '0711583603', '', '', '', '30', '', '3', '1', 'MALE', ''),
(129, '', ' JULIET ATIENO OKOTH', '0721519935', '', '', '', '30', '', '3', '1', 'FEMALE', ''),
(130, '', 'EDWIN OBUYA ODHIAMBO', '0714148232', '', '', '', '30', '', '3', '1', 'MALE', ''),
(131, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(132, '12456515', 'LEVY SIMIYU NYONGESA', '0710300912', '', '', '', '28', '', '3', '1', 'MALE', ''),
(133, '20876030', 'GILBERT OTWANE', '0725346513', '', '', '', '28', '', '3', '1', 'MALE', ''),
(134, '2408765', 'CLEOPHAS  EMASE', '0715171549', '', '', '', '28', '', '3', '1', 'MALE', ''),
(135, '1978785', 'BENARD MASINDE', '0714088207', '', '', '', '28', '', '3', '1', 'MALE', ''),
(136, '31072289', 'MAKIO CHRISTINE', '0727881450', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(137, '25671568', 'ROSE OMIRIKWA', '0706583392', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(138, '2471263', 'ANN  A JUMA', '0711210166', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(139, '30095156', 'CAROLINE A BARASA', '07927990', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(140, '28038899', 'KELLY A OOPAT', '0713451705', '', '', '', '28', '', '3', '1', 'MALE', ''),
(141, '', 'PROTUS  SHIKANGA', '0728432717', '', '', '', '28', '', '3', '1', 'MALE', ''),
(142, '29608504', 'BEATRICE NGEIYWA', '0716080995', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(143, '4334503', 'JOHN E ETYANG', '0742174122', '', '', '', '28', '', '3', '1', 'MALE', ''),
(144, '6075810', 'FELISTUS EDASI', '0713756810', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(145, '948426', 'CLEOPHAS WANZALA', '0724848475', '', '', '', '28', '', '3', '1', 'MALE', ''),
(146, '22771267', 'PIUS ENALACHI', '0704926036', '', '', '', '28', '', '3', '1', 'MALE', ''),
(147, '6774534', 'FLORENCE BARASA', '0716834288', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(148, '11740325', 'LINET WERE SHIKUKU', '0723099422', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(149, '9469268', 'CAREEN OKUTOYI', '0711929662', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(150, '4371478', 'JOSEPH WABWIRE', '0712252803', '', '', '', '28', '', '3', '1', 'FEMALE', ''),
(151, '22918706', 'WYCLIFE DINDI', '0724418714', '', '', '', '28', '', '3', '1', 'MALE', ''),
(152, '26177252', 'DENNIS WANDERA', '0708478525', '', '', '', '28', '', '3', '1', 'MALE', ''),
(153, '6774598', 'PATRICK OKELLO', '0728129247', '', '', '', '28', '', '3', '1', 'MALE', ''),
(154, '9467903', 'SIMON OKIMA', '0726445373', '', '', '', '28', '', '3', '1', 'MALE', ''),
(155, '', 'CHARLES OSIKUKU', '', '', '', '', '28', '', '3', '1', 'MALE', ''),
(156, '6775494', 'MARTIN OSOBOLO', '0724338447', '', '', '', '28', '', '3', '1', 'MALE', ''),
(157, '11597353', 'STEPHEN EKOKU', '0710538910', '', '', '', '28', '', '3', '1', 'MALE', ''),
(158, '', 'CHRISPIN SITIALO', '0720093851', '', '', '', '28', '', '3', '1', 'MALE', ''),
(159, '', 'MOSES OPIYO', '0725535399', '', '', '', '28', '', '3', '1', 'MALE', ''),
(160, '', 'KENNEDY OMUSE', '0729150944', '', '', '', '28', '', '3', '1', 'MALE', ''),
(161, '', 'LAWRENCE JUMA', '0721800375', '', '', '', '28', '', '3', '1', 'MALE', ''),
(162, '', 'MATHEW EKWENYE', '0714513520', '', '', '', '28', '', '3', '1', 'MALE', ''),
(163, '', 'FRANCIS TEMOI', '0727271897', '', '', '', '28', '', '3', '1', 'MALE', ''),
(164, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(165, '6529647', 'CORNELIA NASIMIYU', '0710360514', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(166, '1358452', 'JULIUS WESONGA', '0727271900', '', '', '', '29', '', '3', '1', 'MALE', ''),
(167, '21097728', 'MARY NANGILA WESONGA', '0721722674', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(168, '9468313', 'WILBRODAH BALONGO', '0724639020', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(169, '2058578', 'JACKTON ORUDA ', '0704659743', '', '', '', '29', '', '3', '1', 'MALE', ''),
(170, '25671416', 'JUSTINE ACHIENG JUMA', '0712070940', '', '', '', '29', '', '3', '1', 'MALE', ''),
(171, '10666080', 'STEPHEN BARASA', '0707265274', '', '', '', '29', '', '3', '1', 'MALE', ''),
(172, '6564131', 'JOSAM BULUMA', '0710843402', '', '', '', '29', '', '3', '1', 'MALE', ''),
(173, '66792519', 'FLORENCE MAKOKHA', '0711451386', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(174, '6769470', 'CHARLES OUMA MAKOKHA', '0714632004', '', '', '', '29', '', '3', '1', 'MALE', ''),
(175, '21676172', 'ESTHER WERE CHIRANDE', '0702887187', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(176, '11095246', 'ROSE OGANDA', '0725126749', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(177, '7934316', 'MOSES EFUMBI', '0713850480', '', '', '', '29', '', '3', '1', 'MALE', ''),
(178, '204753', 'ROSE AUMA OKUMU', '0708742296', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(179, '20793817', 'HENRY KUUNDU RECHA', '0727051947', '', '', '', '29', '', '3', '1', 'MALE', ''),
(180, '27000040', 'GEOFFREY ELIMA', '0713718230', '', '', '', '29', '', '3', '1', 'MALE', ''),
(181, '10667472', 'ROSE OMANYO', '0721651691', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(182, '834630', 'PRAXIDES NABWIRE', '0711762543', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(183, '4241904', 'JOSEPH MAKOKHA', '0724018488', '', '', '', '29', '', '3', '1', 'MALE', ''),
(184, '10906416', 'MAXIMILLAH MURAMBI', '0714519210', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(185, '21213428', 'LEONARD WESONGA ', '0714762663', '', '', '', '29', '', '3', '1', 'MALE', ''),
(186, '7921629', 'CHRISPINUS OUMA', '07347313', '', '', '', '29', '', '3', '1', 'MALE', ''),
(187, '9228205', 'KALORI EKESA', '0725103616', '', '', '', '29', '', '3', '1', 'MALE', ''),
(188, '1103077', 'MARGARET ANYANGO', '0704215920', '', '', '', '29', '', '3', '1', 'MALE', ''),
(189, '9173332', 'RUBEN OKINDA NYAPAYA', '0713051693', '', '', '', '29', '', '3', '1', 'FEMALE', ''),
(190, '78797249', 'JOSEPH WESONGA MASIKA', '0711361680', '', '', '', '29', '', '3', '1', 'MALE', ''),
(191, '', 'GERRISHOM PATE', '0723941515', '', '', '', '29', '', '3', '1', 'MALE', ''),
(192, '', 'WILFRED MUNYANI', '0721126924', '', '', '', '29', '', '3', '1', 'MALE', ''),
(193, '', 'PATRICK MABUNDE', '0723098629', '', '', '', '29', '', '3', '1', 'MALE', ''),
(194, '', 'CHRISPINUS OKWARA', '', '', '', '', '29', '', '3', '1', 'MALE', ''),
(195, '', '', '', '', '', '', '29', '', '3', '1', 'MALE', ''),
(196, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(197, '', 'WILFRED ODUORY', '0718989781', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(226, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(227, '', 'WILFRED ODUORY', '718989781', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(228, '', 'CHARLES INDEEDE', '701480628', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(229, '', 'ROSE MALUKWA', '720414784', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'FEMALE', ''),
(230, '', 'SYLVESTER AGULA', '712666479', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(231, '', 'BEN ODUORI', '728802444', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(232, '', 'CHARLES OWINO', '701693739', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(233, '', 'MICHAEL MBOYE', '768776654', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(234, '', 'LAWRENCE OOKO', '706927044', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(235, '', 'DARDY ERICK OKIYA', '746147052', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(236, '', 'MAUREEN NABWIRE', '726512603', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'FEMALE', ''),
(237, '', 'PAUL OPONDO', '726853839', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(238, '', 'JOHN ONYANGO', '720339098', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(239, '', 'GODLIVER KUBALI', '729997303', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(240, '', 'SELINE', '', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'FEMALE', ''),
(241, '', 'STELLA ACHIENG', '716350507', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'FEMALE', ''),
(242, '', 'DISAMS SIMWENYI', '793562921', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(243, '', 'PETER OKUKU', '710896109', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(244, '', 'PHOSTINE OUMA', '728550783', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(245, '', 'FREDRICK ADEYA', '726237345', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(246, '', 'JOHN S MBEJA', '727817641', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(247, '', 'CHARLES OBINYA', '716953855', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(248, '', 'OSCAR', '724897823', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(249, '', 'VICTORIA ROSE OBWAMU', '792670146', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'FEMALE', ''),
(250, '', 'OWINYO CHARLES', '708325297', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(251, '', 'ELIZABETH AOKO', '702744130', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'FEMALE', ''),
(252, '', 'EVALINE TERESA ACHIENG', '715353287', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'FEMALE', ''),
(253, '', 'JANE NEKESA HOTELS', '799573482', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'FEMALE', ''),
(254, '', 'JUDITH  AGROVETS', '723063141', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'FEMALE', ''),
(255, '', 'HANNINGTON MANDAVE', '789594404', 'BUMALA MARKET COMMUN', '', '', '', '', '9', '', 'MALE', ''),
(256, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(257, '', 'HELLEN MARY KADIMA', '0711314524', 'WOMEN LEADERS SAMIA ', '', '', '44', '', '7', '1', '', ''),
(258, '', 'CHRISTINE ACHIENO', '0720616074', 'WOMEN LEADERS SAMIA ', '', '', '42', '', '7', '1', '', ''),
(259, '', 'ROSELINE SEFU', '0723904848', 'WOMEN LEADERS SAMIA ', '', '', '45', '', '7', '1', '', ''),
(260, '', 'FIONA K ODUORI', '0726539114', 'WOMEN LEADERS SAMIA ', '', '', '44', '', '7', '1', '', ''),
(261, '', 'ANGELINA ODUORI', '0716059890', 'WOMEN LEADERS SAMIA ', '', '', '45', '', '7', '1', '', ''),
(262, '', 'ELIZABETH NANJALA', '0711914434', 'WOMEN LEADERS SAMIA ', '', '', '42', '', '7', '1', '', ''),
(263, '', 'CHRISTINE APIYO', '0728152026', 'WOMEN LEADERS SAMIA ', '', '', '43', '', '7', '1', '', ''),
(264, '', 'WILFRIDA ONJELO', '0727414149', 'WOMEN LEADERS SAMIA ', '', '', '45', '', '7', '1', '', ''),
(265, '', 'ALICE A OUNDO', '0711914434', 'WOMEN LEADERS SAMIA ', '', '', '42', '', '7', '1', '', ''),
(266, '', 'JANE NORA OKIDA', '0717729990', 'WOMEN LEADERS SAMIA ', '', '', '43', '', '7', '1', '', ''),
(267, '', 'OGALLE ACHOKA', '0722350798', 'WOMEN LEADERS SAMIA ', '', '', '45', '', '7', '1', '', ''),
(268, '', 'PETRONILA AGOLA', '071112893', 'WOMEN LEADERS SAMIA ', '', '', '43', '', '', '', '', ''),
(269, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(270, '', 'CLAIRE NABWIRE', '0114430507', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(271, '', 'MERCY BELINDA OJIAMBO', '0758262748', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(272, '', 'ENDOVU RAY', '0768978666', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(273, '', 'DICKENS ODHIAMBO', '0710501264', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(274, '', 'WYCKLIFE OUMA', '0721921719', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(275, '', 'JAHVI ISINDU', '0710711300', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(276, '', 'KEN WAFULA', '0727969419', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(277, '', 'MOSES OKENDO', '0714535830', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(278, '', 'MACDONALD OUMA', '0708652971', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(279, '', 'GEORGE EKISA', '0720303673', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(280, '', 'CALEB IMBO', '0720293566', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(281, '', 'RICHARD MAHANDIO', '0724955736', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(282, '', 'GABRIEL BWIRE', '0720453400', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(283, '', 'JULIUS YASUBA ODUMA', '0725891509', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(284, '', 'DICKSON  ODHIAMBO', '0710501264', 'OPAKASI PLAZA BUSIA', '', '', '13', '', '6', '', '', ''),
(285, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(286, '20519334', 'DENIS SAJAH EDEPI', '0720492872', 'VILLAGE ADMINS TESO ', '', '', '17', '', '5', '1', '', ''),
(287, '22711532', 'PAPAI FELIX', '0700240699', 'VILLAGE ADMINS TESO ', '', '', '15', '', '5', '1', '', ''),
(288, '24570167', 'DAVID EKISA', '0707155149', 'VILLAGE ADMINS TESO ', '', '', '16', '', '5', '1', '', ''),
(289, '23088173', 'DICKENS ILUKU', '0740968704', 'VILLAGE ADMINS TESO ', '', '', '19', '', '5', '1', '', ''),
(290, '21865455', 'IDEWA ELIAS IJAKA', '0723258005', 'VILLAGE ADMINS TESO ', '', '', '17', '', '5', '1', '', ''),
(291, '2280386', 'PETER ONYAPIDI', '0723561337', 'VILLAGE ADMINS TESO ', '', '', '11', '', '5', '1', '', ''),
(292, '26173499', 'WAMBANI OMONYA', '0715857798', 'VILLAGE ADMINS TESO ', '', '', '18', '', '5', '1', '', ''),
(293, '23686575', 'PAPA WILSON', '0710782061', 'VILLAGE ADMINS TESO ', '', '', '11', '', '5', '1', '', ''),
(294, '24812958', 'ABEL KIBOI CHEMUOR', '0723554350', 'VILLAGE ADMINS TESO ', '', '', '11', '', '5', '1', '', ''),
(295, '24623644', 'AMOOH ILACHAI ONESMUS', '0793564824', 'VILLAGE ADMINS TESO ', '', '', '19', '', '5', '1', '', ''),
(296, '26177096', 'OKOIT HARON', '0724091527', 'VILLAGE ADMINS TESO ', '', '', '17', '', '5', '1', '', ''),
(297, '20486688', 'EDWIN EMACHAR', '0726632403', 'VILLAGE ADMINS TESO ', '', '', '18', '', '5', '1', '', ''),
(298, '23098638', 'ETYANG ERIARUT', '0734192765', 'VILLAGE ADMINS TESO ', '', '', '15', '', '5', '1', '', ''),
(299, '10748943', 'PAUL IDIAMA', '0727489697', 'VILLAGE ADMINS TESO ', '', '', '18', '', '5', '1', '', ''),
(300, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(301, '31213834', 'MAMBO BARASA ROBERT', '0700861604', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(302, '11279296', 'SARAH N WANGWE', '0714573944', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(303, '81334224', 'EMMANUEL OPILI', '0703831762', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(304, '7517764', 'PATRICK EMURUON', '0711525726', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(305, '4234025', 'JUSTAS MOMAI', '0719213687', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(306, '7421638', 'FRANCIS OPRANG', '0713394721', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(307, '1517905', 'ARNOLD PAPAI', '0714005458', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(308, '4348502', 'VIRGINIA K OUMA', '0710532973', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(309, '16026180', 'GRANDA OWALA', '0712537558', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(310, '14552622', 'JULIA INGATO', '0705310160', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(311, '13166825', 'VICTOR OMASET', '0713198706', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(312, '2064106', 'PETRONILLA AKISA', '0748967712', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(313, '22891027', 'LABORA OGOLLA', '0716131726', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(314, '25291212', 'CAROLYNE EKISA', '0723015732', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(315, '2096498', 'JOHNSTONE BARASA', '0715141530', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(316, '9981918', 'JOSEPH OKEDI', '0707133954', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(317, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(318, '2093477', 'DINDI FRED', '0714650816', 'NAMBALE VILLAGE ADMI', '', '', '29', '', '3', '1', '', ''),
(319, '13169288', 'DINDI JOSEPHINE', '0714516554', 'NAMBALE VILLAGE ADMI', '', '', '46', '', '3', '1', '', ''),
(320, '27629202', 'MOSES WABWIRE WABUKHONYI', '0705471631', 'NAMBALE VILLAGE ADMI', '', '', '29', '', '3', '1', '', ''),
(321, '12687912', 'EVANS NAKHALE', '0714113486', 'NAMBALE VILLAGE ADMI', '', '', '46', '', '3', '1', '', ''),
(322, '26042970', 'OPURONG E SILAUS', '0112443161', 'NAMBALE VILLAGE ADMI', '', '', '28', '', '3', '1', '', ''),
(323, '22348009', 'QUINTO OSWARO', '0722715677', 'NAMBALE VILLAGE ADMI', '', '', '28', '', '3', '1', '', ''),
(324, '20934998', 'KENNETH OMUTOKO', '0711607916', 'NAMBALE VILLAGE ADMI', '', '', '14', '', '3', '1', '', ''),
(325, '25124598', 'BENJAMIN ONGARIA', '0711558512', 'NAMBALE VILLAGE ADMI', '', '', '14', '', '3', '1', '', ''),
(326, '12455685', 'HENRY OMUNACO', '0742228505', 'NAMBALE VILLAGE ADMI', '', '', '28', '', '3', '1', '', ''),
(327, '11822106', 'EVERLYNE BARASA', '0720848551', 'NAMBALE VILLAGE ADMI', '', '', '14', '', '3', '1', '', ''),
(328, '11133680', 'GLADYS AKOTH', '0727060561', 'NAMBALE VILLAGE ADMI', '', '', '29', '', '3', '1', '', ''),
(329, '7977418', 'JOHNSON WANDERA OKATOKO', '0721800241', 'NAMBALE VILLAGE ADMI', '', '', '28', '', '3', '1', '', ''),
(330, '23852693', 'OGUTU IRENE', '0714002829', 'NAMBALE VILLAGE ADMI', '', '', '30', '', '3', '1', '', ''),
(331, '2484662', 'ANN OLIWA', '0726740169', 'NAMBALE VILLAGE ADMI', '', '', '14', '', '3', '1', '', ''),
(332, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(333, '21410150', 'ELLICAH WANYONYI', '0728345929', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(334, '14603253', 'JOHN OKWARE', '0715526326', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(335, '9229387', 'CHARLES OJUMA', '0710157390', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(336, '20432253', 'PHILIP OTWANE IMWENE', '0712289942', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(337, '14531927', 'ABULI CELESTINOS', '0724989921', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(338, '5140500', 'STANLEY OTWANA', '0797031502', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(339, '5141354', 'SYLEVESTER OKWARA', '0729512186', 'AMUKURA PARISH CATKI', '', '', '', '', '6', '1', '', ''),
(340, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(341, '22196404', 'MICHAEL SIOTERO', '0724786122', 'BUDALANGI VILLAGE AD', '', '', '48', '', '8', '1', '', ''),
(342, '25447385', 'JOHN AFUBUA', '0734412031', 'BUDALANGI VILLAGE AD', '', '', '46', '', '8', '1', '', ''),
(343, '27980191', 'COLLINS PENDO', '0717676462', 'BUDALANGI VILLAGE AD', '', '', '49', '', '8', '1', '', ''),
(344, '12685014', 'PAMELA OOKO', '0712495182', 'BUDALANGI VILLAGE AD', '', '', '49', '', '8', '1', '', ''),
(345, '29322974', 'EDWIN ODUORI', '0719204490', 'BUDALANGI VILLAGE AD', '', '', '48', '', '8', '1', '', ''),
(346, '11031434', 'SAMSON WAMEYO', '0725861075', 'BUDALANGI VILLAGE AD', '', '', '49', '', '8', '1', '', ''),
(347, '26072791', 'CHRISTOPHER ADEDE', '0797044846', 'BUDALANGI VILLAGE AD', '', '', '47', '', '8', '1', '', ''),
(348, '25808791', 'JANET WERE', '0711370539', 'BUDALANGI VILLAGE AD', '', '', '48', '', '8', '1', '', ''),
(349, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(350, '28518664', 'CHRISPINUS  E OKISAI', '0703554584', 'BODABODA DRIVERS  LU', '', '', '', '', '6', '1', '', ''),
(351, '10412765', 'GEORGE OWITI', '0713049502', 'BODABODA DRIVERS  AP', '', '', '', '', '6', '1', '', ''),
(352, '24198318', 'PETER OKOITI', '0725444889', 'BODABODA DRIVERS  KA', '', '', '', '', '6', '1', '', ''),
(353, '30366179', 'PETER EKISA O', '0702975727', 'BODABODA DRIVERS  AM', '', '', '', '', '6', '1', '', ''),
(354, '29840721', 'WYCLIFF OBITA', '0708032896', 'BODABODA DRIVERS KAT', '', '', '', '', '6', '1', '', ''),
(355, '33404322', 'KEN OKASIBA', '0705897563', 'BODABODA DRIVERS  KA', '', '', '', '', '6', '1', '', ''),
(356, '20998250', 'JOHN ODEKI', '0700009180', 'BODABODA DRIVERS  KW', '', '', '', '', '6', '1', '', ''),
(357, '3118764', 'FRED KONJA', '0702468915', 'BODABODA DRIVERS KWA', '', '', '', '', '6', '1', '', ''),
(358, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(359, '', 'AMOS OMBISI', '0720108444', 'TREE NURSERY ENTEPRE', '', '', '', '', '', '1', '', ''),
(360, '', 'EMILY OKWARA', '0712543235', 'TREE NURSERY ENTEPRE', '', '', '', '', '', '1', '', ''),
(361, '', 'CATHERINE ACHUNGO', '0713332920', 'TREE NURSERY ENTEPRE', '', '', '', '', '', '1', '', ''),
(362, '', 'PETER OKUDENYA', '0725906956', 'TREE NURSERY ENTEPRE', '', '', '', '', '', '1', '', ''),
(363, '', 'GODFREY EKOKWA', '0705962812', 'TREE NURSERY ENTEPRE', '', '', '', '', '', '1', '', ''),
(364, '', 'JANEFA BARASA', '0704222245', 'WANA DINA SELF HELP ', '', '', '', '', '', '1', '', ''),
(365, '', 'KEZTIA ALESO', '0702975315', 'WANA DINA SELF HELP ', '', '', '', '', '', '1', '', ''),
(366, '', 'CHRISTOPHER SISUMA', '0713789146', 'WANA DINA SELF HELP ', '', '', '', '', '', '1', '', ''),
(367, '', 'ADELAIDE AUMA OMORO', '0724546656', 'MANYOLE JIPANGE SELF', '', '', '30', '', '', '1', '', ''),
(368, '', 'EMMAH NABWIRE', '0799081755', 'MANYOLE JIPANGE SELF', '', '', '30', '', '', '1', '', ''),
(369, '', 'CAROLINE NASIRUMBI', '0706105423', 'MANYOLE JIPANGE SELF', '', '', '30', '', '', '1', '', ''),
(370, '', 'JENTRIX NAMBWOBA', '0718421273', 'MANYOLE JIPANGE SELF', '', '', '30', '', '', '1', '', ''),
(371, '', 'EMILLY AKINYI BUNYASI', '07829655435', 'OLIA KHULUYA LWAO SE', '', '', '', '', '', '1', '', ''),
(372, '', 'MARY CONSOLATA NAFULA', '0712618060', 'OLIA KHULUYA LWAO SE', '', '', '', '', '', '1', '', ''),
(373, '', 'ELIZABETH NEKESA MULAMA', '0786336214', 'OLIA KHULUYA LWAO SE', '', '', '', '', '', '1', '', ''),
(374, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(375, '33770899', 'MIRRIAM BARASA', '0717043579', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(376, '1367432', 'DANIEL KAFWA', '0726834077', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(377, '33112856', 'LEONARD OUMA', '0704110748', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(378, '', 'JAMES ONYANGO', '0111499245', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(379, '', 'GENESISI WANDERA', '', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(380, '', 'JUMA CALBON', '0799525338', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(381, '9338346', 'WILBRODA BARASA', '', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(382, '2785523', 'OPILI JENTRIX', '0717998627', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(383, '28248398', 'ESTHER SUNGU', '0712844226', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(384, '', 'LILIAN ODAYA', '0797113598', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(385, '', 'MARY ANYANGO', '0766635703', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(386, '', 'ROSE ODHIAMBO', '0726216176', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(387, '25566151', 'PAMELA ACHIENG', '0701897117', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(388, '38451289', 'OSCAR NAMENGE', '0742543643', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(389, '24576283', 'CAROLYNE WANDERA', '0715214379', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(390, '28955700', 'PATRICK MANDELA', '0706499799', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(391, '24110850', 'JULIA WANDERA', '0720397034', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(392, '13317597', 'PENNINA EKESA', '0729983736', 'CATERING GROUP MPs H', '', '', '', '', '3', '1', '', ''),
(393, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(394, '', 'LILIAN AUMA', '0713513089', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(395, '', 'FLORENCE ONGACHI', '0717303303', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(396, '', 'JENTRIX AJAMBO', '0769663729', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(397, '', 'EDWIN NGAYWA', '0718464106', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(398, '', 'ABWIRE IRENE ADENGERO', '0712706391', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(399, '', 'SHARON MUSIMBII', '0715786708', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(400, '', 'STEPHEN OUMA', '0768743953', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(401, '', 'GENTRIX CAREY', '0715786708', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(402, '', 'GODLIVER ATIENO AGWATA', '0769730551', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(403, '', 'ERICK OPILO', '0712706391', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(404, '', 'SOFIA NASIRUMBI EGESA', '0710222890', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(405, '', 'AUMA VALARY', '0705047298', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(406, '', 'LAWRENCE KIWANUKA', '0758138164', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(407, '', 'EVANS ODANGA', '', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(408, '', 'SYLVESTER OUMA SANDE', '0103709616', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(409, '', 'LUCY OJUMA EKESA', '0792315246', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(410, '', 'CAREN NYONGESA DINDI', '0741277663', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(411, '', 'IRENE TOMBULA TOLONDO', '0707450279', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(412, '', 'IGNATIUS ALERI DINDI', '0717586397', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(413, '', 'BREANDA OKWARA KUDAYI', '0702347254', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(414, '', 'JANE OPIYO', '', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(415, '', 'MILTON WANDERA', '0758816038', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(416, '', 'HAMATON WESONGA', '0745557046', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(417, '', 'METRIN ADHIAMBO', '', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(418, '', 'ENOS DINSI', '074325588', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(419, '', 'SEROFINA ADIKINYI', '0799309044', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(420, '', 'QUINTO OKANA', '0700561394', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(421, '', 'ESTHER MOMANYI', '0702672024', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(422, '', 'JACCOBATE ONGALE INDAKWA', '', 'LIST  OF PEOPLE WITH', '', '', '14', '', '3', '1', '', ''),
(423, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(424, '', 'ROSELYDA SUMBA', '0713457433', 'MABUNGE ', '', '', '', '', '4', '1', '', ''),
(425, '', 'PETER AMBABA', '0734505272', 'MABUNGE SIEBUKA', '', '', '', '', '4', '1', '', ''),
(426, '', 'KENNETH MADARA', '0710540380', 'MABUNGE MUGOMA', '', '', '', '', '4', '1', '', ''),
(427, '', 'CHRISPINUS OUMA', '0729747930', 'MABUNGE BUDIBIDI', '', '', '', '', '4', '1', '', ''),
(428, '', 'JOEL OGOLA', '0720178899', 'MABUNGE KHUSIEKA', '', '', '', '', '4', '1', '', ''),
(429, '', 'SAMSON WAFULA', '0706719373', 'MABUNGE KINYALA', '', '', '', '', '4', '1', '', ''),
(430, '', 'JAMES EKESA', '0716941049', 'MABUNGE LUNGA', '', '', '', '', '4', '1', '', ''),
(431, '', 'DOULILAS  AMOLO', '0726606264', 'MABUNGE BUSENDE', '', '', '', '', '4', '1', '', ''),
(432, '', 'CHRISTOPHER OKELLO', '0726606264', 'MABUNGE ELIERO', '', '', '', '', '4', '1', '', ''),
(433, '', 'NEREA SANYA', '0727120739', 'MABUNGE LULIBA', '', '', '', '', '4', '1', '', ''),
(434, '', 'JOYCE ALEROLO', '0711447233', 'MABUNGE LUNGA', '', '', '', '', '4', '1', '', ''),
(435, '', 'MARSELIA ADHIAMBO', '0796499', 'MABUNGE BUYAMA', '', '', '', '', '4', '1', '', ''),
(436, '', 'SHWETINO MOKOTCHE', '0711447233', 'MABUNGE LUNIA', '', '', '', '', '4', '1', '', ''),
(437, '', 'KENDY EKOKO', '0723973774', 'MABUNGE BUYAMA', '', '', '', '', '4', '1', '', ''),
(438, '', 'MANG''ENI RICHARD', '0700345868', 'MABUNGE LUNGA', '', '', '', '', '4', '1', '', ''),
(439, '', 'MERCY ARUSI', '0711867831', 'MABUNGE NASEWA', '', '', '', '', '4', '1', '', ''),
(440, '', 'ABRIL AMBUKHO', '0729580533', 'MABUNGE', '', '', '', '', '4', '1', '', ''),
(441, '', 'PHYLIS', '0728634571', 'MABUNGE', '', '', '', '', '4', '1', '', ''),
(442, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(443, '1118692', 'STEPHEN OKWIRA', '0726796258', 'FUNYULA SUB COUNTY V', '', '', '45', '', '7', '1', '', ''),
(444, '12685492', 'PAUL AYIENGA', '0720857520', 'FUNYULA SUB COUNTY V', '', '', '45', '', '7', '1', '', ''),
(445, '23941878', 'VINCENT OCHIENG', '0727405871', 'FUNYULA SUB COUNTY V', '', '', '44', '', '7', '1', '', ''),
(446, '13170625', 'BIRENGE ALFRED OWINO', '0718027398', 'FUNYULA SUB COUNTY V', '', '', '44', '', '7', '1', '', ''),
(447, '24720871', 'JOSHUA WANGIRA', '0703766467', 'FUNYULA SUB COUNTY V', '', '', '44', '', '7', '1', '', ''),
(448, '22579479', 'KIZITO KABNIS', '0723170798', 'FUNYULA SUB COUNTY V', '', '', '43', '', '7', '1', '', ''),
(449, '27087401', 'PETER MUGUBI', '07130944362', 'FUNYULA SUB COUNTY V', '', '', '42', '', '7', '1', '', ''),
(450, '13141671', 'KWENA KWENA SHADRACK', '0721874500', 'FUNYULA SUB COUNTY V', '', '', '43', '', '7', '1', '', ''),
(451, '23057545', 'OYAYA STEPHEN', '0727376270', 'FUNYULA SUB COUNTY V', '', '', '42', '', '7', '1', '', ''),
(452, '27550219', 'BRIGIT WERE', '07921499', 'FUNYULA SUB COUNTY V', '', '', '45', '', '7', '1', '', ''),
(453, '22939994', 'MADINA OSMAN', '0713980144', 'FUNYULA SUB COUNTY V', '', '', '44', '', '7', '1', '', ''),
(454, '21177766', 'AISHA OKUTOYI', '0710314680', 'FUNYULA SUB COUNTY V', '', '', '45', '', '7', '1', '', ''),
(455, '22086080', 'MARLOZE MILTRIZIAN', '0717509661', 'FUNYULA SUB COUNTY V', '', '', '42', '', '7', '1', '', ''),
(456, '25054323', 'FREDRICK OBWAMO', '0715773956', 'FUNYULA SUB COUNTY V', '', '', '43', '', '7', '1', '', ''),
(457, '20803740', 'JOHN WANYAMA', '0726376', 'FUNYULA SUB COUNTY V', '', '', '45', '', '7', '1', '', ''),
(458, '5688697', 'VINCENT AWORI', '0712066726', 'FUNYULA SUB COUNTY V', '', '', '42', '', '7', '1', '', ''),
(459, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(460, '', 'WYCLIFFE W OKUKU', '0729649479', 'MATAYOS WARD COORDIN', '', '', '33', '', '4', '1', '', ''),
(461, '', 'TITUS GIDEON', '0717436487', 'MATAYOS WARD COORDIN', '', '', '34', '', '4', '1', '', ''),
(462, '', 'MORICE O AMBUCHE', '0727242559', 'MATAYOS WARD COORDIN', '', '', '31', '', '4', '1', '', ''),
(463, '', 'SIMON OCHIENG', '0726549259', 'MATAYOS WARD COORDIN', '', '', '33', '', '4', '1', '', ''),
(464, '', 'ELIZABETH OKWARO', '0726531700', 'MATAYOS WARD COORDIN', '', '', '33', '', '4', '1', '', ''),
(465, '', 'QUINTO MARK', '0720249955', 'MATAYOS WARD COORDIN', '', '', '35', '', '4', '1', '', ''),
(466, '', 'SHABAN KULII', '0707635351', 'MATAYOS WARD COORDIN', '', '', '35', '', '4', '1', '', ''),
(467, '', 'LILIAN OWINO', '0728624520', 'MATAYOS WARD COORDIN', '', '', '35', '', '4', '1', '', ''),
(468, '', 'JULIA M MUJERA', '0720984700', 'MATAYOS WARD COORDIN', '', '', '32', '', '4', '1', '', ''),
(469, '', 'CAROLYNE N MWANGI', '0705509803', 'MATAYOS WARD COORDIN', '', '', '35', '', '4', '1', '', ''),
(470, '', 'CLAPPERTON PAMBA', '0725388406', 'MATAYOS WARD COORDIN', '', '', '31', '', '4', '1', '', ''),
(471, '', 'KEVIN OUMA OMOITI', '0798181026', 'MATAYOS WARD COORDIN', '', '', '32', '', '4', '1', '', ''),
(472, '', 'BENARD JUMA', '0723538284', 'MATAYOS WARD COORDIN', '', '', '35', '', '4', '1', '', ''),
(473, '', 'VERONICA ADHIAMBO', '', 'MATAYOS WARD COORDIN', '', '', '31', '', '4', '1', '', ''),
(474, '', 'PHUILIS NABWIRE', '0726312318', 'MATAYOS WARD COORDIN', '', '', '31', '', '4', '1', '', ''),
(475, '', 'ALFRED JUMA', '0717223042', 'MATAYOS WARD COORDIN', '', '', '33', '', '4', '1', '', ''),
(476, '', 'MILDRED AUMA', '0746146318', 'MATAYOS WARD COORDIN', '', '', '34', '', '4', '1', '', ''),
(477, '', 'EUNICE L ORUE', '0714927513', 'MATAYOS WARD COORDIN', '', '', '34', '', '4', '1', '', ''),
(478, '', 'WILFRESHER BARASA', '0716374031', 'MATAYOS WARD COORDIN', '', '', '33', '', '4', '1', '', ''),
(479, '', 'EASTHER AJUMA', '0727908781', 'MATAYOS WARD COORDIN', '', '', '33', '', '4', '1', '', ''),
(480, '', 'ASLI ABDULAHI', '0714743105', 'MATAYOS WARD COORDIN', '', '', '33', '', '4', '1', '', ''),
(481, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(482, '4233971', 'EMMANUEL MUKHWANA', '079738924', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(483, '4233472', 'SEBASTIAN EKISA', '072638949', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(484, '4233219', 'RASMO KHASENYE', '079169778', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(485, '20693839', 'DANIEL EKESA ODHIAMBO', '0702526088', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(486, '4224567', 'DESTERIO OBUSURU EWWATA', '0713705716', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(487, '7920226', 'VINCENT AUTAI OBARI', '0713683773', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(488, '20872505', 'AMOS WANZALA', '0715212424', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(489, '5479570', 'JAMES KWEDHO', '0728803540', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(490, '5233690', 'JOSEPH SOKONI', '0708036739', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(491, '8026410', 'MARY OWINO ACHIENG', '0718538913', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(492, '10907840', 'PATRICIA ETYANG', '0700762815', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(493, '20767434', 'MARTIN MASINDE KORIKO', '0727331541', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(494, '6982344', 'MARCELA KOKONYA', '0791238519', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(495, '6083562', 'VINCENT ADENGOI IYARA', '0712626603', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(496, '11597288', 'ISSAC OSANGER OKUMU', '0712449563', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(497, '7230278', 'SILAS EPETAT  NYONGESA', '0723111433', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(498, '11422751', 'CORNEL AMOIT', '0711473481', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(499, '8809752', 'PHILIP PAKASI', '0719874684', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(500, '423024', 'DANCAN ADOKA IKOLONG', '0705755949', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(501, '8398553', 'MARGARET AUMA ', '0710125531', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(502, '9896166', 'PHANICE NAFULA', '0723706790', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(503, '20874278', 'PETER ORUKO', '0705072947', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(504, '6326688', 'NYONGESA OGOLA', '0706089623', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(505, '4233840', 'LAWRENCE NGEIWYO', '0703498512', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(506, '828174', 'MARY MACHACHA', '0703732141', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(507, '1180433', 'PATRICK OKELLO', '0705887150', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(508, '14530436', 'PATRICK NYONGESA', '0707911586', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(509, '1228644', 'JOSHUA YOKERA', '0703538813', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(510, '22703121', 'WYCLIFE OMUKOTA', '0724046433', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(511, '2855648', 'PETER OPATA', '0711227014', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(512, '7920817', 'PATRICK OBARA OKISAI', '0727861004', 'NAMBALE VILLAGE KAJU', '', '', '28', '', '3', '1', '', ''),
(513, '4234053', 'SYNANUS ORINYO SIRARI', '0708257355', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(514, '10412789', 'BONIFACE ONNO OPUKO', '0708088104', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(515, '4234503', 'JOEL ETYANG', '0742174122', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(516, '11279413', 'NELSON EMOJONG', '0718364290', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(517, '6982344', 'MAERCY ADEDI', '0791238519', 'NAMBALE VILLAGE ELDE', '', '', '28', '', '3', '1', '', ''),
(518, '', '', '', '', '', '', '', '', '3', '1', '', ''),
(519, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(520, '25231772', 'MAXWELL OLUOCH ONGEI', '0729984632', 'MATAYOS VILLAGE ADMI', '', '', '35', '', '4', '1', '', ''),
(521, '25045496', 'AMOS EGESA ONYANGO', '0727065610', 'MATAYOS VILLAGE ADMI', '', '', '33', '', '4', '1', '', ''),
(522, '8616892', 'MESHACK NDEREMA', '0721795394', 'MATAYOS VILLAGE ADMI', '', '', '35', '', '4', '1', '', ''),
(523, '23006729', 'YUYA OKOTH ISSAC', '0723801341', 'MATAYOS VILLAGE ADMI', '', '', '31', '', '4', '1', '', ''),
(524, '36579914', 'OSCAR MALOBA', '0793819766', 'MATAYOS VILLAGE ADMI', '', '', '31', '', '4', '1', '', ''),
(525, '29891538', 'DAVID OKELLO', '0729399728', 'MATAYOS VILLAGE ADMI', '', '', '33', '', '4', '1', '', ''),
(526, '11564360', 'LILIAN OLUOCH', '0726394729', 'MATAYOS VILLAGE ADMI', '', '', '33', '', '4', '1', '', ''),
(527, '24727199', 'MOSES OLAKA', '0720938683', 'MATAYOS VILLAGE ADMI', '', '', '33', '', '4', '1', '', ''),
(528, '12688503', 'KENNETH OUNDO', '0797854221', 'MATAYOS VILLAGE ADMI', '', '', '33', '', '4', '1', '', ''),
(529, '22142911', 'ANTONY MAKOKHA', '0721235191', 'MATAYOS VILLAGE ADMI', '', '', '32', '', '4', '1', '', ''),
(530, '20610445', 'MICHAEL SANDE OUMA ', '0715695224', 'MATAYOS VILLAGE ADMI', '', '', '31', '', '4', '1', '', ''),
(531, '28340350', 'BONFACE WANDERA', '07066109096', 'MATAYOS VILLAGE ADMI', '', '', '32', '', '4', '1', '', ''),
(532, '', 'SIMON OLOO', '0718695443', 'VILLAGE ADMIN MATAYO', '', '', '31', '', '4', '1', 'Male', ''),
(533, '', 'WIFE TO SIMON OLOO VILLAGE ADMIN MATAYOS', '0799736724', 'MATAYOS VILLAGE ADMI', '', '', '31', '', '4', '1', 'Female', ''),
(534, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(535, '', 'VIRGINIA PAMBA BARASA', '0713526848', 'FOCUS WOMEN GROUP ST', '', '', '14', '', '3', '1', '', ''),
(536, '', 'AGNETA AKINYI MAKOKHA', '0719403871', 'FOCUS WOMEN GROUP MA', '', '', '14', '', '3', '1', '', ''),
(537, '', 'BERITA DINDI SISUMA', '0716189205', 'FOCUS WOMEN GROUP MA', '', '', '14', '', '3', '1', '', '');
INSERT INTO `tbl_contacts` (`contact_id`, `id_no`, `names`, `phone_no`, `village`, `sublocation`, `location`, `ward`, `pstation`, `subcounty`, `county`, `gender`, `address`) VALUES
(538, '', 'FRIDAH NAFULA SIMINYU', '0724358733', 'FOCUS WOMEN GROUP SI', '', '', '14', '', '3', '1', '', ''),
(539, '', 'FLORANCE SIKUKU', '0725374348', 'FOCUS WOMEN GROUP EM', '', '', '14', '', '3', '1', '', ''),
(540, '', 'ROSE ASENA', '0700508757', 'FOCUS WOMEN GROUP SE', '', '', '14', '', '3', '1', '', ''),
(541, '', 'ESTHER MARY ACCHARY', '0712098270', 'FOCUS WOMEN GROUP ST', '', '', '14', '', '3', '1', '', ''),
(542, '', 'JACINTA BARASA', '0711231618', 'FOCUS WOMEN GROUP ST', '', '', '14', '', '3', '1', '', ''),
(543, '21788517', 'EMMANUEL OKEMO', '0707408980', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(544, '24204606', 'CALEB ZALI', '0724204606', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(545, '30559600', 'EMMANUEL JUMA', '0704031359', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(546, '26309877', 'MKICHAEL TUMO', '0743202495', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(547, '27737273', 'ROBERT ODHIAMBO', '0713428297', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(548, '9341150', 'PETER KAGWE', '0710166755', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(549, '23886283', 'VINCENT WESONGA', '0717288732', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(550, '36245322', 'STEPHEN OWINO', '0703272211', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(551, '22326713', 'KHAMISI WABWIRE', '0700768006', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(552, '26917769', 'CHARLES JUMA', '0743704872', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(553, '35120108', 'RICKY NYONGESA', '0791183280', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(554, '22346850', 'PATRICK MAJANGA', '0768864017', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(555, '25634182', 'TITUS MAKOKHA', '0704034357', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(556, '24255072', 'COLLINS ODUOR', '0705962810', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(557, '21584570', 'ALEX OGUNA', '0717767171', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(558, '26987978', 'ROSY NABWIRE', '0718490925', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(559, '31329780', 'SIMON KAMANDE', '0754272583', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(560, '20072144', 'ROBERT ODURA', '0714004778', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(561, '25108554', 'JOHN OUMA', '0769408588', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(562, '31762850', 'CHRIS ODHIAMBO', '0708542356', 'NAMBALE MATATU AND L', '', '', '14', '', '3', '1', '', ''),
(563, '', ' LINUS MUSINDAI', '0710564862', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(564, '', 'MOHAMED TITIMU', '0726522505', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(565, '', 'RODGERS EKESA', '0738936671', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(566, '', 'LAMBERT WANGA', '0729305476', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(567, '', 'MOSES DINDI', '0710163389', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(568, '', 'PATRICK WANDERA', '0719745222', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(569, '', 'BENARD SHUNDU', '0712544901', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(570, '', 'SIMON OMBALE', '0727152282', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(571, '', 'JAMES BDIBONDO', '0707211076', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(572, '', 'PETER SANDE', '0710434558', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(573, '', 'SAMWEL OTEKO', '0791867112', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(574, '', 'FRANCIS OKUMU', '0705615079', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(575, '', 'LABAN NYANGWESO', '0710291140', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(576, '', 'JOHN OTIENO', '07104333205', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(577, '', 'PETER KONGANI', '0712870590', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(578, '', 'AMBROSE DINDI', '0791907292', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(579, '', 'DENIS WAFULA', '0792940024', 'NAMBALE TOUTS MANAMB', '', '', '14', '', '3', '1', '', ''),
(580, '', 'ROBERT ODUOR', '0727745968', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(581, '', 'LENTRICK LUSAMBIRI', '0710513695', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(582, '', 'WILSON BARASA', '0714715822', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(583, '', 'TERESA AUMA', '0720208202', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(584, '', 'DENNIS WANDERA', '0721136701', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(585, '', 'ALBERT JUMA', '0711491146', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(586, '', 'LIKA OUNDO', '0723371139', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(587, '', 'SIMON ANALO', '0721791454', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(588, '', 'FRANCIA MALOBA', '0720906815', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(589, '', 'BENARD ODHIAMBO', '0711260234', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(590, '', 'TITUS NAKWARA', '0723701968', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(591, '', 'VICTOR OKUMU', '0715485763', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(592, '', 'PATRICK OKEMO', '0717796767', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(593, '', 'TITUS OKELLO', '0792225914', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(594, '', 'RIBON KHAVAKALI', '0724750897', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(595, '', 'SHEILA ADHIAMBO', '0726445397', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(596, '', 'PATRICK MASIGA', '0714004731', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(597, '', 'THOMAS BARASA', '0715376246', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(598, '', 'CHARLES JUMA', '0703147409', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(599, '', 'MOSES ROI', '0716825180', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(600, '', 'GODFRET NYONGES', '0792918071', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(601, '', 'ZADOCK KOLLI', '0711699810', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(602, '', 'INGINECCIA AUMA', '0716910420', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(603, '', 'FREDRICK ERIKI', '0700821778', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(604, '', 'LAMBAT LUBALO', '0702051442', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(605, '', 'EUGINE NYONGESA', '0703364363', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(606, '', 'CHARLES OMONDI', '0718032701', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(607, '', 'WILLIAM OMERI', '0724690518', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(608, '', 'JANET WAMBANI', '0729327995', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(609, '', 'LAWRENCE OUMA', '0708337520', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(610, '', 'GILBERT OKUMU', '0724790097', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(611, '', 'INDECHE MOSES', '0712104482', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(612, '', 'JUSTUS ODUOR', '0718866039', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(613, '', 'ANTONY EKESA', '0716687909', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(614, '', 'CHARLES MUNUMBI', '0715894877', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(615, '', 'GEORGE MANGENI', '0702700390', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(616, '', 'MARTHA ATIENO', '0705003043', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(617, '', 'TIMOTHY ODHIAMBO', '0726423977', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(618, '', 'FREDRICK MATAYO', '0797301953', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(619, '', 'WILLBERFOCE OUMA', '0799060646', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(620, '', 'MARITINA BARASA', '0799600922', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(621, '', 'JOHN WESONGA', '0797301953', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(622, '', 'ALBERT EKASIBA', '0720675247', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(623, '', 'CHARLES ADEMBO', '0727249315', 'BODA BODA DRIVERS NA', '', '', '14', '', '3', '1', '', ''),
(624, '', 'GEOFREY SAKWA', '0725741070', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(625, '', 'MATHEW ASIYA', '0700662064', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(626, '', 'AYUB ODHIAMBO', '0726445426', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(627, '', 'DAVID WAMBIA', '0703848027', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(628, '', 'MILCAH OMULA', '0706561303', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(629, '', 'ABDALA ORAMBO', '0710186052', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(630, '', 'STEPHEN JUMA', '0768623216', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(631, '', 'MARGARET NAMASAKA', '0701249648', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(632, '', 'EVERLYNE EKESA', '0742121998', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(633, '', 'CAROLINE NABWIRE', '0743160549', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(634, '', 'BENARD WESONGA', '0717001129', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(635, '', 'VIOLET AKINYI', '0703449968', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(636, '', 'JOB OTSIENO', '0717040795', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(637, '', 'GIODFREY WANDERA', '0717297191', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(638, '', 'KEVIN OUMA', '0711352185', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(639, '', 'VINCENT OKELLO', '0714482433', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(640, '', 'GODFREY OMUKAGA', '0726880454', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(641, '', 'DONAT ODUORI', '0703294322', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(642, '', 'FREDRICK OKELLO', '0729467028', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(643, '', 'ANN OJAKA', '0725845854', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(644, '', 'PATRICK  JUMA', '0705511881', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(645, '', 'THOMAS ALAKO', '0794215885', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(646, '', 'HASSAN NDATI', '0706295539', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(647, '', 'SAMWEL KHAULE', '0713789738', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(648, '', 'FREDRICK SAKWA', '0712981983', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(649, '', 'LINUS OKOYO ', '0757930223', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(650, '', 'DENNIS MUYODI', '0727627538', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(651, '', 'MARK MUNYEKENYE', '0798106293', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(652, '', 'HUSSEIN ALI', '0708588266', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(653, '', 'MOSES SAKWA', '0723019014', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(654, '', 'PHENUS BARASA', '0743891366', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(655, '', 'SILAS WESONGA', '0743262831', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(656, '', 'AUGUSTINE OTEBA', '0714183493', 'MUNGATSI BODA BODA D', '', '', '14', '', '3', '1', '', ''),
(657, '', 'ALBERT OKWII', '0711112078', 'ITEKO NAMBALE TOWNSH', '', '', '14', '', '3', '1', '', ''),
(658, '', 'CHRISPINUS NYONGESA', 'O712636789', 'ITEKO NAMBALE TOWNSH', '', '', '14', '', '3', '1', '', ''),
(659, '', 'JOHN OKELELE ', '0721592518', 'ITEKO NAMBALE TOWNSH', '', '', '14', '', '3', '1', '', ''),
(660, '', 'MARGARET CHALE', '0712374191', 'ITEKO NAMBALE TOWNSH', '', '', '14', '', '3', '1', '', ''),
(661, '', 'ALLAN ETYANG', '0716434868', 'ITEKO NAMBALE TOWNSH', '', '', '14', '', '3', '1', '', ''),
(662, '', 'GEORGINA AMOIT', '0705693901', 'ITEKO NAMBALE TOWNSH', '', '', '14', '', '3', '1', '', ''),
(663, '', 'SHOBBY EKASIBA', '0715901448', 'ITEKO NAMBALE TOWNSH', '', '', '14', '', '3', '1', '', ''),
(664, '', 'DONALD P IPERO', '0710926511', 'ITEKO NAMBALE TOWNSH', '', '', '14', '', '3', '1', '', ''),
(665, '', 'LAWRENCE ORAMIS', '0716107965', 'ITEKO NAMBALE TOWNSH', '', '', '14', '', '3', '1', '', ''),
(666, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(667, '', 'WANCHA ISMAIL', '0725276158', '', '', '', '44', '', '7', '1', '', ''),
(668, '', 'ASHIRAF BURHAN', '0702401914', '', '', '', '35', '', '4', '1', '', ''),
(669, '', 'ABDI MOHAMMED', '0723038893', '', '', '', '35', '', '4', '1', '', ''),
(670, '', 'SHEIKH MUHAMMAD', '0722254547', '', '', '', '35', '', '4', '1', '', ''),
(671, '', 'SHEIKH YUSUF', '0701890673', '', '', '', '48', '', '4', '1', '', ''),
(672, '', 'SHABAN HAMAD', '0714580904', '', '', '', '48', '', '4', '1', '', ''),
(673, '', 'ABDKTAR YUSUF', '0727434811', '', '', '', '48', '', '4', '1', '', ''),
(674, '', 'MOHAMMED OMAR', '0724980923', '', '', '', '44', '', '7', '1', '', ''),
(675, '', 'ABDUL WABWIRE', '0710277758', '', '', '', '14', '', '3', '1', '', ''),
(676, '', 'ABUBAKAR BAGOYA', '0724097048', '', '', '', '43', '', '7', '1', '', ''),
(677, '', 'MUSA IMWENE', '0768730079', '', '', '', '28', '', '3', '1', '', ''),
(678, '', 'ALI EMOJONG', '0712127118', '', '', '', '19', '', '5', '1', '', ''),
(679, '', 'SALEH OPILI', '0723468045', '', '', '', '19', '', '6', '1', '', ''),
(680, '', 'KASSIM SUMBA', '0726403962', '', '', '', '13', '', '6', '1', '', ''),
(681, '', 'ABDUL RASHID', '0723990244', '', '', '', '31', '', '4', '1', '', ''),
(682, '', 'OMARI ALI', '0718427851', '', '', '', '14', '', '4', '1', '', ''),
(683, '', 'MOHAMEED RAMADHAN', '0727799309', '', '', '', '13', '', '3', '1', '', ''),
(684, '', 'SULEIMAN MOHAMMED', '0700056009', '', '', '', '12', '', '6', '1', '', ''),
(685, '', 'ABDUSHAKUL ABO', '0795228030', '', '', '', '13', '', '6', '1', '', ''),
(686, '', 'RAMADHAN MUSA', '0728999794', '', '', '', '48', '', '6', '1', '', ''),
(687, '', 'ABDUL AZIZ MUHAMMAD ALI', '0710734530', '', '', '', '48', '', '8', '1', '', ''),
(688, '', 'ALI NGUU', '0726088157', '', '', '', '48', '', '8', '1', '', ''),
(689, '', 'ABUL SHAKUR HASSAN', '0707238563', '', '', '', '22', '', '8', '1', '', ''),
(690, '', 'ABDUKLUKALRMARAN', '0794930416', '', '', '', '43', '', '8', '1', '', ''),
(691, '', 'SALIM ABDUL RAJAB', '0717408174', '', '', '', '43', '', '6', '1', '', ''),
(692, '', 'ABDUL MARK LUMBA', '0720209965', '', '', '', '36', '', '7', '1', '', ''),
(693, '', 'ALI BARASA', '0729469637', '', '', '', '16', '', '4', '1', '', ''),
(694, '', 'SADAT KIBIRA', '0721352536', '', '', '', '35', '', '6', '1', '', ''),
(695, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(696, '', 'EDWARD MANDERA', '711635129', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(697, '', 'PETER MANG''ENI', '724734533', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(698, '', 'PHYLIS NAMULANDA', '700664159', 'WOMEN LEADER MATAYOS', '', '', '33', '', '4', '1', '', ''),
(699, '', 'GRACE NANZALA', '710174517', 'WOMEN LEADER MATAYOS', '', '', '33', '', '4', '1', '', ''),
(700, '', 'CONSTANTINE LEAH', '728641244', 'WOMEN LEADER MATAYOS', '', '', '33', '', '4', '1', '', ''),
(701, '', 'MIRRIAM N MAKOKHA', '711113844', 'WOMEN LEADER MATAYOS', '', '', '33', '', '4', '1', '', ''),
(702, '', 'ALFRED J ODERO', '726312318', 'WARD COORDINATOR MAT', '', '', '33', '', '4', '1', '', ''),
(703, '', 'SIMON OCHIENG ODHIAMBO', '726549259', 'MATAYOS COORDINATOR ', '', '', '33', '', '4', '1', '', ''),
(704, '', 'ALBERT NYONGESA', '795399866', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(705, '', 'GEORGE ODUNGA', '723643328', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(706, '', 'ROBERT OGOLLA', '728028732', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(707, '', 'JOHN OWINO', '710402497', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(708, '', 'CHRISTOPHER OUNDO', '714582955', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(709, '', 'HENRY OUMA', '703725273', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(710, '', 'PHILIP ONDUNGU', '712320729', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(711, '', 'MOSES OKUMU', '728928643', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(712, '', 'FERDINAND WAFULA', '720953215', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(713, '', 'ALOYS BARASA', '727305526', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(714, '', 'DIANA AWINO', '710345078', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(715, '', 'FRANKLINE MALOBA', '710163493', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(716, '', 'GODFREY KLINSMAN', '0721125715', 'BODABODA MATAYOS SOU', '', '', '33', '', '4', '1', '', ''),
(717, '', 'ROSELYN SUMBA', '0713457433', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(718, '', 'PETER AMBASA', '0734505272', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(719, '', 'KENNEDY MADAKA', '0710540380', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(720, '', 'CHRISPINUS OUMA', '0729747930', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(721, '', 'JOEL OGOLA', '0720178899', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(722, '', 'SAMSON WAFULA', '0706719373', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(723, '', 'JAMES EKESA', '0716941049', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(724, '', 'DOUGLAS AMOLO', '0726262992', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(725, '', 'CHRISTOPHER OKELLO', '0726606264', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(726, '', 'NAREA SANYA', '7027120739', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(727, '', 'JOICE OLENGO', '', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(728, '', 'MARSELLA ADHIAMBO', '', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(729, '', 'SHETWIN MUKOTSE', '0711447233', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(730, '', 'KENNEDY EKUKO', '0723973774', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(731, '', 'RICHARD MANG''ENI', '0700345868', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(732, '', 'MERCY ARUSI', '0711867831', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(733, '', 'AGGREY AMBUNGU ', '0729580533', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(734, '', 'PHILIS AMBUNGU', '0728634571', 'OPINION LEADER MATAY', '', '', '33', '', '4', '1', '', ''),
(735, '', 'FRANSISCA NAMUKURU', '0707029824', 'OPINION LEADER MAYAY', '', '', '34', '', '4', '1', '', ''),
(736, '', 'GABRIEL O OTIENO', '0721271083', 'OPINION LEADER MAYAY', '', '', '34', '', '4', '1', '', ''),
(737, '', 'JOHN WANYAMA', '0734422777', 'OPINION LEADER MAYAY', '', '', '34', '', '4', '1', '', ''),
(738, '', 'CONSOLATA SHOKHUNJILA', '0743293777', 'WOMEN LEADER MATAYOS', '', '', '34', '', '4', '1', '', ''),
(739, '', 'JANIPHER AKWARE', '0701006609', 'WOMEN LEADER MATAYOS', '', '', '34', '', '4', '1', '', ''),
(740, '', 'EUNICE LUCY ORUU', '071436487', 'MATAYOS COORDNIATORS', '', '', '34', '', '4', '1', '', ''),
(741, '', 'TITUS GIDEON', '0717436487', 'MATAYOS COORDNIATORS', '', '', '34', '', '4', '1', '', ''),
(742, '', 'PATRICK WAFULA', '0703558630', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(743, '', 'MAURICE WANDERA', '0725651596', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(744, '', 'JOHNSTONE OKWARA', '0724692169', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(745, '', 'PATRICK W KASIBA', '0711485102', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(746, '', 'GETRUDE WANDERA', '0729352048', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(747, '', 'FLORENSE NAMUSHI', '0707303575', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(748, '', 'QUINTO NYONGESA', '0720658511', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(749, '', 'FLORENCE OWOKO', '0722809093', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(750, '', 'EUNICE OMUSOTSI', '0715102877', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(751, '', 'FRANCIS BARASA', '0726658449', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(752, '', 'FLORENCIO MUGENI', '0720935843', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(753, '', 'BEATRICE LUKOBA', '0711506371', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(754, '', 'GOUGLAS WABWIRE', '0726533144', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(755, '', 'HANNINGTON LUKOBA', '0723406696', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(756, '', 'RUTH LUKOBA', '0714565466', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(757, '', 'BENARD MWIRA', '0727247846', 'OPINION LEADERS MATA', '', '', '34', '', '4', '1', '', ''),
(758, '', 'TITUS GIDEON', '0717436487', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(759, '', 'SAMSON PAMBA', '0702289229', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(760, '', 'HANNINGTON EGESA', '07040223729', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(761, '', 'VINCENT ODUOR', '0728234205', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(762, '', 'HUMPREY OUMA', '0715442819', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(763, '', 'KENNETH SHIKUKU', '0712651272', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(764, '', 'CHRISPINUS OKUKU', '0707852700', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(765, '', 'DOUGLAS OJIAMBO', '0714808822', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(766, '', 'JULIES NYANGARANGA', '0710277735', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(767, '', 'WINSTONE OKAKA', '0714156177', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(768, '', 'IGNATIUS OUMA ORIYO', '0721969414', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(769, '', 'MELVIN HAMISI', '0711694656', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(770, '', 'JOSEPHAT OMURUMULA', '0714081819', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(771, '', 'STEPHEN WASIKE', '0721478635', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(772, '', 'PETER MAKANA', '0729549044', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(773, '', 'HUMPHREY WESONGA', '0713964152', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(774, '', 'EMMANUEL WANDERA', '0707312168', 'MATATOS BODABODA  RI', '', '', '34', '', '4', '1', '', ''),
(775, '', 'MILDRED AUMA', '0717223042', 'WOMEN FOCUS GROUP MA', '', '', '34', '', '4', '1', '', ''),
(776, '', 'BEATRICE ADHIAMBO', '0701602218', 'WOMEN FOCUS GROUP MA', '', '', '34', '', '4', '1', '', ''),
(777, '', 'CELESTINE OSORE', '0707801894', 'WOMEN FOCUS GROUP MA', '', '', '34', '', '4', '1', '', ''),
(778, '', 'SHARON OSIBA', '0702306574', 'WOMEN FOCUS GROUP MA', '', '', '34', '', '4', '1', '', ''),
(779, '', 'JOYCE MAWEU', '0719137902', 'WOMEN FOCUS GROUP MA', '', '', '34', '', '4', '1', '', ''),
(780, '', 'EUNICE ORWA', '0714927513', 'WOMEN FOCUS GROUP MA', '', '', '34', '', '4', '1', '', ''),
(781, '', 'HENRY KHALENDE', '0720907182', 'OPINION LEADER MATAY', '', '', '32', '', '4', '1', '', ''),
(782, '', 'JOSHUA OUMA', '0724584998', 'OPINION LEADER MATAY', '', '', '32', '', '4', '1', '', ''),
(783, '', 'NANCY BUSISA', '0723762398', 'WOMEN LEADERS MATAYO', '', '', '32', '', '4', '1', '', ''),
(784, '', 'ZIPPORAH MAYIAH', '070038320', 'WARD REPRESENTATIVES', '', '', '32', '', '4', '1', '', ''),
(785, '', 'MOSES MULEKE', '0727121246', 'FIRM VIEW MATAYOS MA', '', '', '32', '', '4', '1', '', ''),
(786, '', 'CAROLYNE MWANGI NAMASI', '0705509803', 'FIRM VIEW MATAYOS MA', '', '', '32', '', '4', '1', '', ''),
(787, '', 'JULIET ODUOR', '0725363396', 'FIRM VIEW MATAYOS MA', '', '', '32', '', '4', '1', '', ''),
(788, '', 'ZAHRA ABDI', '0721646538', 'FIRM VIEW MATAYOS MA', '', '', '32', '', '4', '1', '', ''),
(789, '', 'EDWIN ODUYA', '0721296748', 'FIRM VIEW MATAYOS MA', '', '', '32', '', '4', '1', '', ''),
(790, '', 'LILIAN A AWINO', '0728624520', 'MATAYOS COORDINATORS', '', '', '32', '', '4', '1', '', ''),
(791, '', 'KELVIN OUMA', '0798181026', 'MATAYOS COORDINATORS', '', '', '32', '', '4', '1', '', ''),
(792, '', 'JULIA MUJERA', '0720984700', 'WOMEN FOCUS GROUP MA', '', '', '32', '', '4', '1', '', ''),
(793, '', 'VIOLET ALIVIZA', '0726449208', 'WOMEN FOCUS GROUP MA', '', '', '32', '', '4', '1', '', ''),
(794, '', 'JOYCE NAMENGE', '0711781576', 'WOMEN FOCUS GROUP MA', '', '', '32', '', '4', '1', '', ''),
(795, '', 'LEONARD ACHIENG', '0728288542', 'WOMEN FOCUS GROUP MA', '', '', '32', '', '4', '1', '', ''),
(796, '', 'MARGERET WERE', '0725783125', 'WOMEN FOCUS GROUP MA', '', '', '32', '', '4', '1', '', ''),
(797, '', 'MARGERET NAFULA', '0728942120', 'WOMEN FOCUS GROUP MA', '', '', '32', '', '4', '1', '', ''),
(798, '', 'MILDRED OKUMU', '0728764711', 'WOMEN FOCUS GROUP MA', '', '', '32', '', '4', '1', '', ''),
(799, '', 'BAETRICE NELIMA', '0721201211', 'WOMEN LEADERS MATAYO', '', '', '35', '', '4', '1', '', ''),
(800, '', 'NANCY ADHIAMBO', '0727393320', 'WOMEN LEADERS MATAYO', '', '', '35', '', '4', '1', '', ''),
(801, '', 'JACOB MARIGA', '0720414106', 'FIRM VIEW MEETING MA', '', '', '35', '', '4', '1', '', ''),
(802, '', 'ANDREW MARITA', '0720240069', 'FIRM VIEW MEETING MA', '', '', '35', '', '4', '1', '', ''),
(803, '', 'GABRIEL ODANGA OKOTH', '0726052734', 'FIRM VIEW MEETING MA', '', '', '35', '', '4', '1', '', ''),
(804, '', 'RAYMOND MASIGA BULUMA', '0722629971', 'FIRM VIEW MEETING MA', '', '', '35', '', '4', '1', '', ''),
(805, '', 'BALOZI AHMED ALI', '0723305955', 'FIRM VIEW MEETING MA', '', '', '35', '', '4', '1', '', ''),
(806, '', 'LUKOYI', '0705509803', 'FIRM VIEW MEETING MA', '', '', '35', '', '4', '1', '', ''),
(807, '', 'ESTHER AJUMA', '0727903781', 'WARD CORDINATOR MATA', '', '', '35', '', '4', '1', '', ''),
(808, '', 'LILLIAN OWINO', '0728624520', 'WARD CORDINATOR MATA', '', '', '35', '', '4', '1', '', ''),
(809, '', 'VERONICA ADHIAMBO', '0703503845', 'BUSINESS COMMUNITY M', '', '', '35', '', '4', '1', '', ''),
(810, '', 'BRENDA WEKESA', '0729089872', 'BUSINESS COMMUNITY M', '', '', '35', '', '4', '1', '', ''),
(811, '', 'PRISCILLA OMWENE', '0713029667', 'BUSINESS COMMUNITY M', '', '', '35', '', '4', '1', '', ''),
(812, '', 'MILDRED AUMA', '0717223042', 'BUSINESS COMMUNITY M', '', '', '35', '', '4', '1', '', ''),
(813, '', 'SERAING ADIKINYI', '0795200832', 'BUSINESS COMMUNITY M', '', '', '35', '', '4', '1', '', ''),
(814, '', 'WILFRESHA  BARASA', '0716374031', 'BUSINESS COMMUNITY M', '', '', '35', '', '4', '1', '', ''),
(815, '', 'JAPHESA OKOYO', '0728152810', 'BUSINESS COMMUNITY M', '', '', '35', '', '4', '1', '', ''),
(816, '', 'WILKISTER MUSUNDI', '0711954732', 'BUSINESS COMMUNITY M', '', '', '35', '', '4', '1', '', ''),
(817, '', 'DOLPHINE OGUTU', '0701162192', 'MATAYOS WOMEN FOCUS ', '', '', '35', '', '4', '1', '', ''),
(818, '', 'PAMELA OLUMI', '0727250609', 'MATAYOS WOMEN FOCUS ', '', '', '35', '', '4', '1', '', ''),
(819, '', 'APULINE ACHIENG', '0718218700', 'MATAYOS WOMEN FOCUS ', '', '', '35', '', '4', '1', '', ''),
(820, '', 'ANJELINE ATIENO', '0712869639', 'MATAYOS WOMEN FOCUS ', '', '', '35', '', '4', '1', '', ''),
(821, '', 'JANE OPIYO', '0712866939', 'MATAYOS WOMEN FOCUS ', '', '', '35', '', '4', '1', '', ''),
(822, '', 'LENA ACHIENG', '0714062596', 'MATAYOS WOMEN FOCUS ', '', '', '35', '', '4', '1', '', ''),
(823, '', 'LILIAN AJUMA', '0727903781', 'MATAYOS WOMEN FOCUS ', '', '', '35', '', '4', '1', '', ''),
(824, '', '', '', 'MATAYOS WOMEN FOCUS ', '', '', '35', '', '4', '1', '', ''),
(825, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(826, '', 'JOHN  PATRICK OBELai', '0723338609', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(827, '', 'PETER OKOIT', '0725442489', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(828, '', 'FRANVCIS WANYONYI', '0715892885', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(829, '', 'FOBION ISOGOL', '0711632820', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(830, '', 'WILBRODA AUMA', '0705330789', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(831, '', 'ACHIENG CONSOLATA', '0712296257', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(832, '', 'WAFULA FELIST', '0707654387', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(833, '', 'ROSELYNE NAMBIRO', '0701063272', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(834, '', 'JOSEPHAT ORUKO ', '0791379183', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(835, '', 'BENARD ODERA', '0790106031', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(836, '', 'DANIELOMASET', '0719060415', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(837, '', 'QUINTO OMUDECK', '0714586858', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(838, '', 'MARTIN OGIRAKOL', '0705248664', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(839, '', 'JACKSON IDERA', '0794211600', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(840, '', 'GEOFFREY EMALAGWAT', '0757536686', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(841, '', 'ISSAC OMUKAGA', '0769170308', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(842, '', 'DISMAS ETYANG', '0707490812', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(843, '', 'VINCENT PAPAI', '0759221697', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(844, '', 'REBECCCA OKWAKOU', '0707933632', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(845, '', 'CAROLINE OKAPES', '0701927461', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(846, '', 'CHRISTINE MASAMBU', '0713981821', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(847, '', 'VICTOR OSIYA', '0700158092', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(848, '', 'MAXIMILLAH ACHOBO', '0703179038', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(849, '', 'FRANCIS AMASE', '0728758487', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(850, '', 'DEBORAH WANYAMA', '0748074844', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(851, '', 'JUSDITH CHEPTEMOI', '0796645144', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(852, '', 'JUDITH AKADIKOR', '0748967728', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(853, '', 'JANET OKWARA', '0746373111', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(854, '', 'PATRICK EMOIT', '0718183605', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(855, '', 'JULIUS OTINGA', '0717336339', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(856, '', 'EVANS OSKUKU', '0716771359', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(857, '', 'EVANS OBWANGA', '0798741473', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(858, '', 'SILVIA OWINO', '0706020440', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(859, '', 'DAVID ODUORY', '0717036948', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(860, '', 'SLESTINE AWUOR', '0710340838', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(861, '', 'JANE WABWIRE', '0701657993', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(862, '', 'JULIET NASIRUMBI', '0797523242', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(863, '', 'NATASHIA BABRA', '0752269803', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(864, '', 'CLEMENTINE NAROCHO', '0701143238', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(865, '', 'PRICISILLA ASIBA', '0726283823', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(866, '', 'GODLIVER NYONGESA', '0704643786', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(867, '', 'CALISTUS KIAMATWA', '0727940090', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(868, '', 'THOMAS IMODO', '0713720343', 'BODA BODA RIDERS KAM', '', '', '18', '', '5', '1', '', ''),
(869, '', 'DENNIS WAGANDA', '0714249357', 'VILLAGE ELDER TESO N', '', '', '18', '', '5', '1', '', ''),
(870, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(871, '', 'OLAKACUNA OMUSE', '0711642421', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(872, '', 'DEOGRACIOUS OWAYA', '0710814615', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(873, '', 'JOSEPH ESEME', '0722964652', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(874, '', 'MIRIAM OSIYA', '0723628516', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(875, '', 'CLEOPHAS ALUKU', '0726843918', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(876, '', 'ROMANO ETYANG', '0720344835', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(877, '', 'JOHN KIATU OMODING', '0728254286', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(878, '', 'MAURICE OPUWA', '0726895265', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(879, '', 'SHADRACK IKISAI', '0725792343', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(880, '', 'ALEX OMOIT', '0726844134', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(881, '', 'PATRICK IDOKE', '0712518246', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(882, '', 'MIRIAM ONYAPIDI', '0726312620', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(883, '', 'DAN MASAKE', '0728597278', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(884, '', 'PAUL EKWENYE OLUNGA', '0720046272', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(885, '', 'FEDILIS ATYANG JAKAIT', '0726818086', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(886, '', 'EMODOI ORIDI', '0725147810', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(887, '', 'BONIFACE OYUGI', '0724349086', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(888, '', 'OMUSE FELEX', '0728705176', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(889, '', 'DAN EPALAT ', '0718000454', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(890, '', 'FRANCIS ODEWA', '0716662342', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(891, '', 'JOHN ODEWA', '0711226006', 'KNUT OFFICIALS TESO ', '', '', '', '', '5', '1', '', ''),
(892, '', 'PROF. BARUA JOEL', '0723825482', 'OPINION SHAPER TESO ', '', '', '', '', '5', '1', '', ''),
(893, '', 'HON. OTE OBOYERE', '0726078045', 'OPINION SHAPER TESO ', '', '', '', '', '5', '', '', ''),
(894, '', 'DR. FREDRICK PAPA', '0724697540', 'OPINION SHAPER TESO ', '', '', '', '', '5', '1', '', ''),
(895, '', 'PETER AMOIT', '0721644971', 'OPINION SHAPER TESO ', '', '', '', '', '5', '1', '', ''),
(896, '', 'DAVID IMWENE', '0725692966', 'OPINION SHAPER TESO ', '', '', '', '', '5', '1', '', ''),
(897, '', 'PATRICK ODEKE', '0722274132', 'OPINION SHAPER TESO ', '', '', '', '', '5', '1', '', ''),
(898, '', 'MOSES OMUSE', '0725930233', 'OPINION SHAPER TESO ', '', '', '', '', '5', '1', '', ''),
(899, '', 'HON. MAURICE CHITAMBE', 'O724079034', 'OPINION SHAPER TESO ', '', '', '', '', '5', '1', '', ''),
(900, '', 'HON. IMWENE', '0714570651', 'OPINION SHAPER TESO ', '', '', '', '', '5', '1', '', ''),
(901, '', 'HON. MOSES MAMAI', '0720955434', 'OPINION SHAPER TESO ', '', '', '', '', '5', '1', '', ''),
(902, '', 'SAMSON OLULWAYI', '0727456561', 'TESO NORTH ELDERS AT', '', '', '20', '', '5', '1', '', ''),
(903, '', 'CANON MASAKE', '0722875182', 'TESO NORTH ELDERS AT', '', '', '20', '', '5', '1', '', ''),
(904, '', 'LEVI MUGANDA', '0729377963', 'TESO NORTH ELDERS AT', '', '', '20', '', '5', '1', '', ''),
(905, '', 'DEDAN OMANYALE', '072714079', 'TESO NORTH ELDERS AT', '', '', '20', '', '5', '1', '', ''),
(906, '', 'ROSEMARY ILUKU', '0725239836', 'TESO NORTH ELDERS AT', '', '', '20', '', '5', '1', '', ''),
(907, '', 'JACKLINE IPALE', '0712330356', 'TESO NORTH ELDERS AT', '', '', '20', '', '5', '1', '', ''),
(908, '', 'ELIUD IKINENG', '0723609158', 'TESO NORTH ELDERS AT', '', '', '19', '', '5', '1', '', ''),
(909, '', 'MIRIAM IBABUKONY', '0726129381', 'TESO NORTH ELDERS AT', '', '', '19', '', '5', '1', '', ''),
(910, '', 'NELSON OCHOKO', '0719298264', 'TESO NORTH ELDERS AT', '', '', '19', '', '5', '1', '', ''),
(911, '', 'LIVINGSTONE OMASETE', '0728226974', 'TESO NORTH ELDERS AT', '', '', '19', '', '5', '1', '', ''),
(912, '', 'HELLEN OMUDEK', '0706063185', 'TESO NORTH ELDERS AT', '', '', '19', '', '5', '1', '', ''),
(913, '', 'MARGARET ACOM', '0700111107', 'TESO NORTH ELDERS AT', '', '', '19', '', '5', '1', '', ''),
(914, '', 'BENJAMIN EKOJOT', '0724050134', 'TESO NORTH ELDERS AT', '', '', '17', '', '5', '1', '', ''),
(915, '', 'FRANCIS ISANYU', '0725254046', 'TESO NORTH ELDERS AT', '', '', '17', '', '5', '1', '', ''),
(916, '', 'AGRREY OSIYEL', '0727167410', 'TESO NORTH ELDERS AT', '', '', '17', '', '5', '1', '', ''),
(917, '', 'JUNIA ORAPA', '0716583403', 'TESO NORTH ELDERS AT', '', '', '17', '', '5', '1', '', ''),
(918, '', 'FANUEL IJAKAA', '0714028544', 'TESO NORTH ELDERS AT', '', '', '17', '', '5', '1', '', ''),
(919, '', 'GEOFFERY EMURIA', '0713575852', 'TESO NORTH ELDERS AT', '', '', '17', '', '5', '1', '', ''),
(920, '', 'CORNEL OMACAI', '0713468036', 'TESO NORTH ELDERS AT', '', '', '17', '', '5', '1', '', ''),
(921, '', 'ISHWAEL MASAKE', '0729992595', 'TESO NORTH ELDERS AT', '', '', '16', '', '5', '1', '', ''),
(922, '', 'MISHAEK AMETUR', '0726285684', 'TESO NORTH ELDERS AT', '', '', '16', '', '5', '1', '', ''),
(923, '', 'REVENIA EKAKERO', '0713681368', 'TESO NORTH ELDERS AT', '', '', '16', '', '5', '1', '', ''),
(924, '', 'MARTIN ISARA', '0733569818', 'TESO NORTH ELDERS AT', '', '', '16', '', '5', '1', '', ''),
(925, '', 'ROBINA ABOO', '0714822513', 'TESO NORTH ELDERS AT', '', '', '16', '', '5', '1', '', ''),
(926, '', 'AGGREY EMOJONG', '0704807432', 'TESO NORTH ELDERS AT', '', '', '16', '', '5', '1', '', ''),
(927, '', 'JEROME IMUTUAN', '0702490389', 'TESO NORTH ELDERS AT', '', '', '15', '', '5', '1', '', ''),
(928, '', 'WYCLIFE OPRONG', '0725936048', 'TESO NORTH ELDERS AT', '', '', '15', '', '5', '1', '', ''),
(929, '', 'JOHNSON OMUNGA', '0729583132', 'TESO NORTH ELDERS AT', '', '', '15', '', '5', '1', '', ''),
(930, '', 'ESNA ASIYO', '0710134625', 'TESO NORTH ELDERS AT', '', '', '15', '', '5', '1', '', ''),
(931, '', 'JOHN ESKUT', '0714583029', 'TESO NORTH ELDERS AT', '', '', '15', '', '5', '1', '', ''),
(932, '', 'COLLETA OMOKOLA', '0717427145', 'TESO NORTH ELDERS AT', '', '', '15', '', '5', '1', '', ''),
(933, '', 'PIUS IKAEL', '0702796336', 'TESO NORTH ELDERS AT', '', '', '18', '', '5', '1', '', ''),
(934, '', 'GERALD ODIKOR', '0710372768', 'TESO NORTH ELDERS AT', '', '', '18', '', '5', '1', '', ''),
(935, '', 'CHRISTINE MURUNGA', '0712552419', 'TESO NORTH ELDERS AT', '', '', '18', '', '5', '1', '', ''),
(936, '', 'CLEMENTINA ODEWA', '0713910929', 'TESO NORTH ELDERS AT', '', '', '18', '', '5', '1', '', ''),
(937, '', 'CLIDE OLIMA', '0720628085', 'TESO NORTH AURIANET ', '', '', '19', '', '5', '1', '', ''),
(938, '', 'NATHAN OLYNIAH', '0720926847', 'TESO NORTH AURIANET ', '', '', '19', '', '5', '1', '', ''),
(939, '', 'JAPHETH ODEKE', '0708727600', 'TESO NORTH AURIANET ', '', '', '19', '', '5', '1', '', ''),
(940, '', 'PHILIS EPUGOT', '0718662685', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(941, '', 'CONSOLATA OTAGA', '0719711543', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(942, '', 'SELLA OPACHA', '', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(943, '', 'CAROLIN OMOIT', '0713222764', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(944, '', 'JERUSA AMOJONG', '0710777289', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(945, '', 'NANCY EKASET', '0713922812', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(946, '', 'CHRISTINE MAJO', '0717147225', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(947, '', 'CARO TOTO ', '0723579174', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(948, '', 'CATHERINE TATA', '0713080145', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(949, '', 'JANEPHER OPIDI', '0796437666', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(950, '', 'HELLEN ALUKU', '0796897837', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(951, '', 'JULLYB TEMKO', '0740441991', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(952, '', 'DINAH ORONI', '0757545113', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(953, '', 'HELLEN ADEKE', '0728763133', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(954, '', 'CONCILETA BAKIRA', '0728054724', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(955, '', 'JANE OMUSE', '0758791206', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(956, '', 'GAUDENCIA OTITI', '0728497469', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(957, '', 'ELIZABETH MMBONE', '0758151911', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(958, '', 'SARAH EMURIA', '0704940743', 'PENTAGON WOMEN GROUP', '', '', '19', '', '5', '1', '', ''),
(959, '', 'REV  PATRICK IMOH', ' 0712496649', 'TESO NORTH OPINION L', '', '', '15', '', '5', '1', '', ''),
(960, '', 'BRENDA INYAA', '0711805281', 'TESO NORTH OPINION L', '', '', '15', '', '5', '1', '', ''),
(961, '', 'IKEE INYAA OLUBAI', '0733999456', 'TESO NORTH OPINION L', '', '', '15', '', '5', '1', '', ''),
(962, '', 'BARNABAS O INYAA', '0722521205', 'TESO NORTH OPINION L', '', '', '15', '', '5', '1', '', ''),
(963, '', 'HON OTE MOSEA', '0723825482', 'EX MCAS TESO NORTH', '', '', '17', '', '5', '1', '', ''),
(964, '', 'HON. PHILIP MUNDAI', '0716181026', 'EX MCAS TESO NORTH', '', '', '18', '', '5', '1', '', ''),
(965, '', 'HON MOSES MAMAI', '0720955434', 'EX MCAS TESO NORTH', '', '', '20', '', '5', '1', '', ''),
(966, '', 'HON IMWENE ICHASI', '071457065', 'EX MCAS TESO NORTH', '', '', '16', '', '5', '1', '', ''),
(967, '', 'HON. ISHMAEL ORODI', '0726212933', 'EX MCAS TESO NORTH', '', '', '15', '', '5', '1', '', ''),
(968, '', 'HON. BENARD PAPA', '0724808385', 'ELECTED MCAS TESO NO', '', '', '16', '', '5', '1', '', ''),
(969, '', 'HON. KOKONYA DAVID', '0720172268', 'ELECTED MCAS TESO NO', '', '', '15', '', '5', '', '', ''),
(970, '', 'HO. PATRICK OMANYALA', '0714176303', 'ELECTED MCAS TESO NO', '', '', '18', '', '5', '1', '', ''),
(971, '', 'HON. GRACE OLITA TATA', '0728481094', 'ELECTED MCAS TESO NO', '', '', '17', '', '5', '1', '', ''),
(972, '', 'HON. LARENCE OKAALE', '0725964837', 'ELECTED MCAS TESO NO', '', '', '19', '', '5', '1', '', ''),
(973, '', 'HON. JOAB OTEBA', '0728036611', 'ELECTED MCAS TESO NO', '', '', '20', '', '5', '1', '', ''),
(974, '', 'JANE VIVE OTWANE', '0711761482', 'TESO SOUTH WOMEN EX ', '', '', '12', '', '6', '1', '', ''),
(975, '', 'LINET OKEMER', '0712565533', 'TESO SOUTH WOMEN SIM', '', '', '12', '', '6', '1', '', ''),
(976, '', 'MELLAB ALUSIA', '0710870162', 'TESO SOUTH WOMEN AKO', '', '', '12', '', '6', '1', '', ''),
(977, '', 'JULIET KAFWA', '0716115724', 'TESO SOUTH WOMEN AKO', '', '', '12', '', '6', '1', '', ''),
(978, '', 'ROBERT OMUSE', '0724691285', 'ROBERT OMUSE KAMARIN', '', '', '12', '', '6', '1', '', ''),
(979, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(980, '', 'JOSEPH JOBIC  EKHABA', '0718792930', 'BUNYALA SUB COUNTY M', '', '', '', '', '8', '1', '', ''),
(981, '', 'PASTOR JUMA ODANGA', '0712665397', 'BUNYALA SUB COUNTY M', '', '', '', '', '8', '1', '', ''),
(982, '', 'TABERIOUS NG''ANG''A OCHIENG', '0729075183', 'BUNYALA SUB COUNTY M', '', '', '', '', '8', '1', '', ''),
(983, '', 'VICTOR MWOYA WANYAMA', '0726262829', 'BUNYALA SUB COUNTY M', '', '', '', '', '8', '1', '', ''),
(984, '', 'JOHN OLANDO OWINO', '0720399547', 'BUNYALA SUB COUNTY M', '', '', '', '', '8', '1', '', ''),
(985, '', 'FREDRICK OUNDO MUSEE', '0711574462', 'BUNYALA SUB COUNTY M', '', '', '', '', '8', '1', '', ''),
(986, '', 'ROSELINE NJERI OGUTU', '0726583673', 'BUNYALA SUB COUNTY M', '', '', '', '', '8', '1', '', ''),
(987, '', 'CHARLES MUTOKA', '0712230413', 'BUNYALA SUB COUNTY M', '', '', '', '', '8', '1', '', ''),
(988, '', 'DAVID WANGA', '0721101339', 'BUNYALA SUB COUNTY M', '', '', '', '', '8', '1', '', ''),
(989, '', 'JOACHIM ELIAKIM ONYANGO', '0746014031', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(990, '', 'MORTON NAFULA NAGERI', '0710443238', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(991, '', 'DAVID NAMENYA', '0724895111', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(992, '', 'CHARLES O OKOTCH', '0712558747', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(993, '', 'RAPHAEL OGIYO', '0703946375', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(994, '', 'SAMSON MALOBA', '0790153453', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(995, '', 'MARTIN MARABI', '0700513893', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(996, '', 'GIDEON OGEMBE', '0705416697', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(997, '', 'PAMELA OKORA', '0727221057', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(998, '', 'MARGERET AKECH', '0750262825', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(999, '', 'KEVIN MANGO', '0711767917', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1000, '', 'JACKLINE OJIAMBO', '0705770179', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1001, '', 'OTONGOLO KHADUMBA', '0725537202', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1002, '', 'JOSEPH LUNJALA AJUMU', '0710809363', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1003, '', 'ROSEMARY AUMA OMANJU', '0723101014', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1004, '', 'JULIANA APONDI TABU', '0793336637', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1005, '', 'LEMINTINA OBELI', '0718348547', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1006, '', 'SARAH AJIAMBO LUKULU', '0728779937', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1007, '', 'EUNICE A MANG''ENI', '0728282909', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1008, '', 'DAN OUMA OCHWELE', '0710867446', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1009, '', 'RAPHAEL TAABU ABRA', '0705143988', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1010, '', 'HELLEN NABALAYO MONGOLO', '0723799239', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1011, '', 'EDNAH ACHIENG MAHANGA', '0714349261', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1012, '', 'LUCAS SIROJA', '0708267429', 'BUNYALA  SUB LOCATIO', '', '', '', '', '8', '1', '', ''),
(1013, '', 'DAVID WANGA', '0727872933', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1014, '', 'CAROLYNE NIGHT', '0720043332', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1015, '', 'ELIAS NYONGESA MUSIOLA', '0727872933', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1016, '', 'MOSES MAKOKHA OKTH', '0715437127', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1017, '', 'JOHN BAHATI OJIAMBO', '0728648291', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1018, '', 'BETHWEL MANGO', '0708848772', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1019, '', 'ALBERT  LUPERU ODONGE', '0768741190', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1020, '', 'JOSEPH E NYANGWESO', '0718792930', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1021, '', 'CONSOLATA OTIEKO', '0713443205', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1022, '', 'CHARLES ORII', '0748082296', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1023, '', 'JAMES OKELLO BARASA', '0790218292', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1024, '', 'JANE NDEGE', '0722471016', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1025, '', 'DORINE AKINYI BULUMA', '0707895763', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1026, '', 'MONICAH AKINYA', '0725410760', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1027, '', 'DENNIS E EROKHA', '0717676492', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1028, '', 'JACKLYNE O NANJALA', '0714464786', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1029, '', 'REBBECA AKUKU', '0716183951', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1030, '', 'BENA OCHOLA', '0719377287', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1031, '', 'BENTA A YAMO', '0725290316', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1032, '', 'BONIFACE MALOBA', '0713689738', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1033, '', 'FREDRICK KHANDULI', '0715860946', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', '');
INSERT INTO `tbl_contacts` (`contact_id`, `id_no`, `names`, `phone_no`, `village`, `sublocation`, `location`, `ward`, `pstation`, `subcounty`, `county`, `gender`, `address`) VALUES
(1034, '', 'DENNIS MULAYI', '0720300497', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1035, '', 'MAURINE  JUMA', '0700835780', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1036, '', 'KHANDIANGU OPONDO ALPHHONCE', '0728423786', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1037, '', 'SCOLASTICA KHIRE WASIRA', '0720816906', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1038, '', 'PAMELA OKELO WERE', '0703266582', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1039, '', 'PETRONILA ANYANGO', '0705999361', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1040, '', 'IBRAHIM NGODI', '0716298200', 'BUNYALA ODM DEFECTOR', '', '', '', '', '8', '1', '', ''),
(1041, '', 'PAMELA OKORA ', '0727221057', 'BUNYALA WEST WARD ME', '', '', '', '', '8', '1', '', ''),
(1042, '', 'MARGRET AKETCH ', '0705262825', 'BUNYALA WEST WARD ME', '', '', '', '', '8', '1', '', ''),
(1043, '', 'EUNICE A MANG''ENI', '0728282909', 'BUNYALA WEST WARD ME', '', '', '', '', '8', '1', '', ''),
(1044, '', 'JOSEPH JOBIC EKHABA', '0718792930', 'BUNYALA WEST WARD ME', '', '', '', '', '8', '1', '', ''),
(1045, '', 'TIBERIOUS NG''ANG''A OCHIENG', '0729075183', 'BUNYALA WEST WARD ME', '', '', '', '', '8', '1', '', ''),
(1046, '', 'CHARLES MAGIO OORI', '0748082296', 'BUNYALA WEST WARD ME', '', '', '', '', '8', '1', '', ''),
(1047, '', 'WILKISTER NAHULO', '0704222610', 'BUNYALA WEST WARD ME', '', '', '', '', '8', '1', '', ''),
(1048, '', 'FLEVIA N BEDA', '0727313299', 'BUNYALA WEST WARD ME', '', '', '', '', '8', '1', '', ''),
(1049, '', 'JAMES OTONGOLO KHATUBA', '0725537202', 'BUNYALA CENTRAL WARD', '', '', '', '', '8', '1', '', ''),
(1050, '', 'PAMELA WEKE', '0703266582', 'BUNYALA CENTRAL WARD', '', '', '', '', '8', '1', '', ''),
(1051, '', 'LYDIAH WANGOMA', '0725275586', 'BUNYALA CENTRAL WARD', '', '', '', '', '8', '1', '', ''),
(1052, '', 'GODLIER ODIANGA', '0748224067', 'BUNYALA CENTRAL WARD', '', '', '', '', '8', '1', '', ''),
(1053, '', 'JOHN AFUBWA', '0734412031', 'BUNYALA CENTRAL WARD', '', '', '', '', '8', '1', '', ''),
(1054, '', 'HELLEN N MOMGOLO', '0723799239', 'BUNYALA NORTH WARD M', '', '', '', '', '8', '1', '', ''),
(1055, '', 'MORTON N NAGERIAH', '0710443238', 'BUNYALA NORTH WARD M', '', '', '', '', '8', '1', '', ''),
(1056, '', 'ROSEMARY AMANYO', '0723101014', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1057, '', 'DAN O OCHWELE ', '0710867446', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1058, '', 'BATHELEMEW MANGO', '0708848772', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1059, '', 'JACKLINE OMBERIA', '0714464786', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1060, '', 'CAROLINE NIGHT MUNYOLO', '0720043332', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1061, '', 'RAPHAEL OBARA', '0705143988', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1062, '', 'PAMELA A ODINDO', '0707361887', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1063, '', 'BEATRICE  OLOO', '0701169365', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1064, '', 'PAMELA OOKO', '0712495182', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1065, '', 'COLLINS PENDO', '0717676462', 'BUNAYALA SOUTH WARD ', '', '', '', '', '8', '1', '', ''),
(1066, '', 'JOSEPH ONGUDI', '0728344421', 'OGWANG''AGOBA SHG MEE', '', '', '', '', '8', '1', '', ''),
(1067, '', 'PAULINE MONGAI NAGILA', '0720416158', 'OGWANG''AGOBA SHG MEE', '', '', '', '', '8', '1', '', ''),
(1068, '', 'ISABELLA NANGURA', '0717174133', 'OGWANG''AGOBA SHG MEE', '', '', '', '', '8', '1', '', ''),
(1069, '', 'PAUILINE NAGIRA', '0707497572', 'OGWANG''AGOBA SHG MEE', '', '', '', '', '8', '1', '', ''),
(1070, '', 'FREDRICK OUMA', '0711734672', 'OGWANG''AGOBA SHG MEE', '', '', '', '', '8', '1', '', ''),
(1071, '', 'HUMPHREY BULUMA', '0725994503', 'OGWANG''AGOBA SHG MEE', '', '', '', '', '8', '1', '', ''),
(1072, '', 'PATRCIK OLOKO', '0725361079', 'OGWANG''AGOBA SHG MEE', '', '', '', '', '8', '1', '', ''),
(1073, '', 'PATRICK NAGUILA', '0710731435', 'OGWANG''AGOBA SHG MEE', '', '', '', '', '8', '1', '', ''),
(1074, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1075, '', 'JOSEPH OMONYO', '0705114772', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1076, '', 'SEVERIO OKELLO', '0710394262', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1077, '', 'VINCENT ODHIAMBO', '0712987501', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1078, '', 'JOEL DINDI OKWARA', '0792313885', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1079, '', 'ALLAN NAMUKHWA', '0710277786', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1080, '', 'PATRICK SIKAMA', '0726974010', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1081, '', 'HANNINGTON SEBEYI', '0718464177', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1082, '', 'FREDRICK WABWIRE', '0729451130', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1083, '', 'JARED ODUORI', '0719136253', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1084, '', 'JACKSON AWUORI', '0707644846', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1085, '', 'MAURICE MUTIMBA', '0723674716', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1086, '', 'HEZRON AWUORI', '0723664414', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1087, '', 'AFRICANUS JUMA', '0723675617', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1088, '', 'ALFRED OWINO', '0722916814', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1089, '', 'SIMON BARASA', '0714680021', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1090, '', 'EVERLYNE NASIRUMBI', '0729632481', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1091, '', 'JOSEPH MUYODI', '0711926730', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1092, '', 'DORCUS EKESA', '0718525034', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1093, '', 'JOICE AGOLA', '0727020007', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1094, '', 'CAROLYNE AGUTU', '0715050153', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1095, '', 'SAMSON ONYUMA', '0716686614', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1096, '', 'JAMES NASIKE', '0713859547', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1097, '', 'OKELLO KAFWA', '0707267575', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1098, '', 'ALEX MAKIO', '0705599651', 'BUKHAYO CENTRAL VILL', '', '', '30', '', '3', '1', '', ''),
(1099, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1100, '13670963', 'KEVIN OOKO', '070028629', 'MARACHI CENTRAL WARD', '', '', '38', '', '9', '1', '', ''),
(1101, '14695344', 'SYLVIA ', '0720883660', 'MARACHI CENTRAL WARD', '', '', '38', '', '9', '1', '', ''),
(1102, '13529625', 'VINCENT ', '0731715236', 'MARACHI CENTRAL WARD', '', '', '38', '', '9', '1', '', ''),
(1103, '6652919', 'ARNOLD ', '0703630600', 'MARACHI CENTRAL WARD', '', '', '38', '', '9', '1', '', ''),
(1104, '11109090', 'WILLIMINA', '0710830442', 'MARACHI CENTRAL WARD', '', '', '38', '', '9', '1', '', ''),
(1105, '25869958', 'ALICE', '0724895330', 'MARACHI CENTRAL WARD', '', '', '38', '', '9', '1', '', ''),
(1106, '20767203', 'ESIKOMA', '0710665000', 'MARACHI CENTRAL WARD', '', '', '38', '', '9', '1', '', ''),
(1107, '5132181', 'NEELA WEST', '0743373882', 'MARACHI CENTRAL WARD', '', '', '38', '', '9', '1', '', ''),
(1108, '', 'JOSEPH ASIBA', '0715235358', 'MARACHI CENTRAL WARD', '', '', '38', '', '9', '1', '', ''),
(1109, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1110, '10748669', 'LAWRENCE AMENYA', '0729541805', 'PARLIAMENTARY STAFF ', '', '', '30', '', '3', '1', '', ''),
(1111, '22897709', 'SAMUEL WANDERA', '0715885326', 'PARLIAMENTARY STAFF ', '', '', '14', '', '3', '1', '', ''),
(1112, '7897249', 'JOSEPH MASIKA', '0711361680', 'PARLIAMENTARY STAFF ', '', '', '30', '', '3', '1', '', ''),
(1113, '6077830', 'IBRAHIM JUMA', '0712747780', 'PARLIAMENTARY STAFF ', '', '', '28', '', '3', '1', '', ''),
(1114, '29491352', 'HILDA NAMBANGA', '0705377229', 'PARLIAMENTARY STAFF ', '', '', '14', '', '3', '1', '', ''),
(1115, '12456698', 'BENARD YONGA BUNYASI', '0711121663', 'PARLIAMENTARY STAFF ', '', '', '29', '', '3', '1', '', ''),
(1116, '12761389', 'SALOME MWANIKA BARASA', '0714752025', 'PARLIAMENTARY STAFF ', '', '', '28', '', '3', '1', '', ''),
(1117, '9173332', 'RUBEN OKINDA NYABAYA', '0713051693', 'PARLIAMENTARY STAFF ', '', '', '29', '', '3', '1', '', ''),
(1118, '12684127', 'JOSHUA WAFULA', '0726273047', 'PARLIAMENTARY STAFF ', '', '', '14', '', '3', '1', '', ''),
(1119, '27522290', 'BONFACE K OKWARA', '0727169826', 'PARLIAMENTARY STAFF ', '', '', '14', '', '3', '1', '', ''),
(1120, '1322594', 'WILLIS EKASIBA NYONGESA', '0715005957', 'PARLIAMENTARY STAFF ', '', '', '28', '', '3', '1', '', ''),
(1121, '24680843', 'VITALIS OTIENO', '0729707648', 'PARLIAMENTARY STAFF ', '', '', '30', '', '3', '1', '', ''),
(1122, '1261389', 'SARAH OCHEYA', '0724776872', 'PARLIAMENTARY STAFF ', '', '', '29', '', '3', '1', '', ''),
(1123, '4979191', 'AGGREY OFISI', '0710277765', 'PARLIAMENTARY STAFF ', '', '', '30', '', '3', '1', '', ''),
(1124, '9607998', 'CHARLES AYITSA', '0710524769', 'PARLIAMENTARY STAFF ', '', '', '30', '', '3', '1', '', ''),
(1125, '11597353', 'STEPHEN APOMA', '0710538910', 'PARLIAMENTARY STAFF ', '', '', '30', '', '3', '1', '', ''),
(1126, '6775494', 'MARTIN MUNYANE OSOBOLO', '0724338447', 'PARLIAMENTARY STAFF ', '', '', '28', '', '3', '1', '', ''),
(1127, '12456556', 'CONSTANT NAKHONE', '0710222456', 'PARLIAMENTARY STAFF ', '', '', '29', '', '3', '1', 'Male', ''),
(1128, '20099527', 'CHARLES MAGERO', '0714683135', 'PARLIAMENTARY STAFF ', '', '', '29', '', '3', '1', '', ''),
(1129, '21917699', 'JUDITH OYIENGO', '0719742906', 'PARLIAMENTARY STAFF ', '', '', '14', '', '3', '1', '', ''),
(1130, '21794233', 'ABRAHAM BARASA', '0728754573', 'PARLIAMENTARY STAFF ', '', '', '14', '', '3', '1', '', ''),
(1131, '23151295', 'STEPHEN MAMAI', '0700488836', 'PARLIAMENTARY STAFF ', '', '', '28', '', '3', '1', '', ''),
(1132, '21830061', 'ROBERT MUKELE', '0706951293', 'PARLIAMENTARY STAFF ', '', '', '29', '', '3', '1', '', ''),
(1133, '24734269', 'MICHAEL WANDERA', '0704643855', 'PARLIAMENTARY STAFF ', '', '', '29', '', '3', '1', '', ''),
(1134, '1358452', 'JULIUS DINDI WESONGA', '0727271900', 'PARLIAMENTARY STAFF ', '', '', '29', '', '3', '1', '', ''),
(1135, '21271676', 'MILLICENT ODUORY', '0725040320', 'PARLIAMENTARY STAFF ', '', '', '14', '', '3', '1', '', ''),
(1136, '4241904', 'JOSEPH JUMA', '0724018488', 'PARLIAMENTARY STAFF ', '', '', '29', '', '3', '1', '', ''),
(1137, '27664127', ' BASHIR WERE', '0725363936', 'PARLIAMENTARY STAFF ', '', '', '21', '', '3', '1', '', ''),
(1138, '24085487', 'MOSES MASIGA', '0715395364', 'PARLIAMENTARY STAFF ', '', '', '28', '', '3', '1', '', ''),
(1139, '9468117', 'EVERLINE ATIENO BARASA', '0704643750', 'PARLIAMENTARY STAFF ', '', '', '30', '', '3', '1', '', ''),
(1140, '22699587', 'PHILIP OTWANE', '0724154202', 'PARLIAMENTARY STAFF ', '', '', '28', '', '3', '1', '', ''),
(1141, '', 'STEPHEN OKOKU', '0710538910', 'PARLIAMENTARY STAFF ', '', '', '28', '', '3', '1', '', ''),
(1142, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1143, '', 'MARTIN MUDORO', '0720095315', 'COUNTY CONSTITUENCY ', '', '', '14', '', '3', '1', '', ''),
(1144, '', 'ESTHER ACHARI', '0712098270', 'COUNTY CONSTITUENCY ', '', '', '14', '', '3', '1', '', ''),
(1145, '', 'WYCLIFFE WANDERA', '0729649479', 'COUNTY CONSTITUENCY ', '', '', '34', '', '3', '1', '', ''),
(1146, '', 'ESTHER AJUMA', '0727903781', 'COUNTY CONSTITUENCY ', '', '', '35', '', '3', '1', '', ''),
(1147, '', 'PHILIP OSORE', '0726322014', 'COUNTY CONSTITUENCY ', '', '', '37', '', '9', '1', '', ''),
(1148, '', 'RITA OUMA', '0724895330', 'COUNTY CONSTITUENCY ', '', '', '38', '', '9', '1', '', ''),
(1149, '', 'ISSA BAGOYA', '0728454890', 'COUNTY CONSTITUENCY ', '', '', '43', '', '7', '1', '', ''),
(1150, '', 'ROSEMARY AKINYI', '0791501869', 'COUNTY CONSTITUENCY ', '', '', '42', '', '7', '1', '', ''),
(1151, '', 'PAMELA OKORA', '0727221057', 'COUNTY CONSTITUENCY ', '', '', '31', '', '8', '1', '', ''),
(1152, '', 'RAPHAEL OBARA', '0705143988', 'COUNTY CONSTITUENCY ', '', '', '49', '', '8', '1', '', ''),
(1153, '', 'MOSES OMUSE', '0722091622', 'COUNTY CONSTITUENCY ', '', '', '17', '', '5', '1', '', ''),
(1154, '', 'PRISCA NEKOYE', '0710678079', 'COUNTY CONSTITUENCY ', '', '', '20', '', '5', '1', '', ''),
(1155, '', 'CHRIS ODWALI', '0728597058', 'COUNTY CONSTITUENCY ', '', '', '12', '', '6', '1', '', ''),
(1156, '', 'ANNAH OLWANE', '0711485948', 'COUNTY CONSTITUENCY ', '', '', '22', '', '6', '1', '', ''),
(1157, '', 'DAVID WANGA', '0721101339', 'COUNTY CONSTITUENCY ', '', '', '48', '', '8', '1', '', ''),
(1158, '', 'CAROLINE NIGHT', '0720043332', 'COUNTY CONSTITUENCY ', '', '', '49', '', '8', '1', '', ''),
(1159, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1160, '', 'NYAKWARODONDO', '0721254037', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1161, '', 'MAURICE OTIENO', '0722948286', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1162, '', 'WHATSAPP', '0103570141', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1163, '', 'SANKARA', '0115743232', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1164, '', 'WHATSAPP', '0700686109', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1165, '', 'THOMAS', '0700877806', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1166, '', 'SLIM DADDY', '0701178467', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1167, '', 'CHARLES', '0701480628', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1168, '', 'WHATSAPP', '0701775240', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1169, '', 'NYAKWAR OBILA', '0701884523', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1170, '', 'UNIQUE', '0702347132', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1171, '', 'FIRST LADY', '0702621729', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1172, '', 'DNA', '0702642729', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1173, '', 'WHATSAPP', '0703255674', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1174, '', 'KEVIN MAKOOKO', '0703687108', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1175, '', 'WHATSAPP', '0704190074', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1176, '', 'WHATSAPP', '0704572646', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1177, '', 'SONKORE', '0704899663', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1178, '', 'WHATSAPP', '0705043573', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1179, '', 'DR NAFWA', '0705425791', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1180, '', 'EVANSO', '0705517919', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1181, '', 'WHATSAPP', '0706069705', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1182, '', 'WHATSAPP', '0706116592', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1183, '', 'DAVID', '0706212924', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1184, '', 'WHATSAPP', '0706770684', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1185, '', 'WHATSAPP', '0706778919', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1186, '', 'BRIFTAR CYRUS', '0707118631', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1187, '', 'WHATSAPP', '0708017417', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1188, '', 'WHATSAPP', '0708468010', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1189, '', 'WHATSAPP', '0708667767', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1190, '', 'WHATSAPP', '0710124668', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1191, '', 'COACH JACKTON', '0710753677', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1192, '', 'WHATSAPP', '0710788304', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1193, '', 'CHRISTINE FLORENCE', '0710912040', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1194, '', 'MCHELSEA', '0710926209', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1195, '', 'OTI BABA', '0711422471', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1196, '', 'SEWE OPATRICK', '0711924350', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1197, '', 'WHATSAPP', '0712243473', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1198, '', 'WHATSAPP', '0712268423', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1199, '', 'MANYUMBA 10', '0712491028', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1200, '', 'WHATSAPP', '0712550035', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1201, '', 'PWILLIAMOGOLLAH5', '0713344929', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1202, '', 'MALOBAKEVIN3', '0713461313', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1203, '', 'BRAM', '0713521736', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1204, '', 'WHATSAPP', '0713521736', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1205, '', 'WHATSAPP', '0714327499', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1206, '', 'BARACK MUNUANGO', '0714716611', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1207, '', 'WHATSAPP', '0714944266', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1208, '', 'WHATSAPP', '0715291475', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1209, '', 'DWEEB', '0715655081', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1210, '', 'WHATSAPP', '0716078354', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1211, '', 'MUSA', '0716201755', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1212, '', 'WANDERA', '0716296652', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1213, '', 'AMEN', '0716487664', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1214, '', 'OSCAROTIENO80', '0717479453', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1215, '', 'JOYCILINE MASINDE', '0717633159', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1216, '', 'ODHIAMBO JOHN 853', '0717966432', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1217, '', 'CALVIN', '0718101809', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1218, '', 'WHATSAPP', '0718183012', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1219, '', 'ADRIAN', '0718456405', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1220, '', 'DANIEL MASAKHWE', '0718524550', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1221, '', 'WHATSAPP', '0719264252', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1222, '', 'SOBWOR', '0720079056', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1223, '', 'JULIUS SICHEMO', '0720452243', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1224, '', 'WHATSAPP', '0720596805', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1225, '', 'PIUS SIKEMO', '0720655248', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1226, '', 'MAN OF GOD', '0720907791', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1227, '', 'HARYZ DANIEL', '0721136590', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1228, '', 'WHATSAPP', '0721262889', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1229, '', 'WHATSAPP', '0721612094', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1230, '', 'WHATSAPP', '07226999', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1231, '', 'MICHAEL OBUNDE', '0722147254', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1232, '', 'WHATSAPP', '0722167564', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1233, '', 'WHATSAPP', '0722257483', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1234, '', 'WHATSAPP', '0722722017', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1235, '', 'WHATSAPP', '0723015222', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1236, '', 'WHATSAPP', '0723016758', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1237, '', 'WHATSAPP', '07230918960', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1238, '', 'JOHN', '0723314575', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1239, '', 'WHATSAPP', '0723333359', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1240, '', 'WHATSAPP', '0723735337', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1241, '', 'WHATSAPP', '0723882322', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1242, '', 'PETER KABIRO', '0723923308', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1243, '', 'WHATSAPP', '0724305740', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1244, '', 'ACHIENG JOHNSTONE', '0724336999', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1245, '', 'WHATSAPP', '0724427880', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1246, '', 'KEN MAKOPWAPO', '0724521732', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1247, '', 'WHATSAPP', '0724546010', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1248, '', 'WHATSAPP', '0724546092', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1249, '', 'WHATSAPP', '0724567373', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1250, '', 'WHATSAPP', '0724586010', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1251, '', 'WHATSAPP', '0724853494', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1252, '', 'WHATSAPP', '0724886811', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1253, '', 'WHATSAPP', '0725157217', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1254, '', 'YONAH MCOCHIENG', '0725447411', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1255, '', 'WHATSAPP', '0725605457', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1256, '', 'PST PHILIP OWINO', '0706341609', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1257, '', 'WHATSAPP', '0726378745', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1258, '', 'WHATSAPP', '0726451826', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1259, '', 'WHATSAPP', '0727068234', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1260, '', 'WHATSAPP', '0727119346', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1261, '', 'WHATSAPP', '0728415872', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1262, '', 'WHATSAPP', '0728480561', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1263, '', 'WHATSAPP', '0728773354', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1264, '', 'WHATSAPP', '0729144756', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1265, '', 'DR LUTAH', '0729222147', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1266, '', 'MJUSH', '0729340762', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1267, '', 'WHATSAPP', '0729835368', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1268, '', 'WHATSAPP', '0731907852', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1269, '', 'AMBITIOUS SULTAN', '0733699611', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1270, '', 'PEOPLES POWER', '0740109830', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1271, '', 'CHARLES OBUYA', '0740499282', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1272, '', 'WHATSAPP', '0741032005', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1273, '', 'SCHOLAR', '0741557428', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1274, '', 'WUOD SOJA', '0741693158', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1275, '', 'WHATSAPP', '0743107667', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1276, '', 'WHATSAPP', '0743269325', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1277, '', 'STEVEJUMAH7', '0746571389', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1278, '', 'WHATSAPP', '0748147517', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1279, '', 'WHATSAPP', '0748826822', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1280, '', 'WHATSAPP', '0750454990', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1281, '', 'WHATSAPP', '0755828492', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1282, '', 'CAPT JNR', '0757782419', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1283, '', 'OMONDI OKELLO JNR', '0757893889', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1284, '', 'JOSHUA CALEB', '0762081979', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1285, '', 'WHATSAPP', '0768588594', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1286, '', 'WHATSAPP', '0769680378', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1287, '', 'WHATSAPP', '0769932087', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1288, '', 'WHATSAPP', '0776677067', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1289, '', 'WHATSAPP', '0785050554', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1290, '', 'WHATSAPP', '0787306298', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1291, '', 'WHATSAPP', '0791321504', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1292, '', 'DENNIS', '0791965581', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1293, '', 'PETER ', '0794228207', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1294, '', 'ANTONY OMONDI', '0794512379', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1295, '', 'WHATSAPP', '0794846549', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1296, '', 'WHATSAPP', '0795157891', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1297, '', 'WHATSAPP', '0796006690', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1298, '', 'WHATSAPP', '0796032558', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1299, '', 'WHATSAPP', '0796304966', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1300, '', 'WHATSAPP', '0796684795', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1301, '', 'BOSS', '0798224078', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1302, '', 'FESTO', '0799403514', 'MARACHI WEST WARD WH', '', '', '', '', '9', '1', '', ''),
(1303, '6671174', 'CHRISTOPHER MUYODI', '0729544343', 'PARLIAMENTARY STAFF', '', '', '28', '', '3', '1', '', ''),
(1304, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1305, '25709353', 'VIOLET WAMBANI ONYANGO', '0724070878', 'NAMBALE CDF  STAFF', '', '', '28', '', '3', '1', '', ''),
(1306, '32532208', 'MAXWEL OLUKOYE', '0706913976', 'NAMBALE CDF  STAFF', '', '', '14', '', '3', '1', '', ''),
(1307, '24370276', 'ELIZABETH TERESA OMUNYIN', '0721596633', 'NAMBALE CDF  STAFF', '', '', '14', '', '3', '1', '', ''),
(1308, '28860157', 'SHARONH DOTA KESA', '0717160189', 'NAMBALE CDF  STAFF', '', '', '46', '', '3', '1', '', ''),
(1309, '31068106', 'KEVIN WERE', '0714374706', 'NAMBALE CDF  STAFF', '', '', '29', '', '3', '1', '', ''),
(1310, '22740610', 'PAUL ODONGO OMOLO', '0723427377', 'NAMBALE CDF  STAFF', '', '', '14', '', '3', '1', '', ''),
(1311, '26029204', 'CYNTHIA TAFA', '0711139113', 'NAMBALE CDF  STAFF', '', '', '14', '', '3', '1', '', ''),
(1312, '21094145', 'ASHA LUTA KAYE', '0702898141', 'NAMBALE CDF  STAFF', '', '', '14', '', '3', '1', '', ''),
(1313, '1144712', 'MRS JUDITH INDASI MURWAYI', '0728986124', 'NAMBALE CDF COMMITTE', '', '', '14', '', '3', '1', '', ''),
(1314, '6774095', 'MR ALFRED JUMA OKOCHIL', '0702280692', 'NAMBALE CDF COMMITTE', '', '', '14', '', '3', '1', '', ''),
(1315, '6141694', 'MR JAMES OKUMU MAKOKHA', '0713757818', 'NAMBALE CDF COMMITTE', '', '', '29', '', '3', '1', '', ''),
(1316, '29496309', 'MS TRYPHOSA NGOBIRO MUYODI', '0740386282', 'NAMBALE CDF COMMITTE', '', '', '28', '', '3', '1', '', ''),
(1317, '23770963', 'MR GEORGE  KENYATTA OKELLO', '0701324308', 'NAMBALE CDF COMMITTE', '', '', '14', '', '3', '1', '', ''),
(1318, '391198', 'MR BENJAMIN LUNZALU OPEMI', '0703686725', 'NAMBALE CDF COMMITTE', '', '', '46', '', '3', '1', '', ''),
(1319, '10121198', 'MR MARGERET PAMBA OSERE', '0710360567', 'NAMBALE CDF COMMITTE', '', '', '29', '', '3', '1', '', ''),
(1320, '28860592', 'MR FELIX WESONGA  OTSYULA', '0701637832', 'NAMBALE CDF COMMITTE', '', '', '46', '', '3', '1', '', ''),
(1321, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1322, '10666372', 'BONFACE MASIGA ADEYA', '0729482754', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1323, '21496462', 'MAKOBA PATRICK MAKUBA', '0729675791', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1324, '13528181', 'WESONGA VINCENT MAGERO', '0708647086', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1325, '22096753', 'OMWENE HENRY NYONGESA', '0703616124', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1326, '9467932', 'EKESA WESONGA FREDRICK', '0729521391', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1327, '7897408', 'ETYANGA STEPHEN INYASI', '0715370260', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1328, '9468339', 'NAFULA MEDIATRIX ', '0701628218', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1329, '', 'WEKOBA SALIM', '0717174386', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1330, '20070990', 'OKUMU LAMBERT WANGA', '0729305476', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1331, '6769310', 'SISUMA B DINDI', '0716189205', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1332, '9805693', 'MAKOKHA AGATA', '0719403871', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1333, '20055666', 'ADHIAMBO MWATOM NANAZALA', '0716784659', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1334, '26158346', 'OKUMU JOSEPHINE', '0701619640', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1335, '11095846', 'OGANDA ROSE VIHENDA', '0725126749', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1336, '22800548', 'NASAMBU EUNICE SIMIYU', '0725602997', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1337, '11537486', 'NASENYA JUDY  EMASE', '0720569037', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1338, '21097728', 'NANGILA MARY WESONGA', '0721722674', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1339, '21676172', 'CHIRANDE ESTHER WERE', '0702887187', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1340, '24426686', 'OPWORA CAROLYNE AWORI', '0712950502', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1341, '9608006', 'NAMBIRE ONYANGO MARY', '0712793923', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1342, '20873135', 'EKESA KASANOI PAMELA', '0712579431', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1343, '', 'BARASA EVERLYNE ATSIENO', '0704643750', 'SALOME ANC LIST 2018', '', '', '', '', '3', '1', '', ''),
(1344, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1345, '11248516', 'CLEMENT EYINDA', '0722446746', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1346, '13580843', 'EZEKIEL ODINGA', '0719744861', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1347, '7893018', 'ALLAN OTOLA', '0717152666', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1348, '7935472', 'OLUMASAYI ESHAPAYA', '0727775502', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1349, '8012873', 'BENSON OMUSANGA', '0721667512', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1350, '20888889', 'MESHACK AMBAISI', '0718021977', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1351, '7590656', 'ASHIOYA MANYASI', '0721542431', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1352, '8707659', 'LITUNYA ANGATIA', '0717224174', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1353, '7017199', 'PATRICK INJEDI', '0728343299', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1354, '13856013', 'ESTHER NYAMBALA', '0722503874', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1355, '', 'JULIA ALWALI', '0710542003', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1356, '2019898', 'EVERLYNE NYONGESA', '0719204039', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1357, '10120461', 'TOPISTER ASHIOYA', '0726019851', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1358, '11298037', 'ROSELYNE OMUSANGA', '0726962475', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1359, '5655862', 'MELLEH OKUSIMBA', '0718926698', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1360, '7977689', 'WINNIE WESONGA', '0711540230', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1361, '', 'PHYLISTUS AYIETA', '0721588301', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1362, '13303681', 'GLADYS ANGATIA', '0711342758', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1363, '21948145', 'VIOLET MAKOKHA ', '0715068183', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1364, '', 'CHITERI VINCENT', '0726629867', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1365, '', 'GENEVIVE MAMBO', '0722219661', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1366, '', 'AGNES MUSUNGU', '0723736415', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1367, '', 'CHARLES MALUBA', '0724967908', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1368, '', 'GLADYS AMBATSI', '0717052969', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1369, '', 'AGNETA JUMA', '0715652432', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1370, '', 'REBECCA MECHA', '0700267853', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1371, '', 'GALDYS ALUSALA', '0722590787', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1372, '13176', 'SAMMY NGANYI', '0704808570', 'SUNRISE SELF HELP GR', '', '', '14', '', '3', '1', '', ''),
(1373, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1374, '', 'JAMES  ACHAYO', '0718464190', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1375, '', 'PST PASCAL WANDERA', '0726348613', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1376, '', 'GHODFREY INADTIE', '0711694504', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1377, '', 'SEBASTIAN Z MERIKE', '0708478645', 'PASTORS LWANYANGE', '', '', '28', '', '3', '1', '', ''),
(1378, '', 'CLEMT O OBUYA', '0725826088', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1379, '', 'PST TIMOTHY NALIANYA', '0714735928', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1380, '', 'ACHOLA N RODUEL', '0791333297', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1381, '', 'FANISH O BWIRE', '0759854547', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1382, '', 'OWINO DALMUS', '0794710631', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1383, '', 'BENARD O MAKIO', '0712626435', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1384, '', 'JUMA O GODFREY', '0708149035', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1385, '', 'YAHANA OKIRU', '0705773022', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1386, '', 'NICHOLUS ONGEKO', '0727235724', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1387, '', 'WILSON OPONDO', '0715637897', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1388, '', 'REV ISAAC OWINO', '0729264605', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1389, '', 'PST OBILO GEORGE', '0714811782', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1390, '', 'PST LEONARD OTUNGA', '0721802589', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1391, '', 'REV BENSON BENNYHINN', '0722154334', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1392, '', 'APOSTLE OUKO IKASI', '0705068344', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1393, '', 'BISHOP GEORGE O LAKITAN', '0711390792', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1394, '', 'PST TRIZA MAKOKHA', '0710100623', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1395, '', 'FLORENCE ODWON', '0705134610', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1396, '', 'EUNICE WAFULA', '0705114592', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1397, '', 'CYNTHIA CENTRIX', '0759854553', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1398, '', 'BISHOP  JAMES OMOLLO', '0722420203', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1399, '', 'REV NETIA W J', '07126182210', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1400, '', 'BISHOP OKWERO SABASTIAN', '0712583857', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1401, '', 'REV SIMON PETER BUNYASI', '0717389896', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1402, '', 'REV AYUB ODHIAMBO', '0726445426', 'PASTORS LWANYANGE', '', '', '14', '', '3', '1', '', ''),
(1403, '', 'PST GIVAN M OKELLO', '0705359579', 'PASTORS LWANYANGE', '', '', '29', '', '3', '1', '', ''),
(1404, '', 'EVERLYNE KHANALI', '0719766560', 'PASTORS LWANYANGE', '', '', '30', '', '3', '1', '', ''),
(1405, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1406, '', 'FRANCIS SAKWA', '0713758838', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1407, '', 'DANIEL OBORE', '0795379155', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1408, '', 'MARGARET ADHIAMBO', '0727971380', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1409, '', 'ROSE SIMIYU', '0711451058', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1410, '', 'LILIAN WASIKE', '0720916046', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1411, '', 'DINA WANZALA', '0791063739', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1412, '', 'VINCENT SUMBA', '0759223039', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1413, '', 'PRISCAH TIYA', '0708218153', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1414, '', 'LINDA ACHIENG', '0719264108', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1415, '', 'WILLIAM WABWIRE', '0711451079', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1416, '', 'CONSOLATA AUMA', '0740065774', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1417, '', 'FLORENCE WABWIRE', '0792539438', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1418, '', 'DORICE ACHIENG', '07140584426', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1419, '', 'FAITH NASIMIYU', '0727405537', 'TWENDE PAMOJA SELF H', '', '', '28', '', '3', '1', '', ''),
(1420, '', 'MARGARATE ETAI', '070726012', 'UMOJA NI NGUVU WOMEN', '', '', '28', '', '3', '1', '', ''),
(1421, '', 'JOSEHINE MAGERO', '0714938054', 'UMOJA NI NGUVU WOMEN', '', '', '28', '', '3', '1', '', ''),
(1422, '', 'WILKISTAH BARASA', '0706258332', 'UMOJA NI NGUVU WOMEN', '', '', '28', '', '3', '1', '', ''),
(1423, '', 'CELESTINE MKUBWA', '0701002678', 'MUSAMARIA WOMEN GROU', '', '', '28', '', '3', '1', '', ''),
(1424, '', 'EDITH NEKESA', '0715198123', 'MUSAMARIA WOMEN GROU', '', '', '28', '', '3', '1', '', ''),
(1425, '', 'REGINITTA NYONGESA', '0703662442', 'MUSAMARIA WOMEN GROU', '', '', '28', '', '3', '1', '', ''),
(1426, '', 'JULIA IKAPEL', '0714363783', 'IMARA WOMEN GROUP MU', '', '', '28', '', '3', '1', '', ''),
(1427, '', 'PASCALIAH MAKOKHA', '0715706141', 'IMARA WOMEN GROUP MU', '', '', '28', '', '3', '1', '', ''),
(1428, '', 'IRENE KHAKASA', '0737907040', 'SONGA MBELE WOMEN GR', '', '', '28', '', '3', '1', '', ''),
(1429, '', 'PAMELA NDULA', '0722836789', 'SONGA MBELE WOMEN GR', '', '', '28', '', '3', '1', '', ''),
(1430, '', 'JUDITH SIMIYU', '0716144958', 'SONGA MBELE WOMEN GR', '', '', '28', '', '3', '1', '', ''),
(1431, '', 'IMELDA SIKUKU', '0715515143', 'AGAPE WOMEN GROUP IG', '', '', '28', '', '3', '1', '', ''),
(1432, '', 'LILIAN ANYANGO OUMA', '0719346760', 'AGAPE WOMEN GROUP IG', '', '', '28', '', '3', '1', '', ''),
(1433, '', 'ESTHER WANYAMA ', '0725362109', 'AGAPE WOMEN GROUP IG', '', '', '28', '', '3', '1', '', ''),
(1434, '', 'SELIPHER NAFULA', '0758947840', 'KALUDEKA POWERFUL WO', '', '', '28', '', '3', '1', '', ''),
(1435, '', 'EVERLYNE NAFULA', '0793042147', 'KALUDEKA POWERFUL WO', '', '', '28', '', '3', '1', '', ''),
(1436, '', 'BEATRICE ATIENO', '0715635336', 'KAPATU WOMEN GROUP O', '', '', '28', '', '3', '1', '', ''),
(1437, '', 'CELESTINE NEKESA', '0703848029', 'KAPATU WOMEN GROUP O', '', '', '28', '', '3', '1', '', ''),
(1438, '', 'JOSPHINE MAGAR', '0714938084', 'KAPATU WOMEN GROUP O', '', '', '28', '', '3', '1', '', ''),
(1439, '', 'WILLIMINAH ODUOR', '0700243838', 'BENGA WOMEN GROUP', '', '', '28', '', '3', '1', '', ''),
(1440, '', 'AMINA ACHIENG OPONDO', '0719469374', 'BENGA WOMEN GROUP', '', '', '28', '', '3', '1', '', ''),
(1441, '', 'LENNY WANZALA', '0716383135', 'UPENDO WOMEN GROUP K', '', '', '28', '', '3', '1', '', ''),
(1442, '', 'BEATRICE OTIENO', '0715635336', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1443, '', 'EUNICE   ODEKE', '0717607756', 'UPENDO WOMEN GROUP O', '', '', '28', '', '3', '1', '', ''),
(1444, '', 'ANNET MBEMBE', '0725360822', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1445, '', 'BEATRICE KHASOYA', '0721791320', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1446, '', 'ADELATE ANYOBA', '0706285856', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1447, '', 'ROSEMARY  OKEMO', '0705774543', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1448, '', 'MARY WANZALA', '0701185568', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1449, '', 'AGNETA NEKESA', '0798106065', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1450, '', 'DORAH  KHAEMBA', '0711896616', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1451, '', 'JOSEPHINE  OUMA', '0714938084', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1452, '', 'JANE AWORI', '0757204408', 'UPENDO WOMEN GROUP  ', '', '', '28', '', '3', '1', '', ''),
(1453, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1454, '', 'LUKAS WESONGA', '0723487774', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1455, '', 'NELSON EKESA', '0710205676', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1456, '', 'PETRONILLA SAKWA', '0715870280', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1457, '', 'JANET MAKOKHA', '0705864102', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1458, '', 'LUKAS MAKOKHA', '0701790198', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1459, '', 'ADELITE ANYOVA', '0706285856', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1460, '', 'CAROLYNE PANYAKO', '0718681072', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1461, '', 'ANJELINE PANYAKO', '0725531236', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1462, '', 'BEATRICE OUMA', '0715635336', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1463, '', 'COLLETA ANYANGO', '0715555789', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1464, '', 'HUMPREY BARASA ', '0704369484', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1465, '', 'ERICK WEKESA', '0748088118', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1466, '', 'PHAUSTINE ADHIAMBO', '0705560676', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1467, '', 'ROBERT WANDERA', '0714052590', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1468, '', 'SAMUEL WANZALA', '0740877884', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1469, '', 'SIVANUS EKESA', '0708622290', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1470, '', 'ANNET ALUKONYI', '0715457185', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1471, '', 'PAMELA TIMAJE', '0700219733', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1472, '', 'EVERLINE NANZALA', '0795441462', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1473, '', 'JACKLINE OMEDE', '0708117262', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1474, '', 'JACKL;INE NAROTSO', '0710856042', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1475, '', 'ANN MBEMBE', '0725360822', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1476, '', 'MARYLINHE ONYANKI', '0725528229', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1477, '', 'JOSEPHAT WAFULA', '0705839005', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1478, '', 'GRACE  AFUBWA', '0728332592', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1479, '', 'PASCAL OMASU', '0746951199', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1480, '', 'JERUSA IKWARE', '0718617129', 'KALUDEKA RIDERS SELF', '', '', '28', '', '3', '1', '', ''),
(1481, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1482, '', 'MAXIMILLA AKELLO', '0796009822', 'SIKINGA WANA UMOJA D', '', '', '29', '', '3', '1', '', ''),
(1483, '', 'CATHERINE CHEMWANI', '0718229997', 'SIKINGA WANA UMOJA D', '', '', '29', '', '3', '1', '', ''),
(1484, '', 'GAUDENCIA WESONGA', '0716736781', 'SIKINGA WANA UMOJA D', '', '', '29', '', '3', '1', '', ''),
(1485, '', 'STELLA OUMA', '0743941610', 'SIKINGA WANA UMOJA D', '', '', '29', '', '3', '1', '', ''),
(1486, '', 'ROSE WANDERA', '0740831617', 'SIKINGA WANA UMOJA D', '', '', '29', '', '3', '1', '', ''),
(1487, '', 'PETRONILLA NAMWALO', '0754760432', 'SIKINGA WANA UMOJA D', '', '', '29', '', '3', '1', '', ''),
(1488, '', 'MAXIMILLA SALLE', '0724422457', 'SIKINGA WANA UMOJA D', '', '', '29', '', '3', '1', '', ''),
(1489, '', 'MAGERET OROSIA', '0718364356', 'SIKINGA WANA UMOJA D', '', '', '29', '', '3', '1', '', ''),
(1490, '', 'PHAUSTINE S NASERA', '0721321553', 'MUNGATSI UMOJA MANYA', '', '', '29', '', '3', '1', '', ''),
(1491, '', 'MILLYSENT A MUMBEH', '0723474682', 'MUNGATSI UMOJA MANYA', '', '', '29', '', '3', '1', '', ''),
(1492, '', 'MAURINE R WESONGA', '0727249647', 'MUNGATSI UMOJA MANYA', '', '', '29', '', '3', '1', '', ''),
(1493, '', 'EMILY A LYULENDE', '0726715431', 'MUNGATSI UMOJA MANYA', '', '', '29', '', '3', '1', '', ''),
(1494, '', 'JOSEPHINE BUNYASI', '0714389554', 'MUNGATSI WOMEN GROUP', '', '', '29', '', '3', '1', '', ''),
(1495, '', 'EMILY NEKESA', '0727152117', 'MUNGATSI WOMEN GROUP', '', '', '29', '', '3', '1', '', ''),
(1496, '', 'PHYLIS ANYIKO', '0701185555', 'MUNGATSI WOMEN GROUP', '', '', '29', '', '3', '1', '', ''),
(1497, '', 'MILKA MULYANGA', '0707228613', 'MUNGATSI WOMEN GROUP', '', '', '29', '', '3', '1', '', ''),
(1498, '', 'LILLIAN MAKOKHA', '0727269119', 'MUNGATSI ORONYO WOME', '', '', '29', '', '3', '1', '', ''),
(1499, '', 'MARY OLIVER MBWALWE', '0721711130', 'MUNGATSI ORONYO WOME', '', '', '29', '', '3', '1', '', ''),
(1500, '', 'JULIAN KOKONYA', '0724041528', 'MUNGATSI ORONYO WOME', '', '', '29', '', '3', '1', '', ''),
(1501, '', 'MARYLINE AKUKU', '0727331757', 'MUNGATSI ORONYO WOME', '', '', '29', '', '3', '1', '', ''),
(1502, '27524387', 'PRAXIDES ATIENO', '0705125605', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1503, '26927121', 'GODLIVER AKINYI', '0707836181', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1504, '30758368', 'SELINE OBOTA', '0740403822', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1505, '24208029', 'LINET ODEKE', '0711891617', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1506, '26043043', 'ROSELINE AMOIT', '0704572860', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1507, '25918841', 'CONCEPTAM ANYONGA', '0706338988', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1508, '3596936', 'TERESINA AUMA EKESA', '0704171605', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1509, '24208822', 'EMILY O MACHUMA', '0718252928', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1510, '20836217', 'MARY ALANDO', '0707817602', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1511, '21224627', 'CHRISTINE NIJIRA', '0700642790', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1512, '13879034', 'ROSELIDA AWINO', '0719801677', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1513, '21169916', 'PAMELA NYONGESA', '0703404804', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1514, '32918476', 'ZABLONE EKESA', '0740870074', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1515, '35656722', 'EUSEBIA EKESA', '0706094206', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1516, '29635048', 'PHILIP MASINDE WANZALA', '0707279583', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', '');
INSERT INTO `tbl_contacts` (`contact_id`, `id_no`, `names`, `phone_no`, `village`, `sublocation`, `location`, `ward`, `pstation`, `subcounty`, `county`, `gender`, `address`) VALUES
(1517, '30114721', 'CHRISPINUS ODAYA', '0708113177', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1518, '27461946', 'MOURINE KADOGO MONDO', '0722984219', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1519, '30621330', 'MAURINE NI WASIKE', '0704339758', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1520, '35051835', 'JANET AUMA SIDAKA', '0799047961', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1521, '32100282', 'BETTY C WAFULA', '0714680257', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1522, '32418253', 'VERONICAH N AMUGET', '0719825263', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1523, '30128483', 'ELECTINE O NORAH', '0790227235', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1524, '31979860', 'GUNCAN K SIMIYU', '0715514483', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1525, '32197424', 'ANN ANSIMIYU', '0728863291', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1526, '30774701', 'PATRICK MWANGA', '0742567780', 'WOMEN GROUP SALOME', '', '', '', '', '', '1', '', ''),
(1527, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1528, '', 'PHOUSTINE NASERA', '0721321553', 'UMOJA MANYALA SISTER', '', '', '29', '', '3', '1', '', ''),
(1529, '', 'MILLICENT MUMBEH', '0723474682', 'UMOJA MANYALA SISTER', '', '', '29', '', '3', '1', '', ''),
(1530, '', 'MOURINE WESONGA', '0727249647', 'UMOJA MANYALA SISTER', '', '', '29', '', '3', '1', '', ''),
(1531, '', 'EMILLY LUDENDE', '0726715431', 'UMOJA MANYALA SISTER', '', '', '29', '', '3', '1', '', ''),
(1532, '', 'JOSEPHINE BUNYASI', '0714389554', 'MUNGATSI WOMEN GROUP', '', '', '29', '', '3', '1', '', ''),
(1533, '', 'EMMILLY EKESAH', '0727152117', 'MUNGATSI WOMEN GROUP', '', '', '29', '', '3', '1', '', ''),
(1534, '', 'PHILICE ANYIKO', '0701185555', 'MUNGATSI WOMEN GROUP', '', '', '29', '', '3', '1', '', ''),
(1535, '', 'MILKA MURUNGA', '0707228613', 'MUNGATSI WOMEN GROUP', '', '', '29', '', '3', '1', '', ''),
(1536, '', 'LILIAN MAKOKHA', '0727269119', 'ORONYO SELF HELP JOI', '', '', '29', '', '3', '1', '', ''),
(1537, '', 'MARY OLIVER MBALWE', '0721711130', 'ORONYO SELF HELP JOI', '', '', '29', '', '3', '1', '', ''),
(1538, '', 'MARYLINE AKUKU', '0727331751', 'ORONYO SELF HELP JOI', '', '', '29', '', '3', '1', '', ''),
(1539, '', 'JULIAN  KOKONYA', '0724041528', 'ORONYO SELF HELP JOI', '', '', '29', '', '3', '1', '', ''),
(1540, '', 'MARY NALIAKA', '0796222469', 'MADIBO SALAMU CLUB S', '', '', '29', '', '3', '1', '', ''),
(1541, '', 'ROSEMARY MASINDE', '0703594958', 'MADIBO SALAMU CLUB S', '', '', '29', '', '3', '1', '', ''),
(1542, '', 'JOSEPHINE WANYONYI', '0710733675', 'MADIBO SALAMU CLUB S', '', '', '29', '', '3', '1', '', ''),
(1543, '', 'PRAXIDEES MANYURU', '0711767543', 'MADIBO SALAMU CLUB S', '', '', '29', '', '3', '1', '', ''),
(1544, '', 'KIZITO KATILA', '0702007463', 'TWENDELEE YOUTH GROU', '', '', '29', '', '3', '1', '', ''),
(1545, '', 'CHRISTOPHER SIMIYU', '0706471075', 'TWENDELEE YOUTH GROU', '', '', '29', '', '3', '1', '', ''),
(1546, '', 'EMMANUEL EKESA', '0742634611', 'TWENDELEE YOUTH GROU', '', '', '29', '', '3', '1', '', ''),
(1547, '', 'ROSE ODUOR', '0714500320', 'MALUMINI SELF HELP G', '', '', '29', '', '3', '1', '', ''),
(1548, '', 'CORNELIA MWIMA', '0710360514', 'MALUMINI SELF HELP G', '', '', '29', '', '3', '1', '', ''),
(1549, '', 'SYLVIA WANYAMA', '0704876753', 'MALUMINI SELF HELP G', '', '', '29', '', '3', '1', '', ''),
(1550, '', 'COINDENCE MWIMA', '0716736781', 'MALUMINI SELF HELP G', '', '', '29', '', '3', '1', '', ''),
(1551, '', 'PHYLIS JUMA', '0704526093', 'KHULWANDA SOUND HARV', '', '', '29', '', '3', '1', '', ''),
(1552, '', 'MAXIMILLAH WALEKHWA', '0727860817', 'KHULWANDA SOUND HARV', '', '', '29', '', '3', '1', '', ''),
(1553, '', 'JENTRIX BARASA', '0792399196', 'KHULWANDA SOUND HARV', '', '', '29', '', '3', '1', '', ''),
(1554, '', 'ROSE OMANYO', '0721651691', 'KHULWANDA SOUND HARV', '', '', '29', '', '3', '1', '', ''),
(1555, '', 'GLADYS NEKESA', '0706754376', 'OBULALA NDE MANI YOU', '', '', '29', '', '3', '1', '', ''),
(1556, '', 'MELOVIN AKINYI', '0700399903', 'OBULALA NDE MANI YOU', '', '', '29', '', '3', '1', '', ''),
(1557, '', 'FLORENCE ACHIENG', '0702735621', 'OBULALA NDE MANI YOU', '', '', '29', '', '3', '1', '', ''),
(1558, '', 'PRAXIDESE ASHIOYA', '0705869073', 'OBULALA NDE MANI YOU', '', '', '29', '', '3', '1', '', ''),
(1559, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1560, '2930558', 'REBECCA AUMA', '0768427972', '', '', '', '', '29', '3', '1', '', ''),
(1561, '2090665', 'JOHN OGARA', '0708330068', '', '', '', '', '29', '3', '1', '', ''),
(1562, '4852126', 'EMILY ASHIOYA', '0725432795', '', '', '', '', '29', '3', '1', '', ''),
(1563, '24627735', 'GLADYS AUMA WASIKE', '0759330757', '', '', '', '', '29', '3', '1', '', ''),
(1564, '2219583', 'VIOLET WASIKE', '0714564049', '', '', '', '', '29', '3', '1', '', ''),
(1565, '21927496', 'AWINO JANET MAKOKHA', '0715702517', '', '', '', '', '29', '3', '1', '', ''),
(1566, '2263094', 'JOSEPHINE NANZALA', '0700857604', '', '', '', '', '29', '3', '1', '', ''),
(1567, '21306805', 'MILDRED OTONYO', '0743622411', '', '', '', '', '29', '3', '1', '', ''),
(1568, '1367051', 'SILVIA ATIENO', '0704876753', '', '', '', '', '29', '3', '1', '', ''),
(1569, '14531113', 'BARONESS WANZALA', '0705590008', '', '', '', '', '29', '3', '1', '', ''),
(1570, '14661350', 'BEATRICE NABANGI', '0790760164', '', '', '', '', '29', '3', '1', '', ''),
(1571, '21177513', 'LINET WANYAMA', '0729356709', '', '', '', '', '29', '3', '1', '', ''),
(1572, '7504937', 'FELISTUS NEKESA', '0714375619', '', '', '', '', '29', '3', '1', '', ''),
(1573, '1764373', 'GAUDENSIA WESONGA', '0716736781', '', '', '', '', '29', '3', '1', '', ''),
(1574, '', '', '', '', '', '', '', '29', '3', '1', '', ''),
(1575, '', '', '', '', '', '', '', '29', '3', '1', '', ''),
(1576, '', '', '', '', '', '', '', '29', '3', '1', '', ''),
(1577, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1578, '', 'BEATRICE AMUKAGA ETYANG', '0701064305', 'THREE CHAIRPERSONS  ', '', '', '11', '', '6', '1', '', ''),
(1579, '', 'DEBORA AMACHILANG', '0707493917', 'THREE CHAIRPERSONS M', '', '', '18', '', '5', '1', '', ''),
(1580, '', 'LINET IMELLA OBUSE', '0712110767', 'THREE CHAIRPERSONS M', '', '', '18', '', '5', '1', '', ''),
(1581, '', 'WINNIE WESONGA', '0700267853', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1582, '', 'AGNES MUSUNGU', '0711540230', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1583, '', 'GLADYS ALUSALA', '0723736415', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1584, '', 'VINCENT MWAKHA', '0722590787', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1585, '', 'GLADYS  O ANJATIA', '0715068188', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1586, '', 'PELISTUS AYIETA OLUMAAI', '0711342758', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1587, '', 'MELEAH OKUSIMBA', '0721588301', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1588, '', 'ROSELYNE OMUSANJA', '0718926698', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1589, '', 'TOPISTER ASHIAYO', '0726962475', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1590, '', 'EVERLYNE NYONGESA', '0719204039', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1591, '', 'JULIA ALWALI MAHERO', '0710542003', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1592, '', 'EASTHER NYUMBALA', '0722503874', 'NAMBALE TOWNSHIP SHA', '', '', '14', '', '3', '1', '', ''),
(1593, '', 'GERSHOM JUMA', '0718414440', 'COMMUNITY HEALTH WOR', '', '', '', '', '3', '1', '', ''),
(1594, '', 'FELIA CHALLENJI', '0712243224', 'COMMUNITY HEALTH WOR', '', '', '', '', '3', '1', '', ''),
(1595, '', 'EVERLINE AUMA', '0713462895', 'COMMUNITY HEALTH WOR', '', '', '', '', '3', '1', '', ''),
(1596, '', 'JANET MAKOKHA', '0705864102', 'COMMUNITY HEALTH WOR', '', '', '', '', '3', '1', '', ''),
(1597, '', 'MINAM FWADE', '0705527953', 'COMMUNITY HEALTH WOR', '', '', '', '', '3', '1', '', ''),
(1598, '', 'BENSON NABANYA', '0725797085', 'COMMUNITY HEALTH WOR', '', '', '', '', '3', '1', '', ''),
(1599, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1600, '11133092', 'HENDRICA OKUMU', '0710141075', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1601, '11537797', 'MARY KOKONYA', '0710683723', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1602, '67655360', 'MARGARET MUSUMBA', '0713967563', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1603, '25510890', 'SELINA ORONI', '0713025495', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1604, '34004361', 'RISPA LAKITARI', '0797602962', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1605, '1145344', 'JOHN OKELLO', '0704643884', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1606, '1144428', 'GEORGE ANGAYA', '0721150846', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1607, '29407872', 'PAMELLA ODUOR', '0716344945', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1608, '24260331', 'VIOLET OKOYO', '0710618062', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1609, '28655614', 'VIOLET NALIAKA', '0717936225', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1610, '13670596', 'RUTH NANDIRI', '07279455677', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1611, '11739754', 'EVERLYNE JUMA', '0711756261', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1612, '1180598', 'EVERLYNE NANDIRI', '0706633497', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1613, '21030258', 'CONSOLATE OKOTH', '0725246241', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1614, '24138548', 'JANE OSANYA', '0706868063', 'UWEZO FUND CHAKO NI ', '', '', '', '', '3', '1', '', ''),
(1615, '685548', 'JOSEPHINE BUNYASI', 'O714389554', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1616, '13879728', 'EMILLY EKESAH', '0727152117', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1617, '10614231', 'PHILICE OCHAKA', '0701185555', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1618, '13670540', 'JUDITH OKINDA', '0707732832', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1619, '24083868', 'PRACXIDES KADOGO', '0723030745', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1620, '23173904', 'MATHILDA AUMA', '0701603050', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1621, '9509932', 'BETTY OMBULA', '0729989787', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1622, '14678107', 'MILKA MULYANGA', '0707228613', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1623, '13670991', 'AJELINE ODUOR', '0728556579', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1624, '9338934', 'WILIMINA  ACHOKA', '0703842488', 'UWEZO FUND MUNGATSI ', '', '', '', '', '3', '1', '', ''),
(1625, '27569222', 'TITUS WANYONYI', '0714807892', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1626, '30114942', 'EVANS AKWATA', '0706220340', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1627, '32100131', 'EVERLYNE EKISE', '0727418051', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1628, '21832923', 'SANDREW SAKWA', '0729873731', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1629, '23890684', 'FLORENCIO OFISI', '0705696172', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1630, '25540482', 'TITUS OTWANE', '0701941618', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1631, '21876225', 'JOSEPH SIMIYU', '0711708870', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1632, '11740043', 'NATHAN OKWARO', '0723582816', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1633, '9468281', 'GEORGINA MAGERO', '0711849698', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1634, '10906364', 'KENNETH OKUMU', '0712707678', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1635, '11822082', 'BENARD OUMA', '0742828285', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1636, '9238045', 'HENRY SIMIYU', '0729446886', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1637, '8398617', 'VINCENT WANJALA', '0711543625', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1638, '7897237', 'AFUBWA NYONGESA', '0702526031', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1639, '5673016', 'LAWRENCE ETYANG', '0715171587', 'UWEZO FUND MUSOKOTO ', '', '', '', '', '3', '1', '', ''),
(1640, '6649198', 'MARGARET ULUMA', '0712886022', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1641, '11278454', 'PETRONILLA WANGADIA', '0716886627', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1642, '9687895', 'DOROTHY WERE', '0716981885', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1643, '9898220', 'JENDRICK MAKOKHA', '0797594940', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1644, '126294', 'MESHACK SAKWA', '0715395408', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1645, '4232150', 'CATHERINE SEMBEYA', '0717546736', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1646, '9896098', 'SELESTINE NAKHMICHA', '0701601565', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1647, '42322481', 'FRANSISCA SEMBEA', '0715584002', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1648, '8288085', 'MACTILDA CHIMWANI', '0717881195', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1649, '22742869', 'ROSELIDA NAMUSONGE', '0718524427', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1650, '26180298', 'LUCY NASAKA', '0725380616', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1651, '32916580', 'IBRAHIM SAKWA', '0705878379', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1652, '21451682', 'LYDIA OTEBA', '0736369004', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1653, '33948516', 'FELISTAS NAMENGE', '0791989730', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1654, '26884157', 'VIOLET NAMKHUMWA', '0714578712', 'UWEZO FUND NANGALWE ', '', '', '', '', '3', '1', '', ''),
(1655, '24369722', 'LILIAN MAKOKHA', '0727269119', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1656, '27980737', 'MARION AKUKU', '0727331751', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1657, '126840737', 'MARYOLIVER MBALWE', '0721711130', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1658, '27461946', 'MAURINE MONDOH', '0722984319', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1659, '26348909', 'SARAH JUMA', '0720317859', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1660, '22681659', 'PRAXIDIS OUMA', '0715317859', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1661, '29388793', 'JUDITH AKINYI', '0705562868', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1662, '21606805', 'JULIAN KOKONYA', '0724041528', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1663, '1942421', 'JERIDAH OKIYA', '0701403865', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1664, '1859739', 'FRODAS OUMA', '0727269119', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1665, '2222076', 'VICTOR OUMA', '0713307859', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1666, '13581694', 'LILIAN TAABU', '0727477142', 'UWEZO FUND ORONJO JO', '', '', '', '', '3', '1', '', ''),
(1667, '8399540', 'ROSEMARY IRONI', '0707375671', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1668, '8012394', 'ANNA NANJALA', '0710186041', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1669, '9980159', 'JANEPHER JUMA', '0731318065', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1670, '11683248', 'GETRUDE NATOYI', '0700600052', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1671, '3423962', 'PRISCA MAKOKHA', '0720204885', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1672, '682401', 'GRACE OYENDA', '0713089291', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1673, '6765208', 'VIDELIA MANYASA', '0700514586', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1674, '1145151', 'WILFRIDA MANYASA', '0716383196', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1675, '287561', 'CHRISTOPHER ODUKU', '0711830471', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1676, '475502', 'PETER OTIENO', '0726990882', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1677, '118351', 'SYPRIAN ODHIAMBO', '0736980562', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1678, '725338', 'CHARLES WALUKOBA', '0717169273', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1679, '2274262', 'JOSEPH EKESA', '0721869944', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1680, '8727599', 'JANE AKOTH', '0707982938', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1681, '20394266', 'GOFREY MUSUNGU', '0727604806', 'UWEZO  FUND BUKHAYO ', '', '', '', '', '3', '1', '', ''),
(1682, '26042170', 'EMMANUEL WANDERA', '0717385410', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1683, '313330002', 'HELLEN EKESA', '0742634288', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1684, '30236843', 'PAUL OKWARA', '0726973759', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1685, '31194685', 'MORINE MACHIO', '0703748377', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1686, '24576162', 'AMBROSE WASIKE', '0728826829', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1687, '32559523', 'PHYLIS INDIMULI', '0729791260', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1688, '29118186', 'SUSAN OUMA', '0796795053', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1689, '28648073', 'WILIKISTER OKWERO', '0712653074', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1690, '377778241', 'BRIAN EKESA', '0743218789', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1691, '35856628', 'WILLIMINA MUKANDA', '0797070123', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1692, '24906628', 'MAXIMILLAH KWEDHO', '0716456483', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1693, '31965754', 'GRACE WANDERA', '0703558457', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1694, '29253712', 'JOSEPHINE WEKESA', '0743534907', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1695, '30298911', 'BEATRICE OKWERO', '0797667445', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1696, '37862790', 'EDWIN ETYANG', '0725120723', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1697, '29961839', 'JERUSA AMAYO', '0722275511', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1698, '31953493', 'LILIAN AUMA MUTORO', '0798106111', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1699, '21398285', 'PETRONILLA NABWIRE', '0713258577', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1700, '5140965', 'SIKUTATU OMUSE', '0728378017', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1701, '13528066', 'CHRISPINUS KAFWA', '0720485716', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1702, '23014034', 'EVERLYNE SAKWA', '0713182015', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1703, '1180579', 'MARY OBUNINI', '0704181410', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1704, '292214836', 'MICHAEL JUMA', '0736101120', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1705, '2059339', 'KELENSIA OBWORA', '0736182020', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1706, '30972855', 'HILLARY MAKENI', '0700213045', 'UWEZO FUND NAMBALE M', '', '', '', '', '3', '1', '', ''),
(1707, '2614485', 'GLADYS AUMA', '0705530124', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1708, '22563534', 'STELLA NAMIKHOYE', '0714254296', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1709, '583092', 'ALICE KEYA', '0710496617', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1710, '6055207', 'FLORENCE WANDERA', '0714388435', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1711, '9239732', 'AMIDA NAKHUMICHA', '0799714587', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1712, '26028153', 'JANE IMAROT', '0721123663', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1713, '682491', 'RAEL OKUMU', '0729560562', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1714, '9029336', 'MARY OBIERO', '0725572637', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1715, '10352776', 'FELISTER KAGEHA', '0700244042', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1716, '216699201', 'DAVID SHIKUYU', '0712960607', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1717, '2146726', 'JOHN JUMA', '0724962947', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1718, '13039784', 'BENARD   ', '0728415811', 'UWEZO FUND ONYUNYURI', '', '', '', '', '3', '1', '', ''),
(1719, '28638558', 'JAMES BARASA', '0704601931', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1720, '35084715', 'BRIGIT SHAKILA', '0745357657', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1721, '30158443', 'BENJAMIN COLLINS', '0708778798', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1722, '11596452', 'TIMOTHY OKUMU', '0710441776', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1723, '38709943', 'MICHAEL OLUOCH', '0745947915', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1724, '29195567', 'SYLVESTER OTIENO', '0783714947', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1725, '27355022', 'JOYCE ADHIAMBO', '0708609236', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1726, '30157486', 'HARRISON EKESA', '0796671582', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1727, '22247504', 'MOURICE WAFULA', '0710434507', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1728, '25866070', 'EUGINE NASIRUMBI', '0759388192', 'UWEZO FUND OBULALA H', '', '', '', '', '3', '1', '', ''),
(1729, '23352432', 'CAROLINE MAKARI', '0727123167', 'UWEZO FUND HOPE STAR', '', '', '', '', '3', '1', '', ''),
(1730, '1132207', 'GETRUDAH OYOLO', '0713956359', 'UWEZO FUND HOPE STAR', '', '', '', '', '3', '1', '', ''),
(1731, '22490878', 'VALENTINE ANGAYO', '0708529668', 'UWEZO FUND HOPE STAR', '', '', '', '', '3', '1', '', ''),
(1732, '111333466', 'FLORENCE EGESA', '0701468028', 'UWEZO FUND HOPE STAR', '', '', '', '', '3', '1', '', ''),
(1733, '23588545', 'ROSEMARY ATIENO', '0733402990', 'UWEZO FUND HOPE STAR', '', '', '', '', '3', '1', '', ''),
(1734, '20848339', 'PRAXIDES NAMANGALE', '0714614728', 'UWEZO FUND HOPE STAR', '', '', '', '', '3', '1', '', ''),
(1735, '9608032', 'CATHERINE OPEMI', '0720384237', 'UWEZO FUND HOPE STAR', '', '', '', '', '3', '1', '', ''),
(1736, '20179139', 'MARGARET LITANGA', '0738034120', 'UWEZO FUND HOPE STAR', '', '', '', '', '3', '1', '', ''),
(1737, '20058387', 'LEONARD ODONGO', '0729312716', 'UWEZO FUND HOPE STAR', '', '', '', '', '3', '1', '', ''),
(1738, '14679216', 'EVERLYNE ADURE', '0722695433', 'UWEZO FUND UMOJA MAN', '', '', '', '', '3', '1', '', ''),
(1739, '211800998', 'EMELDA LUDENDE', '0726715543', 'UWEZO FUND UMOJA MAN', '', '', '', '', '3', '1', '', ''),
(1740, '13670614', 'MAURICE WESONGA', '0727249647', 'UWEZO FUND UMOJA MAN', '', '', '', '', '3', '1', '', ''),
(1741, '26811983', 'MILLICENT MUNIBEH', '0723474682', 'UWEZO FUND UMOJA MAN', '', '', '', '', '3', '1', '', ''),
(1742, '20253456', 'FLORENCE OKODO', '0799059897', 'UWEZO FUND UMOJA MAN', '', '', '', '', '3', '1', '', ''),
(1743, '234447389', 'FAUSTEEN NASERA', '0721321553', 'UWEZO FUND UMOJA MAN', '', '', '', '', '3', '1', '', ''),
(1744, '22959165', 'ALBERT WAFULA', '0701446983', 'UWEZO FUND UMOJA MAN', '', '', '', '', '3', '1', '', ''),
(1745, '20702480', 'YUSUF MISOLA', '0726984002', 'UWEZO FUND UMOJA MAN', '', '', '', '', '3', '1', '', ''),
(1746, '35543710', 'GRACE MBERA', '0700026966', 'UWEZO FUND UMOJA MAN', '', '', '', '', '3', '1', '', ''),
(1747, '135216', 'ELECTINE OLENGO', '0702769107', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1748, '25650195', 'JUDITH OPICHO', '0707385081', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1749, '23451440', 'MARY OKWERO', '0710124676', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1750, '3396788', 'JENTRIX ACHIENG', '0707221432', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1751, '876801', 'EUNICE NAFULA', '0742324152', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1752, '25520798', 'MOSES ODEBA', '0733577700', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1753, '22077386', 'EUNICE NAMBANGA', '0710873845', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1754, '30463017', 'CATHERINE OGOLA', '0710202018', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1755, '24139132', 'SILVIA AKINYI', '0742501685', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1756, '26774362', 'CONSOLATA JUMA', '0743441016', 'UWEZO FUND MAKALE TR', '', '', '', '', '3', '1', '', ''),
(1757, '258866157', 'CHRISTINE OYUGI', '0721876304', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1758, '10666499', 'RISPER ANGENGO', '0725385931', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1759, '13670920', 'PATRICIA NYANGWESO', '0705947131', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1760, '20672095', 'CHRISTINE ACHIENG', '0723030418', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1761, '2005316', 'SOFIA AKELLO', '0717245942', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1762, '36296030', 'LILIAN AUMA  ', '0713788392', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1763, '28439767', 'SUSAN AUMA', '0726866869', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1764, '9899413', 'ROSEMARY ACHIENG', '0743290515', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1765, '30399387', 'IRENE AKINYI', '0702282578', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1766, '28855191', 'CAROLINE MULIRO', '0701843951', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1767, '32208347', 'MARY OCHIENG', '0703830989', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1768, '26767056', 'LILIAN ODUOR', '07049440867', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1769, '7320119', 'EMILY OMOTO', '0711347139', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1770, '31803325', 'DAMARIS ACHIENG', '0707761204', 'UWEZO FUND MWENDA PO', '', '', '', '', '3', '1', '', ''),
(1771, '20452540', 'FLORENCE NABASWA', '0700811954', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1772, '20270113', 'PRAXIDEES NJUBI', '0720504186', 'UWEZO FUND ISAAMBO W', '', '', '', '', '', '', '', ''),
(1773, '11344172', 'ANN OMONJO', '0790638997', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1774, '1145237', 'ESTHER WERE', '0719632021', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1775, '2062234', 'CAROLYNE IMAMAI', '0727211220', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1776, '2009701', 'ANJELINE ODUORY', '0703697158', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1777, '25729069', 'JULIAN ODUORY', '0700418061', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1778, '20062849', 'GODLIVER OUMA', '0726848508', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1779, '11159719', 'CAROLYNE KHAMALA', '0729839759', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1780, '838912', 'ROSEMARY ODEMBO', '0714089560', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1781, '29371426', 'ESTHER WESONGA', '0718217977', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1782, '11822002', 'JUDITH WERE', '0706307654', 'UWEZO FUND ISAAMBO W', '', '', '', '', '3', '1', '', ''),
(1783, '35956090', 'AUGUSTINE BARASA', '0703364452', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1784, '35452171', 'PIUS OKUTOYI', '0795466180', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1785, '32112171', 'SARAH NANJALA', '0715592262', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1786, '23305718', 'WYCLIFE OKELLO', '0725380495', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1787, '10906396', 'VIOLET OKELLO', '0726869740', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1788, '20775952', 'BENARD NAKHABI', '0729743156', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1789, '9683846', 'FLORENCE OUNDO', '0716201770', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1790, '23297358', 'BENARD OCHIENG', '0702512787', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1791, '7531208', 'FATUMA OMARI', '0792340736', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1792, '22637483', 'BEATRICE OPONDO', '0790779205', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1793, '22224483', 'MERCYLINE SUSUMA', '0712537481', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1794, '10004872', 'JOSPHENE AUMA', '0702639740', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1795, '20119515', 'ROSE WANDERA', '0724938323', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1796, '27441479', 'MWANGALA LUVONGA', '0720203380', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1797, '11238237', 'GLADYS NYONGESA', '0726463094', 'UWEZO FUND MAUTETE S', '', '', '', '', '3', '1', '', ''),
(1798, 'id_no', 'names', 'phone_no', 'village', 'sublocation', 'location', 'ward code', 'pstation', 'subcounty Code', 'county Code', 'gender', 'address'),
(1799, '7420067', 'HELLEN OKUMU', '0716501845', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1800, '8637904', 'ROSE SHIRENYA', '0725684247', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1801, '1180076', 'HENRY ONDUNYU', '0727770003', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1802, '6765614', 'BENJAMIN OKUMU', '0710553097', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1803, '7920739', 'FREDRICK OKWEDO', '0740735090', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1804, '115897494', 'STEPHEN OSIKE', '0726445665', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1805, '21398270', 'ANN NYONGESA', '0706309960', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1806, '7897261', 'BEATRICE  BARASA', '0714307165', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1807, '1144210', 'ANN MAKOKHA ', '0739884961', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1808, '24114347', 'WILLIMINA BALA', '0727176565', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1809, '2043427', 'ALICE ODHIAMBO', '0711343157', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1810, '28378516', 'ALICE NABWIRE', '0711438486', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1811, '7915696', 'ROSEMARY ANYANGO', '0716784871', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1812, '13529530', 'ANN AWINO', '0700237660', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1813, '11538163', 'PATRICK BARASA', '0727175766', 'UWEZO FUND BUNYASI S', '', '', '', '', '3', '1', '', ''),
(1814, '11352816', 'ELCTINE OLENGO', '0702769107', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1815, '7231815', 'ANN NDUBI', '0713049187', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1816, '122891', 'ROSELINE JUMA', '0715261642', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1817, '20324487', 'CHRISTINE OKWEDO', '0710884741', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1818, '682970', 'JUCINTER OCHIENG', '070809556', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1819, '1487673', 'KEN NGESA', '0712638415', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1820, '11537655', 'CONEPTA JUMA', '0757894130', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1821, '20875087', 'ADLIGHT OKOTH', '0757439795', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1822, '24551663', 'JOYCE ONONO', '0728968035', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1823, '11454605', 'JOHN ODIPO', '0727688462', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1824, '1181506', 'VALENTINE ODUOKI', '0720957334', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1825, '22348442', 'GEOFFREY ONONO', '0723887733', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1826, '9105391', 'LEARNARD OKOTH', '0757439795', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1827, '5688875', 'FARIDA AKINYI', '0710305175', 'UWEZO FUND TUJIJENGE', '', '', '', '', '3', '1', '', ''),
(1828, '5395041', 'JULIA EKAPEL', '0714363783', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1829, '14725022', 'METRINE NEKESA', '0708952990', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1830, '6965935', 'PASCALIA MAKOKHA', '0721234449', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1831, '22953663', 'WILLOFRIDA WERE', '0790532273', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1832, '5635568', 'PENINAH KHANYAKHA', '0713793384', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1833, '28675405', 'VIOLET NAFULA', '0756622828', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1834, '6565122', 'ALICE NASIMIYU', '0729053290', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1835, '22967669', 'CELESTINE NASIMIYU', '0710593821', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1836, '1088808', 'MAXMILLA BULUMA', '0718885459', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1837, '4234407', 'ALICE SAUKE', '0721234449', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1838, '6315203', 'PAMELA NDOMBI', '0728174631', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1839, '33670138', 'LINDAM ALUKU', '0706089649', 'UWEZO FUND IMARA WIO', '', '', '', '', '3', '1', '', ''),
(1840, '11821770', 'JOSEPHINE OMOI', '0720974388', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1841, '6653282', 'JENTRIX APONDI', '0713089347', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1842, '5141502', 'FAUSTINA ANYANGO', '0711290964', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1843, '390581', 'ALBERT OKWI', '0711112079', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1844, '5141614', 'JONINA AUMA', '0734789190', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1845, '5141601', 'SAMUEL OSIKUKU', '0729646779', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1846, '5142057', 'GETRUDE OSIKUKU', '0714112331', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1847, '27372425', 'CHRISTINE WAKULWA', '0725219044', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1848, '5141548', 'ERNEST NAKHULO', '0720750168', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1849, '4166895', 'CHARITY ARIONG ', '0710933734', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1850, '390814', 'JUSTINE OKWI', '0799025871', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1851, '390745', 'ATYANG ANJELINA', '0700240781', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1852, '24203725', 'PHILIP ODONGO', '0724754124', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1853, '2060702', 'FOBIAN ARIONG', '0715728190', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1854, '2725272', 'PAUL OUMA', '0796144247', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1855, '99818858', 'JOSEPH ETYANG', '0711525744', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1856, '390738', 'JOHN ODONGO', '0797494956', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1857, '390733', 'LEMINA ODONGO', '0706022069', 'UWEZO FUND OKATEKOK ', '', '', '', '', '3', '1', '', ''),
(1858, '7259279', 'FAIZAH SHAABAN', '0719115885', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1859, '5532423', 'ROSE WERE', '0718255864', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1860, '9028317', 'MAIMUNA MUHHAMED', '0701303126', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1861, '9898584', 'PHILIS ALUTIA', '0722824045', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1862, '5778176', 'JOICE KEIZA', '0729333236', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1863, '6643476', 'SARAH ALI', '0705794490', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1864, '25391934', 'SAKINA ALI', '0703756603', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1865, '2603235', 'ZURA NERIMA', '0726711871', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1866, '20055179', 'PAMELA OLUOCH', '0703910526', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1867, '36831457', 'SALMA IDDY', '0700843507', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1868, '17893761', 'AMINA MUHAMOUD', '0708432001', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1869, '25305804', 'HAIBA MUITANI', '0727363321', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1870, '20740245', 'JAMILLA HASSAN', '0710866104', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1871, '30114469', 'SHAKILA OBITO', '0702507709', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1872, '25529436', 'NEVANDA HAWA', '0714341914', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1873, '24546025', 'REHEMA ACHIENG', '0723466143', 'UWEZO FUND ALIMUMINA', '', '', '', '', '3', '1', '', ''),
(1874, '21094145', 'ASHA LUTA', '0702898141', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1875, '26232303', 'ALICE MANYURU', '0715899857', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1876, '32179962', 'FLAVIAN ATIENO', '0758947878', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1877, '27159962', 'LILIAN AJIAMBO', '0713173942', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1878, '24163167', 'IRENE NAFULA', '0729891606', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1879, '27146938', 'EVERLINJE AMACHUDI', '0745881590', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1880, '25346145', 'VIOLET KAMANO', '0714759484', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1881, '33280808', 'EUNICE AWINO', '0714566397', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1882, '26036713', 'DORIS OSANYO', '0791584600', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1883, '22833743', 'INVILATA APONDI', '0720527922', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1884, '20062113', 'CHRISTINE AUMA', '0707845817', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1885, '29988497', 'STELLA WAMBOI', '0714401744', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1886, '32293695', 'LYDIA AMOLO', '0701881594', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1887, '30769079', 'PETRONILLA AUMA', '0759896776', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1888, '26018811', 'PENINA AUMA', '0716720081', 'UWEZO FUND EFUMBUSIA', '', '', '', '', '3', '1', '', ''),
(1889, '13369421', 'JOYCE INDECHE', '0724719488', 'UWEZO FUND NASKINA S', '', '', '', '', '3', '1', '', ''),
(1890, '21743658', 'IRENE NANZALA', '0703772085', 'UWEZO FUND NASKINA S', '', '', '', '', '3', '1', '', ''),
(1891, '20058102', 'MAGERET ADIKINYI', '07213331423', 'UWEZO FUND NASKINA S', '', '', '', '', '3', '1', '', ''),
(1892, '21404358', 'WINFRED ADIKINYI', '0799655497', 'UWEZO FUND NASKINA S', '', '', '', '', '3', '1', '', ''),
(1893, '36243956', 'MAXIMILA AWINO', '0740911464', 'UWEZO FUND NASKINA S', '', '', '', '', '3', '1', '', ''),
(1894, '571528', 'ALECTINA NABWIRE', '0737375796', 'UWEZO FUND NASKINA S', '', '', '', '', '3', '1', '', ''),
(1895, '29007966', 'CAROLYNE AUMA', '0799765497', 'UWEZO FUND NASKINA S', '', '', '', '', '3', '1', '', ''),
(1896, '960758', 'BEATRICE ODUOR', '0735286884', 'UWEZO FUND NASKINA S', '', '', '', '', '3', '1', '', ''),
(1897, '13670764', 'DICKSON ERICK MAKOKHA', '0729549044', 'UWEZO FUND NASKINA S', '', '', '', '', '3', '1', '', ''),
(1898, '22099187', 'DORAH AMBASA', '0711896610', 'UWEZO FUND NGUZO IMA', '', '', '', '', '3', '1', '', ''),
(1899, '34435790', 'SARAH ATISI', '0707777098', 'UWEZO FUND NGUZO IMA', '', '', '', '', '3', '1', '', ''),
(1900, '12456725', 'SIMON BARASA', '0728677830', 'UWEZO FUND NGUZO IMA', '', '', '', '', '3', '1', '', ''),
(1901, '34706090', 'RUTH WANYAMA', '0748353825', 'UWEZO FUND NGUZO IMA', '', '', '', '', '3', '1', '', ''),
(1902, '4234519', 'MARGERET BARASA', '0737273312', 'UWEZO FUND NGUZO IMA', '', '', '', '', '3', '1', '', ''),
(1903, '34709349', 'DORCUS IJAKAA', '0712728865', 'UWEZO FUND NGUZO IMA', '', '', '', '', '3', '1', '', ''),
(1904, '9980506', 'EUNICE OBOTE', '07111950049', 'UWEZO FUND NGUZO IMA', '', '', '', '', '3', '1', '', ''),
(1905, '23942638', 'LUCAS BARASA', '0723487774', 'UWEZO FUND NGUZO IMA', '', '', '', '', '3', '1', '', ''),
(1906, '28714579', 'BENIGINE SOKONI', '0714761381', 'UWEZO FUND NGUZO IMA', '', '', '', '', '3', '1', '', ''),
(1907, '13670523', 'MARGERET O SCOUT', '0726963020', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1908, '26740941', 'MATHA IKASERENG', '0719125281', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1909, '4174362', 'VICTORIA ALUSO', '0710123682', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1910, '10531341', 'JANEROSE ITEKE', '0726924104', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1911, '14435096', 'BEVERLINE ANJAO', '0718492622', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1912, '683022', 'MARY ALICE ASIO', '0700627615', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1913, '22186417', 'VIOLET G IMBAYI', '0720613992', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1914, '30157567', 'JEMIMA IKOITA OMUSE', '0701556734', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1915, '1144683', 'CHRISTINE LUKOBA', '0723165683', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1916, '29030345', 'BEATRICE NABULINE', '0713938783', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1917, '32866149', 'LYDIAH  NASIMIYU', '0708471620', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1918, '28349302', 'PHANICE NABWIRE', '0703711335', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1919, '25294233', 'OKELLO ODERA', '0726386304', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1920, '9228366', 'SAMSON K WEKESA', '0724941811', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1921, '13671042', 'JENTIX AKINYI', '0718714648', 'UWEZO FUND NANOTA SE', '', '', '', '', '3', '1', '', ''),
(1922, '24523152', 'LEAKEY ACHARI', '0720177733', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1923, '24271358', 'MOSES IKURAN', '0725223405', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1924, '21633027', 'JUDITH OTIENG', '0724632486', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1925, '21588112', 'CHRIS ODHIAMBO', '0703837217', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1926, '25809054', 'DOREEN SHABIRA', '0710315085', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1927, '21855406', 'ALICE AUMA', '0725067891', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1928, '28988815', 'DAVID AJWANG', '0708739150', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1929, '23021645', 'GILBERT JUMA', '0713042598', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1930, '32154059', 'COLLINS ALIMASI', '0702092094', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1931, '27983166', 'JUDTH WANDERA', '0717933555', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1932, '31960593', 'ANNET ATIENO', '0701750649', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1933, '22740610', 'PAUL ODONGO', '0723427377', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1934, '30452069', 'MAUREN MUKHONJA', '0704578555', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1935, '13502121', 'PAMELA AYAKO', '0710402658', 'UWEZO FUND NAMBALE P', '', '', '', '', '3', '1', '', ''),
(1936, '25406492', 'VINCENT OKELLO', '0714482433', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1937, '20452602', 'PETRONILLA NYUNDO', '0702532933', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1938, '13879298', 'STELLA NYONGESA', '0716941383', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1939, '23296522', 'GABRIEL OUMA', '0728756796', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1940, '26021859', 'IMELDA JOSEPHINE', '0700005615', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1941, '24283359', 'BEATRICE AUMA', '0727611490', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1942, '6511289', 'FRANCIS WAKHUNGU', '0768252407', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1943, '35758615', 'BEATRICE NAFULA', '0712908800', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1944, '20278040', 'CONSOLATA NAKIBUKA', '0703882796', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1945, '12847008', 'EMILY NAMBUYU', '0715942467', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1946, '21743107', 'GLADYS AWINO', '0715120701', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1947, '20879031', 'CONSOLATA BWIRE', '0720341640', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1948, '30057096', 'GENTRIX AWINO', '0706566904', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1949, '13718432', 'GILBERT MURYATI', '0728512968', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1950, '22086450', 'BENJAMIN EKESA', '0725356379', 'UWEZO FUND ABANG''AYO', '', '', '', '', '3', '1', '', ''),
(1951, '21844824', 'ANHONY JUMA', '07299783852', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1952, '37273918', 'COLLETA NAMENGE', '719174509', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1953, '30509189', 'EMILY BULUMA', '0799056034', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1954, '24370357', 'JOSHUA MUNYEKENYE', '0700422349', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1955, '23290233', 'FREDRICL ISEME', '0746901382', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1956, '30472387', 'ELIZABETH  MWIMA', '0790292691', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1957, '31401197', 'GLADYS OUMA', '0719162958', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1958, '24254956', 'DORCUS JUMA', '0718894597', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1959, '20171187', 'BENSON MWANGALA', '0702621869', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1960, '33277021', 'WILBERFORCE SAKWA', '0795030719', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1961, '33001109', 'SAMUEL NAIKORO', '0712109324', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1962, '31625512', 'ESTHER SIKWE', '0706758565', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1963, '33522572', 'ANN MAKOKHA ', '0703605696', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1964, '33735323', 'LILLIAN SAKWA', '0719174509', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1965, '30934325', 'FRIDAH WESONGA', '0708897363', 'UWEZO FUND MALI SHAM', '', '', '', '', '3', '1', '', ''),
(1966, '20994668', 'ROSELYDA PAMBA', '0799059018', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1967, '22424164', 'EVERLYNE MARUANI', '0714307175', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1968, '24346494', 'SYPHROSE ARITA', '0723131777', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1969, '23559608', 'ZUBEDA WAFULA', '0757224942', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1970, '23525314', 'EVERLYNE NAFULA', '0705425715', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1971, '17896496', 'ANN NEKESA', '0712586183', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1972, '13861096', 'YUSUF LUTTA', '0725410482', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1973, '32613538', 'ANNETTE MIDEVA', '0716011640', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1974, '13576322', 'GEOFFREY SHIKUKU', '0724129479', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1975, '29558147', 'PENINNA NANJALA', '0796094521', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1976, '5274870', 'HERMAN SIDIKA ', '0716011640', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1977, '5762665', 'JOHN LUVEMBE', '0711429731', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1978, '23325417', 'JAMILA MAKOKHA', '0787239899', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1979, '11742564', 'SCOLASTICA LUTOMA', '0714319889', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1980, '12684260', 'BENARD OLANDO', '0717997493', 'UWEZO FUND BUSHIA NE', '', '', '', '', '3', '1', '', ''),
(1981, '28859362', 'MICHAEL IJARA', '0715119504', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1982, '30333216', 'DIANA OKWARA', '0703130014', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1983, '28868878', 'DENNIS OKUKU', '0717960835', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', '');
INSERT INTO `tbl_contacts` (`contact_id`, `id_no`, `names`, `phone_no`, `village`, `sublocation`, `location`, `ward`, `pstation`, `subcounty`, `county`, `gender`, `address`) VALUES
(1984, '8398578', 'ISAAC ONYANGO', '0792660750', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1985, '35846569', 'ELIAS WABWIRE', '0740535874', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1986, '29417589', 'FELISTERS NYABOKE', '0711818756', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1987, '30211231', 'MIKE OLONYO', '0707451724', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1988, '25294777', 'SABINA ETYANG', '0707219751', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1989, '23877238', 'MERYLYNE ATHIENO', '0797375546', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1990, '38429259', 'HUMPHREY OPANGA', '0708097405', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1991, '20929227', 'EVANS CHIRANDE3', '0755906402', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1992, '37481703', 'MESHACK MULANYA', '0792660750', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1993, '25556962', 'WILKISTER ANYANGO', '0720323473', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1994, '293669519', 'FRANCISCA MAKOKHA', '0734483473', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1995, '21672896', 'ROSE SITINDO', '0730403907', 'UWEZO FUND ABAKHONYA', '', '', '', '', '3', '1', '', ''),
(1996, '1145979', 'GEORGE OKUMU', '0714176182', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(1997, '25860710', 'SARAH ONG''ALE', '0712520693', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(1998, '20179139', 'MARGERET LITANGA', '07111875796', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(1999, '23238443', 'FRIDA AMUSUGUTU', '0712520693', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2000, '7920434', 'CRISPON OMONDI', '0704527131', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2001, '1810115', 'MIKE ODERO', '0715696391', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2002, '6251947', 'SOLOMON OBOKI', '0724575841', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2003, '570829', 'PETER ODONGO', '0746013423', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2004, '391560', 'GEORGE ASIOLA', '0790621589', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2005, '9468458', 'AUGUSTUNE OTHIENO', '0708337589', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2006, '200587', 'LEONARD ODONGO', '0799060643', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2007, '6765635', 'WVERLYNE BWIRE', '0714176187', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2008, '23588545', 'ROSEMARY ATHIENO', '0715520018', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2009, '391491', 'GABRIEL OKWERO', '0705500018', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2010, '571328', 'RIUS WABWIRE', '0724115561', 'UWEZO FUND LWANYANGE', '', '', '', '', '3', '1', '', ''),
(2011, '33675546', 'EUNICE NYONGESA ', '0792380676', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2012, '20912027', 'CAROLYNE ONYANGO', '0706787907', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2013, '25457035', 'PATRICK OKUMU', '0701999432', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2014, '22858304', 'EDWARD MALIKA', '0725881413', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2015, '26822890', 'VIOLET MAPESA', '0707030261', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2016, '26907473', 'EUNICE OKUMU', '0732243456', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2017, '25781538', 'JESCA SIRISIA', '0700894554', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2018, '32980352', 'AGNES ORODI', '0726769499', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2019, '32508892', 'MILDRED JUMA', '0714201773', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2020, '32661555', 'WYCLIFF OUMA', '0769020448', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2021, '31317033', 'BENARD OMADWA', '0742361154', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2022, '93154071', 'SUSAN NABWIRE', '0780215165', 'UWEZO FUND NAMBALE D', '', '', '', '', '3', '1', '', ''),
(2028, '23441', 'Frank Test', '0727273661', 'jjj', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE IF NOT EXISTS `tbl_customers` (
`customer_id` int(11) NOT NULL,
  `customer_names` varchar(100) NOT NULL,
  `customer_licence_no` varchar(20) NOT NULL,
  `customer_idno` varchar(20) NOT NULL,
  `customer_licence_status` varchar(10) NOT NULL,
  `customer_registrationdate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labrequests`
--

CREATE TABLE IF NOT EXISTS `tbl_labrequests` (
`labrequest_id` int(11) NOT NULL,
  `labrequest_opno` varchar(10) NOT NULL,
  `labrequest_visitno` varchar(10) NOT NULL,
  `labrequest_labservicecode` varchar(100) NOT NULL,
  `labservice_note` varchar(100) NOT NULL,
  `labrequest_componentsample` varchar(100) NOT NULL,
  `labrequest_results` varchar(500) NOT NULL,
  `labrequest_conclusion` varchar(300) NOT NULL,
  `labrequest_status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_labrequests`
--

INSERT INTO `tbl_labrequests` (`labrequest_id`, `labrequest_opno`, `labrequest_visitno`, `labrequest_labservicecode`, `labservice_note`, `labrequest_componentsample`, `labrequest_results`, `labrequest_conclusion`, `labrequest_status`) VALUES
(1, '1', '1', '001', 'make a blood count option', '0', 'tttttttttttttttt', 'ggggggggggg', ''),
(2, 'OP00002', '1', '001', 'cgh hjddrd aaaas', '0', 'tttttttttttttttt', 'ggggggggggg', ''),
(5, 'OP00002', '1', '002', 'consider x option', '0', 'tttttttttttttttt', 'ggggggggggg', ''),
(6, '1', '1', '002', 'sss', '', '', '', ''),
(7, '1', '1', '002', 'sss', '', '', '', ''),
(8, '1', '1', '002', 'sss', '', '', '', ''),
(9, '1', '1', '001', 'ggg', '', '', '', ''),
(10, '1', '1', '001', 'ggg', '', '', '', ''),
(11, '1', '1', '001', 'ggg', '', '', '', ''),
(12, 'OP00003', '1', '001', 'ggg', '', '', '', ''),
(13, 'OP00003', '1', '001', 'ggg', '', '', '', ''),
(14, 'OP00003', '1', '001', 'ggg', '', '', '', ''),
(15, 'OP00002', '2', '001', 'ggg', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labservices`
--

CREATE TABLE IF NOT EXISTS `tbl_labservices` (
`labservice_id` int(11) NOT NULL,
  `labservice_code` varchar(10) NOT NULL,
  `labservice_name` varchar(100) NOT NULL,
  `labservice_cost` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_labservices`
--

INSERT INTO `tbl_labservices` (`labservice_id`, `labservice_code`, `labservice_name`, `labservice_cost`) VALUES
(1, '001', 'BS for Malaria', '100'),
(2, '002', 'Blood Culture', '800');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locations`
--

CREATE TABLE IF NOT EXISTS `tbl_locations` (
`location_id` int(11) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `location_type` int(11) NOT NULL,
  `location_parent_id` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_locations`
--

INSERT INTO `tbl_locations` (`location_id`, `location_name`, `location_type`, `location_parent_id`) VALUES
(1, 'BUSIA', 1, '0'),
(3, 'NAMBALE', 2, '1'),
(4, 'MATAYOS', 2, '1'),
(5, 'TESO NORTH', 2, '1'),
(6, 'TESO SOUTH', 2, '1'),
(7, 'FUNYULA', 2, '1'),
(8, 'BUDALANGI', 2, '1'),
(9, 'BUTULA', 2, '1'),
(10, 'AMUKURA WEST', 3, '1'),
(11, 'AMUKURA EAST', 3, '1'),
(12, 'AMUKURA CENTRAL', 3, '1'),
(13, 'ANGOROM', 3, '1'),
(14, 'NAMBALE TOWNSHIP', 3, '1'),
(15, 'Malaba Central', 3, ''),
(16, 'Malaba North', 3, ''),
(17, 'Ang’urai South', 3, ''),
(18, 'Malaba South', 3, ''),
(19, 'Ang’urai North', 3, ''),
(20, 'Ang’urai East', 3, ''),
(21, 'Ang’orom', 3, ''),
(22, 'Chakol South', 3, ''),
(24, 'Chakol North', 3, ''),
(28, 'Bukhayo North/Waltsi', 3, ''),
(29, 'Bukhayo East', 3, ''),
(30, 'Bukhayo Central', 3, ''),
(31, 'Bukhayo West', 3, ''),
(32, 'Mayenje', 3, ''),
(33, 'Matayos South', 3, ''),
(34, 'Busibwabo', 3, ''),
(35, 'Burumba', 3, ''),
(36, 'Marachi West', 3, ''),
(37, 'Kingandole', 3, ''),
(38, 'Marachi Central', 3, ''),
(39, 'Marachi East', 3, ''),
(40, 'Marachi North', 3, ''),
(41, 'Elugulu', 3, ''),
(42, 'Nambuku Namboboto', 3, ''),
(43, 'Nangina', 3, ''),
(44, 'Bwiri', 3, ''),
(45, 'Ageng’a nanguba', 3, ''),
(46, 'Bunyala Central', 3, ''),
(47, 'Bunyala North', 3, ''),
(48, 'Bunyala West', 3, ''),
(49, 'Bunyala South', 3, ''),
(50, 'Madende Pri School', 6, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location_types`
--

CREATE TABLE IF NOT EXISTS `tbl_location_types` (
`location_type_id` int(11) NOT NULL,
  `location_type_code` varchar(50) NOT NULL,
  `location_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_location_types`
--

INSERT INTO `tbl_location_types` (`location_type_id`, `location_type_code`, `location_type_name`) VALUES
(1, '1', 'COUNTY'),
(2, '2', 'SUBCOUNTY'),
(3, '3', 'WARD'),
(4, '4', 'LOCATION'),
(5, '5', 'SUB-LOCATION'),
(6, '6', 'POLLING STATION'),
(7, '7', 'VILLAGE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_messages` (
`message_id` int(11) NOT NULL,
  `sender_no` varchar(15) NOT NULL,
  `message_text` varchar(300) NOT NULL,
  `receiver_no` varchar(12) NOT NULL,
  `message_status` int(11) NOT NULL,
  `message_date` varchar(30) NOT NULL,
  `read_status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`message_id`, `sender_no`, `message_text`, `receiver_no`, `message_status`, `message_date`, `read_status`) VALUES
(51, '+254729522550', 'okey', '', 1, '2017-01-09 10:42:24', '1'),
(52, '+254713521702', 'Hae', '', 1, '2017-01-09 10:57:31', '1'),
(54, '+254729522550', 'trying', '', 2, '2017-01-09 13:08:16', '1'),
(57, '+254729522550', 'uu', '', 2, '2021-01-06 10:55:44', '1'),
(60, '+254731707223', 'Noted', '', 1, '2021-07-12 11:54:17', '1'),
(64, 'Safaricom', 'This service is available to Postpaid customers only, send your query to 100. Thank you for staying connected to the better option.', '', 2, '2021-07-14 21:01:06', '1'),
(67, '+254768017555', 'Ujumbe umefika ndugu zangu, maendeleo na mheshimiwa sakwa katika Busia yetu', '', 2, '2021-07-14 21:22:01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_status`
--

CREATE TABLE IF NOT EXISTS `tbl_message_status` (
`status_id` int(11) NOT NULL,
  `status_name` varchar(10) NOT NULL,
  `status_no` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message_status`
--

INSERT INTO `tbl_message_status` (`status_id`, `status_name`, `status_no`) VALUES
(1, 'INBOX', 1),
(2, 'IMPORTANT', 2),
(3, 'DRAFTS', 3),
(4, 'TRASH', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nursingstationrequests`
--

CREATE TABLE IF NOT EXISTS `tbl_nursingstationrequests` (
`nursingstationrequest_id` int(11) NOT NULL,
  `nursingstationrequest_opno` varchar(10) NOT NULL,
  `nursingstationrequest_visitno` varchar(10) NOT NULL,
  `nursingstationrequest_servicecode` varchar(10) NOT NULL,
  `nursingstationrequest_note` varchar(100) NOT NULL,
  `nursingstationrequest_status` varchar(10) NOT NULL,
  `nursingstationrequest_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nursingstationrequests`
--

INSERT INTO `tbl_nursingstationrequests` (`nursingstationrequest_id`, `nursingstationrequest_opno`, `nursingstationrequest_visitno`, `nursingstationrequest_servicecode`, `nursingstationrequest_note`, `nursingstationrequest_status`, `nursingstationrequest_datetime`) VALUES
(4, '1', '1', '002', 'ggg', '', '2022-02-10 13:39:33'),
(5, '1', '1', '003', 'helllo', '', '2022-02-10 13:49:50'),
(6, '1', '1', '004', 'fffff', '', '2022-02-10 14:09:35'),
(7, '1', '1', '004', 'recommended normal', '', '2022-02-10 14:22:33'),
(8, '1', '1', '003', 'ssssas asfgsdff', '', '2022-02-10 14:29:10'),
(9, '1', '1', '005', 'gkgjb vjdfgjd', '', '2022-02-10 14:36:07'),
(10, '1', '1', '001', 'dws', '', '2022-02-10 14:39:25'),
(11, '1', '1', '002', 'tfgg', '', '2022-02-10 14:40:22'),
(12, '1', '1', '001', 'dddddd', '', '2022-02-10 14:42:14'),
(13, '1', '1', '002', 'gyktyuiuh oujkyj yr', '', '2022-02-10 21:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nursingstationservices`
--

CREATE TABLE IF NOT EXISTS `tbl_nursingstationservices` (
`nursingstation_id` int(11) NOT NULL,
  `nursingstation_code` varchar(20) NOT NULL,
  `nursingstation_name` varchar(100) NOT NULL,
  `nursingstation_cost` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nursingstationservices`
--

INSERT INTO `tbl_nursingstationservices` (`nursingstation_id`, `nursingstation_code`, `nursingstation_name`, `nursingstation_cost`) VALUES
(1, '001', 'Nursing Fee', '200'),
(2, '002', 'Stitching', '1500'),
(3, '003', 'Dressing', '1000'),
(4, '004', 'Pregnancy Delivery', '4500'),
(5, '005', 'Removal of foreign bodies', '1000'),
(6, '006', 'Family Planning UID', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE IF NOT EXISTS `tbl_payments` (
`pay_id` int(11) NOT NULL,
  `pay_amount` varchar(10) NOT NULL,
  `pay_licence_code` varchar(20) NOT NULL,
  `pay_mpesacode` varchar(20) NOT NULL,
  `pay_date_time` varchar(20) NOT NULL,
  `pay_frommobilenumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescriptions`
--

CREATE TABLE IF NOT EXISTS `tbl_prescriptions` (
`prescription_id` int(11) NOT NULL,
  `prescription_opno` varchar(20) NOT NULL,
  `prescription_visitno` varchar(20) NOT NULL,
  `prescription_productcode` varchar(20) NOT NULL,
  `prescription_quantity` varchar(20) NOT NULL,
  `prescription_dosagesummary` varchar(300) NOT NULL,
  `prescription_status` varchar(10) NOT NULL,
  `prescription_referred` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prescriptions`
--

INSERT INTO `tbl_prescriptions` (`prescription_id`, `prescription_opno`, `prescription_visitno`, `prescription_productcode`, `prescription_quantity`, `prescription_dosagesummary`, `prescription_status`, `prescription_referred`) VALUES
(1, '1', '1', '001', '2', 'Take 3 times a day. Avoid milk', '1', '0'),
(2, '1', '1', '002', '1', 'Rub twice', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_processpoints`
--

CREATE TABLE IF NOT EXISTS `tbl_processpoints` (
`process_id` int(11) NOT NULL,
  `process_code` varchar(20) NOT NULL,
  `process_name` varchar(50) NOT NULL,
  `process_status` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_processpoints`
--

INSERT INTO `tbl_processpoints` (`process_id`, `process_code`, `process_name`, `process_status`) VALUES
(1, 'REGISTRY', 'REGISTRY', '1'),
(2, 'TRIAGE', 'TRIAGE (Room 2)', '1'),
(3, 'CONSULTATION', 'CONSULTATION  (Room 3)', '1'),
(4, 'LABORATORY', 'LABORATORY  (Room 5)', '1'),
(5, 'PHARMACY', 'PHARMACY', '1'),
(6, 'TREATMENTROOM', 'TREATMENT ROOM', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE IF NOT EXISTS `tbl_products` (
`product_id` int(11) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `product_quantity` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_code`, `product_name`, `product_quantity`) VALUES
(1, '001', 'Paracetamol 500g', '10'),
(2, '002', 'Doxycycline 200g', '15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_queue`
--

CREATE TABLE IF NOT EXISTS `tbl_queue` (
`queue_id` int(20) NOT NULL,
  `queue_no` varchar(20) NOT NULL,
  `queue_opno` varchar(20) NOT NULL,
  `queue_visitno` varchar(20) NOT NULL,
  `queue_idno` varchar(20) NOT NULL,
  `queue_from` varchar(20) NOT NULL,
  `queue_to` varchar(20) NOT NULL,
  `queue_status` varchar(20) NOT NULL,
  `queue_note` varchar(100) NOT NULL,
  `queue_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registry`
--

CREATE TABLE IF NOT EXISTS `tbl_registry` (
`reg_no` int(11) NOT NULL,
  `visit_no` varchar(20) NOT NULL,
  `id_no` varchar(10) NOT NULL,
  `f_name` varchar(40) NOT NULL,
  `l_name` varchar(40) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `residence` varchar(100) NOT NULL,
  `opno` varchar(20) NOT NULL,
  `visit_date` varchar(20) NOT NULL,
  `visit_status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_registry`
--

INSERT INTO `tbl_registry` (`reg_no`, `visit_no`, `id_no`, `f_name`, `l_name`, `phone_no`, `gender`, `dob`, `residence`, `opno`, `visit_date`, `visit_status`) VALUES
(1, '1', '28196441', 'Isaack', 'Wekesa', '0729522550', 'Male', '1985-12-12', 'Siritanyi', '1', '26/01/2022', '1'),
(7, '2', '6728998', 'TREZZAH', 'NANGEKHE', '072263839', 'Female', '1993-01-01', 'MARELL', 'OP00002', '2022-10-02', ''),
(8, '1', '6728998', 'moses', 'NANGEKHE', '072263839', 'Female', '1993-01-01', 'MARELL', 'OP00003', '2022-10-02', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
`settings_id` int(11) NOT NULL,
  `slogan` varchar(100) NOT NULL,
  `l_status` varchar(10) NOT NULL,
  `system_name` varchar(30) NOT NULL,
  `campaigner_name` varchar(30) NOT NULL,
  `campaigner_short_name` varchar(30) NOT NULL,
  `campaign_location` varchar(30) NOT NULL,
  `seat` varchar(30) NOT NULL,
  `inst_date` varchar(15) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `photo_size` varchar(10) NOT NULL,
  `photo_type` varchar(20) NOT NULL,
  `custom_reply_msg` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`settings_id`, `slogan`, `l_status`, `system_name`, `campaigner_name`, `campaigner_short_name`, `campaign_location`, `seat`, `inst_date`, `photo`, `photo_size`, `photo_type`, `custom_reply_msg`) VALUES
(1, 'The best medical services', '', 'Mpeli Clinic Management System', 'HMS', 'Mpeli', 'Busia County', 'Gubernatorial ', '', '', '', '', 'Thank you for reaching us. We will reply you soon....Mpeli');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_triage`
--

CREATE TABLE IF NOT EXISTS `tbl_triage` (
`triage_id` int(11) NOT NULL,
  `triage_idno` varchar(20) NOT NULL,
  `triage_opno` varchar(20) NOT NULL,
  `triage_visitno` varchar(20) NOT NULL,
  `triage_vitalsignid` varchar(10) NOT NULL,
  `triage_remarks` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visits`
--

CREATE TABLE IF NOT EXISTS `tbl_visits` (
`visit_id` int(11) NOT NULL,
  `visit_opno` varchar(10) NOT NULL,
  `visit_no` varchar(10) NOT NULL,
  `visit_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_visits`
--

INSERT INTO `tbl_visits` (`visit_id`, `visit_opno`, `visit_no`, `visit_datetime`) VALUES
(1, '1', '1', '2022-02-10 08:10:32'),
(10, 'OP00002', '1', '2022-02-10 14:46:05'),
(11, 'OP00003', '1', '2022-02-10 14:46:05'),
(12, 'OP00003', '2', '2022-02-24 17:08:12'),
(13, 'OP00002', '2', '2022-02-24 17:08:12'),
(14, '1', '2', '2022-02-24 17:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vitals`
--

CREATE TABLE IF NOT EXISTS `tbl_vitals` (
`vital_id` int(11) NOT NULL,
  `vital_code` varchar(20) NOT NULL,
  `vital_name` varchar(30) NOT NULL,
  `vital_unit` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vitals`
--

INSERT INTO `tbl_vitals` (`vital_id`, `vital_code`, `vital_name`, `vital_unit`) VALUES
(1, '001', 'Height', 'Fts'),
(2, '002', 'Weight', 'Kgs'),
(3, '003', 'Pressure', 'mbs');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vitalsigns`
--

CREATE TABLE IF NOT EXISTS `tbl_vitalsigns` (
`vitalsign_id` int(11) NOT NULL,
  `vitalsign_opno` varchar(20) NOT NULL,
  `vitalsign_visitno` varchar(20) NOT NULL,
  `vitalsign_signcode` varchar(20) NOT NULL,
  `vitalsign_value` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vitalsigns`
--

INSERT INTO `tbl_vitalsigns` (`vitalsign_id`, `vitalsign_opno`, `vitalsign_visitno`, `vitalsign_signcode`, `vitalsign_value`) VALUES
(4, '1', '1', '003', '20'),
(5, '1', '1', '001', '7'),
(6, 'OP00002', '1', '001', '7'),
(7, 'OP00002', '1', '002', '50'),
(8, '1', '1', '002', '50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `s_name` varchar(30) NOT NULL,
  `id_no` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_l` varchar(10) NOT NULL,
  `profile_image` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `s_name`, `id_no`, `email`, `phone`, `password`, `user_l`, `profile_image`) VALUES
(2, 'Francis', 'Okwara', '30287733', 'frankgibs05@gmail.com', '0727459357', 'd0ab8806730c73a1c7c8410d515e96560aa9d8345013a549335a9232eeff7d6b', '', ''),
(3, 'Samuel', 'Wandera', '22897709', 'francookwaro@gmail.com', '0715885326', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '', ''),
(4, 'wex', 'weke', '28196441', 'wexweke@gmail.com', '28196441', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_table`
--
ALTER TABLE `log_table`
 ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `messagein`
--
ALTER TABLE `messagein`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `messagelog`
--
ALTER TABLE `messagelog`
 ADD PRIMARY KEY (`Id`), ADD KEY `IDX_MessageId` (`MessageId`,`SendTime`);

--
-- Indexes for table `messageout`
--
ALTER TABLE `messageout`
 ADD PRIMARY KEY (`Id`), ADD KEY `IDX_IsRead` (`IsRead`);

--
-- Indexes for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
 ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_category_assignment`
--
ALTER TABLE `tbl_category_assignment`
 ADD PRIMARY KEY (`cat_assignment_id`);

--
-- Indexes for table `tbl_consultations`
--
ALTER TABLE `tbl_consultations`
 ADD PRIMARY KEY (`consultation_id`);

--
-- Indexes for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
 ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
 ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_labrequests`
--
ALTER TABLE `tbl_labrequests`
 ADD PRIMARY KEY (`labrequest_id`);

--
-- Indexes for table `tbl_labservices`
--
ALTER TABLE `tbl_labservices`
 ADD PRIMARY KEY (`labservice_id`);

--
-- Indexes for table `tbl_locations`
--
ALTER TABLE `tbl_locations`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tbl_location_types`
--
ALTER TABLE `tbl_location_types`
 ADD PRIMARY KEY (`location_type_id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
 ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_message_status`
--
ALTER TABLE `tbl_message_status`
 ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_nursingstationrequests`
--
ALTER TABLE `tbl_nursingstationrequests`
 ADD PRIMARY KEY (`nursingstationrequest_id`);

--
-- Indexes for table `tbl_nursingstationservices`
--
ALTER TABLE `tbl_nursingstationservices`
 ADD PRIMARY KEY (`nursingstation_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
 ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `tbl_prescriptions`
--
ALTER TABLE `tbl_prescriptions`
 ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `tbl_processpoints`
--
ALTER TABLE `tbl_processpoints`
 ADD PRIMARY KEY (`process_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
 ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
 ADD PRIMARY KEY (`queue_id`);

--
-- Indexes for table `tbl_registry`
--
ALTER TABLE `tbl_registry`
 ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
 ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `tbl_triage`
--
ALTER TABLE `tbl_triage`
 ADD PRIMARY KEY (`triage_id`);

--
-- Indexes for table `tbl_visits`
--
ALTER TABLE `tbl_visits`
 ADD PRIMARY KEY (`visit_id`);

--
-- Indexes for table `tbl_vitals`
--
ALTER TABLE `tbl_vitals`
 ADD PRIMARY KEY (`vital_id`);

--
-- Indexes for table `tbl_vitalsigns`
--
ALTER TABLE `tbl_vitalsigns`
 ADD PRIMARY KEY (`vitalsign_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_table`
--
ALTER TABLE `log_table`
MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messagein`
--
ALTER TABLE `messagein`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `messagelog`
--
ALTER TABLE `messagelog`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=393;
--
-- AUTO_INCREMENT for table `messageout`
--
ALTER TABLE `messageout`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_category_assignment`
--
ALTER TABLE `tbl_category_assignment`
MODIFY `cat_assignment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_consultations`
--
ALTER TABLE `tbl_consultations`
MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2029;
--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_labrequests`
--
ALTER TABLE `tbl_labrequests`
MODIFY `labrequest_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_labservices`
--
ALTER TABLE `tbl_labservices`
MODIFY `labservice_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_locations`
--
ALTER TABLE `tbl_locations`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `tbl_location_types`
--
ALTER TABLE `tbl_location_types`
MODIFY `location_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `tbl_message_status`
--
ALTER TABLE `tbl_message_status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_nursingstationrequests`
--
ALTER TABLE `tbl_nursingstationrequests`
MODIFY `nursingstationrequest_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_nursingstationservices`
--
ALTER TABLE `tbl_nursingstationservices`
MODIFY `nursingstation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_prescriptions`
--
ALTER TABLE `tbl_prescriptions`
MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_processpoints`
--
ALTER TABLE `tbl_processpoints`
MODIFY `process_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
MODIFY `queue_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_registry`
--
ALTER TABLE `tbl_registry`
MODIFY `reg_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_triage`
--
ALTER TABLE `tbl_triage`
MODIFY `triage_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_visits`
--
ALTER TABLE `tbl_visits`
MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_vitals`
--
ALTER TABLE `tbl_vitals`
MODIFY `vital_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_vitalsigns`
--
ALTER TABLE `tbl_vitalsigns`
MODIFY `vitalsign_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
