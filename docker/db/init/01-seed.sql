-- Anonymized demo seed for O'Culture (derived from the 2018 training dump).
-- Personal accounts, XSS payloads and production emails were removed.
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE TABLE `app_user` (
  `id` int(11) NOT NULL,
  `username` varchar(89) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(89) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(89) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(89) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(144) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(89) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(144) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(144) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(89) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `app_user`
--

INSERT INTO `app_user` (`id`, `username`, `email`, `password`, `name`, `description`, `image`, `city`, `facebook`, `twitter`, `website`, `is_active`, `status`, `created_at`, `role_id`, `zipcode`) VALUES
(86, 'admin', 'admin@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Admin Test', NULL, NULL, 'Paris', NULL, NULL, NULL, 1, 1, '2018-08-09 19:02:00', 26, 0),
(87, 'moderator', 'moderator@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Moderator Test', NULL, NULL, 'Paris', NULL, NULL, NULL, 1, 1, '2018-08-09 19:02:00', 27, 0),
(88, 'user', 'user@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'User Test', NULL, NULL, 'Paris', NULL, NULL, NULL, 1, 1, '2018-08-09 19:02:00', 28, 0),
(89, 'artist', 'artist@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Artist Test', 'Description test', NULL, 'Paris', 'www.facebook.com/artist/', 'www.twitter.com/milk-shop/', 'www.artist.com', 1, 1, '2018-08-09 19:02:00', 29, 0),
(90, 'organizer', 'organizer@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Organizer Test', 'Description test', NULL, 'Paris', 'www.facebook.com/organizer/', 'www.twitter.com/organizer/', 'www.organizer.com', 1, 1, '2018-08-09 19:02:00', 30, 0),
(91, 'FlyingEars', 'flyingears@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'The Flying Ears', 'Reprehenderit velit aut et ut praesentium ut amet qui ut voluptas veniam earum sequi occaecati voluptatem ea suscipit temporibus et nihil et ut non voluptatibus maxime nihil suscipit ratione sapiente sed possimus totam adipisci illum vel soluta aperiam quis sint unde voluptas eum consectetur unde placeat nihil quasi dolor quo non fuga quae nobis et itaque temporibus quibusdam sequi fugiat et aperiam ad.', NULL, 'Strasbourg', 'www.facebook.com/flyingears/', NULL, 'maury.fr', 1, 1, '2018-08-09 19:02:00', 29, 0),
(92, 'Bakers', 'bakers@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'The Bakers', 'Ut quia iste mollitia possimus quia non quisquam dolore quia nulla asperiores inventore iure molestias ut aspernatur nihil perspiciatis dolores molestiae deleniti ullam nam consequatur voluptatem nisi enim est vero at ratione ratione ut fugiat adipisci voluptatem vero nostrum aut aut pariatur commodi dolorem et dolore ut alias quisquam voluptas quasi cupiditate eos commodi nulla aut.', NULL, 'Paris', 'www.facebook.com/bakers/', NULL, 'charrier.com', 1, 1, '2018-08-09 19:02:00', 29, 0),
(94, 'The Fordmums & Sisters', 'fordmums@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'The Fordmums & Sisters', 'Ipsa molestiae quia iste est consequatur et cum vel eligendi qui et voluptates sunt ut porro qui atque quasi dicta ut harum molestiae ut accusamus beatae voluptatem dolorem rerum placeat quo distinctio repellendus a provident libero voluptatem cumque et eum quia porro eveniet occaecati ex necessitatibus et eveniet cumque fuga consequatur assumenda laudantium consequatur delectus quibusdam ipsam iste et suscipit et fugiat voluptas et minima autem.', NULL, 'Marseille', NULL, NULL, 'gautier.fr', 1, 1, '2018-08-09 19:02:00', 29, 0),
(95, 'Queens of Lions', 'queens@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Queens of Lions', 'Id est quia dolore et itaque voluptas dolorem porro expedita minus sit reprehenderit maxime rem laudantium eum sit repellendus reiciendis eos deleniti velit et expedita sit doloremque quia ut eligendi eos veritatis quis dolorem libero aperiam officiis voluptas aliquid eligendi quam ut assumenda asperiores expedita numquam dignissimos non quia est eligendi distinctio eaque aut cupiditate blanditiis.', NULL, 'Paris', NULL, NULL, 'lucas.com', 1, 1, '2018-08-09 19:02:00', 29, 0),
(96, 'The Richards', 'richards@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'The Richards', 'Voluptatum ullam quia suscipit necessitatibus delectus dignissimos ratione ut alias beatae maiores quod neque cum hic enim suscipit dolores et natus repellat consequatur et debitis beatae nostrum et sed unde unde excepturi quas consequatur facilis eveniet dolorem a et nesciunt in sint necessitatibus nisi accusantium ab minima sunt corrupti est quasi beatae quasi ea deleniti unde quidem sequi voluptatem repudiandae nemo illo nisi alias esse.', NULL, 'Paris', 'www.facebook.com/richards/', NULL, 'barbier.net', 1, 1, '2018-08-09 19:02:00', 29, 0),
(98, 'MJC des Quais', 'mjcquais@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'MJC des Quais', 'Aut pariatur optio eius molestiae quia dignissimos et ut molestiae minus laborum deleniti dignissimos reiciendis quibusdam doloremque et eligendi quam officiis omnis rem veniam laudantium iure magnam et repellendus placeat qui ut veniam quisquam harum illo fugit qui in quidem praesentium neque quaerat est ratione odit nemo iste.', NULL, 'Toulouse', NULL, NULL, 'brunel.com', 1, 1, '2018-08-09 19:02:00', 30, 0),
(99, 'Danse Compagnie', 'dansecompagnie@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'MJC des Quais', 'Dolore numquam enim pariatur vitae repudiandae eaque quo dolorem quaerat perferendis magnam alias aut fugit dolor pariatur ipsum molestiae perferendis non voluptas aut qui eos harum et voluptas eos totam sed doloremque ullam autem dolorum quaerat placeat eum aspernatur facere aliquam pariatur temporibus minus voluptas recusandae est nostrum itaque architecto velit saepe atque rerum suscipit in earum aut voluptatem alias dolor.', NULL, 'Marseille', NULL, NULL, 'albert.com', 1, 1, '2018-08-08 19:02:00', 30, 0),
(100, 'Troupe des solistes', 'solistes@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Troupe des solistes', 'Voluptatibus ea veritatis nemo laudantium consequuntur neque et delectus possimus voluptatem voluptatem expedita est incidunt ut et qui porro consequatur totam est numquam perspiciatis soluta eum qui sunt id recusandae deleniti corporis dolor sunt veniam.', NULL, 'Paris', NULL, NULL, 'besson.fr', 1, 1, '2018-08-08 19:02:00', 29, 0),
(101, 'Collectif des danseurs', 'collectif@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Collectif des danseurs', 'Incidunt veritatis sit velit voluptas sint non sunt fugit nostrum culpa velit suscipit quia autem alias perspiciatis dolores in aut ratione ab neque non architecto quasi saepe similique voluptates minus at ut odit maiores aut mollitia harum expedita.', NULL, 'Lyon', NULL, NULL, 'bruneau.com', 1, 1, '2018-08-07 19:02:00', 29, 0),
(102, 'Si et Compagnie', 'sietcompagnie@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Si et Compagnie', 'Aut atque similique voluptas est tempora ipsam doloribus dolor rerum eaque animi suscipit neque nobis molestias consectetur et accusamus hic quis maxime eum vel inventore quisquam voluptatibus eius dolore voluptate error sit sunt ut voluptatibus ut est rerum odio et quis quaerat at ipsum voluptatum sequi explicabo similique vel rerum ut impedit quibusdam quia mollitia voluptatem consequatur nisi ipsum odit sed odio animi nihil tenetur quibusdam dolores quaerat quia ipsam.', NULL, 'Lyon', NULL, NULL, 'rodriguez.org', 1, 1, '2018-08-09 19:02:00', 30, 0),
(104, 'test', 'testuser@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'dsdsds', '', NULL, 'MONS', '', '', '', 1, 2, '2018-11-15 12:56:33', 29, 30340),
(105, 'Artiste92', 'artiste92@example.com', '$2y$13$FuDMWRMXFAluevitEoxXhuFEea7ogiwE4oTYHJHONIkXaaIyNHZdO', 'Artiste', '', NULL, 'LYON', '', '', '', 1, 2, '2018-11-29 09:40:08', 29, 69001);

-- --------------------------------------------------------

--
-- Structure de la table `app_user_artist_type`
--

CREATE TABLE `app_user_artist_type` (
  `app_user_id` int(11) NOT NULL,
  `artist_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `app_user_artist_type`
--

INSERT INTO `app_user_artist_type` (`app_user_id`, `artist_type_id`) VALUES
(90, 24),
(91, 21),
(94, 23),
(95, 24),
(96, 23),
(100, 21),
(101, 21);

-- --------------------------------------------------------

--
-- Structure de la table `artist_type`
--

CREATE TABLE `artist_type` (
  `id` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `artist_type`
--

INSERT INTO `artist_type` (`id`, `name`, `is_active`, `created_at`) VALUES
(21, 'Troupe de théâtre', 1, '2018-08-09 19:21:54'),
(22, 'Photographe', 1, '2018-08-09 10:01:09'),
(23, 'Troupe de danse', 1, '2018-08-09 09:14:35'),
(24, 'Groupe', 1, '2018-08-09 10:53:25');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `nb_likes` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL,
  `app_user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nb_alert` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `created_at`, `is_active`, `nb_likes`, `event_id`, `place_id`, `app_user_id`, `status`, `nb_alert`) VALUES
(1, 'Quidem ut quidem voluptatem illo delectus et voluptates voluptatem tempore excepturi et iure quia temporibus reprehenderit id consequatur aut.', '2018-08-09 09:02:00', 1, 4, 81, NULL, 91, 1, NULL),
(3, 'Voluptas aliquid dolorem incidunt veniam et qui dolorum eos sit ullam dolores facere sequi.', '2018-08-09 09:02:00', 1, 8, NULL, 3, 94, 1, NULL),
(5, 'Qui ut quia officiis maiores quia nostrum quia id excepturi in voluptatum harum ipsam.', '2018-08-09 09:02:00', 1, 0, 72, NULL, 91, 1, NULL),
(8, 'Voluptatibus est saepe ab a inventore sed sint quia qui vitae.', '2018-08-09 09:02:00', 1, 2, 76, NULL, 101, 1, NULL),
(10, 'Est dignissimos et ut vitae culpa aut praesentium quis nisi velit veniam impedit cumque aut dolores.', '2018-08-09 09:02:00', 1, 4, NULL, 2, 102, 1, NULL),
(11, 'Architecto magnam enim eveniet quisquam at sunt et adipisci sit officia ad itaque enim quos nulla tempore repellendus labore cumque mollitia.', '2018-08-09 09:02:00', 1, 6, 87, NULL, 91, 1, NULL),
(15, 'Sed consequatur voluptas dolor odio beatae repellendus culpa eum nemo sapiente quam adipisci nesciunt dolorem non ratione modi reiciendis reiciendis.', '2018-08-09 09:02:00', 1, 6, 88, NULL, 98, 1, NULL),
(17, 'Vel asperiores facilis non sit sunt perspiciatis perspiciatis et omnis pariatur fugit commodi dicta.', '2018-08-09 09:02:00', 1, 7, 66, NULL, 98, 1, NULL),
(18, 'Qui reiciendis quos eveniet voluptate quod quo corrupti inventore nesciunt doloribus in est sint adipisci.', '2018-08-09 09:02:00', 1, 6, 77, NULL, 91, 1, NULL),
(19, 'Ex et qui esse id et reprehenderit necessitatibus pariatur optio sequi iusto doloribus ut ea aut ducimus consequatur officia quis quia.', '2018-08-09 09:02:00', 1, 7, NULL, 4, 95, 1, NULL),
(21, 'Qui officiis id culpa voluptate molestiae natus aut omnis dolores sed repudiandae autem vitae quod qui eos.', '2018-08-09 09:02:00', 1, 5, 71, NULL, 95, 1, NULL),
(22, 'Aliquam nam quisquam illum minima repudiandae voluptas perspiciatis eius rem quia ut ipsam voluptas molestiae quia rerum consequatur sed velit consequatur.', '2018-08-09 09:02:00', 1, 4, 68, NULL, 91, 1, NULL),
(23, 'Aut quia ipsam adipisci omnis eum quos et deleniti quod hic eius quod aliquam quis rem natus sed quia.', '2018-08-09 09:02:00', 1, 4, NULL, 4, 98, 1, NULL),
(24, 'Rerum vel corrupti ratione aut tempore ut officia cumque et ut voluptatem corporis.', '2018-08-09 09:02:00', 1, 0, 85, NULL, 92, 1, NULL),
(27, 'Dolorum aut et placeat aspernatur iusto est qui illum nobis maiores ea recusandae quas non et quia perspiciatis expedita cumque molestias.', '2018-08-09 09:02:00', 1, 8, NULL, 2, 98, 1, NULL),
(28, 'Nobis molestiae officiis corrupti aspernatur sapiente et est sapiente et quis dolores aliquam quibusdam sed vero et voluptatem.', '2018-08-09 09:02:00', 1, 0, 72, NULL, 91, 1, NULL),
(29, 'Asperiores harum distinctio in aut aut cum sit ducimus aliquam laudantium molestiae labore et dicta officia consequatur porro nihil.', '2018-08-09 09:02:00', 1, 6, 87, NULL, 94, 1, NULL),
(33, 'hey', '2018-11-17 12:54:48', 1, NULL, 71, NULL, 104, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planned_date` datetime NOT NULL,
  `nb_spectator` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(144) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `app_user_creator_id` int(11) NOT NULL,
  `event_place_id` int(11) DEFAULT NULL,
  `event_type_id` int(11) DEFAULT NULL,
  `nb_alert` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `name`, `planned_date`, `nb_spectator`, `price`, `description`, `image`, `status`, `created_at`, `is_active`, `app_user_creator_id`, `event_place_id`, `event_type_id`, `nb_alert`) VALUES
(63, 'Spectacle de danse classique', '2018-12-12 08:00:00', 423, 39, 'Consequatur totam inventore aut velit sed aut tempora consequatur illum numquam est sed iure minima sit nesciunt nulla tempore id aliquid consequatur et corrupti nemo cupiditate tenetur sit qui magni et sint quo delectus enim maiores in aut ratione et aliquid ex sint officiis ipsum.', '/events/etienne-boulanger-305086-unsplash.jpg', 1, '2018-08-08 16:24:04', 1, 90, 1, 14, NULL),
(66, 'Spectacle de danse moderne', '2018-10-22 19:00:00', 309, 19, 'Dolor maiores quia architecto odio enim occaecati quia quia beatae illo voluptate quia quas iusto ducimus enim dolore et rerum vel veritatis necessitatibus voluptas saepe voluptates quia ea excepturi quas alias magnam ducimus quia facere aut qui labore molestias culpa beatae eum et rerum dolor porro libero autem error eos et laudantium quam soluta quos enim et tenetur in asperiores.', '/events/sergei-gavrilov-528341-unsplash.jpg', 1, '2018-08-09 13:02:54', 1, 94, 4, 15, NULL),
(67, 'Extraits de Molière', '2018-09-04 15:00:00', 119, 24, 'Modi et magni ut mollitia quia quia ipsum doloremque recusandae vel sit porro non praesentium suscipit itaque eligendi reiciendis nostrum fuga est aut aperiam at est tempore vel qui aut vel molestiae illum perferendis voluptatibus blanditiis voluptas in voluptatem est quas vel.', '/events/israel-palacio-459693-unsplash.jpg', 1, '2018-08-09 13:27:48', 1, 94, 4, 15, NULL),
(68, 'Peinture en direct', '2018-12-31 06:00:00', 429, 32, 'Quas ab ipsum et sint minus voluptatum debitis animi aut fugit natus nam eligendi in aspernatur quasi et ea velit voluptatibus consequuntur molestiae ipsum nihil omnis in recusandae exercitationem molestias harum ipsam asperiores dolorem aut ut sit similique voluptatem corrupti beatae aut sit laborum praesentium cum ea nobis.', '/events/painter-1246619_1920.jpg', 1, '2018-08-09 16:57:06', 1, 99, 2, 15, NULL),
(69, 'Exposition de photographie', '2018-09-23 08:00:00', 363, 17, 'Deleniti dolorem nostrum exercitationem commodi dolorum commodi aut distinctio soluta facere non ullam ullam error autem non eum unde reiciendis quis odio nostrum similique et cupiditate officiis ea rem ut ratione quaerat rerum odit quibusdam saepe numquam excepturi porro est rerum repellat.', '/events/gallery-561482_1920.jpg', 1, '2018-07-12 21:00:00', 1, 90, 1, 15, NULL),
(70, 'Représentation des jeunes de l\'Association Tous en scène', '2018-12-18 06:00:00', 281, 2, 'Aperiam incidunt molestiae placeat pariatur eum sapiente alias fuga quis tenetur possimus quam odit ut voluptatum natus pariatur eaque debitis modi omnis sunt ducimus et quaerat rerum hic esse quidem quaerat a sed cupiditate in in nobis aliquam accusamus dolor tenetur dicta provident libero molestias quasi non sit quidem sit fuga sint error voluptatem eligendi quia accusamus vero est sed molestiae harum molestiae et.', '/events/michael-afonso-421924-unsplash.jpg', 1, '2018-08-09 11:19:34', 1, 99, 2, 15, NULL),
(71, 'Scènes musicales parisiennes', '2018-12-22 05:00:00', 284, 25, 'Cumque recusandae est quasi magni voluptates sint totam nulla aut amet omnis et quaerat quia aut dignissimos sunt rerum dolor ratione similique et qui quaerat natus rerum nesciunt qui iure fuga magnam in fugit commodi tenetur odit eum.', '/events/samuel-fyfe-233543-unsplash.jpg', 1, '2018-08-09 10:55:56', 1, 90, 4, 14, NULL),
(72, 'Scènes musicales 2', '2018-09-25 22:00:00', 313, 14, 'Facere ut eaque consectetur possimus dicta dolorem nobis officia sed est enim commodi voluptatem eos voluptatem eos dolor qui quia ducimus eos quibusdam doloremque perferendis suscipit recusandae sit dolor enim ab dignissimos eos ab recusandae ut laudantium praesentium sunt harum qui voluptatum culpa cumque ipsam assumenda.', '/events/david-menidrey-389997-unsplash.jpg', 1, '2018-08-09 10:16:39', 1, 91, 1, 13, NULL),
(74, 'Exposition de sculpture', '2018-10-14 09:00:00', 404, 34, 'Ea non quisquam architecto atque nesciunt in quisquam ut corporis ducimus quo praesentium quis libero quasi asperiores laudantium molestiae vero qui numquam pariatur aliquam qui laboriosam non nesciunt omnis eius dolorem repellendus dolores ullam ea possimus.', '/events/gallery-561482_1920.jpg', 1, '2018-08-09 11:39:48', 1, 90, 4, 15, NULL),
(75, 'Exposition : la région en bande-dessinée', '2018-08-31 07:00:00', 308, 1, 'Omnis sed voluptatem quo tempore consequatur sit in corporis sit consequatur ea odio molestiae autem aperiam quisquam est rerum voluptatibus aliquid nesciunt nam voluptatem consequuntur et minima sed deleniti molestias quibusdam mollitia voluptate expedita nulla culpa expedita quia placeat mollitia est veniam cupiditate voluptate dignissimos id quas aspernatur ut exercitationem dolorem ea iusto quo non culpa autem non explicabo enim sed deleniti aliquam incidunt at distinctio.', '/events/gallery-561482_1920.jpg', 1, '2018-08-09 14:47:15', 1, 99, 2, 15, NULL),
(76, 'Les quais du Rhône en photos', '2018-09-05 21:00:00', 286, 34, 'Amet exercitationem commodi porro neque asperiores illo est molestias placeat fugit id autem doloremque ullam sunt rerum repellendus laborum quasi temporibus mollitia consectetur praesentium placeat autem est blanditiis est ratione quisquam porro explicabo est molestiae et id ut incidunt et.', '/events/gallery-561482_1920.jpg', 1, '2018-08-09 16:32:07', 1, 91, 2, 14, NULL),
(77, 'Concert de metal', '2018-08-31 20:00:00', 295, 18, 'Nostrum corrupti vero incidunt ut voluptates ipsam corporis molestiae velit ut ratione dolor ab earum vero voluptas saepe quis nisi dignissimos veniam doloremque et et non minus eveniet pariatur deleniti qui reiciendis temporibus voluptates illo.', '/events/austin-neill-247237-unsplash.jpg', 1, '2018-08-09 13:24:27', 1, 98, 3, 13, NULL),
(78, 'Théâtre : Mise en scène', '2018-09-08 07:00:00', 468, 19, 'Incidunt aut magnam fugiat molestiae et voluptates voluptatibus aut et dolores doloribus modi in ducimus excepturi tempora enim repellat neque vel saepe ad qui ipsa mollitia odit sunt tempora consequuntur aut aut qui qui voluptatibus rerum quo fugiat sit incidunt neque et deserunt omnis beatae reprehenderit omnis amet quo expedita fugiat sequi reprehenderit sint labore quo impedit perferendis.', '/events/nadim-merrikh-307897-unsplash.jpg', 1, '2018-08-09 10:52:17', 1, 90, 3, 15, NULL),
(79, 'Spectacle de danse africaine', '2018-10-08 07:00:00', 486, 5, 'Quos aut qui eos dolorum nesciunt velit voluptas enim cum ut non quia aut incidunt excepturi vitae facilis aspernatur voluptatem omnis aut qui similique dolorum ducimus quia porro natus magni est alias aut odit voluptatem aut quia non maxime aut neque et expedita sed dolores et rem tenetur explicabo consequuntur doloribus vitae ipsum sed tempore officia sunt.', '/events/henrique-junior-355383-unsplash.jpg', 1, '2018-08-09 19:28:01', 1, 90, 4, 16, NULL),
(80, 'Scènes musicales marseillaises', '2018-09-20 18:00:00', 384, 21, 'Natus dolores ipsum distinctio molestias dolore itaque labore autem provident numquam doloremque voluptas aperiam qui ea sed est ut qui accusantium qui repudiandae commodi ipsum quasi voluptatem dolorem aut culpa sint maxime quidem quaerat necessitatibus non et ab.', '/events/elizeu-dias-602245-unsplash.jpg', 1, '2018-08-09 11:53:46', 1, 102, 4, 13, NULL),
(81, 'Lac d\'Annecy en photos', '2018-09-09 20:00:00', 308, 34, 'Quam vel provident qui qui dolorem ex quia rerum est enim tempora eum et vel quia expedita incidunt commodi in enim saepe nesciunt rerum et aut ipsa et doloribus eum ullam voluptas nobis laborum distinctio reprehenderit sit vel rerum et corrupti consequatur repudiandae quia quo impedit illo praesentium in explicabo.', '/events/eszter-biro-129457-unsplash.jpg', 1, '2018-08-09 08:31:13', 1, 102, 2, 14, NULL),
(82, 'Sketchs : soirée d\'impro', '2018-12-07 20:00:00', 353, 15, 'Fugit cum adipisci delectus aut vitae accusantium nobis tempore aut qui voluptatum officia tenetur non minima itaque doloribus est ut et ab expedita quia ea itaque velit aperiam veniam omnis magnam dignissimos delectus tempora et incidunt blanditiis cum vitae asperiores provident odit enim adipisci quia voluptatem illum temporibus quaerat quia omnis quo unde ipsa quas possimus saepe neque ut rerum dolores magni.', '/events/zachrie-friesen-178358-unsplash.jpg', 1, '2018-08-09 15:09:19', 1, 99, 2, 15, NULL),
(83, 'Humour : soirée d\'impro', '2018-12-13 08:00:00', 295, 32, 'Hic repellendus natus ad rerum dignissimos nemo quae itaque sint dolorem numquam temporibus laudantium ipsa velit laudantium at sint harum quos et deserunt tempore atque eveniet omnis aut quia et eveniet harum sint eaque eius earum qui quis.', '/events/valentino-funghi-146040-unsplash.jpg', 1, '2018-08-09 20:59:45', 1, 99, 2, 14, NULL),
(84, 'Concert de rock', '2018-09-20 08:00:00', 312, 34, 'Nulla voluptas nobis id magni rerum ipsum cumque sapiente totam non rerum ut ex ea praesentium voluptatem quibusdam modi vero perspiciatis voluptate qui omnis a nihil vel nihil quaerat veniam enim nesciunt.', '/events/martin-robles-425849-unsplash.jpg', 1, '2018-08-09 12:07:41', 1, 90, 4, 16, NULL),
(85, 'Concert de funk', '2017-09-09 20:00:00', 183, 37, 'Facere autem est accusamus et officia animi et sit eos soluta quibusdam voluptas doloremque voluptas quos labore officia ipsam consequatur quod molestias porro qui ut deserunt eveniet accusamus asperiores et atque eum nihil deserunt id quisquam et sit.', '/events/shu-xin-553498-unsplash.jpg', 1, '2018-08-09 12:51:56', 1, 96, 1, 13, NULL),
(86, 'Scènes musicales bordelaises', '2018-09-15 20:00:00', 69, 34, 'Hic ut atque est vero nulla quam iste et placeat quisquam voluptatibus error modi blanditiis impedit odit eveniet blanditiis earum consectetur et in delectus dolorem magni est amet occaecati eum repudiandae mollitia odio in qui consectetur et libero dolorum quod ut expedita laborum voluptas error adipisci et non vel porro eum quod laborum et veniam inventore porro vitae iure incidunt sint et ad et iure tempora autem dolores officiis.', '/events/tadas-mikuckis-20931-unsplash.jpg', 1, '2018-09-23 08:08:33', 1, 102, 1, 15, NULL),
(87, 'Scènes musicales strasbourgeoises', '2018-09-20 19:00:00', 369, 36, 'Dolores sed quaerat magnam voluptatem quibusdam nobis alias libero nulla eos nostrum sapiente fugiat autem illo qui asperiores quia rerum corrupti quaerat voluptas sint eaque quis omnis et velit vel et perspiciatis debitis voluptas consequatur distinctio expedita odit ullam optio ipsa qui autem fuga quia non exercitationem est aspernatur assumenda ut sunt asperiores non expedita perferendis possimus vero minima delectus repellat sequi nobis explicabo consequatur.', '/events/concerts-1150042_1920.jpg', 1, '2018-08-09 11:54:15', 1, 94, 2, 13, NULL),
(88, 'Photographie : le travail des artisans de la région', '2018-09-23 20:00:00', 169, 22, 'Ab vel vero voluptas sequi tempora nesciunt voluptatem natus molestias ut consequatur aut sapiente id sint illo et et tempora est sit et qui eius laborum sed id quis id cupiditate dolor qui quo ut totam qui sapiente facilis exercitationem inventore sint autem rem consectetur architecto in ipsam est et harum laboriosam eligendi.', '/events/jonathan-daniels-420014-unsplash.jpg', 1, '2018-08-09 14:18:25', 1, 98, 3, 13, NULL),
(90, 'Soirée scène ouverte', '2018-09-26 20:00:00', 485, 4, 'Et pariatur error voluptatem quia illo suscipit et est voluptatem quasi suscipit aut quia quia velit omnis eos doloribus voluptatum perferendis quo modi ut aliquid fugiat temporibus modi minus sunt magnam quia aspernatur fugiat expedita consequatur harum atque sapiente voluptas et consequatur consectetur officia fuga sapiente quia qui tempore vitae libero aut consequatur assumenda non magnam in asperiores eos.', '/events/bogomil-mihaylov-519207-unsplash.jpg', 1, '2018-08-09 17:35:37', 1, 101, 2, 13, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `event_participant_appuser`
--

CREATE TABLE `event_participant_appuser` (
  `event_id` int(11) NOT NULL,
  `app_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `event_participant_appuser`
--

INSERT INTO `event_participant_appuser` (`event_id`, `app_user_id`) VALUES
(63, 88),
(88, 91);

-- --------------------------------------------------------

--
-- Structure de la table `event_performer_appuser`
--

CREATE TABLE `event_performer_appuser` (
  `event_id` int(11) NOT NULL,
  `app_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `event_performer_appuser`
--

INSERT INTO `event_performer_appuser` (`event_id`, `app_user_id`) VALUES
(63, 89),
(66, 95),
(67, 89),
(68, 91),
(69, 94),
(70, 101),
(71, 92),
(72, 95),
(74, 101),
(75, 89),
(76, 91),
(77, 94),
(78, 89),
(79, 101),
(80, 89),
(81, 102),
(82, 92),
(83, 91),
(84, 89),
(85, 89),
(86, 96),
(87, 89),
(88, 92),
(90, 92);

-- --------------------------------------------------------

--
-- Structure de la table `event_tag`
--

CREATE TABLE `event_tag` (
  `event_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `event_tag`
--

INSERT INTO `event_tag` (`event_id`, `tag_id`) VALUES
(63, 53),
(66, 56),
(67, 56),
(68, 58),
(69, 55),
(70, 60),
(71, 58),
(72, 58),
(74, 52),
(75, 56),
(76, 60),
(77, 52),
(78, 51),
(79, 59),
(80, 55),
(81, 57),
(82, 54),
(83, 58),
(84, 54),
(85, 59),
(86, 60),
(87, 56),
(88, 59),
(90, 56);

-- --------------------------------------------------------

--
-- Structure de la table `event_type`
--

CREATE TABLE `event_type` (
  `id` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `event_type`
--

INSERT INTO `event_type` (`id`, `name`, `is_active`, `created_at`) VALUES
(13, 'Danse', 1, '2018-08-09 12:00:00'),
(14, 'Musique', 1, '2018-08-09 04:00:44'),
(15, 'Exposition', 1, '2018-08-09 14:36:22'),
(16, 'Théâtre', 1, '2018-08-09 21:45:47');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `expeditor_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `content`, `created_at`, `expeditor_id`, `receiver_id`) VALUES
(11, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '2018-08-10 08:19:19', 90, 96),
(12, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '2018-08-10 10:21:21', 102, 94),
(13, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '2018-08-10 10:21:21', 98, 92),
(14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '2018-08-10 15:13:21', 91, 99),
(15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '2018-08-10 09:26:21', 94, 98);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180815072856'),
('20180815074238');

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
  `id` int(11) NOT NULL,
  `name` varchar(144) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siret` int(11) DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(144) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `email` varchar(89) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `website` varchar(89) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `facebook` varchar(144) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_user_creator_id` int(11) NOT NULL,
  `place_type_id` int(11) DEFAULT NULL,
  `nb_alert` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `place`
--

INSERT INTO `place` (`id`, `name`, `siret`, `adress`, `city`, `zipcode`, `email`, `description`, `website`, `image`, `is_active`, `status`, `created_at`, `facebook`, `app_user_creator_id`, `place_type_id`, `nb_alert`) VALUES
(1, 'Milk Shop', 0, '12 rue des Arts', 'BAYONNE', 64000, 'milkshop@example.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequ', 'milkshop.fr', '/places/beerta-maini-418390-unsplash.jpg', 1, 1, '2018-08-10 00:00:00', 'www.facebook.com/milk-shop/', 90, 21, NULL),
(2, 'Le Victoria', 0, 'victoria', 'LYON', 69000, 'victoria@example.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'victoria.fr', '/places/kilyan-sockalingum-478724-unsplash.jpg', 1, 1, '2018-08-10 00:00:00', 'www.facebook.com/victoria', 99, 22, NULL),
(3, 'Le Surfing', 0, '10 rue des vagues', 'TOULOUSE', 31000, 'surfing@example.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'surfing.com', '/places/stage-2223130_1920.jpg', 1, 1, '2018-08-10 00:00:00', 'www.facebook.com/surfing', 90, 22, NULL),
(4, 'Bleu Café', 0, 'rue des croissants', 'MARSEILLE', 13000, 'bleucafe@example.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 'bleucafe.com', '/places/maia-eli-233485-unsplash.jpg', 1, 1, '2018-08-10 00:00:00', 'www.facebook.com/bleucafe', 90, 21, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `place_type`
--

CREATE TABLE `place_type` (
  `id` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `place_type`
--

INSERT INTO `place_type` (`id`, `name`, `is_active`, `created_at`) VALUES
(21, 'Café', 1, '2018-08-09 12:31:58'),
(22, 'Salle de spectacle', 1, '2018-08-09 11:27:57'),
(23, 'Shop', 1, '2018-08-09 10:07:26'),
(24, 'Bar', 1, '2018-08-09 16:23:53'),
(25, 'Restaurant', 1, '2018-08-09 14:00:51');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `name`, `code`, `is_active`) VALUES
(26, 'Administrateur', 'ROLE_ADMINISTRATOR', 1),
(27, 'Moderateur', 'ROLE_MODERATOR', 1),
(28, 'Utilisateur', 'ROLE_USER', 1),
(29, 'Artiste', 'ROLE_ARTIST', 1),
(30, 'Organisateur', 'ROLE_ORGANIZER', 1),
(31, 'Spectateur', 'ROLE_SPECTATOR', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `event_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `is_active`, `created_at`, `event_type_id`) VALUES
(51, 'Classique', 0, '2016-03-14 17:29:41', 13),
(52, 'Jazz', 0, '2014-09-10 11:37:06', 13),
(53, 'Rock', 0, '1999-01-06 11:55:06', 14),
(54, 'Photographie', 1, '1974-01-15 23:33:43', 15),
(55, 'Folk', 1, '1993-07-04 08:56:01', 14),
(56, 'Sculpture', 0, '2001-03-16 13:38:12', 15),
(57, 'Jeunesse', 1, '1982-02-03 21:27:22', 16),
(58, 'Metal', 0, '1986-03-10 04:19:15', 14),
(59, 'Peinture', 0, '2007-11-21 11:49:12', 15),
(60, 'Contemporrain', 1, '2000-07-25 17:59:33', 13);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_88BDF3E9F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_88BDF3E9E7927C74` (`email`),
  ADD KEY `IDX_88BDF3E9D60322AC` (`role_id`);

--
-- Index pour la table `app_user_artist_type`
--
ALTER TABLE `app_user_artist_type`
  ADD PRIMARY KEY (`app_user_id`,`artist_type_id`),
  ADD KEY `IDX_D45F9824A3353D8` (`app_user_id`),
  ADD KEY `IDX_D45F9827203D2A4` (`artist_type_id`);

--
-- Index pour la table `artist_type`
--
ALTER TABLE `artist_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C71F7E88B` (`event_id`),
  ADD KEY `IDX_9474526CDA6A219` (`place_id`),
  ADD KEY `IDX_9474526C4A3353D8` (`app_user_id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BAE0AA79C9FEDC3` (`app_user_creator_id`),
  ADD KEY `IDX_3BAE0AA74B4A4BC9` (`event_place_id`),
  ADD KEY `IDX_3BAE0AA7401B253C` (`event_type_id`);

--
-- Index pour la table `event_participant_appuser`
--
ALTER TABLE `event_participant_appuser`
  ADD PRIMARY KEY (`event_id`,`app_user_id`),
  ADD KEY `IDX_83DFC4E971F7E88B` (`event_id`),
  ADD KEY `IDX_83DFC4E94A3353D8` (`app_user_id`);

--
-- Index pour la table `event_performer_appuser`
--
ALTER TABLE `event_performer_appuser`
  ADD PRIMARY KEY (`event_id`,`app_user_id`),
  ADD KEY `IDX_CDD637A471F7E88B` (`event_id`),
  ADD KEY `IDX_CDD637A44A3353D8` (`app_user_id`);

--
-- Index pour la table `event_tag`
--
ALTER TABLE `event_tag`
  ADD PRIMARY KEY (`event_id`,`tag_id`),
  ADD KEY `IDX_1246725071F7E88B` (`event_id`),
  ADD KEY `IDX_12467250BAD26311` (`tag_id`);

--
-- Index pour la table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6BD307FF61053BB` (`expeditor_id`),
  ADD KEY `IDX_B6BD307FCD53EDB6` (`receiver_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_741D53CD9C9FEDC3` (`app_user_creator_id`),
  ADD KEY `IDX_741D53CDF1809B68` (`place_type_id`);

--
-- Index pour la table `place_type`
--
ALTER TABLE `place_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_389B783401B253C` (`event_type_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT pour la table `artist_type`
--
ALTER TABLE `artist_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT pour la table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `place`
--
ALTER TABLE `place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `place_type`
--
ALTER TABLE `place_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `app_user`
--
ALTER TABLE `app_user`
  ADD CONSTRAINT `FK_88BDF3E9D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `app_user_artist_type`
--
ALTER TABLE `app_user_artist_type`
  ADD CONSTRAINT `FK_D45F9824A3353D8` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D45F9827203D2A4` FOREIGN KEY (`artist_type_id`) REFERENCES `artist_type` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C4A3353D8` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `FK_9474526C71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_9474526CDA6A219` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA7401B253C` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA74B4A4BC9` FOREIGN KEY (`event_place_id`) REFERENCES `place` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA79C9FEDC3` FOREIGN KEY (`app_user_creator_id`) REFERENCES `app_user` (`id`);

--
-- Contraintes pour la table `event_participant_appuser`
--
ALTER TABLE `event_participant_appuser`
  ADD CONSTRAINT `FK_83DFC4E94A3353D8` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_83DFC4E971F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_performer_appuser`
--
ALTER TABLE `event_performer_appuser`
  ADD CONSTRAINT `FK_CDD637A44A3353D8` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDD637A471F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_tag`
--
ALTER TABLE `event_tag`
  ADD CONSTRAINT `FK_1246725071F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_12467250BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307FE92F8F78` FOREIGN KEY (`receiver_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `FK_B6BD307FF624B39D` FOREIGN KEY (`expeditor_id`) REFERENCES `app_user` (`id`);

--
-- Contraintes pour la table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `FK_741D53CD9C9FEDC3` FOREIGN KEY (`app_user_creator_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `FK_741D53CDF1809B68` FOREIGN KEY (`place_type_id`) REFERENCES `place_type` (`id`);

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `FK_389B783401B253C` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`);

-- Schedule demo events from seed time so /api/events (upcoming only) is not empty.
UPDATE `event`
SET `planned_date` = DATE_ADD(
  DATE_ADD(CURDATE(), INTERVAL (`id` % 60) + 1 DAY),
  INTERVAL 19 HOUR
);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
