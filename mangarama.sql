-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : jeu. 27 jan. 2022 à 15:16
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mangarama`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220114101602', '2022-01-14 10:16:19', 364),
('DoctrineMigrations\\Version20220114141915', '2022-01-14 14:20:09', 687),
('DoctrineMigrations\\Version20220114162602', '2022-01-14 16:26:12', 1415),
('DoctrineMigrations\\Version20220114170357', '2022-01-14 17:04:51', 255),
('DoctrineMigrations\\Version20220126173416', '2022-01-26 17:34:25', 441);

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

CREATE TABLE `manga` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` decimal(4,2) DEFAULT '0.00',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voters_number` smallint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`id`, `name`, `description`, `score`, `image`, `voters_number`) VALUES
(6, 'One Piece', 'Gloire, fortune et puissance, c\'est ce que possédait Gold Roger, le tout puissant roi des pirates, avant de mourir sur l\'échafaud. Mais ses dernières paroles ont éveillées bien des convoitises, et lança la fabuleuse \"ère de la piraterie\", chacun voulant trouver le fabuleux trésor qu\'il disait avoir laissé.\r\n\r\nBien des années plus tard, Shanks, un redoutable pirate aux cheveux rouges, rencontre Luffy, un jeune garçon d\'une dizaine d\'années dans un petit port de pêche. Il veut devenir pirate et le rejoindre, mais Shanks lui répond qu\'il est trop jeune. Plus tard, Luffy avalera accidentellement le fruit Gomu Gomu qui rendra son corps élastique, mais aussi maudit par les eaux. Incapable de nager, Luffy ne veut pourtant pas renoncer à son rêve. Pour le consoler lorsqu\'il part, Shanks lui offre son chapeau. Luffy jure alors de le rejoindre un jour avec son propre équipage.\r\n\r\nA 17 ans, Luffy prend la mer dans une petite barque avec pour but de réunir un équipage de pirates, mais de pirates pas comme les autres, qui devront partager sa conception un peu étrange de la piraterie. L\'aventure est lancée.', '9.28', '61f07e25da61a.jpg', 1481),
(7, 'Naruto', 'Il y a de cela douze ans, Kyūbi, un démon ayant la forme d\'un renard à neuf queues, entreprit la destruction du village de Konoha, mais le quatrième Hokage neutralisa ce démon en le scellant dans le corps d\'un nouveau-né : Naruto Uzumaki. Le quatrième Hokage se sacrifia ainsi pour sauver le village de Konoha.\r\n\r\nL\'histoire commence pendant l\'adolescence de Naruto, vers ses douze ans. Orphelin, éternel cancre et grand farceur, il fait toutes les bêtises possibles pour se faire remarquer. Son rêve : devenir Hokage afin d\'être reconnu par les habitants de son village. En effet, le démon scellé en lui a attisé la crainte et le mépris des autres villageois, qui, avec le temps, ne font plus de différence entre le Kyūbi et Naruto. Malgré cela, Naruto s\'entraîne dur afin de devenir genin, le premier niveau chez les ninjas.', '8.81', '61f07e83e48be.jpg', 1183),
(8, 'Dr. STONE', 'Un jour, une lumière éclaira la Terre, changeant tous les humains en pierre. Ainsi, l\'humanité s\'éteignit. Plusieurs millénaires plus tard, Taiju parvient à s\'échapper de son enveloppe de pierre pour découvrir un monde dans lequel la nature a repris ses droits. Avec son ami Senku, ils décident de tout mettre en œuvres pour faire renaître l\'humanité de ses cendres et survivre.', '8.95', '61f07f05b2c6f.jpg', 451),
(9, 'L\'Attaque des Titans', 'Eren est un petit garçon rêvant de voyager dans le monde extérieur. Mais cela est impossible car il vit dans une ville fortifiée aux murailles dépassant les cinquante mètres de haut. Ces remparts sont nécessaires à la sécurité des habitants car ils sont les derniers représentants de l\'humanité, obligés de se cacher pour échapper aux titans qui ont massacré la majeure partie du genre humain un siècle plus tôt. Eren est têtu : il ne se doute pas de la violence des combats qui ont opposé les hommes aux titans. Il décide de poster sa candidature pour devenir éclaireur, car il s\'agit des seuls soldats autorisés à sortir de la ville pour en savoir plus sur les titans. Mais un beau jour, un géant parvient à détruire le mur qui protégeait la ville et ouvre la voie à plusieurs dizaines de ses congénères ! Eren assiste impuissant à la mort atroce de sa mère qui finit dévorée. Alors qu\'il fuit avec d\'autres survivants, il se jure de se venger et de détruire la race des titans jusqu\'à ce qu\'il n\'en reste plus un seul !!', '9.25', '61f07ff6082ef.jpg', 1485),
(11, 'Sun-Ken Rock', 'Kitano Ken, un jeune Japonais, est un looser et passe son temps à se lamenter sur son sort. Un jour il décide de prendre son destin en main : il part à Séoul. Il veut retrouver Yumin, une fille qu\'il aime. Elle travaille dans la police. Afin de l\'impressionner, Ken veut devenir agent de police... Mais le chemin est semé d\'embûche.\r\n\r\nKen va malencontreusement faire la connaissance d\'un gang de mafieux... Pour lui, une nouvelle vie commence !', '8.94', '61f0828a4cc7b.jpg', 234),
(12, 'Shounen no Abyss', 'Dans une ville sans rien, au milieu d\'une vie quotidienne avec apparemment aucun signe de changement, le lycéen Reiji Kurose vivait \"juste\". Famille, rêves d\'avenir, amis d\'enfance. Tous le liaient à cette ville. Il pensait qu\'il continuerait \"juste\" à vivre comme ça. Jusqu\'à ce qu\'il la rencontre. Y a-t-il de l\'espoir à vivre? Y a-t-il de la lumière qui l\'attend?', '9.00', '61f085f57a52b.jpg', 25),
(13, 'Gunnm', 'Gally est un cyborg créé par le docteur Ido qui est aussi un chasseur de prime.\r\nCe dernier la trouve alors qu\'il cherchait des pièces pour cyborgs dans une décharge.\r\nGally suit ensuite les traces de son créateur Ido et devient chasseur de prime.\r\n\r\nRapidemment, Gally devient l\'un des meilleurs chasseurs de prime de toute la décharge et son talent est reconnu par tous.\r\nC\'est en chassant un criminel que Gally rencontre Yugo, un jeune mécano qui répare les inventions du docteur Ido.\r\n\r\nGally tombe sous le charme de Yugo et fera tout pour être à ses côtés.\r\nYugo rêvant d\'aller à Zalem, Gally fera tout pour aider ce dernier à rejoindre cette cité...', '8.89', '61f0863c7485f.jpg', 269),
(14, 'Jujutsu Kaisen', 'Chaque année au Japon, on recense plus de 10 000 morts inexpliquées et portés disparus.\r\n\r\nDans la majorité des cas, ce sont les sentiments négatifs des êtres humains qui sont en cause. Souffrance, regrets, humiliation : leur accumulation dans un même endroit provoque des malédictions souvent fatales...\r\n\r\nC\'est ce que va découvrir à ses dépens Yuji Itadori, lycéen et membre du club de spiritisme. Il ne croit pas aux fantômes, mais sa force physique hors du commun est un précieux atout pour les missions du groupe... jusqu\'à ce que l\'une d\'elles tourne mal. La relique qu\'ils dénichent, le doigt sectionné d\'une créature millénaire, attire les monstres ! Le jeune homme n\'hésite pas une seconde : il avale la relique pour conjurer le mauvais sort !\r\n\r\nLe voilà possédé par Ryomen Sukuna, le célèbre démon à deux visages. Contre toute attente, Yuji réussit à reprendre le contrôle de son corps. C\'est du jamais vu ! Malgré tout, il est condamné à mort par l\'organisation des exorcistes... Une sentence qui ne pourra être repoussée qu\'à une seule condition : trouver et ingérer tous les doigts de Sukuna afin d\'éliminer la menace une fois pour toutes. Et pour ça, l\'adolescent va devoir s\'initier à l\'art occulte et mystérieux de l\'exorcisme !\r\n\r\nMonstres assoiffés de sang, combats épiques et magie surpuissante : découvrez la nouvelle bombe dark fantasy ! Au cœur d\'une lutte millénaire entre exorcistes et démons, comment garder son humanité alors même que le mal se tapit au plus profond de soi ?', '8.97', '61f0866888dab.jpg', 545),
(15, 'Tokyo Ghoul', 'A Tokyo, de nos jours.\r\nPlusieurs cadavres mutilés ont été retrouvés par la police qui recherche vainement un coupable. Quelques spécialistes évoquent les goules, créatures monstrueuses qui chassent les humains pour les manger. Kaneki Ken, jeune homme de 18 ans étudiant à l\'université, ne se préoccupe pas plus que ça de ces incidents, mais la réalité va le rattraper ! En effet, la jolie fille pour laquelle il a eu le coup de foudre dans un café et avec qui il sort n\'est autre que la goule qui sévit dans le quartier ! Celle-ci tente de le dévorer et lui broie l\'abdomen, mais elle est achevée par la chute de poutres en métal d\'un chantier avant d\'avoir pu mettre son sinistre dessein à exécution. Tout pourrait être bien qui finit bien, mais les médecins qui retrouvent Kaneki à moitié mort ne trouvent pas d\'autre moyen pour le sauver que de transplanter les organes du monstre dans son corps ! Après son opération, le jeune homme constate avec horreur qu\'il se transforme petit à petit en goule... La descente aux enfers de Kaneki commence !!', '9.08', '61f0869e47243.jpg', 935),
(16, 'Tokyo Ghoul:re', 'Deux ans après les événements qui ont impliqué les goules du 20ème et le CCG, on suit Haise Sasaki, un inspecteur du CCG et son équipe, assignés pour traquer une goule sans scrupule qui se fait passer pour un chauffeur de taxi. Si on fait appel à eux pour ce cas, c\'est parce qu\'ils possèdent des caractéristiques bien précises...', '8.92', '61f086ca1e371.png', 529),
(18, 'Tower of God', 'La légende veut qu\'au sommet de la Tour de Dieu se trouve tout ce que l\'on désire. Rachel représente tout pour Bam, jeune garçon né dans les ténèbres. Lorsque celle-ci l\'abandonne pour entamer l\'ascension des 134 étages de la Tour, ce dernier se lance à sa poursuite. La progression graduelle de la Tour ne s\'effectue cependant qu\'à l\'issue d\'une épreuve imposée à chaque étage. Bam fera la rencontre de différents protagonistes et devra braver tests ardus et situations mortelles dans son avancée périlleuse.', '9.00', '61f08738ea810.jpg', 246),
(19, 'Rent-a-Girlfriend', 'Kazuya Kinoshita est un étudiant plutôt banal qui vient de se faire larguer par sa petite-amie, qui a décidé d\'aller voir ailleurs. Effondré, se sentant plus bas que terre, il décide d\'installer sur son téléphone la nouvelle application en vogue, Diamond, et de louer une nouvelle copine pour se sentir mieux. Il tombe sur une certaine Chizuru Mizuhara ; une jeune fille qui, à première vue, a tout pour lui plaire.', '8.34', '61f087af6d452.png', 137),
(20, 'Blood-C', 'Saya Kisaragi est une fille, qui en apparence, parait tout à fait normale. Elle vit avec son père Tadayoshi Kisaragi, prêtre shintoïste, dans un sanctuaire. Pendant la journée, elle va au lycée et passe du temps avec ses amis dans un café local. Mais quand la nuit tombe, Saya est appelée à protéger son village de monstres étranges nommés Les Anciens.', '9.00', '61f119c65ab4a.jpg', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
