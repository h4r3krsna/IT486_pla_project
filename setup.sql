-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Table structure for table `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` int(11) NOT NULL,
  `studentid` text COLLATE utf8_unicode_ci NOT NULL,
  `firstname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `lastname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `email` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `phone` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `internshiptitle` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `company` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `hoursworked` decimal(11,1) NOT NULL,
  `supervisorname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `supervisortitle` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `supervisoremail` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `supervisorphone` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `descriptionofduties` text COLLATE utf8_unicode_ci NOT NULL,
  `reflection0` text COLLATE utf8_unicode_ci NOT NULL,
  `reflection1` text COLLATE utf8_unicode_ci NOT NULL,
  `reflection2` text COLLATE utf8_unicode_ci NOT NULL,
  `reflection3` text COLLATE utf8_unicode_ci NOT NULL,
  `reflection4` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
