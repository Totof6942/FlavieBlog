SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `online` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

INSERT INTO `menus` (`id`, `name`, `type`, `controller`, `action`, `level`, `ordre`) VALUES
(1, 'Ajouter un article', 'side', 'articles', 'edit', 7, 10),
(2, 'Liste des articles', 'side', 'articles', 'index', 7, 20),
(3, 'Ajouter une catégorie', 'side', 'categories', 'edit', 7, 30),
(4, 'Liste des catégories', 'side', 'categories', 'index', 7, 40),
(5, 'Nouveaux commentaires', 'side', 'comments', 'new', 5, 50),
(6, 'Liste des commentaires', 'side', 'comments', 'index', 5, 60),
(7, 'Ajouter un utilisateur', 'side', 'users', 'edit', 9, 70),
(8, 'Liste des utilisateurs', 'side', 'users', 'index', 9, 80),
(9, 'Ajouter un groupe', 'side', 'groups', 'edit', 9, 100),
(10, 'Liste des groupes', 'side', 'groups', 'index', 9, 110),
(11, 'Articles', 'nav', 'articles', 'index', 7, 10),
(12, 'Catégories', 'nav', 'categories', 'index', 7, 20),
(13, 'Commentaires', 'nav', 'comments', 'index', 5, 30),
(14, 'Utilisateurs', 'nav', 'users', 'index', 9, 40),
(15, 'Groupes', 'nav', 'groups', 'index', 9, 50);

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
