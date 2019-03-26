SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `f_tmp` (
  `id` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `log_ip` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `time` bigint(20) NOT NULL,
  `info` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `time` bigint(20) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `info` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mail` varchar(254) DEFAULT NULL,
  `vk` bigint(20) DEFAULT NULL,
  `passwd` varchar(255) NOT NULL,
  `avatar` varchar(32) DEFAULT NULL,
  `2fa` varchar(16) DEFAULT NULL,
  `access` int(1) NOT NULL DEFAULT 1,
  `user_values` varchar(1024) DEFAULT NULL,
  `register_date` bigint(20) DEFAULT NULL,
  `last_activity` bigint(20) DEFAULT NULL,
  `ads` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `xbt_config` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `xbt_files` (
  `fid` int(11) NOT NULL,
  `info_hash` binary(20) NOT NULL,
  `leechers` int(11) NOT NULL DEFAULT 0,
  `seeders` int(11) NOT NULL DEFAULT 0,
  `completed` int(11) NOT NULL DEFAULT 0,
  `flags` int(11) NOT NULL DEFAULT 0,
  `mtime` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `info` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `xbt_files_users` (
  `fid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `announced` int(11) NOT NULL,
  `completed` int(11) NOT NULL,
  `downloaded` bigint(20) UNSIGNED NOT NULL,
  `left` bigint(20) UNSIGNED NOT NULL,
  `uploaded` bigint(20) UNSIGNED NOT NULL,
  `mtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `xbt_users` (
  `uid` int(11) NOT NULL,
  `torrent_pass_version` int(11) NOT NULL DEFAULT 0,
  `downloaded` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `uploaded` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `xrelease` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `aname` varchar(255) NOT NULL,
  `year` int(11) NOT NULL DEFAULT 2018,
  `type` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `voice` varchar(255) NOT NULL,
  `translator` varchar(255) NOT NULL,
  `editing` varchar(255) NOT NULL,
  `decor` varchar(255) NOT NULL,
  `timing` varchar(255) NOT NULL,
  `announce` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 3,
  `search_status` varchar(16) NOT NULL,
  `moonplayer` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `season` varchar(255) DEFAULT NULL,
  `last` bigint(20) NOT NULL DEFAULT 0,
  `day` int(1) NOT NULL DEFAULT 1,
  `rating` int(11) NOT NULL DEFAULT 0,
  `code` varchar(1024) DEFAULT NULL,
  `block` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `youtube` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `vid` varchar(128) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `comment` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(32) NOT NULL,
  `time` bigint(20) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `upcoming_votes` (
  `urid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `upcoming_votes`
  ADD KEY `urid` (`urid`);

ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `rid` (`rid`);

ALTER TABLE `f_tmp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vid` (`vid`),
  ADD KEY `rid` (`rid`);

ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `log_ip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `hash` (`hash`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `vk` (`vk`);

ALTER TABLE `xbt_files`
  ADD PRIMARY KEY (`fid`),
  ADD UNIQUE KEY `info_hash` (`info_hash`),
  ADD KEY `rid` (`rid`),
  ADD KEY `flags` (`flags`);

ALTER TABLE `xbt_files_users`
  ADD UNIQUE KEY `fid` (`fid`,`uid`),
  ADD KEY `uid` (`uid`);

ALTER TABLE `xbt_users`
  ADD PRIMARY KEY (`uid`);

ALTER TABLE `xrelease`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `last` (`last`),
  ADD KEY `day` (`day`),
  ADD KEY `status` (`status`),
  ADD KEY `aname` (`aname`);
ALTER TABLE `xrelease` ADD FULLTEXT KEY `name` (`name`,`ename`,`search_status`);

ALTER TABLE `youtube`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vid` (`vid`),
  ADD KEY `type` (`type`),
  ADD KEY `time` (`time`);


ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `f_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `log_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `xbt_files`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `xbt_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `xrelease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `youtube`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
