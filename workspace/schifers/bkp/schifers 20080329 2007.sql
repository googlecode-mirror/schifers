-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.37-community-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema schifers
--

CREATE DATABASE IF NOT EXISTS schifers_main;
USE schifers_main;

--
-- Definition of table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `arti_id` int(11) NOT NULL auto_increment,
  `arti_title` varchar(50) NOT NULL,
  `arti_date` datetime NOT NULL,
  `arti_user_id` int(11) NOT NULL,
  `arti_subj_id` int(11) NOT NULL,
  PRIMARY KEY  (`arti_id`),
  KEY `arti_user_fk` (`arti_user_id`),
  KEY `arti_subj_fk` (`arti_subj_id`),
  CONSTRAINT `arti_user_fk` FOREIGN KEY (`arti_user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `arti_subj_fk` FOREIGN KEY (`arti_subj_id`) REFERENCES `subjects` (`subj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;


--
-- Definition of table `menu_itens`
--

DROP TABLE IF EXISTS `menu_itens`;
CREATE TABLE `menu_itens` (
  `mnit_id` int(11) NOT NULL auto_increment,
  `mnit_order` int(11) NOT NULL,
  `mnit_modu_id` int(11) NOT NULL,
  `mnit_menu_id` int(11) NOT NULL,
  PRIMARY KEY  (`mnit_id`),
  KEY `mnit_modu_fk` (`mnit_modu_id`),
  KEY `mnit_menu_fk` (`mnit_menu_id`),
  CONSTRAINT `mnit_modu_fk` FOREIGN KEY (`mnit_modu_id`) REFERENCES `modules` (`modu_id`),
  CONSTRAINT `mnit_menu_fk` FOREIGN KEY (`mnit_menu_id`) REFERENCES `menus` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_itens`
--

/*!40000 ALTER TABLE `menu_itens` DISABLE KEYS */;
INSERT INTO `menu_itens` (`mnit_id`,`mnit_order`,`mnit_modu_id`,`mnit_menu_id`) VALUES 
 (1,1,14,1),
 (2,2,16,1),
 (3,3,15,1),
 (4,4,19,1),
 (5,1,8,2),
 (6,2,18,2),
 (7,3,17,2),
 (8,4,11,2),
 (9,5,4,2),
 (10,6,10,2),
 (11,7,13,2),
 (12,8,9,2),
 (13,9,7,2),
 (14,10,12,2),
 (15,11,6,2),
 (16,12,5,2),
 (17,13,20,2),
 (18,14,23,2),
 (19,15,24,2),
 (20,16,25,2),
 (21,17,26,2),
 (22,18,27,2),
 (23,19,28,2),
 (24,20,29,2);
/*!40000 ALTER TABLE `menu_itens` ENABLE KEYS */;


--
-- Definition of table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL auto_increment,
  `menu_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`menu_id`,`menu_name`) VALUES 
 (1,'Principal'),
 (2,'Administração');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;


--
-- Definition of table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `mess_id` int(11) NOT NULL auto_increment,
  `mess_text` text NOT NULL,
  `mess_date` datetime NOT NULL,
  `mess_hits` int(11) NOT NULL default '0',
  `mess_topc_id` int(11) NOT NULL,
  `mess_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`mess_id`),
  KEY `mess_topc_fk` (`mess_topc_id`),
  KEY `mess_user_fk` (`mess_user_id`),
  CONSTRAINT `mess_topc_fk` FOREIGN KEY (`mess_topc_id`) REFERENCES `topics` (`topc_id`),
  CONSTRAINT `mess_user_fk` FOREIGN KEY (`mess_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


--
-- Definition of table `moderators`
--

DROP TABLE IF EXISTS `moderators`;
CREATE TABLE `moderators` (
  `modr_id` int(11) NOT NULL auto_increment,
  `modr_topc_id` int(11) NOT NULL,
  `modr_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`modr_id`),
  KEY `modr_topc_fk` (`modr_topc_id`),
  KEY `modr_user_fk` (`modr_user_id`),
  CONSTRAINT `modr_topc_fk` FOREIGN KEY (`modr_topc_id`) REFERENCES `topics` (`topc_id`),
  CONSTRAINT `modr_user_fk` FOREIGN KEY (`modr_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moderators`
--

/*!40000 ALTER TABLE `moderators` DISABLE KEYS */;
/*!40000 ALTER TABLE `moderators` ENABLE KEYS */;


--
-- Definition of table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `modu_id` int(11) NOT NULL auto_increment,
  `modu_nick` varchar(50) NOT NULL,
  `modu_name` varchar(50) NOT NULL,
  `modu_url` varchar(100) NOT NULL,
  PRIMARY KEY  (`modu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`modu_id`,`modu_nick`,`modu_name`,`modu_url`) VALUES 
 (1,'main','Principal','index.php'),
 (2,'admin','Administração','/schifers/pages/pgAdmin.php'),
 (3,'inside','Interna','/schifers/pages/pgRestricted.php'),
 (4,'module','Módulo','/schifers/pages/pgModule.php'),
 (5,'user','Usuário','/schifers/pages/pgUser.php'),
 (6,'session','Sessão','/schifers/pages/pgSession.php'),
 (7,'profile','Perfil','/schifers/pages/pgProfile.php'),
 (8,'article','Artigo','/schifers/pages/pgArticle.php'),
 (9,'paragraph','Parágrafo','/schifers/pages/pgParagraph.php'),
 (10,'new','Notícia','/schifers/pages/pgNew.php'),
 (11,'menu','Menu','/schifers/pages/pgMenu.php'),
 (12,'privilege','Privilégio','/schifers/pages/pgPrivilege.php'),
 (13,'role','Papel','/schifers/pages/pgRole.php'),
 (14,'forum','Fórum','/schifers/pages/pgForum.php'),
 (15,'shout_page','Grito da Galera','/schifers/pages/pgShoutPage.php'),
 (16,'article_page','Artigos','/schifers/pages/pgArticlePage.php'),
 (17,'menu_item','Item de Menu','/schifers/pages/pgMenuItem.php'),
 (18,'shout','Grito da Galera','/schifers/pages/pgShout.php');
INSERT INTO `modules` (`modu_id`,`modu_nick`,`modu_name`,`modu_url`) VALUES 
 (19,'register','Cadastrar-se','/schifers/pages/pgRegister.php'),
 (20,'activate_users','Ativar Usuários','/schifers/pages/pgActivateUsers.php'),
 (21,'error','Erro','/schifers/pages/pgError.php'),
 (22,'exit','Saída','/schifers/pages/pgExit.php'),
 (23,'subject','Assunto','/schifers/pages/pgSubject.php'),
 (24,'generate_sql','Gerador de SQL','/schifers/pages/pgGenerateSql.php'),
 (25,'execute_sql','Executor de SQL','/schifers/pages/pgExecuteSql.php'),
 (26,'page','Página','/schifers/pages/pgPage.php'),
 (27,'topic','Tópico','/schifers/pages/pgTopic.php'),
 (28,'message','Mensagem','/schifers/pages/pgMessage.php'),
 (29,'moderator','Moderador','/schifers/pages/pgModerator.php');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;


--
-- Definition of table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `news_id` int(11) NOT NULL auto_increment,
  `news_title` varchar(50) NOT NULL,
  `news_text` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`news_id`),
  KEY `news_user_fk` (`news_user_id`),
  CONSTRAINT `news_user_fk` FOREIGN KEY (`news_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


--
-- Definition of table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL auto_increment,
  `page_number` int(11) NOT NULL,
  `page_date` datetime NOT NULL,
  `page_arti_id` int(11) NOT NULL,
  `page_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`page_id`),
  KEY `page_arti_fk` (`page_arti_id`),
  KEY `page_user_fk` (`page_user_id`),
  CONSTRAINT `page_arti_fk` FOREIGN KEY (`page_arti_id`) REFERENCES `articles` (`arti_id`),
  CONSTRAINT `page_user_fk` FOREIGN KEY (`page_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;


--
-- Definition of table `paragraphs`
--

DROP TABLE IF EXISTS `paragraphs`;
CREATE TABLE `paragraphs` (
  `para_id` int(11) NOT NULL auto_increment,
  `para_text` text NOT NULL,
  `para_date` datetime NOT NULL,
  `para_order` int(11) NOT NULL,
  `para_page_id` int(11) NOT NULL,
  `para_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`para_id`),
  KEY `para_page_fk` (`para_page_id`),
  KEY `para_user_fk` (`para_user_id`),
  CONSTRAINT `para_page_fk` FOREIGN KEY (`para_page_id`) REFERENCES `pages` (`page_id`),
  CONSTRAINT `para_user_fk` FOREIGN KEY (`para_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paragraphs`
--

/*!40000 ALTER TABLE `paragraphs` DISABLE KEYS */;
/*!40000 ALTER TABLE `paragraphs` ENABLE KEYS */;


--
-- Definition of table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE `privileges` (
  `priv_id` int(11) NOT NULL auto_increment,
  `priv_prof_id` int(11) NOT NULL,
  `priv_modu_id` int(11) NOT NULL,
  PRIMARY KEY  (`priv_id`),
  KEY `priv_prof_fk` (`priv_prof_id`),
  KEY `priv_modu_fk` (`priv_modu_id`),
  CONSTRAINT `priv_prof_fk` FOREIGN KEY (`priv_prof_id`) REFERENCES `profiles` (`prof_id`),
  CONSTRAINT `priv_modu_fk` FOREIGN KEY (`priv_modu_id`) REFERENCES `modules` (`modu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privileges`
--

/*!40000 ALTER TABLE `privileges` DISABLE KEYS */;
INSERT INTO `privileges` (`priv_id`,`priv_prof_id`,`priv_modu_id`) VALUES 
 (1,2,1),
 (2,2,19),
 (3,2,21),
 (4,2,22),
 (5,2,14),
 (6,2,15),
 (7,2,16),
 (8,1,1),
 (9,1,3),
 (10,1,21),
 (11,1,8),
 (12,1,18),
 (13,1,17),
 (14,1,11),
 (15,1,4),
 (16,1,10),
 (17,1,13),
 (18,1,9),
 (19,1,7),
 (20,1,12),
 (21,1,6),
 (22,1,5),
 (23,1,20),
 (24,1,22),
 (25,1,23),
 (26,1,16),
 (27,1,24),
 (28,1,25),
 (29,1,26),
 (30,1,27),
 (31,1,28),
 (32,1,14),
 (33,1,15),
 (34,1,19),
 (35,1,29);
/*!40000 ALTER TABLE `privileges` ENABLE KEYS */;


--
-- Definition of table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `prof_id` int(11) NOT NULL auto_increment,
  `prof_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`prof_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` (`prof_id`,`prof_name`) VALUES 
 (1,'Administrador'),
 (2,'Convidado');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;


--
-- Definition of table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL auto_increment,
  `role_prof_id` int(11) NOT NULL,
  `role_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`role_id`),
  KEY `role_prof_fk` (`role_prof_id`),
  KEY `role_user_fk` (`role_user_id`),
  CONSTRAINT `role_prof_fk` FOREIGN KEY (`role_prof_id`) REFERENCES `profiles` (`prof_id`),
  CONSTRAINT `role_user_fk` FOREIGN KEY (`role_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`role_id`,`role_prof_id`,`role_user_id`) VALUES 
 (1,1,1),
 (2,2,2);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


--
-- Definition of table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `sess_id` varchar(32) NOT NULL,
  `sess_date_start` datetime NOT NULL,
  `sess_date_last` datetime default NULL,
  `sess_active` int(11) NOT NULL,
  `sess_ip` varchar(50) NOT NULL,
  `sess_user_id` int(11) default NULL,
  PRIMARY KEY  (`sess_id`),
  UNIQUE KEY `sess_id` (`sess_id`),
  KEY `sess_user_fk` (`sess_user_id`),
  CONSTRAINT `sess_user_fk` FOREIGN KEY (`sess_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`sess_id`,`sess_date_start`,`sess_date_last`,`sess_active`,`sess_ip`,`sess_user_id`) VALUES 
 ('f4de92e9ce3a535128dead46f1eefaec','2008-03-29 20:05:11','2008-03-29 20:05:11',1,'127.0.0.1',2);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;


--
-- Definition of table `shouts`
--

DROP TABLE IF EXISTS `shouts`;
CREATE TABLE `shouts` (
  `shou_id` int(11) NOT NULL auto_increment,
  `shou_text` text NOT NULL,
  `shou_date` datetime NOT NULL,
  `shou_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`shou_id`),
  KEY `shou_user_fk` (`shou_user_id`),
  CONSTRAINT `shou_user_fk` FOREIGN KEY (`shou_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shouts`
--

/*!40000 ALTER TABLE `shouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shouts` ENABLE KEYS */;


--
-- Definition of table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `subj_id` int(11) NOT NULL auto_increment,
  `subj_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`subj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;


--
-- Definition of table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `topc_id` int(11) NOT NULL auto_increment,
  `topc_title` varchar(255) NOT NULL,
  `topc_text` text,
  `topc_date` datetime NOT NULL,
  `topc_level` int(11) default NULL,
  `topc_hits` int(11) NOT NULL default '0',
  `topc_topc_id` int(11) default NULL,
  `topc_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`topc_id`),
  KEY `topc_topc_fk` (`topc_topc_id`),
  KEY `topc_user_fk` (`topc_user_id`),
  CONSTRAINT `topc_topc_fk` FOREIGN KEY (`topc_topc_id`) REFERENCES `topics` (`topc_id`),
  CONSTRAINT `topc_user_fk` FOREIGN KEY (`topc_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_active` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`,`user_username`,`user_password`,`user_active`) VALUES 
 (1,'admin','21232f297a57a5a743894a0e4a801fc3',1),
 (2,'guest','084e0343a0486ff05530df6c705c8bb4',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


--
-- Definition of table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
CREATE TABLE `users_info` (
  `usif_id` int(11) NOT NULL auto_increment,
  `usif_first_name` varchar(50) NOT NULL,
  `usif_last_name` varchar(50) NOT NULL,
  `usif_nick` varchar(50) NOT NULL,
  `usif_email` varchar(100) NOT NULL,
  `usif_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`usif_id`),
  KEY `usif_user_fk` (`usif_user_id`),
  CONSTRAINT `usif_user_fk` FOREIGN KEY (`usif_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_info`
--

/*!40000 ALTER TABLE `users_info` DISABLE KEYS */;
INSERT INTO `users_info` (`usif_id`,`usif_first_name`,`usif_last_name`,`usif_nick`,`usif_email`,`usif_user_id`) VALUES 
 (1,'Administrador','SCHIFER','Administrador','schifers@hotmail.com',1),
 (2,'SCHIFER','SCHIFER','Convidado','schifers@hotmail.com',2);
/*!40000 ALTER TABLE `users_info` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
