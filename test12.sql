--
-- `country` table structure
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- `user` table structure
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(30) NOT NULL,
  `real_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `bdate` date NOT NULL,
  `country_id` int(11) NOT NULL,
  `agreed` smallint(6) NOT NULL DEFAULT '0',
  `registered` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- table indexes
--

ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_email` (`email`),
  ADD UNIQUE KEY `uniq_login` (`login`),
  ADD KEY `country_id` (`country_id`);


ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);
COMMIT;


--
-- `country` table data dump
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Ukraine'),
(2, 'Moldova'),
(3, 'Georgia'),
(4, 'Azerbaijan'),
(5, 'USA'),
(6, 'Belarus'),
(7, 'Bulgaria'),
(8, 'China'),
(9, 'Saudi Arabia'),
(10, 'Germany'),
(11, 'Italy'),
(12, 'Poland'),
(13, 'Great Britain');
