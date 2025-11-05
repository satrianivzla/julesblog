-- Artists Schema for CodeIgniter Music Blog

--
-- Table structure for table `artists`
--
CREATE TABLE `artists` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `bio_en` text,
  `bio_es` text,
  `image` varchar(255) DEFAULT NULL,
  `social_media_links` text,
  `official_website` varchar(255) DEFAULT NULL,
  `online_store` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Alter table `posts` to add `artist_id`
--
ALTER TABLE `posts`
  ADD `artist_id` int(11) unsigned DEFAULT NULL AFTER `author_id`,
  ADD KEY `artist_id` (`artist_id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE SET NULL;
