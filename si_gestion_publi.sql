-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 15 mai 2022 à 20:42
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `si_gestion_publi`
--

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

DROP TABLE IF EXISTS `domaine`;
CREATE TABLE IF NOT EXISTS `domaine` (
  `idDomaine` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idDomaine`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`idDomaine`, `nom`) VALUES
(1, 'Mathématiques'),
(2, 'Physique'),
(3, 'Chimie'),
(4, 'Neurosciences');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `idMembre` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `idDomaine` smallint(6) NOT NULL,
  PRIMARY KEY (`idMembre`),
  KEY `idDomaine` (`idDomaine`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`idMembre`, `nom`, `prenom`, `username`, `password`, `idDomaine`) VALUES
(1, 'Duran', 'Adem', 'adem', 'ziakimbo', 1),
(2, 'Abdelkrim', 'Fares', 'fares', 'iggyilestmort', 3),
(3, 'Musk', 'Elon', 'elon', 'ilovetesla', 2);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `idPublication` smallint(6) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) DEFAULT NULL,
  `publishedAt` date DEFAULT NULL,
  `content` mediumtext,
  `origine` varchar(50) DEFAULT NULL,
  `volume` varchar(50) DEFAULT NULL,
  `issue` smallint(6) DEFAULT NULL,
  `pages` varchar(50) DEFAULT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `idType` smallint(6) NOT NULL,
  PRIMARY KEY (`idPublication`),
  KEY `idType` (`idType`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`idPublication`, `titre`, `publishedAt`, `content`, `origine`, `volume`, `issue`, `pages`, `publisher`, `idType`) VALUES
(1, 'Application des mathematiques a la medecine', '2022-05-01', 'L\'application des mathématiques à la médecine est de plus en plus importante. D\'autant plus qu\'il est nécessaire au mathématiciens de développer leurs recherches autour du secteur de la santé étant donné les futurs enjeux majeurs des prochaines crises pandémiques auxquelles le monde pourrait être confronté.\r\n\r\nIl n\'est cependant pas clair pour les néophytes de comprendre l\'intérêt réel des mathématiques dans ce secteur. Au travers de ces recherches, nous vous proposons d\'en apprendre un peu plus sur ce qui pourrait être les plus grandes avancées de notre ère en matière de santé', 'Sciences et vie junior', 'Édition mathématiques', 4, '4 à 8', 'Reworld Media', 1),
(2, 'Le rechauffement augmente les risques d’ouragans', '2021-05-02', 'Notre planète bleue se réchauffe dangereusement, et les océans qui recouvrent 70% de sa surface ne sont pas épargnés. Or c’est au cœur des océans, que naissent les ouragans, les typhons ou les cyclones ! Science et Vie Junior vous explique en vidéo, pourquoi le réchauffement des océans augmente-t-il les risques d’ouragans extrêmes ?\r\n\r\nQu’est-ce qu’un ouragan ?\r\n\r\nUn ouragan est une tempête formée par des nuages orageux en rotation, accompagnés par des vents dépassant les 119km/h. Quelles différences entre les ouragans, les cyclones et typhons ? Leur nom dépend de l’océan qui les a vus naître.\r\n\r\nPour la formation d’un ouragan, plusieurs conditions doivent être réunies. Parmi les principales, il y a la présence de vents en altitude, une forte humidité et une température des eaux de surface.', 'Sciences et vie junior', 'Édition Terre', 1, '1 à 80', 'Reworld Media', 4),
(3, 'L\'effet papillon', '2022-04-04', 'Un coup de feu éclate au Maroc... Incident sans importance, mais qui va changer la vie d’un couple d’américains, d’une nourrice mexicaine, d’une adolescente japonaise. Tout un jeu de petits effets et de grandes conséquences. Une réflexion sur la destinée humaine, soumise au hasard ou à la nécessité ? Beaucoup d’émotion dans Babel, ce film de Alejandro González Iñárritu sorti en 2006. Les critiques de cinéma n’ont pas manqué d’y voir une illustration du fameux effet papillon qui est probablement le phénomène mathématique le plus connu du grand public.\r\n\r\nQue signifie l’effet papillon ?\r\n\r\nGoogle cite 409 000 pages sur « Effet Papillon » et 1 900 000 pages sur « Butterfly Effect ». On trouve tout et n’importe quoi : des interprétations contradictoires, des affirmations fantaisistes. Selon un internaute s’exprimant dans un forum d’amateurs de cinéma, l’effet papillon serait ... un proverbe japonais !\r\n\r\nUn peu d’histoire.\r\n\r\nLa météorologie étudie un phénomène d’une complexité inextricable : le mouvement de l’atmosphère. L’équation qui régit ce mouvement est connue depuis longtemps : c’est l’équation de Navier-Stokes. Mais, savoir écrire une équation ne signifie pas qu’on sache la résoudre ! Qu’on songe un peu à la quantité d’informations nécessaires pour décrire l’atmosphère : il faut connaître la température, la vitesse du vent, la pression atmosphérique, l’hygrométrie etc., non seulement en un endroit donné mais aussi en tous les endroits du globe terrestre ! Avoir une connaissance exacte de ces données est tout simplement impossible : il faut une infinité de données, la plupart inaccessibles.\r\n\r\nEdward Lorenz était un théoricien de la météorologie, de formation mathématique, disparu récemment. En 1962, il a l’idée de caricaturer l’équation de Navier-Stokes, de simplifier à l’extrême, de faire « comme si » l’atmosphère ne dépendait que de trois paramètres, alors qu’il en faudrait une infinité ! Simplifier un problème compliqué en espérant qu’il gardera l’essence du phénomène étudié : voilà bien une activité de mathématicien. Et dans son « atmosphère atrophiée » réduite à ses trois coordonnées, E. Lorenz peut faire tourner son ordinateur et calculer les solutions numériques qui sont censées décrire le mouvement. Imaginez l’ordinateur de Lorenz, avec ses petites capacités, en 1962 ! C’est alors qu’il constate « expérimentalement » que la moindre modification dans « son atmosphère jouet », ajouter par exemple 0.0000001 à l’une des trois coordonnées, entraîne dans le mouvement atmosphérique un changement considérable après un temps relativement modeste. C’est le phénomène de la « dépendance sensible aux conditions initiales », le paradigme de la théorie du chaos.', 'Images des mathematiques', 'Volume Chaos', 8, NULL, 'IONOS', 2),
(4, 'Échos de la recherche', '2021-11-17', 'I - Les différents types de calendriers\r\nDe tout temps, les peuples ont eu besoin de se repérer dans le temps, d’abord en comptant les jours, puis en observant le ciel et plus particulièrement la lune et le soleil.\r\n\r\nLes calendriers lunaires\r\n\r\nLes premiers calendriers ont d’abord été lunaires. En effet, le cycle de la lune est très facile à observer, on peut repérer aisément ses changements de phase. (Pleine Lune, Nouvelle Lune, Premier et Dernier Quartier). De plus, la marche des saisons revient à peu près à 12 lunaisons (ce qui fait 354 jours).\r\n\r\nOn s’est d’abord servi de calendriers lunaires en Mésopotamie, en Egypte, en Grèce, à Rome, en Chine. Ces calendriers comportaient 12 mois de 29 ou 30 jours alternés de façon à suivre les lunaisons (un mois lunaire dure à peu près 29,53 jours). A Babylone, quand l’écart avec les saisons devenait trop génant, le souverain promulguait l’ajout d’un mois supplémentaire.\r\n\r\nActuellement, le calendrier lunaire le plus connu est le calendrier musulman. Il comprend 12 mois de 30 et 29 jours. Le dernier mois de l’année a une durée variable de 29 ou 30 jours pour mieux s’adapter aux mouvements de la lune (c’est à cause du 29,53 et non 29,5). Dans un cycle de 30 ans, il y a 19 années communes (le dernier mois de l’année a 29 jours) et 11 années abondantes (le dernier mois de l’année a 30 jours). Tous les ans, les mois reculent par rapport aux saisons (de 10 ou 11 jours), le calendrier musulman ne suit pas du tout les saisons. La correspondance entre le calendrier musulman et le calendrier grégorien (celui utilisé tous les jours) se reproduit tous les 34 ans.\r\n\r\nLes calendriers lunaires conviennent très bien aux peuples nomades et à ceux qui vivent de la mer. Ils posent des problèmes pour les cultivateurs car ils se décalent par rapport aux saisons.', 'Images des mathématiques', 'Edition R&D', 69, '4 à 120', 'Glenat', 8),
(7, 'Nouveau record d’énergie pour la fusion nucléaire', '2022-03-16', 'Les PFAS, aussi appelés \"polluants éternels\", sont largement utilisés dans l\'industrie chimique, \"notamment pour les traitements anti-taches et imperméabilisants de textiles (vêtements, tissus, tapis, moquettes...), les enduits résistants aux matières grasses pour les emballages en papier et/ou carton autorisés pour le contact alimentaire, les revêtements anti-adhésifs, les mousses anti-incendie, les tensioactifs utilisés dans l’exploitation minière et les puits de pétrole, les cires à parquet, ou encore certaines formulations d’insecticides\", explique l\'Inserm dans un rapport. Une omniprésence qui a rendu banal le contact aux PFAS. \"Les consommateurs des pays industrialisés sont aujourd’hui en contact avec ces composés dans leur vie quotidienne, à travers un grand nombre de produits manufacturés. Les PFC relargués dans l’environnement se retrouvent dans la chaîne alimentaire et in fine dans les organismes vivants.\" Les PFAS avaient d\'ailleurs fait l\'objet du film Dark Waters (sorti en 2019), qui montre le combat d\'un avocat contre la firme chimique DuPont, produisant le Téflon.\r\n\r\nDes taux bien plus élevés que les valeurs référence \r\nIl n\'existe pour le moment pas de normes européennes sur les perfluorés, bannis en 2020 de l\'Union européenne. Toutefois, les analyses réalisées à Pierre-Bénite par le professeur de chimie néerlandais Jacob de Boer, professeur à l\'université libre d\'Amsterdam, livrent un constat alarmant. Dans l\'air, les échantillons prélevés ont montré un taux de PFOA (un perfluoré de la famille des PFAS) jusqu\'à huit fois supérieures aux valeurs de référence de l\'ONU. Dans les sols, les taux retrouvés dépassent de 83 fois les normes néerlandaises (249 microgrammes/kg contre 3 μg/kg, utilisés comme référence faute de réglementation française). Dans les eaux rejetées par l\'usine dans le Rhône, le taux de PFAS est 36.414 fois supérieur à celui relevé dans le fleuve en amont (364.144 nanogrammes/litre contre 10 ng/l). Tous les échantillons d\'eau du robinet dépassent les normes européennes qui doivent bientôt entrer en vigueur en France (plus de 200 ng/l sur trois captages contre 100 ng/l). Et la moyenne des PFAS retrouvés dans le lait maternel est deux fois plus importante que chez les femmes néerlandaises (160,7 ng/kg contre 70,7 ng/kg). Pour le professeur De Boer, cette situation, en particulier sur l\'eau potable, \"nécessite une attention immédiate des autorités\".\r\n\r\nLa présence de plusieurs représentants de cette classe de polluants chimiques dans certains fluides et tissus biologiques humains est \"avérée\", selon l\'Inserm. Une exposition fœtale aux perfluorés a aussi été démontrée par plusieurs études faisant état d\'un transfert de la mère au fœtus via le sang du cordon ombilical. \"Toutefois, les niveaux de concentration rapportés dans le sang du cordon sont systématiquement inférieurs aux teneurs observées dans le sang maternel (d’un facteur 1,5 à 3,5). L’existence d’une exposition du nourrisson allaité via le lait maternel est de même démontrée, même si cette voie de transfert de la mère à l’enfant apparaît plus limitée que pour d’autres classes de polluants organiques.\"', 'Sciences et Avenir', '144', NULL, '1 à 5', 'Sciences et Avenir Publisher', 7),
(8, 'La pollution plastique et chimique', '2022-05-05', 'Moins de 10% du plastique mondial recyclé\r\nL\'étude intervient alors que le lancement de négociations sur la pollution plastique \"de la source à la mer\" doit être examiné par l\'ONU à la fin du mois à Nairobi.\r\n\r\nSi tous les efforts pour éviter que ces matières se retrouvent dans l\'environnement sont bons à prendre, l\'ampleur du problème pousse les scientifiques à pousser pour des solutions plus radicales, comme un plafond maximal de production. D\'autant que le recyclage affiche des résultats médiocres, avec par exemple moins de 10% du plastique mondial recyclé, pour une production qui a doublé depuis l\'an 2000 et culmine actuellement à 367 millions de tonnes.\r\n\r\nUne usine de recyclage de bouteilles en plastique à Fetsund, en Norvège, en janvier 2021 (AFP/Archives - Fredrik Varfjell)\r\n\r\nAujourd\'hui, le plastique présent sur Terre représente quatre fois la biomasse de tous les animaux vivants, selon des études scientifiques. \"Ce que nous essayons de dire, c\'est peut-être que ça suffit, que peut-être nous ne pouvons pas tolérer ça davantage. Peut-être qu\'il faut mettre des limites de production, dire qu\'il ne faut pas produire autant qu\'un certain niveau\", plaide la chercheuse basée en Suède.\r\n\r\nDepuis plusieurs années, le Stockholm Resilience Centre mène des travaux de référence sur les \"limites planétaires\", dans neuf domaines (changement climatique, usage de l\'eau douce, acidifications des océans...).', 'Swedish Daily', '9', NULL, '852 à 52', 'Swedish Department of Publishing', 6);

-- --------------------------------------------------------

--
-- Structure de la table `publie`
--

DROP TABLE IF EXISTS `publie`;
CREATE TABLE IF NOT EXISTS `publie` (
  `idMembre` smallint(6) NOT NULL AUTO_INCREMENT,
  `idPublication` smallint(6) NOT NULL,
  PRIMARY KEY (`idMembre`,`idPublication`),
  KEY `idPublication` (`idPublication`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publie`
--

INSERT INTO `publie` (`idMembre`, `idPublication`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(3, 2),
(1, 3),
(2, 4),
(3, 7),
(2, 8),
(3, 8);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `idType` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`idType`, `nom`) VALUES
(1, 'Revue'),
(2, 'Conférence'),
(3, 'Chapitre'),
(4, 'Livre'),
(5, 'Thèse'),
(6, 'Brevet'),
(7, 'Document judiciaire'),
(8, 'Autre');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `membres`
--
ALTER TABLE `membres`
  ADD CONSTRAINT `membres_ibfk_1` FOREIGN KEY (`idDomaine`) REFERENCES `domaine` (`idDomaine`);

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`idType`) REFERENCES `type` (`idType`);

--
-- Contraintes pour la table `publie`
--
ALTER TABLE `publie`
  ADD CONSTRAINT `publie_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`idMembre`),
  ADD CONSTRAINT `publie_ibfk_2` FOREIGN KEY (`idPublication`) REFERENCES `publication` (`idPublication`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
