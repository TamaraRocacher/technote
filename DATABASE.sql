-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Technote
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `Technote`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `Technote` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `Technote`;

--
-- Table structure for table `Answers`
--

DROP TABLE IF EXISTS `Answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `fk_answers_1` (`question_id`),
  KEY `fk_answers_2` (`user_id`),
  CONSTRAINT `fk_answers_1` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_answers_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Answers`
--

LOCK TABLES `Answers` WRITE;
/*!40000 ALTER TABLE `Answers` DISABLE KEYS */;
INSERT INTO `Answers` VALUES (7,'Oui',5,9,'2016-04-25 19:33:12'),(8,'non',5,9,'2016-04-25 19:33:17');
/*!40000 ALTER TABLE `Answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `fk_comments_1` (`note_id`),
  KEY `fk_comments_2` (`user_id`),
  CONSTRAINT `fk_comments_1` FOREIGN KEY (`note_id`) REFERENCES `Notes` (`note_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_comments_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (2,'Quel beau code!',23,20,'2016-04-26 19:39:57'),(3,'Merci bien !',23,9,'2016-04-26 19:40:52');
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `KeywordN`
--

DROP TABLE IF EXISTS `KeywordN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KeywordN` (
  `keyn_id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(15) NOT NULL,
  `note_id` int(11) NOT NULL,
  PRIMARY KEY (`keyn_id`),
  KEY `fk_note_id` (`note_id`),
  CONSTRAINT `fk_note_id` FOREIGN KEY (`note_id`) REFERENCES `Notes` (`note_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `KeywordN`
--

LOCK TABLES `KeywordN` WRITE;
/*!40000 ALTER TABLE `KeywordN` DISABLE KEYS */;
INSERT INTO `KeywordN` VALUES (60,'NeuralNetworks',23),(61,'neuron',23),(62,'neurons',23);
/*!40000 ALTER TABLE `KeywordN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `KeywordQ`
--

DROP TABLE IF EXISTS `KeywordQ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KeywordQ` (
  `keyq_id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(15) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`keyq_id`),
  KEY `fk_keywq_1` (`question_id`),
  CONSTRAINT `fk_keywq_1` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `KeywordQ`
--

LOCK TABLES `KeywordQ` WRITE;
/*!40000 ALTER TABLE `KeywordQ` DISABLE KEYS */;
INSERT INTO `KeywordQ` VALUES (14,'scala',5),(15,'java',5),(16,'reflexion',5),(20,'regex',7),(21,'regexp',7);
/*!40000 ALTER TABLE `KeywordQ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notes`
--

DROP TABLE IF EXISTS `Notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `texte` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`note_id`),
  KEY `fk_notes_1` (`user_id`),
  CONSTRAINT `fk_notes_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notes`
--

LOCK TABLES `Notes` WRITE;
/*!40000 ALTER TABLE `Notes` DISABLE KEYS */;
INSERT INTO `Notes` VALUES (23,'Neuron.h','Voici le code :\r\n<pre><code>\r\n#ifndef DEF_NEURON\r\n#define DEF_NEURON\r\n\r\n#include &lt;vector&gt;\r\n#include &lt;iostream&gt;\r\n#include &lt;cstdlib&gt;\r\n#include &lt;cassert&gt;\r\n#include &lt;cmath&gt;\r\n#include &lt;fstream&gt;\r\n#include &lt;sstream&gt;\r\n\r\n#include &quot;common.h&quot;\r\n\r\nclass Neuron\r\n{\r\npublic:\r\n    Neuron(unsigned numOutputs, unsigned myIndex);\r\n    void setOutputVal(double val) { m_outputVal = val; }\r\n    double getOutputVal(void) const { return m_outputVal; }\r\n    void feedForward(const Layer &amp;prevLayer);\r\n    void calcOutputGradients(double targetVal);\r\n    void calcHiddenGradients(const Layer &amp;nextLayer);\r\n    void updateInputWeights(Layer &amp;prevLayer);\r\n\r\nprivate:\r\n    static double eta;   // [0.0..1.0] overall net training rate\r\n    static double alpha; // [0.0..n] multiplier of last weight change (momentum)\r\n    static double transferFunction(double x);\r\n    static double transferFunctionDerivative(double x);\r\n    static double randomWeight(void) { return rand() / double(RAND_MAX); }\r\n    double sumDOW(const Layer &amp;nextLayer) const;\r\n    double m_outputVal;\r\n    std::vector&lt;Connection&gt; m_outputWeights;\r\n    unsigned m_myIndex;\r\n    double m_gradient;\r\n};\r\n\r\n#endif\r\n</code></pre> ',9,'2016-04-25 18:27:28');
/*!40000 ALTER TABLE `Notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Questions`
--

DROP TABLE IF EXISTS `Questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `texte` text NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `fk_questions_1` (`user_id`),
  CONSTRAINT `fk_questions_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Questions`
--

LOCK TABLES `Questions` WRITE;
/*!40000 ALTER TABLE `Questions` DISABLE KEYS */;
INSERT INTO `Questions` VALUES (5,'Scala bound type parameter and reflection','Could the following java code :\r\n<pre><code>\r\npublic &lt;T extends Enum&lt;T&gt;&gt; T foo(Class&lt;T&gt; clazz) {\r\n\r\n  return clazz.getEnumConstants()[0];\r\n}\r\n\r\npublic void bar(Class&lt;?&gt; clazz) {\r\n\r\n    if (Enum.class.isAssignableFrom(clazz)) {\r\n        System.out.println(foo(clazz.asSubclass(Enum.class)));\r\n    }\r\n}\r\n\r\nbar(MyEnum.class) // will print first value of MyEnum\r\nbar(String.class) // won\'t print anything\r\n\r\n</code></pre>\r\n\r\nbe translated to Scala ?',1,9,'2016-04-25 18:31:10'),(7,'Learning Regular Expressions','I don\'t really understand regular expressions. Can you explain them to me in an easy-to-follow manner? If there are any online tools or books, could you also link to them?',0,21,'2016-04-26 19:50:17');
/*!40000 ALTER TABLE `Questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (9,'meryll.essig@free.fr','6fbd05aca31e0aad518610791017f03719fcdc8a','Meryll',0),(20,'tamara.rocacher@gmail.com','c429bfd7bd2d1297e21f973e23f19375a101b60d','Tam',1),(21,'newbie@noob.com','34bcdf98deb05825ee8f40bad4b5912df89b0b95','Newbie',1);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-26 19:51:39
