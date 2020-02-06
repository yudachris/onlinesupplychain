-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03 Feb 2017 pada 04.04
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olscm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `avail_item`
--

CREATE TABLE `avail_item` (
  `username` varchar(30) NOT NULL,
  `good_id` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `availability` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `avail_item`
--

INSERT INTO `avail_item` (`username`, `good_id`, `price`, `availability`) VALUES
('admin', 'G1', 100, 'Available'),
('admin', 'G2', 4, 'Available'),
('admin', 'G3', 150, 'Available');

-- --------------------------------------------------------

--
-- Struktur dari tabel `backlogs`
--

CREATE TABLE `backlogs` (
  `game_name` varchar(30) NOT NULL,
  `player_id` varchar(30) NOT NULL,
  `turn_count` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cost`
--

CREATE TABLE `cost` (
  `game_name` varchar(30) NOT NULL,
  `inventory_cost` int(11) NOT NULL,
  `excess_cost` int(11) NOT NULL,
  `backlog_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `demand`
--

CREATE TABLE `demand` (
  `game_name` varchar(30) NOT NULL,
  `from` varchar(30) NOT NULL,
  `turn_count` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `game`
--

CREATE TABLE `game` (
  `game_name` varchar(100) NOT NULL,
  `current_turn` int(11) NOT NULL,
  `end_turn` int(11) NOT NULL,
  `login_permit` varchar(30) NOT NULL,
  `made_by` varchar(30) NOT NULL,
  `mode` varchar(30) NOT NULL,
  `difficulty` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `player`
--

CREATE TABLE `player` (
  `game_name` varchar(30) NOT NULL,
  `player_id` varchar(30) NOT NULL,
  `player_pass` varchar(100) NOT NULL,
  `player_team` varchar(1) NOT NULL,
  `player_role` varchar(20) NOT NULL,
  `inventory_cap` int(11) NOT NULL,
  `current_inventory` int(11) NOT NULL,
  `excess_inventory` int(11) NOT NULL,
  `current_backlog` int(11) NOT NULL,
  `accum_inv` int(11) NOT NULL,
  `accum_ex` int(11) NOT NULL,
  `accum_back` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `login` varchar(3) NOT NULL,
  `status` varchar(30) NOT NULL,
  `leadtime` int(11) NOT NULL,
  `spability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `preset_demand`
--

CREATE TABLE `preset_demand` (
  `game_name` varchar(30) NOT NULL,
  `turn_count` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `preset_demand_temp`
--

CREATE TABLE `preset_demand_temp` (
  `username` varchar(30) NOT NULL,
  `turn_count` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `saved_settings`
--

CREATE TABLE `saved_settings` (
  `setting_name` varchar(40) NOT NULL,
  `game_name` varchar(40) NOT NULL,
  `game_pass` varchar(40) NOT NULL,
  `game_turn` int(11) NOT NULL,
  `game_credit` int(11) NOT NULL,
  `game_lt` int(11) NOT NULL,
  `game_inv_cost` int(11) NOT NULL,
  `game_ex_inv_cost` int(11) NOT NULL,
  `game_back_cost` int(11) NOT NULL,
  `game_init_inv_cap` int(11) NOT NULL,
  `game_init_inv_lvl` int(11) NOT NULL,
  `game_intransit_lvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipping_delay`
--

CREATE TABLE `shipping_delay` (
  `game_name` varchar(30) NOT NULL,
  `player_id` varchar(50) NOT NULL,
  `delay_num` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shop`
--

CREATE TABLE `shop` (
  `good_id` varchar(50) NOT NULL,
  `good_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `shop`
--

INSERT INTO `shop` (`good_id`, `good_name`) VALUES
('G1', 'Leadtime Decrease'),
('G2', 'Inventory Expansion'),
('G3', 'Future Forecast');

-- --------------------------------------------------------

--
-- Struktur dari tabel `statistics`
--

CREATE TABLE `statistics` (
  `game_name` varchar(30) NOT NULL,
  `turn_count` int(11) NOT NULL,
  `player_id` varchar(50) NOT NULL,
  `player_team` varchar(1) NOT NULL,
  `current_backlog` int(11) NOT NULL,
  `current_backlog_cost` int(11) NOT NULL,
  `current_inventory` int(11) NOT NULL,
  `current_excess_inventory` int(11) NOT NULL,
  `current_inventory_cost` int(11) NOT NULL,
  `current_excess_inv_cost` int(11) NOT NULL,
  `current_supply` int(11) NOT NULL,
  `current_demand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supply`
--

CREATE TABLE `supply` (
  `game_name` varchar(30) NOT NULL,
  `from` varchar(30) NOT NULL,
  `turn_count` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `team`
--

CREATE TABLE `team` (
  `team_code` varchar(30) NOT NULL,
  `game_name` varchar(30) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `team_credit` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `setting` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `status`) VALUES
(2, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Administrator', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avail_item`
--
ALTER TABLE `avail_item`
  ADD KEY `game_name` (`username`),
  ADD KEY `good_id` (`good_id`),
  ADD KEY `good_id_2` (`good_id`);

--
-- Indexes for table `backlogs`
--
ALTER TABLE `backlogs`
  ADD KEY `game_name` (`game_name`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD KEY `game_name` (`game_name`);

--
-- Indexes for table `demand`
--
ALTER TABLE `demand`
  ADD KEY `game_name` (`game_name`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_name`),
  ADD UNIQUE KEY `made_by` (`made_by`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD KEY `player_team` (`player_team`),
  ADD KEY `game_id` (`game_name`);

--
-- Indexes for table `preset_demand`
--
ALTER TABLE `preset_demand`
  ADD KEY `game_name` (`game_name`);

--
-- Indexes for table `saved_settings`
--
ALTER TABLE `saved_settings`
  ADD PRIMARY KEY (`setting_name`);

--
-- Indexes for table `shipping_delay`
--
ALTER TABLE `shipping_delay`
  ADD KEY `player_id` (`player_id`),
  ADD KEY `player_id_2` (`player_id`),
  ADD KEY `game_name` (`game_name`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`good_id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD KEY `player_id` (`player_id`),
  ADD KEY `player_team` (`player_team`),
  ADD KEY `game_name` (`game_name`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD KEY `game_name` (`game_name`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD KEY `game_name` (`game_name`),
  ADD KEY `game_name_2` (`game_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `avail_item`
--
ALTER TABLE `avail_item`
  ADD CONSTRAINT `avail_item_ibfk_2` FOREIGN KEY (`good_id`) REFERENCES `shop` (`good_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avail_item_ibfk_3` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `backlogs`
--
ALTER TABLE `backlogs`
  ADD CONSTRAINT `backlogs_ibfk_1` FOREIGN KEY (`game_name`) REFERENCES `game` (`game_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cost`
--
ALTER TABLE `cost`
  ADD CONSTRAINT `cost_ibfk_1` FOREIGN KEY (`game_name`) REFERENCES `game` (`game_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `demand`
--
ALTER TABLE `demand`
  ADD CONSTRAINT `demand_ibfk_1` FOREIGN KEY (`game_name`) REFERENCES `game` (`game_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`game_name`) REFERENCES `game` (`game_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `preset_demand`
--
ALTER TABLE `preset_demand`
  ADD CONSTRAINT `preset_demand_ibfk_1` FOREIGN KEY (`game_name`) REFERENCES `game` (`game_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `shipping_delay`
--
ALTER TABLE `shipping_delay`
  ADD CONSTRAINT `shipping_delay_ibfk_1` FOREIGN KEY (`game_name`) REFERENCES `game` (`game_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`game_name`) REFERENCES `game` (`game_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supply`
--
ALTER TABLE `supply`
  ADD CONSTRAINT `supply_ibfk_1` FOREIGN KEY (`game_name`) REFERENCES `game` (`game_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`game_name`) REFERENCES `game` (`game_name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
