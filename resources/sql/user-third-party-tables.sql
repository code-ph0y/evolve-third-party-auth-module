-- --------------------------------------------------------
--
-- Table structure for table `user_third_party`
--

CREATE TABLE `user_third_party` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `user_id` int(16) NOT NULL,
  `api_key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
