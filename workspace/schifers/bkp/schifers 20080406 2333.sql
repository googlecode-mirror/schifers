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
-- Create schema schifers_main
--
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
  CONSTRAINT `arti_subj_fk` FOREIGN KEY (`arti_subj_id`) REFERENCES `subjects` (`subj_id`),
  CONSTRAINT `arti_user_fk` FOREIGN KEY (`arti_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB;

--
-- Dumping data for table `articles`
--

/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`arti_id`,`arti_title`,`arti_date`,`arti_user_id`,`arti_subj_id`) VALUES 
 (1,'Configura&ccedil;&atilde;o de Projeto com SDL','2008-03-30 00:00:00',1,1),
 (2,'M&aacute;quina de Estados','2008-04-04 00:00:00',1,2);
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
  CONSTRAINT `mnit_menu_fk` FOREIGN KEY (`mnit_menu_id`) REFERENCES `menus` (`menu_id`),
  CONSTRAINT `mnit_modu_fk` FOREIGN KEY (`mnit_modu_id`) REFERENCES `modules` (`modu_id`)
) ENGINE=InnoDB;

--
-- Dumping data for table `menu_itens`
--

/*!40000 ALTER TABLE `menu_itens` DISABLE KEYS */;
INSERT INTO `menu_itens` (`mnit_id`,`mnit_order`,`mnit_modu_id`,`mnit_menu_id`) VALUES 
 (2,2,16,1),
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
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

--
-- Dumping data for table `modules`
--

/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`modu_id`,`modu_nick`,`modu_name`,`modu_url`) VALUES 
 (1,'main','Principal','index.php'),
 (2,'admin','Administra&ccedil;&atilde;o','/schifers/pages/pgAdmin.php'),
 (3,'inside','Interna','/schifers/pages/pgRestricted.php'),
 (4,'module','M&oacute;dulo','/schifers/pages/pgModule.php'),
 (5,'user','Usu&aacute;rio','/schifers/pages/pgUser.php'),
 (6,'session','Sess&atilde;o','/schifers/pages/pgSession.php'),
 (7,'profile','Perfil','/schifers/pages/pgProfile.php'),
 (8,'article','Artigo','/schifers/pages/pgArticle.php'),
 (9,'paragraph','Par&aacute;grafo','/schifers/pages/pgParagraph.php'),
 (10,'new','Not&iacute;cia','/schifers/pages/pgNew.php'),
 (11,'menu','Menu','/schifers/pages/pgMenu.php'),
 (12,'privilege','Privil&eacute;gio','/schifers/pages/pgPrivilege.php'),
 (13,'role','Papel','/schifers/pages/pgRole.php'),
 (14,'forum','F&oacute;rum','/schifers/pages/pgForum.php'),
 (15,'shout_page','Grito da Galera','/schifers/pages/pgShoutPage.php'),
 (16,'article_page','Artigos','/schifers/pages/pgArticlePage.php'),
 (17,'menu_item','Item de Menu','//schiferspages/pgMenuItem.php'),
 (18,'shout','Grito da Galera','/schifers/pages/pgShout.php'),
 (19,'register','Cadastrar-se','/schifers/pages/pgRegister.php'),
 (20,'activate_users','Ativar Usu&aacute;rios','/schifers/pages/pgActivateUsers.php');
INSERT INTO `modules` (`modu_id`,`modu_nick`,`modu_name`,`modu_url`) VALUES 
 (21,'error','Erro','/schifers/pages/pgError.php'),
 (22,'exit','Sa&iacute;da','/schifers/pages/pgExit.php'),
 (23,'subject','Assunto','/schifers/pages/pgSubject.php'),
 (24,'generate_sql','Gerador de SQL','/schifers/pages/pgGenerateSql.php'),
 (25,'execute_sql','Executor de SQL','/schifers/pages/pgExecuteSql.php'),
 (26,'page','P&aacute;gina','/schifers/pages/pgPage.php'),
 (27,'topic','T&oacute;pico','/schifers/pages/pgTopic.php'),
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
) ENGINE=InnoDB;

--
-- Dumping data for table `news`
--

/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`news_id`,`news_title`,`news_text`,`news_date`,`news_user_id`) VALUES 
 (1,'Lan&ccedil;amento do site!','Hoje estou comemorando o lan&ccedil;amento do site SCHIFER.\r\n<br><br>\r\nEstarei tratando sobre programa&ccedil;&atilde;o de jogos aqui e assuntos relacionados. \r\n<br><br>\r\nEst&atilde;o previstos os seguintes lan&ccedil;amentos:\r\n<br><br>\r\n- Constru&ccedil;&atilde;o do m&oacute;dulo de f&oacute;rum do site\r\n<br>\r\n- Artigos sobre programa&ccedil;&atilde;o de jogos em SDL\r\n<br>\r\n- Projeto MOSKAS\r\n<br><br>\r\nAguardem mais novidades.\r\n<br><br>\r\nSejam bem vindos,\r\n<br><br>\r\nBruno Schifer.','2008-03-30 16:00:00',1),
 (2,'Projeto MOSKAS','In&iacute;cio da produ&ccedil;&atilde;o do projeto MOSKAS.\r\n<br><br>\r\nTrata-se de um pequeno projeto de jogo feito em SDL e C++.\r\n<br><br>\r\nInteressados em ajudar, favor enviar e-mail para <a href=\'mailto:schifers@hotmail.com\'><font color=\'#0000FF\'>schifers@hotmail.com</font></a>.\r\n<br><br>\r\nO projeto MOSKAS procura:\r\n<br><br>\r\n- Animador 2D que saiba fazer Pixel Art\r\n<br>\r\n- Compositor de músicas e efeitos no formato *.WAV\r\n<br><br>\r\nBruno Schifer','2008-03-30 16:30:00',1),
 (3,'Cadastro','Hoje recebi uma mensagem dizendo que o site est&aacute; vulner&aacute;vel. Eu n&atilde;o diria vulner&aacute;vel e sim flex&iacute;vel.\r\n<br><br>\r\nEu criei um site para que a comunidade programadora de jogos, principalmente integrantes da PDJ, pudessem vir a conhecer um pouco sobre mim e sobre as &aacute;reas da programa&ccedil;&atilde;o de jogos que eu estudei, lendo os tutoriais que escrevo.\r\n<br><br>\r\nO objetivo do Grito da Galera era ficar aberto para que as pessoas que viessem aqui deixassem uma mensagem, uma pergunta ou qualquer coisa que acrescentasse algo aos utilizadores do site. Por&eacute;m, ele estar&aacute; dispon&iacute;vel somente aos membros do site.\r\n<br><br>\r\nEu n&atilde;o vou, por enquanto, melhorar a seguran&ccedil;a do site, ainda mais porque ele &eacute; muito pouco acessado.\r\n<br><br>\r\nEnt&atilde;o, se voc&ecirc; quiser se cadastrar e ajudar a comunidade da PDJ - <a href=\'http://www.pdj.com.br\'>http://www.pdj.com.br</a> - e outros interessados na programa&ccedil;&atilde;o de jogos, seja bem vindo.\r\n<br><br>\r\nAl&eacute;m disso, se voc&ecirc; quiser participar dos meus projetos ou se quiser apenas ser um membro do site, cadastre-se e voc&ecirc; poder&aacute; usar o Grito da Galera, assim como as futuras funcionalidades que virei a implementar aqui.\r\n<br><br>\r\nS&oacute; pe&ccedil;o que aguarde um pouco para que os administradores possam liberar seu acesso ao conteúdo interno do site.\r\n<br><br>\r\nNo mais &eacute; isso a&iacute;. O pr&oacute;ximo artigo est&aacute; quase pronto e assim que termin&aacute;-lo, estarei publicando ele aqui e se poss&iacute;vel, tamb&eacute;m no PDJBlog.\r\n<br><br>\r\nAt&eacute; a pr&oacute;xima!\r\n<br><br>\r\nBruno Schifer','2008-04-04 07:36:26',1);
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
) ENGINE=InnoDB;

--
-- Dumping data for table `pages`
--

/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`page_id`,`page_number`,`page_date`,`page_arti_id`,`page_user_id`) VALUES 
 (1,1,'2008-03-30 00:00:00',1,1),
 (2,2,'2008-03-30 00:00:00',1,1),
 (3,1,'2008-04-05 15:19:55',2,1),
 (4,2,'2008-04-05 15:46:18',2,1),
 (5,3,'2008-04-05 15:50:35',2,1),
 (6,4,'2008-04-05 15:56:10',2,1),
 (7,5,'2008-04-05 16:00:52',2,1);
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
) ENGINE=InnoDB;

--
-- Dumping data for table `paragraphs`
--

/*!40000 ALTER TABLE `paragraphs` DISABLE KEYS */;
INSERT INTO `paragraphs` (`para_id`,`para_text`,`para_date`,`para_order`,`para_page_id`,`para_user_id`) VALUES 
 (1,'Este artigo tem por finalidade mostrar como configurar um projeto em um compilador free para trabalharmos com SDL e C++ no Windows.\r\n<br><br>\r\nComo o objetivo &eacute; trabalhar com C++, com um compilador free que rode no Windows, eu escolhi o compilador Dev-C++.\r\n<br><br>\r\nVoc&ecirc; pode baixar a vers&atilde;o 4.9.9.2 para Windows no link abaixo:\r\n<br><br>\r\n<a href=\'http://prdownloads.sourceforge.net/dev-cpp/devcpp-4.9.9.2_setup.exe\'>http://prdownloads.sourceforge.net/dev-cpp/devcpp-4.9.9.2_setup.exe</a>\r\n<br><br>\r\nAp&oacute;s terminar o download do arquivo, execute e instale o programa seguindo os passos abaixo:\r\n<br><br>','2008-03-30 00:00:00',1,1,1),
 (2,'Agora chegou a hora de instalarmos a biblioteca SDL. A SDL ou Simple DirectMedia Library &eacute; uma biblioteca que, inicialmente, foi desenvolvida para Linux e, posteriormente, foi portada para Windows. Ela &eacute; uma das mais indicadas bibliotecas para o aprendizado de Programa&ccedil;&atilde;o de Jogos pela facilidade do uso de suas fun&ccedil;&otilde;es.\r\n<br><br>\r\nPara que possamos instalar a biblioteca, voc&ecirc; deve fazer o download do seguinte arquivo:\r\n<br><br>\r\n<a href=\'http://www.libsdl.org/release/SDL-devel-1.2.13-mingw32.tar.gz\'>http://www.libsdl.org/release/SDL-devel-1.2.13-mingw32.tar.gz</a>\r\n<br><br>\r\nAp&oacute;s fazer o download do arquivo, descompacte-o em uma pasta do Windows, de prefer&ecirc;ncia em C:, pois assim fica f&aacute;cil encontrarmos os arquivos depois.\r\n<br><br>\r\nCaso voc&ecirc; n&atilde;o queira instalar no raiz da sua m&aacute;quina, escolha um outro local e armazene o caminho para que possamos utilizar quando formos configurar o compilador.\r\n<br><br>\r\nNa pr&oacute;xima p&aacute;gina vamos mostrar como configurar o projeto no Dev-C++.\r\n<br><br>','2008-03-30 00:00:00',1,2,1),
 (3,'Ap&oacute;s a instala&ccedil;&atilde;o, siga para a pr&oacute;xima p&aacute;gina para instalarmos a SDL.\r\n<br><br>','2008-03-31 00:00:00',10,1,1);
INSERT INTO `paragraphs` (`para_id`,`para_text`,`para_date`,`para_order`,`para_page_id`,`para_user_id`) VALUES 
 (4,'Ao executar o programa de instala&ccedil;&atilde;o, voc&ecirc; receber&aacute; uma mensagem como a que est&aacute; abaixo:\r\n<br><br>\r\n<center><img src=\'/schifers/images/art01/fig01.gif\' border=\'0\'></center>\r\n<br><br>\r\nEssa mensagem &eacute; um aviso do instalador dizendo que n&atilde;o &eacute; recomend&aacute;vel instalar o Dev-C++ por cima de uma outra instala&ccedil;&atilde;o do mesmo software. Portanto, se voc&ecirc; j&aacute; tinha o Dev instalado, cancele a instala&ccedil;&atilde;o, desinstale antes a vers&atilde;o antiga e inicie o processo novamente.\r\n<br><br>','2008-03-31 00:00:00',2,1,1),
 (5,'Em seguida, aparecer&aacute; a telinha de sele&ccedil;&atilde;o da linguagem do instalador:\r\n<br><br>\r\n<center><img src=\'/schifers/images/art01/fig02.gif\' border=\'0\'></center>\r\n<br><br>\r\nEscolha a op&ccedil;&atilde;o Portugu&ecirc;s.\r\n<br><br>','2008-03-31 00:00:00',3,1,1),
 (6,'A tela que aparece em seguida &eacute; essa que voc&ecirc; v&ecirc; logo aqui abaixo.\r\n<br><br>\r\n<center><img src=\'/schifers/images/art01/fig03.gif\' border=\'0\'></center>\r\n<br><br>\r\nTrata-se do contrato de licen&ccedil;a do Dev-C++. Se for de seu interesse, leia o contrato e se voc&ecirc; n&atilde;o tiver nada contra clique no bot&atilde;o Aceito.\r\n<br><br>','2008-03-31 00:00:00',4,1,1),
 (7,'Logo ap&oacute;s aceitar o contrato, voc&ecirc; ver&aacute; a tela com as op&ccedil;&otilde;es de instala&ccedil;&atilde;o da ferramenta:\r\n<br><br>\r\n<center><img src=\'/schifers/images/art01/fig04.gif\' border=\'0\'></center>\r\n<br><br>\r\nEu recomendo instalar tudo o que estiver selecionado da forma padr&atilde;o que veio, caso voc&ecirc; queira ver o que est&aacute; instalando, use um pouco do seu tempo para ler as op&ccedil;&otilde;es e entender o que cada uma delas faz. Ap&oacute;s selecionar o que for de seu interesse, pressione o bot&atilde;o seguinte para dar continuidade &agrave; instala&ccedil;&atilde;o.\r\n<br><br>','2008-03-31 00:00:00',5,1,1);
INSERT INTO `paragraphs` (`para_id`,`para_text`,`para_date`,`para_order`,`para_page_id`,`para_user_id`) VALUES 
 (8,'Chegou a hora de escolher o local da instala&ccedil;&atilde;o da sua ferramenta. A tela tem que ser igual a que est&aacute; mais abaixo:\r\n<br><br>\r\n<center><img src=\'/schifers/images/art01/fig05.gif\' border=\'0\'></center>\r\n<br><br>\r\nMais uma vez, eu recomendo deixar no local padr&atilde;o de instala&ccedil;&atilde;o. Dessa forma fica mais f&aacute;cil encontrar o Dev-C++ quando voc&ecirc; precisar configurar as op&ccedil;&otilde;es dele com maior precis&atilde;o. Pressione o bot&atilde;o Instalar.\r\n<br><br>','2008-03-31 00:00:00',6,1,1),
 (9,'Ap&oacute;s selecionar o local e iniciar a instala&ccedil;&atilde;o, a seguinte tela ir&aacute; aparecer:\r\n<br><br>\r\n<center><img src=\'/schifers/images/art01/fig06.gif\' border=\'0\'></center>\r\n<br><br>\r\nEssa tela indica que o processo de instala&ccedil;&atilde;o est&aacute; em andamento. Aguarde a conclus&atilde;o da instala&ccedil;&atilde;o.\r\n<br><br>','2008-03-31 00:00:00',7,1,1),
 (10,'Em seguida &eacute; perguntado se voc&ecirc; quer ou n&atilde;o instalar a ferramenta para todos os usu&aacute;rios do seu computador:\r\n<br><br>\r\n<center><img src=\'/schifers/images/art01/fig07.gif\' border=\'0\'></center>\r\n<br><br>\r\nEssa op&ccedil;&atilde;o fica a seu crit&eacute;rio. Eu costumo colocar que sim, pois eu sou o único usu&aacute;rio do meu computador.\r\n<br><br>','2008-03-31 00:00:00',8,1,1),
 (11,'Concluindo a instala&ccedil;&atilde;o:\r\n<br><br>\r\n<center><img src=\'/schifers/images/art01/fig08.gif\' border=\'0\'></center>\r\n<br><br>\r\nEssa última tela indica que o Dev-C++ foi instalado com sucesso e pergunta se voc&ecirc; quer execut&aacute;-lo ap&oacute;s encerrar a instala&ccedil;&atilde;o. N&atilde;o mexa na sele&ccedil;&atilde;o e aperte o bot&atilde;o Terminar, pois vamos dar continuidade na instala&ccedil;&atilde;o na pr&oacute;xima p&aacute;gina.\r\n<br><br>','2008-03-31 00:00:00',9,1,1);
INSERT INTO `paragraphs` (`para_id`,`para_text`,`para_date`,`para_order`,`para_page_id`,`para_user_id`) VALUES 
 (12,'Nesse tutorial eu vou ensinar uma t&eacute;cnica de programa&ccedil;&atilde;o muito útil para o desenvolvimento de jogos.\r\n<br><br>\r\nTrata-se da m&aacute;quina de estado que pode ser usada para controle da execu&ccedil;&atilde;o do seu jogo entre outras coisas.\r\n<br><br>\r\nAntes de mais nada, vamos chamar o objeto de estudo deste tutorial corretamente, pois o nome est&aacute; incompleto.\r\n<br><br>\r\nAs m&aacute;quinas de estado s&atilde;o mais corretamente denominadas M&aacute;quina de Estado Finito ou em ingl&ecirc;s &quot;Finite State Machine&quot; ou ainda melhor, FSM.\r\n<br><br>\r\nA utiliza&ccedil;&atilde;o das FSMs no mundo da programa&ccedil;&atilde;o j&aacute; &eacute; muito difundida e qualquer projeto mais complexo pode se utilizar desta t&eacute;cnica para resolver problemas comuns de l&oacute;gica.\r\n<br><br>\r\nCom a utiliza&ccedil;&atilde;o, foi-se criando um padr&atilde;o de implementa&ccedil;&atilde;o para esse objeto e n&atilde;o &eacute; &agrave; toa que os autores Erich Gamma, Richard Helm, Ralph Johnson e John Vlissides, inclu&iacute;ram um padr&atilde;o que pode ser usado para implementar a FSM em C++ no livro &quot;Design Patterns: Elements of Reusable Object-Oriented Software&quot;.\r\n<br><br>\r\nEu j&aacute; encontrei FSMs em implementa&ccedil;&otilde;es de jogos, algoritmos de intelig&ecirc;ncia artificial, algoritmos de parsing (compiladores) e em muitos outros lugares, ou seja, &eacute; muito importante para qualquer desenvolvedor de jogos entender o funcionamento das M&aacute;quinas de Estado Finito.\r\n<br><br>\r\nO estudo das FSMs &eacute; normalmente conhecido como a Teoria dos Aut&ocirc;matos ou ainda Teoria da Computa&ccedil;&atilde;o e ela &eacute; ensinada nas universidades para a implementa&ccedil;&atilde;o de compiladores e algoritmos de parsing, apesar de ter muitas outras aplica&ccedil;&otilde;es.\r\n<br><br>\r\nVamos ent&atilde;o ao significado do termo: FSM &eacute; um modelo de comportamento composto por um número finito de estados, transi&ccedil;&otilde;es e eventos que geram essas transi&ccedil;&otilde;es.\r\n<br><br>\r\nUm modelo &eacute; uma interpreta&ccedil;&atilde;o ou abstra&ccedil;&atilde;o de uma realidade para que possamos compreender e utilizar o objeto com maior facilidade.\r\n<br><br>\r\nPortanto, a m&aacute;quina de estados cria um modelo do comportamento de um objeto para que possamos utiliz&aacute;-lo em nossas aplica&ccedil;&otilde;es.\r\n<br><br>\r\nPor número finito de estados queremos dizer que n&oacute;s podemos contar quantos estados a m&aacute;quina possui.\r\n<br><br>\r\nLogo, esse modelo de comportamento pode assumir um número limitado de estados.\r\n<br><br>\r\nCom base nisso, n&oacute;s podemos representar uma FSM atrav&eacute;s de um &quot;diagrama de transi&ccedil;&atilde;o de estados&quot; ou atrav&eacute;s de um &quot;diagrama de estados&quot; definido na UML.\r\n<br><br>\r\nN&atilde;o vou me aprofundar nos diagramas citados acima, pois eles n&atilde;o entram no escopo deste tutorial.\r\n<br><br>\r\nO que eu vim aqui mostrar &eacute; uma implementa&ccedil;&atilde;o de uma FSM utilizando o State Pattern definido no livro de Padr&otilde;es de Projetos do Erich Gamma.\r\n<br><br>\r\nVamos ao exemplo...\r\n<br><br>','2008-04-05 15:41:09',1,3,1),
 (13,'Simplificando o modelo, vamos imaginar um jogo qualquer bem simples. A minha id&eacute;ia &eacute; criar um jogo que possua uma tela de apresenta&ccedil;&atilde;o, uma tela de menu e uma tela com o jogo em si. Dessa forma, conclu&iacute;mos que o número de estados dessa aplica&ccedil;&atilde;o &eacute; 3 (tr&ecirc;s).\r\n<br><br>\r\nAs transi&ccedil;&otilde;es entre os estados s&atilde;o acionadas a partir de certos eventos. Vamos tentar relacion&aacute;-los aqui:\r\n<br><br>\r\nQuando o jogo entra na tela de apresenta&ccedil;&atilde;o n&atilde;o &eacute; poss&iacute;vel que o jogador saia da tela. Ele ter&aacute; que aguardar 5 segundos para que ocorra a primeira transi&ccedil;&atilde;o de estado. Ap&oacute;s os 5 segundos, um evento ocorrer&aacute; e a transi&ccedil;&atilde;o para o estado de menu ser&aacute; acionada. Portanto, o primeiro evento de transi&ccedil;&atilde;o &eacute; o tempo alcan&ccedil;ar 5 segundos ap&oacute;s a entrada na m&aacute;quina.\r\n<br><br>\r\nDentro do estado de menu, o jogador pode sair da aplica&ccedil;&atilde;o pressionando o bot&atilde;o sa&iacute;da ou pode entrar no estado jogo, pressionando o bot&atilde;o jogar. As transi&ccedil;&otilde;es nesse estado ocorrem somente com o pressionamento de dois bot&otilde;es.\r\n<br><br>\r\nPor último, o jogador estando dentro da tela de jogo, pode sair da mesma pressionando o bot&atilde;o ESC no teclado. Ao sair desse estado, a m&aacute;quina volta para o estado menu.\r\n<br><br>\r\nVamos visualizar em um diagrama de estados da UML o modelo de comportamento desse jogo:\r\n<br><br>\r\n<img src=\'/schifers/images/art02/MaquinaEstado.jpg\' border=\'0\'>\r\n<br><br>\r\nCom esse diagrama, conseguimos ver exatamento o comportamento do jogo mapeado em um modelo de FSM.\r\n<br><br>\r\nAp&oacute;s ter definido nosso modelo, podemos come&ccedil;ar a implementar.\r\n<br><br>\r\nComo meu objetivo &eacute; mostrar a implementa&ccedil;&atilde;o do State Pattern, n&atilde;o vou apresentar uma aplica&ccedil;&atilde;o gr&aacute;fica aqui. Tudo ser&aacute; implementado no console do DOS.\r\n<br><br>\r\nAo c&oacute;digo ent&atilde;o...\r\n<br><br>\r\nCrie um projeto vazio com o nome de MaquinaEstado no Dev-C++.\r\n<br><br>\r\nAcrescente os seguintes arquivos no projeto:\r\n<br><br>\r\n- Main.cpp\r\n<br>\r\n- Global.h\r\n<br>\r\n- Maquina.cpp\r\n<br>\r\n- Maquina.h\r\n<br>\r\n- Estado.cpp\r\n<br>\r\n- Estado.h\r\n<br>\r\n- Estados.cpp\r\n<br>\r\n- Estados.h\r\n<br><br>\r\nPronto, agora pegue o arquivo Main.cpp e inclua o seguinte c&oacute;digo nele:\r\n<br><br>\r\n<center>\r\n<table width=\'90%\' cellspacing=\'0\' cellpadding=\'0\' bgcolor=\'#EEEEEE\'>\r\n<tr>\r\n<td>\r\n<font face=\'arial\' color=\'#000000\' size=\'1\'>\r\n#include&nbsp;&quot;Global.h&quot;&nbsp;<br>\r\n<br>\r\nint&nbsp;main()<br>\r\n{<br>\r\n&nbsp;&nbsp;//&nbsp;Loop&nbsp;principal&nbsp;do&nbsp;jogo<br>\r\n&nbsp;&nbsp;while(1)<br>\r\n&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Implementa&ccedil;&atilde;o&nbsp;dos&nbsp;eventos:&nbsp;teclas&nbsp;ESC,&nbsp;j&nbsp;e&nbsp;q,&nbsp;e&nbsp;evento&nbsp;de&nbsp;tempo&nbsp;terminado<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;if(kbhit())<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;int&nbsp;tecla&nbsp;=&nbsp;getch();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(tecla&nbsp;==&nbsp;27)&nbsp;//&nbsp;tecla&nbsp;ESC<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>\r\n		break;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;}<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Limpa&nbsp;a&nbsp;tela<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;system(&quot;cls&quot;);<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Desenha&nbsp;na&nbsp;tela<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;printf(&quot;Loop&quot;);<br>\r\n&nbsp;&nbsp;}<br>\r\n<br>\r\n&nbsp;&nbsp;return&nbsp;0;<br>\r\n}&nbsp;\r\n</font>\r\n</td>\r\n</tr>\r\n</table>\r\n</center>\r\n<br><br>\r\nPegue o arquivo Global.h e insira o seguinte c&oacute;digo:\r\n<br><br>\r\n<center>\r\n<table width=\'90%\' cellspacing=\'0\' cellpadding=\'0\' bgcolor=\'#EEEEEE\'>\r\n<tr>\r\n<td>\r\n<font face=\'arial\' color=\'#000000\' size=\'1\'>\r\n#include &lt;stdio.h&gt;<br>\r\n#include &lt;conio.h&gt;<br>\r\n#include &lt;stdlib.h&gt;<br>\r\n#include &lt;time.h&gt;<br>\r\n</font>\r\n</td>\r\n</tr>\r\n</table>\r\n</center>\r\n<br>\r\nComo eu disse, n&atilde;o estaremos usando nada gr&aacute;fico aqui.\r\n<br><br>\r\nCompile o programa e execute. Esse programa &eacute; um modelo simplificado de jogo. Voc&ecirc; pode observar no c&oacute;digo de Main.cpp o loop principal da aplica&ccedil;&atilde;o que espera entradas no teclado, comando kbhit() e getch(). Caso ocorra algum pressionar de bot&atilde;o, o programa armazena a tecla pressionada na vari&aacute;vel espec&iacute;fica e caso a tecla pressionada seja um ESC, o loop &eacute; interrompido com o comando break.\r\n<br><br>\r\nMais a frente no c&oacute;digo, podemos encontrar a simula&ccedil;&atilde;o de uma limpeza no buffer da tela, comando system(&quot;cls&quot;), e podemos encontrar o comando printf() que simula o desenhar da tela. Tudo isso dentro de um modelo simplificado que tem como objetivo excluir a complexidade do desenvolvimento de um jogo para que possamos focar o problema na implementa&ccedil;&atilde;o de uma FSM.\r\n<br><br>\r\nNo c&oacute;digo de Global.h voc&ecirc; pode encontrar as bibliotecas padr&atilde;o do C que estamos usando nessa aplica&ccedil;&atilde;o.\r\n<br><br>\r\nCom essa aplica&ccedil;&atilde;o, n&oacute;s j&aacute; podemos receber 3 dos eventos que acionam as transi&ccedil;&otilde;es de estado da m&aacute;quina:\r\n<br><br>\r\n- Pressionar da tecla &quot;j&quot; para jogar\r\n- Pressionar da tecla &quot;q&quot; para sair\r\n- Pressionar da tecla &quot;ESC&quot;\r\n<br><br>\r\nEst&aacute; faltando somente um dos eventos relacionados anteriormente no tutorial:\r\n<br><br>\r\n- limite de tempo de 5 segundos alcan&ccedil;ado ap&oacute;s a entrada da aplica&ccedil;&atilde;o\r\n<br><br>\r\nAcrescente o c&oacute;digo em vermelho na fun&ccedil;&atilde;o main para podermos monitorar o tempo:\r\n<br><br>\r\n<center>\r\n<table width=\'90%\' cellspacing=\'0\' cellpadding=\'0\' bgcolor=\'#EEEEEE\'>\r\n<tr>\r\n<td>\r\n<font face=\'arial\' color=\'#000000\' size=\'1\'>\r\n#include &quot;Global.h&quot;\r\n<br><br>\r\nint main()<br>\r\n{<br>\r\n&nbsp;&nbsp;<font color=\'#FF0000\'>// Tempo</font><br>\r\n&nbsp;&nbsp;<font color=\'#FF0000\'>time_t timer_start;</font><br>\r\n&nbsp;&nbsp;<font color=\'#FF0000\'>time_t timer_current;</font><br>\r\n<br>\r\n&nbsp;&nbsp;<font color=\'#FF0000\'>timer_start = time(NULL);</font><br>\r\n<br>\r\n&nbsp;&nbsp;<font color=\'#FF0000\'>double diff = 0;</font><br>\r\n<br>\r\n&nbsp;&nbsp;// Loop principal do jogo<br>\r\n&nbsp;&nbsp;while(1)<br>\r\n&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<font color=\'#FF0000\'>timer_current = time(NULL);</font><br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<font color=\'#FF0000\'>diff = difftime(timer_current, timer_start);</font><br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;if(kbhit())<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;int tecla = getch();<br>\r\n      <br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(tecla == 27)<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;}<br>\r\n	<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;// Limpa a tela<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;system(&quot;cls&quot;);<br>\r\n	<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;// Desenha na tela<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<font color=\'#FF0000\'>printf(&quot;Loop: %4.2f\n&quot;, diff);</font><br>\r\n&nbsp;&nbsp;}<br>\r\n<br>\r\n&nbsp;&nbsp;return 0;<br>\r\n}\r\n</font>\r\n</td>\r\n</tr>\r\n</table>\r\n</center>\r\n<br><br>\r\nPronto, a partir de agora somos capazes de capturar qualquer evento necess&aacute;rio para que as transi&ccedil;&otilde;es existentes no nosso modelo sejam acionadas. Est&aacute; na hora de come&ccedil;ar a implementar os estados da m&aacute;quina.\r\n<br><br>','2008-04-05 15:48:20',1,4,1);
INSERT INTO `paragraphs` (`para_id`,`para_text`,`para_date`,`para_order`,`para_page_id`,`para_user_id`) VALUES 
 (14,'Segundo Erich Gamma, inicialmente, temos que implementar uma classe abstrata chamada, no meu caso, de Estado e essa classe, basicamente, ir&aacute; implementar uma interface comum para todos os estados do jogo. As subclasses de Estado, implementam, ent&atilde;o, comportamentos espec&iacute;ficos a cada um destes estados.\r\n<br><br>\r\nO modelo n&atilde;o &eacute; complicado. Segue abaixo um diagrama de classes do modelo que irei implementar baseado no livro do Gamma.\r\n<br><br>\r\n<img src=\'/schifers/images/art02/MaquinaEstadoClasse.jpg\' border=\'0\'>\r\n<br><br>\r\nNesse modelo, a classe Maquina mant&eacute;m uma inst&acirc;ncia da classe Estado e a utiliza para executar opera&ccedil;&otilde;es espec&iacute;ficas ao estado do jogo.\r\n<br><br>\r\nToda vez que um estado muda, ou melhor, quando ocorre uma transi&ccedil;&atilde;o de estados, a inst&acirc;ncia de Estado da classe Maquina muda.\r\n<br><br>\r\nPrimeiramente, vamos observar o c&oacute;digo da classe Estado, pai de todos os estados do jogo. Abra o arquivo Estado.h e acrescente o c&oacute;digo abaixo:\r\n<br><br>\r\n<center>\r\n<table width=\'90%\' cellspacing=\'0\' cellpadding=\'0\' bgcolor=\'#EEEEEE\'>\r\n<tr>\r\n<td>\r\n<font face=\'arial\' color=\'#000000\' size=\'1\'>\r\n#ifndef&nbsp;ESTADO_H<br>\r\n#define&nbsp;ESTADO_H<br>\r\n<br>\r\nclass&nbsp;Estado<br>\r\n{<br>\r\n&nbsp;&nbsp;public:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Eventos&nbsp;de&nbsp;mudan&ccedil;a&nbsp;de&nbsp;estado<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;virtual&nbsp;void&nbsp;AoPressionarJogar(Maquina*&nbsp;maquina)&nbsp;{};<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;virtual&nbsp;void&nbsp;AoPressionarSair(Maquina*&nbsp;maquina)&nbsp;{};<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;virtual&nbsp;void&nbsp;AoPressionarESC(Maquina*&nbsp;maquina)&nbsp;{};<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;virtual&nbsp;void&nbsp;AoTerminarTempo(Maquina*&nbsp;maquina)&nbsp;{};<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Executa&nbsp;o&nbsp;evento&nbsp;de&nbsp;entrada&nbsp;do&nbsp;estado<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;virtual&nbsp;void&nbsp;AoEntrar()&nbsp;{};<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Executa&nbsp;um&nbsp;frame&nbsp;de&nbsp;anima&ccedil;&atilde;o&nbsp;do&nbsp;estado&nbsp;atual<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;virtual&nbsp;void&nbsp;ExecutaFrame()&nbsp;{};<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Executa&nbsp;o&nbsp;evento&nbsp;de&nbsp;sa&iacute;da&nbsp;do&nbsp;estado<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;virtual&nbsp;void&nbsp;AoSair()&nbsp;{};<br>\r\n&nbsp;&nbsp;protected:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;ExecutaTransicao(Maquina*&nbsp;maquina,&nbsp;Estado*&nbsp;estado);<br>\r\n};<br>\r\n<br>\r\n#endif\r\n</font>\r\n</td>\r\n</tr>\r\n</table>\r\n</center>\r\n<br><br>\r\nA nossa classe Estado possui um m&eacute;todo para cada evento tratado pela m&aacute;quina. Esses m&eacute;todos s&atilde;o abstratos (virtual) e podem ser reescritos nas classes filhas de Estado, ou seja, cada um dos estados do jogo ter&aacute; o tratamento de um evento espec&iacute;fico para o seu caso. Lembrando que n&atilde;o existe a necessidade de implementa&ccedil;&atilde;o de todos os m&eacute;todos de evento na classe filha, vou explicar isso mais a frente quando eu mostrar a implementa&ccedil;&atilde;o dessa classe.\r\n<br><br>\r\nComo meus estados s&atilde;o estados de um jogo, antes de executar o frame de anima&ccedil;&atilde;o, eu preciso instanciar todos os objetos que irei utilizar na tela e os meus controladores de objetos, al&eacute;m de outras coisas. Por isso que crio dois eventos de estado que s&atilde;o: AoEntrar() e AoSair(). No momento em que executo uma transi&ccedil;&atilde;o de estados, eu fa&ccedil;o uma chamada ao m&eacute;todo AoSair() do estado atual, pois a m&aacute;quina ir&aacute; sair desse estado no momento da transi&ccedil;&atilde;o e ap&oacute;s que ocorrer a transi&ccedil;&atilde;o eu fa&ccedil;o uma chamada ao m&eacute;todo AoEntrar() do estado atual, pois o estado foi alterado para um novo estado. Esses dois m&eacute;todos s&atilde;o chamados antes e depois da transi&ccedil;&atilde;o e eles s&atilde;o respons&aacute;veis por instanciar e liberar os recursos usados no Estado em quest&atilde;o.\r\n<br><br>\r\nO m&eacute;todo ExecutaFrame() &eacute; usado para a l&oacute;gica contida no loop do jogo referente a um estado espec&iacute;fico. &Eacute; nesse m&eacute;todo que eu, por exemplo, no EstadoJogo desenho e atualizo o jogador, os inimigos, os tiros, etc.\r\n<br><br>\r\nPor último, o m&eacute;todo ExecutaTransicao() &eacute; utilizado para chamar os m&eacute;todos AoSair() e AoEntrar() e para executar a transi&ccedil;&atilde;o de estados em si. Ele &eacute; implementado na classe pai Estado, pois a l&oacute;gica deve ser a mesma para todos os estados filhos desta classe.\r\n<br><br>\r\nVamos observar o c&oacute;digo de implementa&ccedil;&atilde;o dessa classe Estado:\r\n<br><br>\r\n<center>\r\n<table width=\'90%\' cellspacing=\'0\' cellpadding=\'0\' bgcolor=\'#EEEEEE\'>\r\n<tr>\r\n<td>\r\n<font face=\'arial\' color=\'#000000\' size=\'1\'>\r\n#include&nbsp;&quot;Global.h&quot;<br>\r\n<br>\r\nvoid&nbsp;Estado::ExecutaTransicao(Maquina*&nbsp;maquina,&nbsp;Estado*&nbsp;estado)<br>\r\n{<br>\r\n&nbsp;&nbsp;maquina->ExecutaTransicao(estado);<br>\r\n}\r\n</font>\r\n</td>\r\n</tr>\r\n</table>\r\n</center>\r\n<br><br>\r\nO único m&eacute;todo que temos que implementar aqui &eacute; o m&eacute;todo ExecutaTransicao(). Ao ser chamado, ele informa &agrave; m&aacute;quina, atrav&eacute;s do m&eacute;todo maquina->ExecutaTransicao(estado) o novo estado que a m&aacute;quina vai assumir como estado corrente.\r\n<br><br>','2008-04-05 15:52:43',1,5,1),
 (15,'Vamos observar o codigo da classe Maquina. Abra o arquivo Maquina.h e inclua o seguinte c&oacute;digo nele:\r\n<br><br>\r\n<center>\r\n<table width=\'90%\' cellspacing=\'0\' cellpadding=\'0\' bgcolor=\'#EEEEEE\'>\r\n<tr>\r\n<td>\r\n<font face=\'arial\' color=\'#000000\' size=\'1\'>\r\n#ifndef&nbsp;MAQUINA_H<br>\r\n#define&nbsp;MAQUINA_H<br>\r\n<br>\r\nclass&nbsp;Estado;<br>\r\n<br>\r\nclass&nbsp;Maquina<br>\r\n{<br>\r\n&nbsp;&nbsp;private:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Inst&acirc;ncia&nbsp;única&nbsp;da&nbsp;classe&nbsp;(Singleton)<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;Maquina*&nbsp;m_pInstancia;<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Estado&nbsp;atual<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;class&nbsp;Estado*&nbsp;m_pEstadoAtual;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Indica&nbsp;se&nbsp;a&nbsp;m&aacute;quina&nbsp;tem&nbsp;que&nbsp;parar<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;bool&nbsp;m_Finalizar;<br>\r\n&nbsp;&nbsp;public:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Construtor&nbsp;da&nbsp;classe<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;Maquina();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Cria&nbsp;a&nbsp;inst&acirc;ncia&nbsp;única&nbsp;da&nbsp;classe&nbsp;(Singleton)<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;Maquina*&nbsp;CriaInstancia();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Executa&nbsp;um&nbsp;frame&nbsp;de&nbsp;anima&ccedil;&atilde;o&nbsp;do&nbsp;estado&nbsp;atual<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;ExecutaFrame();<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Executa&nbsp;transi&ccedil;&atilde;o&nbsp;de&nbsp;estados<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;ExecutaTransicao(Estado*&nbsp;estado);<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Finaliza&nbsp;a&nbsp;m&aacute;quina<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;Finalizar();<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Pergunta&nbsp;se&nbsp;pode&nbsp;finalizar&nbsp;a&nbsp;m&aacute;quina<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;bool&nbsp;PodeFinalizar();<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Eventos&nbsp;de&nbsp;mudan&ccedil;a&nbsp;de&nbsp;estado<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoPressionarJogar();<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoPressionarSair();<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoPressionarESC();<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoTerminarTempo();<br>\r\n};<br>\r\n<br>\r\n#endif\r\n</font>\r\n</td>\r\n</tr>\r\n</table>\r\n</center>\r\n<br><br>\r\nNesse fragmento acima n&oacute;s temos a classe Maquina que ir&aacute; controlar as mudan&ccedil;as de estado do meu jogo. Ao criar o objeto Maquina, eu utilizarei o padr&atilde;o Singleton garantindo que eu tenha somente uma inst&acirc;ncia dessa classe em toda a execu&ccedil;&atilde;o da minha aplica&ccedil;&atilde;o. Esse padr&atilde;o n&atilde;o me deixa cometer o erro de criar duas inst&acirc;ncias dessa classe. Para aprender mais sobre o Singleton consulte o livro do Gamma ou procure na Internet, existem v&aacute;rios sites que mostram como implement&aacute;-lo. Esse padr&atilde;o ser&aacute; assunto de um tutorial futuro aqui na Schifer. O atributo m_pInstancia aponta para a inst&acirc;ncia única da m&aacute;quina e o m&eacute;todo CriaInstancia() &eacute; o respons&aacute;vel pela cria&ccedil;&atilde;o da inst&acirc;ncia única.\r\n<br><br>\r\nO segundo atributo da classe Maquina &eacute; uma refer&ecirc;ncia para o estado corrente do meu jogo: m_pEstadoAtual.\r\n<br><br>\r\nEm seguida, eu coloco um atributo booleano que informa se a m&aacute;quina ir&aacute; finalizar ou n&atilde;o. Caso esse atributo assuma um valor verdadeiro, a m&aacute;quina ir&aacute; informar &agrave; aplica&ccedil;&atilde;o que o loop principal deve ser interrompido atrav&eacute;s de um comando break. Quem informa a aplica&ccedil;&atilde;o &eacute; o m&eacute;todo PodeFinalizar(). Esse m&eacute;todo &eacute; chamado no meio do loop principal. Existe ainda um m&eacute;todo Finalizar() que pode ser chamado em qualquer lugar da aplica&ccedil;&atilde;o informando que a partir de agora, a m&aacute;quina pode interromper o fluxo de execu&ccedil;&atilde;o, ou seja, esse m&eacute;todo informa que j&aacute; pode finalizar e o m&eacute;todo PodeFinalizar() s&oacute; responde a pergunta, pois em um ponto espec&iacute;fico da execu&ccedil;&atilde;o, precisamos perguntar se podemos ou n&atilde;o executar o comando break.\r\n<br><br>\r\nTemos, ent&atilde;o, o construtor da classe que limpa os ponteiros e faz com que a vari&aacute;vel m_Finalizar receba falso, pois quando for verdadeiro, ela ir&aacute; terminar a execu&ccedil;&atilde;o do loop principal.\r\n<br><br>\r\nAp&oacute;s o construtor, temos o m&eacute;todo CriaInstancia() do Singleton.\r\n<br><br>\r\nDepois do m&eacute;todo do Singleton, temos o m&eacute;todo ExecutaFrame(). Ele &eacute; respons&aacute;vel por chamar o m&eacute;todo ExecutaFrame() do estado corrente.\r\n<br><br>\r\nOs dois m&eacute;todos seguintes s&atilde;o os m&eacute;todos de finaliza&ccedil;&atilde;o da m&aacute;quina j&aacute; explicado.\r\n<br><br>\r\nPor último, n&oacute;s temos os m&eacute;todos que lan&ccedil;am os eventos que a m&aacute;quina trata. Para cada evento tratado, deve existir um m&eacute;todo de lan&ccedil;amento desse evento. Eu poderia trocar esses nomes por nomes mais conceituais de jogo, mas para manter a complexidade baixa, eu chamei os m&eacute;todos com os nomes das teclas que ser&atilde;o pressionadas, mas isso acabe a voc&ecirc; decidir como ir&aacute; implementar.\r\n<br><br>\r\nVamos observar o c&oacute;digo de implementa&ccedil;&atilde;o dos m&eacute;todos acima:\r\n<br><br>\r\n<center>\r\n<table width=\'90%\' cellspacing=\'0\' cellpadding=\'0\' bgcolor=\'#EEEEEE\'>\r\n<tr>\r\n<td>\r\n<font face=\'arial\' color=\'#000000\' size=\'1\'>\r\n#include&nbsp;&quot;Global.h&quot;<br>\r\n<br>\r\nMaquina::Maquina()<br>\r\n{<br>\r\n&nbsp;&nbsp;m_pEstadoAtual&nbsp;=&nbsp;0;<br>\r\n&nbsp;&nbsp;m_Finalizar&nbsp;=&nbsp;false;<br>\r\n}<br>\r\n<br>\r\n//&nbsp;Defini&ccedil;&atilde;o&nbsp;do&nbsp;atributo&nbsp;inst&acirc;ncia<br>\r\nMaquina*&nbsp;Maquina::m_pInstancia&nbsp;=&nbsp;0;<br>\r\n<br>\r\n//&nbsp;Cria&nbsp;a&nbsp;inst&acirc;ncia&nbsp;única&nbsp;da&nbsp;classe&nbsp;(Singleton)<br>\r\nMaquina*&nbsp;Maquina::CriaInstancia()<br>\r\n{<br>\r\n&nbsp;&nbsp;if(m_pInstancia&nbsp;==&nbsp;0)<br>\r\n&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;m_pInstancia&nbsp;=&nbsp;new&nbsp;Maquina();<br>\r\n&nbsp;&nbsp;}<br>\r\n&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;return&nbsp;m_pInstancia;<br>\r\n}<br>\r\n<br>\r\n//&nbsp;Executa&nbsp;uma&nbsp;transi&ccedil;&atilde;o&nbsp;de&nbsp;estado<br>\r\nvoid&nbsp;Maquina::ExecutaTransicao(Estado*&nbsp;estado)<br>\r\n{<br>\r\n&nbsp;&nbsp;//&nbsp;Executa&nbsp;o&nbsp;evento&nbsp;AoSair()&nbsp;do&nbsp;estado&nbsp;antigo&nbsp;antes&nbsp;de&nbsp;executar&nbsp;a&nbsp;transi&ccedil;&atilde;o<br>\r\n&nbsp;&nbsp;if(m_pEstadoAtual&nbsp;!=&nbsp;0)<br>\r\n&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;m_pEstadoAtual->AoSair();<br>\r\n&nbsp;&nbsp;}<br>\r\n<br>\r\n&nbsp;&nbsp;m_pEstadoAtual&nbsp;=&nbsp;estado;<br>\r\n&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;//&nbsp;Executa&nbsp;o&nbsp;evento&nbsp;AoEntrar()&nbsp;do&nbsp;estado&nbsp;novo&nbsp;logo&nbsp;ap&oacute;s&nbsp;executar&nbsp;a&nbsp;transi&ccedil;&atilde;o<br>\r\n&nbsp;&nbsp;m_pEstadoAtual->AoEntrar();<br>\r\n}<br>\r\n<br>\r\n//&nbsp;Executa&nbsp;um&nbsp;frame&nbsp;de&nbsp;anima&ccedil;&atilde;o&nbsp;do&nbsp;estado&nbsp;atual<br>\r\nvoid&nbsp;Maquina::ExecutaFrame()<br>\r\n{<br>\r\n&nbsp;&nbsp;m_pEstadoAtual->ExecutaFrame();<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;Maquina::Finalizar()<br>\r\n{<br>\r\n&nbsp;&nbsp;m_Finalizar&nbsp;=&nbsp;true;<br>\r\n}<br>\r\n<br>\r\nbool&nbsp;Maquina::PodeFinalizar()<br>\r\n{<br>\r\n&nbsp;&nbsp;return&nbsp;m_Finalizar;<br>\r\n}<br>\r\n<br>\r\n//&nbsp;Eventos&nbsp;de&nbsp;mudan&ccedil;a&nbsp;de&nbsp;estado<br>\r\nvoid&nbsp;Maquina::AoPressionarJogar()<br>\r\n{<br>\r\n&nbsp;&nbsp;m_pEstadoAtual->AoPressionarJogar(this);<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;Maquina::AoPressionarSair()<br>\r\n{<br>\r\n&nbsp;&nbsp;m_pEstadoAtual->AoPressionarSair(this);<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;Maquina::AoPressionarESC()<br>\r\n{<br>\r\n&nbsp;&nbsp;m_pEstadoAtual->AoPressionarESC(this);<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;Maquina::AoTerminarTempo()<br>\r\n{<br>\r\n&nbsp;&nbsp;m_pEstadoAtual->AoTerminarTempo(this);<br>\r\n}\r\n</font>\r\n</td>\r\n</tr>\r\n</table>\r\n</center>\r\n<br><br>\r\nO c&oacute;digo come&ccedil;a com o construtor que j&aacute; foi explicado anteriormente, assim como o pr&oacute;ximo m&eacute;todo que &eacute; o respons&aacute;vel pela cria&ccedil;&atilde;o do Singleton.\r\n<br><br>\r\nO m&eacute;todo ExecutaTransicao() &eacute; o respons&aacute;vel pela troca de estados. Existe um teste inicial que verifica se o valor do estado corrente &eacute; zero, pois se for, um erro ser&aacute; lan&ccedil;ado ao se tentar usar um m&eacute;todo a partir de um ponteiro para objeto vazio. Esse teste &eacute; necess&aacute;rio, pois n&atilde;o podemos chamar o m&eacute;todo OnSair() na primeira vez que estivermos executando a m&aacute;quina. Em seguida ele muda a refer&ecirc;ncia do estado atual e logo em seguida chama o m&eacute;todo OnEntrar() para o novo objeto que o ponteiro estar&aacute; referenciando.\r\n<br><br>\r\nAp&oacute;s trocar o estado, temos o m&eacute;todo ExecutaFrame() que como foi explicado anteriormente, chama o ExecutaFrame() do estado atual.\r\n<br><br>\r\nTemos ent&atilde;o os m&eacute;todos que fazem o controle de finaliza&ccedil;&atilde;o da m&aacute;quina, j&aacute; explicados, e os m&eacute;todos que implementam os eventos que a m&aacute;quina trata. Todos eles chamam seus respectivos m&eacute;todos nas classes filhas. &Eacute; nas classes filhas que implementamos a l&oacute;gica das transi&ccedil;&otilde;es, pois dependendo do evento que ocorrer e do estado atual, o pr&oacute;prio estado indica qual o pr&oacute;ximo estado que a m&aacute;quina assumir&aacute;.\r\n<br><br>','2008-04-05 15:57:49',1,6,1);
INSERT INTO `paragraphs` (`para_id`,`para_text`,`para_date`,`para_order`,`para_page_id`,`para_user_id`) VALUES 
 (16,'Vamos implementar agora os 3 estados deste jogo. Copie o c&oacute;digo seguinte para o arquivo Estados.h.\r\n<br><br>\r\n<center>\r\n<table width=\'90%\' cellspacing=\'0\' cellpadding=\'0\' bgcolor=\'#EEEEEE\'>\r\n<tr>\r\n<td>\r\n<font face=\'arial\' color=\'#000000\' size=\'1\'>\r\n#ifndef&nbsp;ESTADOS_H<br>\r\n#define&nbsp;ESTADOS_H<br>\r\n<br>\r\nclass&nbsp;EstadoApresentacao&nbsp;:&nbsp;public&nbsp;Estado<br>\r\n{<br>\r\n&nbsp;&nbsp;private:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Inst&acirc;ncia&nbsp;única&nbsp;da&nbsp;classe&nbsp;(Singleton)<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;EstadoApresentacao*&nbsp;m_pInstancia;<br>\r\n&nbsp;&nbsp;public:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Cria&nbsp;a&nbsp;inst&acirc;ncia&nbsp;única&nbsp;da&nbsp;classe&nbsp;(Singleton)<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;EstadoApresentacao*&nbsp;CriaInstancia();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoEntrar();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;ExecutaFrame();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoSair();<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Eventos&nbsp;de&nbsp;mudan&ccedil;a&nbsp;de&nbsp;estado<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoTerminarTempo(Maquina*&nbsp;maquina);<br>\r\n};<br>\r\n<br>\r\nclass&nbsp;EstadoMenu&nbsp;:&nbsp;public&nbsp;Estado<br>\r\n{<br>\r\n&nbsp;&nbsp;private:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Inst&acirc;ncia&nbsp;única&nbsp;da&nbsp;classe&nbsp;(Singleton)<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;EstadoMenu*&nbsp;m_pInstancia;<br>\r\n&nbsp;&nbsp;public:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Cria&nbsp;a&nbsp;inst&acirc;ncia&nbsp;única&nbsp;da&nbsp;classe&nbsp;(Singleton)<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;EstadoMenu*&nbsp;CriaInstancia();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoEntrar();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;ExecutaFrame();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoSair();<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Eventos&nbsp;de&nbsp;mudan&ccedil;a&nbsp;de&nbsp;estado<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoPressionarJogar(Maquina*&nbsp;maquina);<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoPressionarSair(Maquina*&nbsp;maquina);<br>\r\n};<br>\r\n<br>\r\nclass&nbsp;EstadoJogo&nbsp;:&nbsp;public&nbsp;Estado<br>\r\n{<br>\r\n&nbsp;&nbsp;private:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Inst&acirc;ncia&nbsp;única&nbsp;da&nbsp;classe&nbsp;(Singleton)<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;EstadoJogo*&nbsp;m_pInstancia;<br>\r\n&nbsp;&nbsp;public:<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Cria&nbsp;a&nbsp;inst&acirc;ncia&nbsp;única&nbsp;da&nbsp;classe&nbsp;(Singleton)<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;EstadoJogo*&nbsp;CriaInstancia();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoEntrar();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;ExecutaFrame();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoSair();<br>\r\n<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Eventos&nbsp;de&nbsp;mudan&ccedil;a&nbsp;de&nbsp;estado<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;void&nbsp;AoPressionarESC(Maquina*&nbsp;maquina);<br>\r\n};<br>\r\n<br>\r\n#endif\r\n</font>\r\n</td>\r\n</tr>\r\n</table>\r\n</center>\r\n<br><br>\r\nComo voc&ecirc; pode visualizar no c&oacute;digo, todos os meus estados s&atilde;o um Singleton, isso &eacute; recomenda&ccedil;&atilde;o do Erich Gamma em seu livro. Portanto, os 3 estados ter&atilde;o os m&eacute;todos e atributos referentes ao padr&atilde;o Singleton. O m&eacute;todo &eacute; o CriaInstancia() e o atributo &eacute; o m_pInstancia. Voc&ecirc; pode notar que todos os estados possuem esse m&eacute;todo e esse atributo.\r\n<br><br>\r\nEm seguida temos a declara&ccedil;&atilde;o dos 3 m&eacute;todos que foram declarados abstratos na classe Estado: AoSair(), ExecutarFrame() e AoEntrar(). Cada um desses m&eacute;todos j&aacute; foram explicados anteriormente, mas o que vou acrescentar &eacute; que cada um dos estados possui uma l&oacute;gica sua de sequ&ecirc;ncia de tarefas que eles v&atilde;o executar, ou seja, a l&oacute;gica &eacute; espec&iacute;fica para cada estado. Eu mostrarei isso na implementa&ccedil;&atilde;o do estado.\r\n<br><br>\r\nAp&oacute;s declarar os m&eacute;todos acima, encontramos os eventos da m&aacute;quina tratados por um estado espec&iacute;fico. Os estados n&atilde;o implementam todos os eventos e sim somente aqueles que ele ir&aacute; ser capaz de tratar. Por isso que no primeiro estado, voc&ecirc; encontra o m&eacute;todo AoTerminarTempo() e nos outros estados n&atilde;o. Esse m&eacute;todo s&oacute; &eacute; necess&aacute;rio no estado apresenta&ccedil;&atilde;o de acordo com as defini&ccedil;&otilde;es de nosso projeto. Isso vale para os outros estados tamb&eacute;m, voc&ecirc; ver&aacute; que cada um implementa os eventos necess&aacute;rios para ele.\r\n<br><br>\r\nAgora, observe a implementa&ccedil;&atilde;o da classe acima. Acrescente o c&oacute;digo abaixo no arquivo Estados.cpp:\r\n<br><br>\r\n<center>\r\n<table width=\'90%\' cellspacing=\'0\' cellpadding=\'0\' bgcolor=\'#EEEEEE\'>\r\n<tr>\r\n<td>\r\n<font face=\'arial\' color=\'#000000\' size=\'1\'>\r\n#include&nbsp;&quot;Global.h&quot;<br>\r\n<br>\r\nEstadoApresentacao*&nbsp;EstadoApresentacao::m_pInstancia&nbsp;=&nbsp;0;<br>\r\n<br>\r\nEstadoApresentacao*&nbsp;EstadoApresentacao::CriaInstancia()<br>\r\n{<br>\r\n&nbsp;&nbsp;if(m_pInstancia&nbsp;==&nbsp;0)<br>\r\n&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;m_pInstancia&nbsp;=&nbsp;new&nbsp;EstadoApresentacao();<br>\r\n&nbsp;&nbsp;}<br>\r\n&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;return&nbsp;m_pInstancia;<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoApresentacao::AoEntrar()<br>\r\n{<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoApresentacao::ExecutaFrame()<br>\r\n{<br>\r\n&nbsp;&nbsp;printf(&quot;\nApresentacao\n&quot;);<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoApresentacao::AoSair()<br>\r\n{<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoApresentacao::AoTerminarTempo(Maquina*&nbsp;maquina)<br>\r\n{<br>\r\n&nbsp;&nbsp;ExecutaTransicao(maquina,&nbsp;EstadoMenu::CriaInstancia());<br>\r\n}<br>\r\n<br>\r\nEstadoMenu*&nbsp;EstadoMenu::m_pInstancia&nbsp;=&nbsp;0;<br>\r\n<br>\r\nEstadoMenu*&nbsp;EstadoMenu::CriaInstancia()<br>\r\n{<br>\r\n&nbsp;&nbsp;if(m_pInstancia&nbsp;==&nbsp;0)<br>\r\n&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;m_pInstancia&nbsp;=&nbsp;new&nbsp;EstadoMenu();<br>\r\n&nbsp;&nbsp;}<br>\r\n&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;return&nbsp;m_pInstancia;<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoMenu::AoEntrar()<br>\r\n{<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoMenu::ExecutaFrame()<br>\r\n{<br>\r\n&nbsp;&nbsp;printf(&quot;\nMenu\n&quot;);<br>\r\n&nbsp;&nbsp;printf(&quot;\n-&nbsp;Pressione&nbsp;\'j\'&nbsp;para&nbsp;jogar&quot;);<br>\r\n&nbsp;&nbsp;printf(&quot;\n-&nbsp;Pressione&nbsp;\'q\'&nbsp;para&nbsp;sair\n\n&quot;);<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoMenu::AoSair()<br>\r\n{<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoMenu::AoPressionarSair(Maquina*&nbsp;maquina)<br>\r\n{<br>\r\n&nbsp;&nbsp;maquina->Finalizar();<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoMenu::AoPressionarJogar(Maquina*&nbsp;maquina)<br>\r\n{<br>\r\n&nbsp;&nbsp;ExecutaTransicao(maquina,&nbsp;EstadoJogo::CriaInstancia());<br>\r\n}<br>\r\n<br>\r\nEstadoJogo*&nbsp;EstadoJogo::m_pInstancia&nbsp;=&nbsp;0;<br>\r\n<br>\r\nEstadoJogo*&nbsp;EstadoJogo::CriaInstancia()<br>\r\n{<br>\r\n&nbsp;&nbsp;if(m_pInstancia&nbsp;==&nbsp;0)<br>\r\n&nbsp;&nbsp;{<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;m_pInstancia&nbsp;=&nbsp;new&nbsp;EstadoJogo();<br>\r\n&nbsp;&nbsp;}<br>\r\n&nbsp;&nbsp;<br>\r\n&nbsp;&nbsp;return&nbsp;m_pInstancia;<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoJogo::AoEntrar()<br>\r\n{<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoJogo::ExecutaFrame()<br>\r\n{<br>\r\n&nbsp;&nbsp;printf(&quot;\nJogo\n&quot;);<br>\r\n&nbsp;&nbsp;printf(&quot;\nPressione&nbsp;\'ESC\'&nbsp;para&nbsp;sair&quot;);<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoJogo::AoSair()<br>\r\n{<br>\r\n}<br>\r\n<br>\r\nvoid&nbsp;EstadoJogo::AoPressionarESC(Maquina*&nbsp;maquina)<br>\r\n{<br>\r\n&nbsp;&nbsp;ExecutaTransicao(maquina,&nbsp;EstadoMenu::CriaInstancia());<br>\r\n}\r\n</font>\r\n</td>\r\n</tr>\r\n</table>\r\n</center>\r\n<br><br>\r\nNo c&oacute;digo acima, n&oacute;s vemos o padr&atilde;o Singleton implementado para cada um dos estados (j&aacute; foi explicado anteriormente). Em seguida, n&atilde;o precisei implementar c&oacute;digo para os eventos AoSair() e AoEntrar(), pois a simplicidade do meu projeto n&atilde;o exige inicializa&ccedil;&atilde;o de objetos nos estados, ao contr&aacute;rio do m&eacute;todo ExecutaFrame(). Esse último necessita de um c&oacute;digo espec&iacute;fico, pois aqui eu imprimo a mensagem que indica na tela qual estado est&aacute; rodando nesse momento.\r\n<br><br>\r\nEm seguida, n&oacute;s encontraremos a implementa&ccedil;&atilde;o dos eventos. Basicamente, nesse tutorial, a l&oacute;gica da transi&ccedil;&atilde;o de um estado &eacute; simplesmente passar a inst&acirc;ncia da m&aacute;quina e a inst&acirc;ncia do novo estado. O m&eacute;todo ExecutaTransicao() implementado na classe Estado pai &eacute; ent&atilde;o chamado recebendo a m&aacute;quina e o novo estado. Ele chama ent&atilde;o, o m&eacute;todo ExecutaTransicao() da m&aacute;quina recebendo a inst&acirc;ncia do novo estado. Esse m&eacute;todo pegar&aacute; essa inst&acirc;ncia e indicar&aacute; que o seu atributo m_pEstadoAtual ir&aacute; receber a refer&ecirc;ncia para essa inst&acirc;ncia. Dessa forma, o estado atual muda e a m&aacute;quina assume um novo estado concreto.\r\n<br><br>\r\nSe voc&ecirc; quer fazer o download do projeto com o c&oacute;digo fonte completo deste tutorial no Dev-C++ <a href=\'http://rapidshare.com/files/105126414/tutorial.zip.html\'>clique aqui</a>.\r\n<br><br>\r\nCom isso, n&oacute;s terminamos mais um tutorial da Schifer. Se voc&ecirc; seguiu o tutorial inteiro e gostou ou n&atilde;o gostou do que leu, tem dúvidas sobre o que leu, ou quer apenas me mandar uma mensagem, sinta-se livre para me enviar um e-mail. Meu e-mail &eacute; <a href=\'mailto:schifers@hotmail.com\'>schifers@hotmail.com</a>. Agrade&ccedil;o a aten&ccedil;&atilde;o e espero que voc&ecirc;s tenham entendido tudo o que foi explicado aqui.\r\n<br><br>\r\nUm abra&ccedil;o a todos e at&eacute; o pr&oacute;ximo tutorial.\r\n<br><br>\r\nBruno Schifer\r\n<br><br>','2008-04-05 16:12:24',1,7,1);
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
  CONSTRAINT `priv_modu_fk` FOREIGN KEY (`priv_modu_id`) REFERENCES `modules` (`modu_id`),
  CONSTRAINT `priv_prof_fk` FOREIGN KEY (`priv_prof_id`) REFERENCES `profiles` (`prof_id`)
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

--
-- Dumping data for table `sessions`
--

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
) ENGINE=InnoDB;

--
-- Dumping data for table `shouts`
--

/*!40000 ALTER TABLE `shouts` DISABLE KEYS */;
INSERT INTO `shouts` (`shou_id`,`shou_text`,`shou_date`,`shou_user_id`) VALUES 
 (1,'Aten&ccedil;&atilde;o!<br><br>\r\nSite SCHIFER lan&ccedil;ado!<br><br>\r\nAguardem mais novidades em breve.<br><br>\r\nBruno Schifer','2008-03-30 16:30:00',1),
 (2,'Na se&ccedil;&atilde;o de artigos, a parte que trata da instala&ccedil;&atilde;o do Dev-C++ est&aacute; completa.','2008-03-31 09:00:00',1),
 (5,'Inseri um novo artigo no site. Aprenda a desenvolver uma m&aacute;quina de estados para os seus jogos.','2008-04-05 17:47:53',1);
/*!40000 ALTER TABLE `shouts` ENABLE KEYS */;


--
-- Definition of table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `subj_id` int(11) NOT NULL auto_increment,
  `subj_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`subj_id`)
) ENGINE=InnoDB;

--
-- Dumping data for table `subjects`
--

/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` (`subj_id`,`subj_name`) VALUES 
 (1,'Programa&ccedil;&atilde;o de Jogos em SDL'),
 (2,'Padr&otilde;es de Projeto para Jogos');
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
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`,`user_username`,`user_password`,`user_active`) VALUES 
 (1,'admin','fc04d9502d1beff39ec6740a526a55b2',1),
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
) ENGINE=InnoDB;

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
