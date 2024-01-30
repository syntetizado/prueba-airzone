-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 10, 2021 at 08:03 AM
-- Server version: 10.4.12-MariaDB-1:10.4.12+maria~bionic
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prueba_incorporacion`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `visible`) VALUES
(1, NULL, 'Laravel', 'laravel', 1),
(2, NULL, 'VueJs', 'vuejs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `blog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`id`, `category`, `blog`) VALUES
(1, 1, 1),
(2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user`, `datetime`, `content`) VALUES
(1, 2, '2021-06-04 08:07:22', 'Expetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.\r\n\r\nEst ei erat mucius quaeque. Ei his quas phaedrum, efficiantur mediocritatem ne sed, hinc oratio blandit ei sed. Blandit gloriatur eam et. Brute noluisse per et, verear disputando neglegentur at quo. Sea quem legere ei, unum soluta ne duo. Ludus complectitur quo te, ut vide autem homero pro.'),
(2, 3, '2021-06-04 08:18:12', 'Expetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.'),
(3, 2, '2021-06-04 08:18:12', 'His audiam deserunt in, eum ubique voluptatibus te. In reque dicta usu. Ne rebum dissentiet eam, vim omnis deseruisse id. Ullum deleniti vituperata at quo, insolens complectitur te eos, ea pri dico munere propriae. Vel ferri facilis ut, qui paulo ridens praesent ad. Possim alterum qui cu. Accusamus consulatu ius te, cu decore soleat appareat usu.');

-- --------------------------------------------------------

--
-- Table structure for table `comment_post`
--

CREATE TABLE `comment_post` (
  `id` int(11) NOT NULL,
  `comment` int(11) NOT NULL,
  `blog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_post`
--

INSERT INTO `comment_post` (`id`, `comment`, `blog`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `marks` mediumtext DEFAULT NULL,
  `picture` varchar(128) DEFAULT NULL,
  `short_content` text NOT NULL,
  `content` longtext DEFAULT NULL,
  `added` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `comment` tinyint(4) NOT NULL DEFAULT 0,
  `pending` tinyint(4) NOT NULL DEFAULT 0,
  `public` tinyint(4) NOT NULL DEFAULT 1,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user`, `title`, `slug`, `marks`, `picture`, `short_content`, `content`, `added`, `updated`, `comment`, `pending`, `public`, `active`) VALUES
