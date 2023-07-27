-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2017 at 06:51 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_campaigner_db`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `split_str` (`X` VARCHAR(255), `delim` VARCHAR(12), `pos` INT) RETURNS VARCHAR(500) CHARSET latin1 RETURN replace(SUBSTRING(SUBSTRING_INDEX(
    x, delim, pos), CHAR_LENGTH(SUBSTRING_INDEX(x, delim, pos-1))+ 1),
               delim, '')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_table`
--

CREATE TABLE `log_table` (
  `log_id` int(11) NOT NULL,
  `user_id_no` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messagein`
--

CREATE TABLE `messagein` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(62, '2017-01-09 15:27:37', '2017-01-09 15:28:05', '+254729522550', '+254724594418', NULL, 'y', NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `messagein`
--
DELIMITER $$
CREATE TRIGGER `mgnin_trigger` AFTER INSERT ON `messagein` FOR EACH ROW BEGIN

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
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `messagelog`
--

CREATE TABLE `messagelog` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(35, '2017-01-09 15:28:10', NULL, 200, 'Success: Message accepted by GSM modem gateway.', '+254729522550', NULL, 'Your message was successfully received. Mheshimiwa will reply to you....Wex.', NULL, '8:+254729522550:15', '', '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messageout`
--

CREATE TABLE `messageout` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `cat_no` varchar(20) NOT NULL,
  `cat_description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `cat_no`, `cat_description`) VALUES
(1, 'Agents', '10', 'My agents');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_assignment`
--

CREATE TABLE `tbl_category_assignment` (
  `cat_assignment_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contacts`
--

CREATE TABLE `tbl_contacts` (
  `contact_id` int(11) NOT NULL,
  `id_no` varchar(10) NOT NULL,
  `names` varchar(50) NOT NULL,
  `phone_no` varchar(13) NOT NULL,
  `village` varchar(20) NOT NULL,
  `sublocation` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `ward` varchar(20) NOT NULL,
  `subcounty` varchar(20) NOT NULL,
  `county` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contacts`
--

INSERT INTO `tbl_contacts` (`contact_id`, `id_no`, `names`, `phone_no`, `village`, `sublocation`, `location`, `ward`, `subcounty`, `county`, `gender`, `address`) VALUES
(2, '29913736', 'Benson Sifuna', '0702847413', 'Sinoko', 'Lumboka', 'South Bukusu', 'South Bukusu', 'Bumula', 'Bungoma', 'Male', '87 BGM'),
(13, '', '', '+254729522550', '', '', '', '', '', '', '', ''),
(14, '2222222', 'Liz Anjela', '+254713521702', 'ttttt', 'hh', 'hh', 'v', 'v', 'kjb', 'Female', 'vhv');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `message_id` int(11) NOT NULL,
  `sender_no` varchar(15) NOT NULL,
  `message_text` varchar(300) NOT NULL,
  `receiver_no` varchar(12) NOT NULL,
  `message_status` int(11) NOT NULL,
  `message_date` varchar(30) NOT NULL,
  `read_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`message_id`, `sender_no`, `message_text`, `receiver_no`, `message_status`, `message_date`, `read_status`) VALUES
(46, '+254729522550', 'knjj', '', 4, '2017-01-09 08:12:23', '0'),
(47, '+254729522550', 'h', '', 4, '2017-01-09 08:13:17', '0'),
(48, '+254729522550', 't', '', 1, '2017-01-09 09:25:29', '0'),
(49, '+254729522550', 'we', '', 1, '2017-01-09 10:04:56', '1'),
(50, '+254729522550', 'koioikk', '', 2, '2017-01-09 10:05:48', '0'),
(51, '+254729522550', 'okey', '', 1, '2017-01-09 10:42:24', '1'),
(52, '+254713521702', 'Hae', '', 1, '2017-01-09 10:57:31', '0'),
(53, '+254716326634', 'Test', '', 2, '2017-01-09 13:03:08', '1'),
(54, '+254729522550', 'trying', '', 1, '2017-01-09 13:08:16', '0'),
(55, '+254729522550', 'y', '', 1, '2017-01-09 15:27:37', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_status`
--

CREATE TABLE `tbl_message_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(10) NOT NULL,
  `status_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`settings_id`, `slogan`, `l_status`, `system_name`, `campaigner_name`, `campaigner_short_name`, `campaign_location`, `seat`, `inst_date`, `photo`, `photo_size`, `photo_type`, `custom_reply_msg`) VALUES
(1, 'Pamoja Tunaweza', '', 'Smart Guy', 'Wambumuli Campaign Manager', 'Wex', 'Bumula', 'Member of Parliament', '', '', '', '', 'Your message was successfully received. ... will reply to you....Wex.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `s_name` varchar(30) NOT NULL,
  `id_no` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_l` varchar(10) NOT NULL,
  `profile_image` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `s_name`, `id_no`, `email`, `phone`, `password`, `user_l`, `profile_image`) VALUES
(1, 'Isaac', 'Wekesa', '', 'demo@admin.com', '0702847413', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', ''),
(2, 'Isaac', 'Wex', '28196441', 'wexweke@gmail.com', '0729522550', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '');

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
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IDX_MessageId` (`MessageId`,`SendTime`);

--
-- Indexes for table `messageout`
--
ALTER TABLE `messageout`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IDX_IsRead` (`IsRead`);

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
-- Indexes for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  ADD PRIMARY KEY (`contact_id`);

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
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`settings_id`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `messagelog`
--
ALTER TABLE `messagelog`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `messageout`
--
ALTER TABLE `messageout`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_category_assignment`
--
ALTER TABLE `tbl_category_assignment`
  MODIFY `cat_assignment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `tbl_message_status`
--
ALTER TABLE `tbl_message_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
