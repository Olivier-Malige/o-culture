-- Anonymized demo seed for O'Culture (derived from the 2018 training dump).
-- Personal accounts, XSS payloads and production emails were removed.
-- MariaDB applies this folder only on first volume create (/docker-entrypoint-initdb.d).
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
(89, 'artist', 'artist@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Artist Test', 'Compte démo artiste.', NULL, 'Paris', 'www.facebook.com/artist/', 'www.twitter.com/milk-shop/', 'www.artist.com', 1, 1, '2018-08-09 19:02:00', 29, 0),
(90, 'organizer', 'organizer@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Organizer Test', 'Compte démo organisateur.', NULL, 'Paris', 'www.facebook.com/organizer/', 'www.twitter.com/organizer/', 'www.organizer.com', 1, 1, '2018-08-09 19:02:00', 30, 0),
(91, 'FlyingEars', 'flyingears@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'The Flying Ears', 'Groupe strasbourgeois. Concerts intimistes ou sets plus énergiques, selon la salle.', NULL, 'Strasbourg', 'www.facebook.com/flyingears/', NULL, 'maury.fr', 1, 1, '2018-08-09 19:02:00', 29, 0),
(92, 'Bakers', 'bakers@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'The Bakers', 'Duo parisien. Pop, folk et reprises, souvent en acoustique.', NULL, 'Paris', 'www.facebook.com/bakers/', NULL, 'charrier.com', 1, 1, '2018-08-09 19:02:00', 29, 0),
(94, 'The Fordmums & Sisters', 'fordmums@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'The Fordmums & Sisters', 'Troupe marseillaise. Chant, danse et un peu de théâtre.', NULL, 'Marseille', NULL, NULL, 'gautier.fr', 1, 1, '2018-08-09 19:02:00', 29, 0),
(95, 'Queens of Lions', 'queens@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Queens of Lions', 'Groupe rock basé à Paris. Première partie ou tête d\'affiche, selon la salle.', NULL, 'Paris', NULL, NULL, 'lucas.com', 1, 1, '2018-08-09 19:02:00', 29, 0),
(96, 'The Richards', 'richards@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'The Richards', 'Quatuor. Jazz et reprises, plutôt le soir.', NULL, 'Paris', 'www.facebook.com/richards/', NULL, 'barbier.net', 1, 1, '2018-08-09 19:02:00', 29, 0),
(98, 'MJC des Quais', 'mjcquais@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'MJC des Quais', 'Maison de quartier à Toulouse. Ateliers, concerts et sorties pour tous les âges.', NULL, 'Toulouse', NULL, NULL, 'brunel.com', 1, 1, '2018-08-09 19:02:00', 30, 0),
(99, 'Danse Compagnie', 'dansecompagnie@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'MJC des Quais', 'Compagnie de danse contemporaine. Créations courtes et stages ouverts.', NULL, 'Marseille', NULL, NULL, 'albert.com', 1, 1, '2018-08-08 19:02:00', 30, 0),
(100, 'Troupe des solistes', 'solistes@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Troupe des solistes', 'Troupe de théâtre. Classique et textes contemporains.', NULL, 'Paris', NULL, NULL, 'besson.fr', 1, 1, '2018-08-08 19:02:00', 29, 0),
(101, 'Collectif des danseurs', 'collectif@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Collectif des danseurs', 'Collectif lyonnais. Hip-hop, contemporain et jam sessions.', NULL, 'Lyon', NULL, NULL, 'bruneau.com', 1, 1, '2018-08-07 19:02:00', 29, 0),
(102, 'Si et Compagnie', 'sietcompagnie@example.com', '$2y$13$n79kUpyaLVtVmvexywm.ZuTh.dAPSiWRD8TrBYL3lCUWgrF.ce.oq', 'Si et Compagnie', 'Compagnie pluridisciplinaire. Musique, théâtre et expos photos.', NULL, 'Lyon', NULL, NULL, 'rodriguez.org', 1, 1, '2018-08-09 19:02:00', 30, 0),
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
(1, 'Très belles photos, surtout celles du matin sur le lac.', '2018-08-09 09:02:00', 1, 4, 81, NULL, 91, 1, NULL),
(3, 'Bonne salle, un peu sonore près de la scène.', '2018-08-09 09:02:00', 1, 8, NULL, 3, 94, 1, NULL),
(5, 'Les jeunes groupes étaient vraiment bien. On revient.', '2018-08-09 09:02:00', 1, 0, 72, NULL, 91, 1, NULL),
(8, 'Belle série sur les quais. J\'ai acheté un tirage.', '2018-08-09 09:02:00', 1, 2, 76, NULL, 101, 1, NULL),
(10, 'Accueil sympa, on voit bien la scène depuis le fond.', '2018-08-09 09:02:00', 1, 4, NULL, 2, 102, 1, NULL),
(11, 'Soirée réussie, le dernier set était le plus fort.', '2018-08-09 09:02:00', 1, 6, 87, NULL, 91, 1, NULL),
(15, 'Les portraits d\'artisans sont justes. À voir.', '2018-08-09 09:02:00', 1, 6, 88, NULL, 98, 1, NULL),
(17, 'Danse moderne accessible, même si on n\'y connaît rien.', '2018-08-09 09:02:00', 1, 7, 66, NULL, 98, 1, NULL),
(18, 'Fort comme prévu. Prenez des bouchons.', '2018-08-09 09:02:00', 1, 6, 77, NULL, 91, 1, NULL),
(19, 'Bon café, petite salle chaleureuse.', '2018-08-09 09:02:00', 1, 7, NULL, 4, 95, 1, NULL),
(21, 'Trois groupes, trois ambiances. Le jazz était top.', '2018-08-09 09:02:00', 1, 5, 71, NULL, 95, 1, NULL),
(22, 'Bluffant de voir la toile se faire en live.', '2018-08-09 09:02:00', 1, 4, 68, NULL, 91, 1, NULL),
(23, 'On y va souvent le samedi. Programmation régulière.', '2018-08-09 09:02:00', 1, 4, NULL, 4, 98, 1, NULL),
(24, 'Funk efficace, tout le monde dansait.', '2018-08-09 09:02:00', 1, 0, 85, NULL, 92, 1, NULL),
(27, 'Un peu cher au bar, mais la salle est nickel.', '2018-08-09 09:02:00', 1, 8, NULL, 2, 98, 1, NULL),
(28, 'Un peu long entre les sets, sinon nickel.', '2018-08-09 09:02:00', 1, 0, 72, NULL, 91, 1, NULL),
(29, 'Le folk de début de soirée m\'a moins parlé.', '2018-08-09 09:02:00', 1, 6, 87, NULL, 94, 1, NULL),
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
(63, 'Spectacle de danse classique', '2018-12-12 08:00:00', 423, 39, 'Ballet et extraits du répertoire. Une heure, tout public.', '/events/etienne-boulanger-305086-unsplash.jpg', 1, '2018-08-08 16:24:04', 1, 90, 1, 14, NULL),
(66, 'Spectacle de danse moderne', '2018-10-22 19:00:00', 309, 19, 'Pièce contemporaine, six danseurs. Entrée libre pour les moins de 12 ans.', '/events/sergei-gavrilov-528341-unsplash.jpg', 1, '2018-08-09 13:02:54', 1, 94, 4, 15, NULL),
(67, 'Extraits de Molière', '2018-09-04 15:00:00', 119, 24, 'Scènes du Misanthrope et des Fourberies. Décors simples, jeu vif.', '/events/israel-palacio-459693-unsplash.jpg', 1, '2018-08-09 13:27:48', 1, 94, 4, 15, NULL),
(68, 'Peinture en direct', '2018-12-31 06:00:00', 429, 32, 'Un peintre compose une toile pendant la soirée. On peut poser des questions.', '/events/painter-1246619_1920.jpg', 1, '2018-08-09 16:57:06', 1, 99, 2, 15, NULL),
(69, 'Exposition de photographie', '2018-09-23 08:00:00', 363, 17, 'Tirages récents, noir et blanc et couleur. Visite libre.', '/events/gallery-561482_1920.jpg', 1, '2018-07-12 21:00:00', 1, 90, 1, 15, NULL),
(70, 'Représentation des jeunes de l\'Association Tous en scène', '2018-12-18 06:00:00', 281, 2, 'Les ados de l\'asso jouent une pièce qu\'ils ont écrite. 45 minutes.', '/events/michael-afonso-421924-unsplash.jpg', 1, '2018-08-09 11:19:34', 1, 99, 2, 15, NULL),
(71, 'Scènes musicales parisiennes', '2018-12-22 05:00:00', 284, 25, 'Trois groupes, une scène. Jazz, rock et un peu de folk.', '/events/samuel-fyfe-233543-unsplash.jpg', 1, '2018-08-09 10:55:56', 1, 90, 4, 14, NULL),
(72, 'Scènes musicales 2', '2018-09-25 22:00:00', 313, 14, 'Deuxième volet : jeunes formations locales, sets de 20 minutes.', '/events/david-menidrey-389997-unsplash.jpg', 1, '2018-08-09 10:16:39', 1, 91, 1, 13, NULL),
(74, 'Exposition de sculpture', '2018-10-14 09:00:00', 404, 34, 'Pièces en terre et métal. L\'artiste est là le week-end.', '/events/gallery-561482_1920.jpg', 1, '2018-08-09 11:39:48', 1, 90, 4, 15, NULL),
(75, 'Exposition : la région en bande-dessinée', '2018-08-31 07:00:00', 308, 1, 'Planches et croquis d\'auteurs locaux. Atelier BD le samedi.', '/events/gallery-561482_1920.jpg', 1, '2018-08-09 14:47:15', 1, 99, 2, 15, NULL),
(76, 'Les quais du Rhône en photos', '2018-09-05 21:00:00', 286, 34, 'Série sur les quais, matin et soir. Tirages en vente sur place.', '/events/gallery-561482_1920.jpg', 1, '2018-08-09 16:32:07', 1, 91, 2, 14, NULL),
(77, 'Concert de metal', '2018-08-31 20:00:00', 295, 18, 'Deux groupes. Ça va être fort : bouchons d\'oreilles à l\'entrée.', '/events/austin-neill-247237-unsplash.jpg', 1, '2018-08-09 13:24:27', 1, 98, 3, 13, NULL),
(78, 'Théâtre : Mise en scène', '2018-09-08 07:00:00', 468, 19, 'Lecture mise en espace d\'un texte inédit. Échanges avec l\'équipe après.', '/events/nadim-merrikh-307897-unsplash.jpg', 1, '2018-08-09 10:52:17', 1, 90, 3, 15, NULL),
(79, 'Spectacle de danse africaine', '2018-10-08 07:00:00', 486, 5, 'Percussions live et danses d\'Afrique de l\'Ouest. Tout public.', '/events/henrique-junior-355383-unsplash.jpg', 1, '2018-08-09 19:28:01', 1, 90, 4, 16, NULL),
(80, 'Scènes musicales marseillaises', '2018-09-20 18:00:00', 384, 21, 'Artistes de la ville, de la chanson au rap. Terrasse ouverte s\'il fait beau.', '/events/elizeu-dias-602245-unsplash.jpg', 1, '2018-08-09 11:53:46', 1, 102, 4, 13, NULL),
(81, 'Lac d\'Annecy en photos', '2018-09-09 20:00:00', 308, 34, 'Paysages du lac, saisons et villages. Tirages grand format.', '/events/eszter-biro-129457-unsplash.jpg', 1, '2018-08-09 08:31:13', 1, 102, 2, 14, NULL),
(82, 'Sketchs : soirée d\'impro', '2018-12-07 20:00:00', 353, 15, 'Troupes invitées, thèmes tirés au sort. On peut proposer des idées.', '/events/zachrie-friesen-178358-unsplash.jpg', 1, '2018-08-09 15:09:19', 1, 99, 2, 15, NULL),
(83, 'Humour : soirée d\'impro', '2018-12-13 08:00:00', 295, 32, 'Match d\'impro, deux équipes. Ambiance café-théâtre.', '/events/valentino-funghi-146040-unsplash.jpg', 1, '2018-08-09 20:59:45', 1, 99, 2, 14, NULL),
(84, 'Concert de rock', '2018-09-20 08:00:00', 312, 34, 'Set d\'une heure, reprises et morceaux originaux.', '/events/martin-robles-425849-unsplash.jpg', 1, '2018-08-09 12:07:41', 1, 90, 4, 16, NULL),
(85, 'Concert de funk', '2017-09-09 20:00:00', 183, 37, 'Cuivres et basse en avant. Piste dégagée pour danser.', '/events/shu-xin-553498-unsplash.jpg', 1, '2018-08-09 12:51:56', 1, 96, 1, 13, NULL),
(86, 'Scènes musicales bordelaises', '2018-09-15 20:00:00', 69, 34, 'Découverte de groupes girondins. Trois sets, un bar.', '/events/tadas-mikuckis-20931-unsplash.jpg', 1, '2018-09-23 08:08:33', 1, 102, 1, 15, NULL),
(87, 'Scènes musicales strasbourgeoises', '2018-09-20 19:00:00', 369, 36, 'Folk, chanson et un DJ en fin de soirée.', '/events/concerts-1150042_1920.jpg', 1, '2018-08-09 11:54:15', 1, 94, 2, 13, NULL),
(88, 'Photographie : le travail des artisans de la région', '2018-09-23 20:00:00', 169, 22, 'Portraits d\'artisans (bois, fer, céramique) autour de la ville.', '/events/jonathan-daniels-420014-unsplash.jpg', 1, '2018-08-09 14:18:25', 1, 98, 3, 13, NULL),
(90, 'Soirée scène ouverte', '2018-09-26 20:00:00', 485, 4, 'Inscrivez-vous à l\'entrée. 10 minutes par personne, acoustique.', '/events/bogomil-mihaylov-519207-unsplash.jpg', 1, '2018-08-09 17:35:37', 1, 101, 2, 13, NULL);

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
(11, 'Salut, on peut caler un set chez vous en octobre ?', '2018-08-10 08:19:19', 90, 96),
(12, 'Merci pour l\'accueil samedi. On a passé une super soirée.', '2018-08-10 10:21:21', 102, 94),
(13, 'Vous auriez une date libre en novembre pour une expo ?', '2018-08-10 10:21:21', 98, 92),
(14, 'On confirme pour vendredi 20h. On arrive vers 18h pour le son.', '2018-08-10 15:13:21', 91, 99),
(15, 'Ok pour le prêt de matériel. On se voit à 17h.', '2018-08-10 09:26:21', 94, 98);

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
(1, 'Milk Shop', 0, '12 rue des Arts', 'BAYONNE', 64000, 'milkshop@example.com', 'Café-concert à Bayonne. Petite scène, bonne acoustique, plats simples le midi.', 'milkshop.fr', '/places/beerta-maini-418390-unsplash.jpg', 1, 1, '2018-08-10 00:00:00', 'www.facebook.com/milk-shop/', 90, 21, NULL),
(2, 'Le Victoria', 0, 'victoria', 'LYON', 69000, 'victoria@example.com', 'Salle lyonnaise pour concerts et expos. Bar ouvert dès 18h.', 'victoria.fr', '/places/kilyan-sockalingum-478724-unsplash.jpg', 1, 1, '2018-08-10 00:00:00', 'www.facebook.com/victoria', 99, 22, NULL),
(3, 'Le Surfing', 0, '10 rue des vagues', 'TOULOUSE', 31000, 'surfing@example.com', 'Salle de spectacle à Toulouse. Programmation mixte, du jazz au théâtre.', 'surfing.com', '/places/stage-2223130_1920.jpg', 1, 1, '2018-08-10 00:00:00', 'www.facebook.com/surfing', 90, 22, NULL),
(4, 'Bleu Café', 0, 'rue des croissants', 'MARSEILLE', 13000, 'bleucafe@example.com', 'Café culturel à Marseille. Expos, lectures et petits concerts le week-end.', 'bleucafe.com', '/places/maia-eli-233485-unsplash.jpg', 1, 1, '2018-08-10 00:00:00', 'www.facebook.com/bleucafe', 90, 21, NULL);

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