(1, 1, 'Laravel Collections', 'laravel-collections', NULL, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fes.wikipedia.org%2Fwiki%2FGoogle_Im%25C3%25A1genes&psig=AOvVaw3mXB2Xhpk_v_SZT5', 'Vis id minim dicant sensibus. Pri aliquip conclusionemque ad, ad malis evertitur torquatos his. Has ei solum harum reprimique, id illum saperet tractatos his. Ei omnis soleat antiopam quo. Ad augue inani postulant mel, mel ea qualisque forensibus.', 'Expetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.\r\n\r\nHis audiam deserunt in, eum ubique voluptatibus te. In reque dicta usu. Ne rebum dissentiet eam, vim omnis deseruisse id. Ullum deleniti vituperata at quo, insolens complectitur te eos, ea pri dico munere propriae. Vel ferri facilis ut, qui paulo ridens praesent ad. Possim alterum qui cu. Accusamus consulatu ius te, cu decore soleat appareat usu.\r\n\r\nEst ei erat mucius quaeque. Ei his quas phaedrum, efficiantur mediocritatem ne sed, hinc oratio blandit ei sed. Blandit gloriatur eam et. Brute noluisse per et, verear disputando neglegentur at quo. Sea quem legere ei, unum soluta ne duo. Ludus complectitur quo te, ut vide autem homero pro.', '2021-06-04 10:02:26', '2021-06-10 07:18:10', 1, 0, 1, 1),
(3, 3, 'Laravel Requests', 'laravel-request', NULL, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fnergiza.com%2Fairzone-y-otros-sistemas-de-zonificacion-funcionan-bien%2F&psig=', 'Expetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.', 'Vis id minim dicant sensibus. Pri aliquip conclusionemque ad, ad malis evertitur torquatos his. Has ei solum harum reprimique, id illum saperet tractatos his. Ei omnis soleat antiopam quo. Ad augue inani postulant mel, mel ea qualisque forensibus.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.\r\n\r\nEst ei erat mucius quaeque. Ei his quas phaedrum, efficiantur mediocritatem ne sed, hinc oratio blandit ei sed. Blandit gloriatur eam et. Brute noluisse per et, verear disputando neglegentur at quo. Sea quem legere ei, unum soluta ne duo. Ludus complectitur quo te, ut vide autem homero pro.\r\n\r\nExpetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.\r\n\r\nHis audiam deserunt in, eum ubique voluptatibus te. In reque dicta usu. Ne rebum dissentiet eam, vim omnis deseruisse id. Ullum deleniti vituperata at quo, insolens complectitur te eos, ea pri dico munere propriae. Vel ferri facilis ut, qui paulo ridens praesent ad. Possim alterum qui cu. Accusamus consulatu ius te, cu decore soleat appareat usu.\r\n\r\nIn mel saperet expetendis. Vitae urbanitas sadipscing nec ut, at vim quis lorem labitur. Exerci electram has et, vidit solet tincidunt quo ad, moderatius contentiones nec no. Nam et puto abhorreant scripserit, et cum inimicus accusamus.\r\n\r\nMei eu mollis albucius, ex nisl contentiones vix. Duo persius volutpat at, cu iuvaret epicuri mei. Duo posse pertinacia no, ex dolor contentiones mea. Nec omnium utamur dignissim ne. Mundi lucilius salutandi an sea, ne sea aeque iudico comprehensam. Populo delicatissimi ad pri. Ex vitae accusam vivendum pro.\r\n\r\nLorem salutandi eu mea, eam in soleat iriure assentior. Tamquam lobortis id qui. Ea sanctus democritum mei, per eu alterum electram adversarium. Ea vix probo dicta iuvaret, posse epicurei suavitate eam an, nam et vidit menandri. Ut his accusata petentium.\r\n\r\nMeis vocent signiferumque pri et. Facilis corpora recusabo ne quo, eum ne eruditi blandit suscipiantur. Mazim sapientem sed id, sea debet commune iracundia in. Eius falli propriae te usu. In usu nonummy volumus expetenda, sint quando facilisis ei per, delectus constituto sea te.\r\n\r\nCu nam labores lobortis definiebas, ei aliquyam salutatus persequeris quo, cum eu nemore fierent dissentiunt. Per vero dolor id, vide democritum scribentur eu vim, pri erroribus temporibus ex. Euismod molestie offendit has no. Quo te semper invidunt quaestio, per vituperatoribus sadipscing ei, partem aliquyam sensibus in cum.', '2021-06-04 10:19:44', '2021-06-10 07:18:29', 1, 0, 1, 1),
(4, 3, 'Laravel Models', 'laravel-models', NULL, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fnergiza.com%2Fairzone-y-otros-sistemas-de-zonificacion-funcionan-bien%2F&psig=', 'Expetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.', 'Vis id minim dicant sensibus. Pri aliquip conclusionemque ad, ad malis evertitur torquatos his. Has ei solum harum reprimique, id illum saperet tractatos his. Ei omnis soleat antiopam quo. Ad augue inani postulant mel, mel ea qualisque forensibus.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.\r\n\r\nEst ei erat mucius quaeque. Ei his quas phaedrum, efficiantur mediocritatem ne sed, hinc oratio blandit ei sed. Blandit gloriatur eam et. Brute noluisse per et, verear disputando neglegentur at quo. Sea quem legere ei, unum soluta ne duo. Ludus complectitur quo te, ut vide autem homero pro.\r\n\r\nExpetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.\r\n\r\nHis audiam deserunt in, eum ubique voluptatibus te. In reque dicta usu. Ne rebum dissentiet eam, vim omnis deseruisse id. Ullum deleniti vituperata at quo, insolens complectitur te eos, ea pri dico munere propriae. Vel ferri facilis ut, qui paulo ridens praesent ad. Possim alterum qui cu. Accusamus consulatu ius te, cu decore soleat appareat usu.\r\n\r\nIn mel saperet expetendis. Vitae urbanitas sadipscing nec ut, at vim quis lorem labitur. Exerci electram has et, vidit solet tincidunt quo ad, moderatius contentiones nec no. Nam et puto abhorreant scripserit, et cum inimicus accusamus.\r\n\r\nMei eu mollis albucius, ex nisl contentiones vix. Duo persius volutpat at, cu iuvaret epicuri mei. Duo posse pertinacia no, ex dolor contentiones mea. Nec omnium utamur dignissim ne. Mundi lucilius salutandi an sea, ne sea aeque iudico comprehensam. Populo delicatissimi ad pri. Ex vitae accusam vivendum pro.\r\n\r\nLorem salutandi eu mea, eam in soleat iriure assentior. Tamquam lobortis id qui. Ea sanctus democritum mei, per eu alterum electram adversarium. Ea vix probo dicta iuvaret, posse epicurei suavitate eam an, nam et vidit menandri. Ut his accusata petentium.\r\n\r\nMeis vocent signiferumque pri et. Facilis corpora recusabo ne quo, eum ne eruditi blandit suscipiantur. Mazim sapientem sed id, sea debet commune iracundia in. Eius falli propriae te usu. In usu nonummy volumus expetenda, sint quando facilisis ei per, delectus constituto sea te.\r\n\r\nCu nam labores lobortis definiebas, ei aliquyam salutatus persequeris quo, cum eu nemore fierent dissentiunt. Per vero dolor id, vide democritum scribentur eu vim, pri erroribus temporibus ex. Euismod molestie offendit has no. Quo te semper invidunt quaestio, per vituperatoribus sadipscing ei, partem aliquyam sensibus in cum.', '2021-06-04 10:19:44', '2021-06-10 07:18:29', 1, 0, 1, 1),
(5, 3, 'VueJs components', 'vuejs-components', NULL, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fnergiza.com%2Fairzone-y-otros-sistemas-de-zonificacion-funcionan-bien%2F&psig=', 'Expetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.', 'Vis id minim dicant sensibus. Pri aliquip conclusionemque ad, ad malis evertitur torquatos his. Has ei solum harum reprimique, id illum saperet tractatos his. Ei omnis soleat antiopam quo. Ad augue inani postulant mel, mel ea qualisque forensibus.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.\r\n\r\nEst ei erat mucius quaeque. Ei his quas phaedrum, efficiantur mediocritatem ne sed, hinc oratio blandit ei sed. Blandit gloriatur eam et. Brute noluisse per et, verear disputando neglegentur at quo. Sea quem legere ei, unum soluta ne duo. Ludus complectitur quo te, ut vide autem homero pro.\r\n\r\nExpetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.\r\n\r\nHis audiam deserunt in, eum ubique voluptatibus te. In reque dicta usu. Ne rebum dissentiet eam, vim omnis deseruisse id. Ullum deleniti vituperata at quo, insolens complectitur te eos, ea pri dico munere propriae. Vel ferri facilis ut, qui paulo ridens praesent ad. Possim alterum qui cu. Accusamus consulatu ius te, cu decore soleat appareat usu.\r\n\r\nIn mel saperet expetendis. Vitae urbanitas sadipscing nec ut, at vim quis lorem labitur. Exerci electram has et, vidit solet tincidunt quo ad, moderatius contentiones nec no. Nam et puto abhorreant scripserit, et cum inimicus accusamus.\r\n\r\nMei eu mollis albucius, ex nisl contentiones vix. Duo persius volutpat at, cu iuvaret epicuri mei. Duo posse pertinacia no, ex dolor contentiones mea. Nec omnium utamur dignissim ne. Mundi lucilius salutandi an sea, ne sea aeque iudico comprehensam. Populo delicatissimi ad pri. Ex vitae accusam vivendum pro.\r\n\r\nLorem salutandi eu mea, eam in soleat iriure assentior. Tamquam lobortis id qui. Ea sanctus democritum mei, per eu alterum electram adversarium. Ea vix probo dicta iuvaret, posse epicurei suavitate eam an, nam et vidit menandri. Ut his accusata petentium.\r\n\r\nMeis vocent signiferumque pri et. Facilis corpora recusabo ne quo, eum ne eruditi blandit suscipiantur. Mazim sapientem sed id, sea debet commune iracundia in. Eius falli propriae te usu. In usu nonummy volumus expetenda, sint quando facilisis ei per, delectus constituto sea te.\r\n\r\nCu nam labores lobortis definiebas, ei aliquyam salutatus persequeris quo, cum eu nemore fierent dissentiunt. Per vero dolor id, vide democritum scribentur eu vim, pri erroribus temporibus ex. Euismod molestie offendit has no. Quo te semper invidunt quaestio, per vituperatoribus sadipscing ei, partem aliquyam sensibus in cum.', '2021-06-04 10:19:44', '2021-06-10 07:18:29', 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `full_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `full_name`) VALUES
(1, 'usuario_1', 'Usuario 1'),
(2, 'usuario_2', 'Usuario 2'),
(3, 'usuario_3', 'Usuario 3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `category_category_parent_idx` (`parent_id`);

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
  ADD PRIMARY KEY (`id`,`category`,`blog`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `category_blog_category_idx` (`category`) USING BTREE,
  ADD KEY `category_blog_blog_idx` (`blog`) USING BTREE;

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`,`user`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `comment_user_idx` (`user`);

--
-- Indexes for table `comment_post`
--
ALTER TABLE `comment_post`
  ADD PRIMARY KEY (`id`,`comment`,`blog`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `comment_blog_comment_idx` (`comment`) USING BTREE,
  ADD KEY `comment_blog_blog_idx` (`blog`) USING BTREE;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`,`user`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `blog_user_idx` (`user`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_post`
--
ALTER TABLE `category_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment_post`
--
ALTER TABLE `comment_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `category_category_parent` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category_post`
--
ALTER TABLE `category_post`
  ADD CONSTRAINT `category_post_category` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `category_post_post` FOREIGN KEY (`blog`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comment_post`
--
ALTER TABLE `comment_post`
  ADD CONSTRAINT `comment_post_comment` FOREIGN KEY (`comment`) REFERENCES `comments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comment_post_post` FOREIGN KEY (`blog`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
